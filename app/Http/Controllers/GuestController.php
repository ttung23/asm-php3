<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function home () {
        $products = Product::paginate(8);
        return view('clients.home', compact('products'));
    }
}
