<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('guest.index');
    }

    public function about(){
        return view('guest.about');
    }

    public function produk(){
        return view('guest.produk.index');
    }

    public function community(){
        return view('guest.community');
    }
}
