<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        //$products = Product::with('images')->get();
        $products = Product::with('images')->paginate(12);

        $maxPrice = Product::max('price');
        $minPrice = Product::min('price');

        $categories = Category::all();  // Fetch all categories from Category model

        $topSellingProducts = Product::withCount('orders')
            ->orderBy('orders_count', 'desc')
            ->take(3)
            ->get();


        return view('welcome', ['products' => $products, 'categories' => $categories, 'maxPrice' => $maxPrice, 'minPrice' => $minPrice, 'topSellingProducts' => $topSellingProducts]);
    }

    public function getProductsByCategory($id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
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
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->authorize('manage-products');
        $categories = Category::all();
        return view('create', ['categories' => $categories]);
    }


/*    public function store(Request $request): \Illuminate\Http\RedirectResponse
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
    }*/

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'old_price' => 'required|numeric',
            'description' => 'required|string',
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            'size' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:255',
            'car_model_name' => 'nullable|string|max:255',
            'weight' => 'nullable|numeric',
            'part_number' => 'nullable|string|max:255',
            'manufacturer' => 'nullable|string|max:255',
            'compatibility' => 'nullable|string|max:255',
            'material' => 'nullable|string|max:255',
        ]);

        try {

            // Process the request and store the product
            $productData = $request->except('images', 'size', 'color', 'car_model_name', 'weight', 'part_number', 'manufacturer', 'compatibility', 'material');

            if ($request->hasFile('images')) {
                $images = $request->file('images');
                $imageName = time() . '_0.' . $images[0]->extension();
                $images[0]->move(public_path('img'), $imageName);
                $productData['image'] = $imageName;
            }

            $product = Product::create($productData);

            // Create the associated ProductData record
            $productDataDetails = $request->only('size', 'color', 'car_model_name', 'weight', 'part_number', 'manufacturer', 'compatibility', 'material');
            $product->productData()->create($productDataDetails);

            if ($request->hasFile('images')) {
                $i = 1;
                foreach (array_slice($images, 1) as $image) {
                    $imageName = time() . '_' . $i++ . '.' . $image->extension();
                    $image->move(public_path('img'), $imageName);
                    $product->images()->create(['filename' => $imageName]);
                }
            }

                return redirect()->route('products.index')
                    ->with('success', 'Product created successfully');

                } catch (\Exception $e) {
            return redirect()->back()
            ->withErrors(['exception' => $e->getMessage()])
            ->withInput();
        }
    }


    /**
     * @throws AuthorizationException
     */
    public function edit($id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->authorize('manage-products');
        $product = Product::with('productData')->findOrFail($id);
        $categories = Category::all();

        return view('edit', ['product' => $product, 'categories'=>$categories]);
    }

    /**
     * @throws AuthorizationException
     */
    /*public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
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
    }*/
    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $this->authorize('manage-products');
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'sometimes',
            'category_id' => 'sometimes|exists:categories,id',
            'price' => 'sometimes',
            'old_price' => 'sometimes',
            'description' => 'sometimes',
            'images' => 'nullable',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'size' => 'sometimes',
            'color' => 'sometimes',
            'car_model_name' => 'sometimes',
            'weight' => 'sometimes',
            'part_number' => 'sometimes',
            'manufacturer' => 'sometimes',
            'compatibility' => 'sometimes',
            'material' => 'sometimes',
        ]);

        if(!($request->filled('name') || $request->filled('category_id') || $request->filled('price') || $request->filled('old_price') || $request->filled('description') || $request->filled('size') || $request->filled('color') || $request->filled('car_model_name') || $request->filled('weight') || $request->filled('part_number') || $request->filled('manufacturer') || $request->filled('compatibility') || $request->filled('material') || $request->hasFile('images'))) {
            return back()->withErrors(['error' => 'At least one field must be filled to update.']);
        }

        $productData = $request->except(['images', 'size', 'color', 'car_model_name', 'weight', 'part_number', 'manufacturer', 'compatibility', 'material']);

        if($request->hasFile('images')) {
            $images = $request->file('images');
            $imageName = time() . '_0.' . $images[0]->extension();
            $images[0]->move(public_path('img'), $imageName);
            $productData['image'] = $imageName;

            $product->images()->delete();

            $i = 1;
            foreach (array_slice($images, 1) as $image) {
                $imageName = time() . '_' . $i++ . '.' . $image->extension();
                $image->move(public_path('img'), $imageName);
                $product->images()->create(['filename' => $imageName]);
            }
        }

        $product->update($productData);

        if($product->productData) {
            $product->productData->update($request->only(['size', 'color', 'car_model_name', 'weight', 'part_number', 'manufacturer', 'compatibility', 'material']));
        } else {
            $product->productData()->create($request->only(['size', 'color', 'car_model_name', 'weight', 'part_number', 'manufacturer', 'compatibility', 'material']));
        }

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
    public function editindex(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->authorize('manage-products');
        $products = Product::all();
    	$categories = Category::all();

        return view('manage', ['products' => $products, 'categories' => $categories]);
    }

    /**
     * @throws \Exception
     */
    public function getProduct(Request $request): \Illuminate\Contracts\Foundation\Application|Factory|View|Application
    {
        $productId = $request->input('id');
        //$product = Product::with('images')->find($productId);
        $product = Product::with(['images', 'productData'])->find($productId);

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

    public function filter(Request $request): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');

        $products = Product::with('images')
            ->whereBetween('price', [$minPrice, $maxPrice])
            ->get();

        return view('product-list-partial', ['products' => $products]);
    }

    public function filterByCategory(Request $request): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        if ($request->has('categories') && count($request->categories) > 0) {
            $products = Product::whereIn('category_id', $request->categories)->get();  // Update to category_id
        } else {
            $products = Product::all();
        }

        return view('product-list-partial', ['products' => $products]);
    }

}
