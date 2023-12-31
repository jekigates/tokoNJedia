<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class MerchantController extends Controller
{
    public function index()
    {
        $recommendations = Product::all()->random(5);

        return view('merchant.index', [
            'recommendations' => $recommendations,
        ]);
    }
}
