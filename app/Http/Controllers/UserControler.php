<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserControler extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('login', compact('users'));
    }

    public function add_user()
    {
        return view('add_user');
    }

    public function store(UserRequest $request)
{
    // Afficher les données reçues du formulaire pour le débogage
    dd($request->all());

    $user = User::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => bcrypt($request->input('password'))
    ]);

    // Authentifier l'utilisateur après l'enregistrement
    // Auth::login($user);

    return redirect()->route("index.user");
}


    public function users()
    {
        $users = User::all();
        return $users;
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication réussie
            return redirect()->intended('/dashboard');
        }

        // Authentification échouée
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

}
