<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $products = \App\Models\Product::all();

        return view('welcome', ['products' => $products]);
    }

    //return a product by id in json format
    public function product($id): \Illuminate\Http\JsonResponse
    {
        $product = \App\Models\Product::find($id);
        return response()->json($product);
    }

    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('create');
    }


    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required',
            'old_price' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();

        $request->image->move(public_path('img'), $imageName);

        \App\Models\Product::create([
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'old_price' => $request->old_price,
            'image' => $imageName,
        ]);

        return redirect()->route('products.index');
    }

    public function edit($id)
    {
        $product = \App\Models\Product::findOrFail($id);

        return view('edit', ['product' => $product]);
    }

    public function update(Request $request, $id)
    {
        $product = \App\Models\Product::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required',
            'old_price' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product->name = $request->name;
        $product->category = $request->category;
        $product->price = $request->price;
        $product->old_price = $request->old_price;

        if($request->hasFile('image')){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('img'), $imageName);
            $product->image = $imageName;
        }

        $product->save();

        return redirect()->route('products.index');
    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $product = \App\Models\Product::findOrFail($id);

        $product->delete();

        return redirect()->route('products.index');
    }

    public function editindex(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $products = \App\Models\Product::all();

        return view('manage', ['products' => $products]);
    }



}
