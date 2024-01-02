<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $recommendations = Product::all()->random(5);

        return view('chats.index', [
            'recommendations' => $recommendations,
        ]);
    }

    public function redirect($merchant_id)
    {
        echo "hai";
    }
}
