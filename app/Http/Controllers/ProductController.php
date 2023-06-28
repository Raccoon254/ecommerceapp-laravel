<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $products = Product::with('images')->get();

        $maxPrice = Product::max('price');
        $minPrice = Product::min('price');

        $categories = Product::select('category', DB::raw('count(*) as total'))
            ->groupBy('category')
            ->get();

        return view('welcome', ['products' => $products, 'categories' => $categories, 'maxPrice' => $maxPrice, 'minPrice' => $minPrice]);
    }

    //return a product by id in json format
    public function product($id): \Illuminate\Http\JsonResponse
    {
        $product = Product::with('images')->find($id);
        return response()->json($product);
    }

    /**
     * @throws AuthorizationException
     */
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->authorize('manage-products');
        return view('create');
    }


    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {

        //dd($request->all());
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required',
            'old_price' => 'required',
            'description' => 'required',
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ]);

        //dd($validatedData);

        // Process the request and store the product
        $productData = $request->except('images');

        if ($request->hasFile('images')) {
            $images = $request->file('images');
            $imageName = time() . '_0.' . $images[0]->extension();
            $images[0]->move(public_path('img'), $imageName);
            $productData['image'] = $imageName;
        }

        $product = Product::create($productData);

        if ($request->hasFile('images')) {
            $i = 1;
            foreach (array_slice($images, 1) as $image) {
                $imageName = time() . '_' . $i++ . '.' . $image->extension();
                $image->move(public_path('img'), $imageName);
                $product->images()->create(['filename' => $imageName]);
            }
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully');
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

        $productData = $request->except('images');

        if($request->hasFile('images')) {
            $images = $request->file('images');
            $imageName = time() . '_0.' . $images[0]->extension();
            $images[0]->move(public_path('img'), $imageName);
            $productData['image'] = $imageName;

            $product->images()->delete(); // delete previous associated images

            $i = 1;
            foreach (array_slice($images, 1) as $image) {
                $imageName = time() . '_' . $i++ . '.' . $image->extension();
                $image->move(public_path('img'), $imageName);
                $product->images()->create(['filename' => $imageName]);
            }
        }

        $product->update($productData);

        return redirect()->route('products.index');
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $this->authorize('manage-products');
        $product = \App\Models\Product::findOrFail($id);
        $product->productReviews()->delete();
        $product->delete();

        return redirect()->route('manage.products');
    }

    /**
     * @throws AuthorizationException
     */
    public function editindex(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->authorize('manage-products');
        $products = Product::all();

        return view('manage', ['products' => $products]);
    }

    public function getProduct($productId): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $product = Product::with('images')->find($productId);
        $sameCategoryProducts = Product::where('category', $product->category)->get();

        $reviews = $product->productReviews()->paginate(10);  // paginate reviews
        $ratings = $product->ratings; // get ratings

        $userRating = $product->ratings()->where('user_id', Auth::id())->first(); // get user rating
        //dd($userRating->rating);

        $reviewCount = $product->productReviews()->count();  // count the number of reviews

        return view('product', ['product' => $product, 'sameCategoryProducts' => $sameCategoryProducts, 'reviews' => $reviews, 'ratings' => $ratings, 'reviewCount' => $reviewCount, 'userRating' => $userRating]);
    }

    public function filter(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');

        $products = Product::with('images')
            ->whereBetween('price', [$minPrice, $maxPrice])
            ->get();

        return view('product-list-partial', ['products' => $products]);
    }

    public function filterByCategory(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        if ($request->has('categories') && count($request->categories) > 0) {
            $products = Product::whereIn('category', $request->categories)->get();
        } else {
            $products = Product::all();
        }

        return view('product-list-partial', ['products' => $products]);
    }

}
