<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
    }

    public function ventes(){
        return view('ventes');
    }
    
    public function approvisionnements(){
        return view('approvisionnements');
    }
}
