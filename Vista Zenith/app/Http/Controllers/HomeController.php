<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Http\Requests\InitVenteRequest;
use App\Models\Article;
use App\Models\Categorie;
use App\Models\Client;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
    }

    public function ventes()
    {
        return view('ventes');
    }

    public function ligneVente()
    {
        $customers = Client::all()->reverse();
        $products = Article::all()->reverse();
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
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'phone' => $data['phone'],
                'address' => $data['address'],
            ];
        }

        return view('overview', compact('objects', 'customer', 'products'));
    }






    public function venteOverview()
    {
        return view('overview');
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
