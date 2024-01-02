<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $recommendations = Product::all()->random(5);

        return view('merchant.products.index', [
            'recommendations' => $recommendations,
        ]);
    }

    public function create()
    {
        $recommendations = Product::all()->random(5);

        return view('merchant.products.create', [
            'recommendations' => $recommendations,
        ]);
    }
}
