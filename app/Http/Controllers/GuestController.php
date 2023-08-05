<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use PhpParser\Node\Scalar\String_;

class GuestController extends Controller
{
    public function home () {
        $products = Product::paginate(8);
        $categories = Category::all();
        return view('clients.home', compact('products', 'categories'));
    }

    public function detail (String $id) {
        $product = Product::join('categories', 'categories.id', '=', 'products.cate_id')
            ->join('materials', 'materials.id', '=', 'products.material_id')
            ->join('colors', 'colors.id', '=', 'products.color_id')
            ->join('sizes', 'sizes.id', '=', 'products.size_id')
            ->select('products.*',
                'categories.name as cate_name',
                'materials.name as material_name',
                'colors.name as color_name',
                'sizes.name as size_name'
            )
            ->where('products.id', '=', $id)
            ->first();
        $categories = Category::all();
        return view('clients.detail', compact('product', 'categories'));
    }

    public function addCart (Request $request) {

        $cart = new Cart();

        $cart->user_id = session('user')->id;
        $cart->product_id = $request->product_id;
        $cart->quantity_of_products = $request->quantity;
        $cart->save();
        return redirect()->route('cart');
    }

    public function cart () {
        $countCart = Cart::where('user_id', session('user')->id)->count();
        session(['countCart' => $countCart]);
        return view('clients.cart');
    }
}
