<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::all();
        return view('banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('banners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $banner = new Banner();
        $banner->fill($request->except('img'));
        $file = $request->file('img');

        $folder = 'image';

        $filePathAfterUpload = Storage::put($folder, $file);

        $filePathAfterUpload = 'storage/' . $filePathAfterUpload;

        $banner->img = $filePathAfterUpload;
        $banner->save();

        return redirect()->route('admin.banners.index')->with('success', 'Banner has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $banner = Banner::find($id);
        return view('banners.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $banner = Banner::find($id);
        
        // dd($banner);

        $banner->fill($request->except('img'));

        // dd($file);
        
        $oldImg = $banner->img;

        if ($request->hasFile('img')) {
            $banner->img = upload_file('image', $request->file('img'));
            delete_file($oldImg);
        }

        $banner->save();

        return redirect()->route('admin.banners.index')->with('success', 'Banner has been created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Banner::find($id)->delete();
        return redirect()->route('admin.banners.index')->with('success','banner Has Been updated successfully');

    }
}
