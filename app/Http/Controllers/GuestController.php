<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use PhpParser\Node\Scalar\String_;

class GuestController extends Controller
{
    public function home () {
        $products = Product::paginate(8);
        return view('clients.home', compact('products'));
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
        return view('clients.detail', compact('product'));
    }
}
