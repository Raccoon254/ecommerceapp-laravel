<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $products = Product::with('images')->get();
        return view('welcome', ['products' => $products]);
    }

    //return a product by id in json format
    public function product($id): \Illuminate\Http\JsonResponse
    {
        $product = Product::with('images')->find($id);
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
            'description' => 'required',
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $productData = $request->except('images');

        if($request->hasFile('images')) {
            $images = $request->file('images');
            $imageName = time() . '.' . $images[0]->extension();
            $images[0]->move(public_path('img'), $imageName);
            $productData['image'] = $imageName;
        }

        $product = Product::create($productData);

        if($request->hasFile('images')) {
            foreach (array_slice($images, 1) as $image) {
                $imageName = time() . '.' . $image->extension();
                $image->move(public_path('img'), $imageName);
                $product->images()->create(['filename' => $imageName]);
            }
        }

        return redirect()->route('products.index');
    }

    /**
     * @throws AuthorizationException
     */
    public function edit($id): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->authorize('manage-products');
        $product = Product::findOrFail($id);

        return view('edit', ['product' => $product]);
    }

    /**
     * @throws AuthorizationException
     */
    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $this->authorize('manage-products');
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'sometimes',
            'category' => 'sometimes',
            'price' => 'sometimes',
            'old_price' => 'sometimes',
            'description' => 'sometimes',
            'images' => 'nullable',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if(!$request->filled(['name', 'category', 'price', 'old_price', 'description']) && !$request->hasFile('images')) {
            return back()->withErrors(['error' => 'At least one field must be filled to update.']);
        }

        $product->update($request->except('images'));

        if($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '.' . $image->extension();
                $image->move(public_path('img'), $imageName);
                $product->images()->create(['filename' => $imageName]);
            }
        }

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
        $products = Product::all();

        return view('manage', ['products' => $products]);
    }

    public function getProduct($productId)
    {
        $product = Product::with('images')->find($productId);
        $sameCategoryProducts = Product::where('category', $product->category)->get();

        return view('product', ['product' => $product, 'sameCategoryProducts' => $sameCategoryProducts]);
    }

}
