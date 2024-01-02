<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $recommendations = Product::all()->random(5);

        return view('merchant.chats.index', [
            'recommendations' => $recommendations,
        ]);
    }
}
