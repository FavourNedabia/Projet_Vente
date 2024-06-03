<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Http\Requests\InitVenteRequest;
use App\Http\Requests\VendreRequest;
use App\Models\Article;
use App\Models\Categorie;
use App\Models\Client;
use App\Models\LigneVente;
use App\Models\Vente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class HomeController extends Controller
{
    public function index()
    {
        // Récupérer les 6 dernières ventes
        $ventes = Vente::orderBy('id', 'desc')->take(6)->get();

        // Récupérer les 4 produits les plus vendus du mois en cours
        $topProducts = LigneVente::select('article_id', DB::raw('SUM(quantite) as total_quantity'), DB::raw('SUM(montant) as total_sales'))
            ->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->groupBy('article_id')
            ->orderBy('total_quantity', 'desc')
            ->take(4)
            ->with('article')
            ->get();

        // Récupérer les 4 personnels qui ont réalisé le plus de ventes du mois en cours, basé sur la différence entre total et reste
        $topSellers = Vente::select('personnel_id', DB::raw('SUM(total) as total_sales'), DB::raw('SUM(reste) as total_remaining'), DB::raw('SUM(total - reste) as net_sales'))
            ->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->groupBy('personnel_id')
            ->orderBy('net_sales', 'desc')
            ->take(4)
            ->with('personnel')
            ->get();

        // Calculer le total des ventes dans la journée
        $totalSalesToday = Vente::whereDate('created_at', Carbon::today())->sum('total');

        // Calculer le total des paiements effectués dans la journée
        $totalPaymentsToday = Vente::whereDate('created_at', Carbon::today())->sum(DB::raw('total - reste'));

        // Calculer le total des restes à payer de la journée
        $totalRemainingToday  = Vente::whereDate('created_at', Carbon::today())->sum('reste');

        // Calculer le total des restes à payer
        $totalRemaining = Vente::sum('reste');

        return view('index', compact('ventes', 'topProducts', 'topSellers', 'totalSalesToday', 'totalPaymentsToday', 'totalRemaining', 'totalRemainingToday'));
    }



    public function ventes()
    {
        $ventes = Vente::orderBy('id', 'desc')->get();
        return view('ventes', compact('ventes'));
    }

    public function ligneVente()
    {
        $customers = Client::orderBy('id', 'desc')->get();
        $products = Article::orderBy('id', 'desc')->get();
        return view('ligne_vente', compact('customers', 'products'));
    }

    public function venteNext(InitVenteRequest $request)
    {
        $validatedData = $request->validated();
        $productIds = $validatedData['products'];
        $products = Article::whereIn('id', $productIds)->get();
        $customer = Client::find($request->input('customer')) ?? (object) [
            'id' => 0,
            'firstname' => $validatedData['firstname'],
            'lastname' => $validatedData['lastname'],
            'phone' => $validatedData['phone'],
            'address' => $validatedData['address'],
        ];

        return view('vente_next', compact('validatedData', 'products', 'customer'));
    }

    public function overview(Request $request)
    {
        $data = $request->all();
        $products = Article::whereIn('id', array_keys($data['quantities']))->get();
        $objects = [];
        foreach ($data['quantities'] as $productId => $quantity) {
            $article = Article::find($productId);
            if ($article) {
                $montant = $article->prix_vente * $quantity;
                $object = (object) [
                    'id' => $article->id,
                    'quantite' => $quantity,
                    'montant' => $montant,
                ];
                $objects[] = $object;
            }
        }

        $customerId = $data['customer'];
        if ($customerId != 0) {
            $customer = Client::find($customerId);
        } else {
            $customer = (object) [
                'id' => 0,
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'phone' => $data['phone'],
                'address' => $data['address'],
            ];
        }

        return view('overview', compact('objects', 'customer', 'products'));
    }



    public function confirm(VendreRequest $request)
    {
        $validatedData = $request->validated();

        try {
            DB::beginTransaction();

            $customer = Client::find($request->customer_id);
            if (!$customer) {
                $customer = Client::create([
                    'prenoms' => $request->customer_firstname,
                    'nom' => $request->customer_lastname,
                    'telephone' => $request->customer_phone,
                    'adresse' => $request->customer_address,
                ]);
            }

            $sale = Vente::create([
                'client_id' => $customer->id,
                'status' => $request->payment,
                'reste' => $request->remaining_amount,
                'personnel_id' => Auth::user() ? Auth::user()->personnel_id : 0,
            ]);

            $total = 0;
            foreach ($request->products as $productId => $quantity) {
                $product = Article::find($productId);
                if ($product) {
                    $product->stock -= $quantity;
                    $product->save();

                    LigneVente::create([
                        'vente_id' => $sale->id,
                        'article_id' => $product->id,
                        'quantite' => $quantity,
                        'montant' => $product->prix_vente * $quantity,
                    ]);

                    $total += $product->prix_vente * $quantity;
                }
            }


            $sale->total = $total;
            $sale->save();

            DB::commit();

            return redirect()->route('ventes.details', ['id' => $sale->id])->with('success', 'Vente enregistrée avec succès !');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'enregistrement de la vente : ' . $e->getMessage());
        }
    }



    public function details($id)
    {
        $sale = Vente::findOrFail($id);
        return view('details', compact('sale'));
    }


    public function approvisionnements()
    {
        return view('approvisionnements');
    }

    public function produits()
    {
        $categories = Categorie::all()->reverse();
        $products = Article::all()->reverse();

        return view('produits', compact('categories', 'products'));
    }

    public function createProduit(ArticleRequest $request)
    {
        $validatedData = $request->validated();

        $article = new Article();
        $article->code = $request->input('code');
        $article->libelle = $request->input('label');
        $article->stock = $request->input('stock');
        $article->prix_achat = $request->input('cost_price');
        $article->prix_vente = $request->input('selling_price');
        $article->categorie_id = $request->input('category');
        $article->save();

        return redirect()->route('produits')->with('success', 'Article created successfully.');
    }

    public function updateProduit(ArticleRequest $request, Article $article)
    {
        $validatedData = $request->validated();

        $article->update($validatedData);

        return redirect()->route('produits')->with('success', 'Article updated successfully.');
    }
}
