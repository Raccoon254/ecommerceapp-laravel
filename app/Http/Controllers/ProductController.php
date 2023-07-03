<?php

namespace App\Http\Controllers;

use App\Models\Category;
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

        $categories = Category::all();  // Fetch all categories from Category model

        $topSellingProducts = Product::withCount('orders')
            ->orderBy('orders_count', 'desc')
            ->take(3)
            ->get();


        return view('welcome', ['products' => $products, 'categories' => $categories, 'maxPrice' => $maxPrice, 'minPrice' => $minPrice, 'topSellingProducts' => $topSellingProducts]);
    }

    public function getProductsByCategory($id): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        // Fetch all products in the category
        $products = Product::where('category_id', $id)->get();

        // Return a view with the products data
        return view('product-list-partial', ['products' => $products]);
    }


    public function search(Request $request)
    {
        // Define an empty collection to store all matched products
        $allProducts = collect();

        if ($request->has('category') && $request->category != 0) {
            $categoryProducts = Product::where('category_id', $request->category)->get();
            $allProducts = $allProducts->concat($categoryProducts);
        }

        if ($request->has('search') && $request->search !== '') {
            //validate the request it should be a string without any special characters if not return error
            // Check if a category with the same name exists
            $category = Category::where('name', 'LIKE', '%' . $request->search . '%')->first();

            if ($category) {
                // If it exists, get all products in that category
                $categoryProducts = Product::where('category_id', $category->id)->get();
                $allProducts = $allProducts->concat($categoryProducts);
            }

            // Search by name and description regardless of the category result
            $searchProducts = Product::where('name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('description', 'LIKE', '%' . $request->search . '%')
                ->get();
            $allProducts = $allProducts->concat($searchProducts);
        }

        // Remove duplicates (products that were found by both category and name/description)
        // And sort the collection so that products with a direct name match come first
        $products = $allProducts->unique('id')->sortByDesc(function($product) use ($request) {
            return strpos($product->name, $request->search) !== false ? 1 : 0;
        });

        return view('product-list-partial', ['products' => $products]);
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
        $categories = Category::all();
        return view('create', ['categories' => $categories]);
    }


    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {

        //dd($request->all());
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',  // Update to category_id
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
            'category_id' => 'sometimes|exists:categories,id', // Update to category_id
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

        // Manually delete associated records in order_product table
        DB::table('order_product')->where('product_id', $id)->delete();

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

    /**
     * @throws \Exception
     */
    public function getProduct(Request $request): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $productId = $request->input('id');
        $product = Product::with('images')->find($productId);

        // Check if the product exists
        if ($product === null) {
            // Handle the case when the product does not exist, for example:
            throw new \Exception('Product not found');
        }

        $sameCategoryProducts = Product::where('category_id', $product->category_id)->get();  // Update to category_id
        if ($sameCategoryProducts === null)
        {
            $sameCategoryProducts = []; // Initialized to an empty array
        }

        $reviews = $product->productReviews()->paginate(10);  // paginate reviews
        $ratings = $product->ratings; // get ratings

        $userRating = $product->ratings()->where('user_id', Auth::id())->first(); // get user rating

        $reviewCount = $product->productReviews()->count();  // count the number of reviews

        $categories = Category::all();

        return view('product', ['product' => $product, 'sameCategoryProducts' => $sameCategoryProducts, 'reviews' => $reviews, 'ratings' => $ratings, 'reviewCount' => $reviewCount, 'userRating' => $userRating, 'categories' => $categories]);
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
            $products = Product::whereIn('category_id', $request->categories)->get();  // Update to category_id
        } else {
            $products = Product::all();
        }

        return view('product-list-partial', ['products' => $products]);
    }

}
