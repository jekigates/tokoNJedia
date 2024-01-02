<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
