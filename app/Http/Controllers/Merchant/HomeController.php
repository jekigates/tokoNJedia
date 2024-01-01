<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $recommendations = Product::all()->random(5);

        return view('merchant.index', [
            'recommendations' => $recommendations,
        ]);
    }

    public function show($id)
    {
        $recommendations = Product::all()->random(5);

        return view('merchant.show', [
            'recommendations' => $recommendations,
        ]);
    }
}
