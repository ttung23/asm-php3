<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Material;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::join('categories', 'categories.id', '=', 'products.cate_id')
            ->join('materials', 'materials.id', '=', 'products.material_id')
            ->join('colors', 'colors.id', '=', 'products.color_id')
            ->join('sizes', 'sizes.id', '=', 'products.size_id')
            //                            ->orderBy('products.id', 'asc')
            ->select(
                'products.*',
                'categories.name as cate_name',
                'materials.name as material_name',
                'colors.name as color_name',
                'sizes.name as size_name'
            )
            ->get();
        return view('products.list_products', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $colors = Color::all();
        $materials = Material::all();
        $sizes = Size::all();
        return view('products.create', compact('categories', 'colors', 'sizes', 'materials'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->fill($request->except('img', 'sku', 'slug'));
        $cate = Category::find($request->post('cate_id'));
        $product->sku = $cate->short_name . rand(1, 9999);
        $product->slug = Str::slug($request->post('name'));
        $file = $request->file('img');

        $folder = 'image';

        $filePathAfterUpload = Storage::put($folder, $file);

        $filePathAfterUpload = 'storage/' . $filePathAfterUpload;

        $product->img = $filePathAfterUpload;
        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Company has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    //    public function show(string $id)
    //    {
    //        //
    //    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);

        $categories = Category::all();
        $colors = Color::all();
        $materials = Material::all();
        $sizes = Size::all();
        return view('products.edit', compact('product', 'categories', 'colors', 'sizes', 'materials'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //        $request->validate([
        //            'name' => 'required',
        //            'rate' => 'required',
        //        ]);

        $product = Product::find($id);
        $product->fill($request->except('img'));
        $oldImg = $product->img;

        if ($request->hasFile('img')) {
            $product->img = upload_file('image', $request->file('img'));
            delete_file($oldImg);
        }

        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Company Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::find($id)->delete();
        return redirect()->route('products.index')->with('success', 'Company Has Been updated successfully');
    }
}
