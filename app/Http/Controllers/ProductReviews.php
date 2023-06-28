<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductReviews extends Controller
{
    public function create(Product $product): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        // Get any existing review by the current user
        $review = $product->productReviews()->where('user_id', auth()->id())->first();

        // Return the view for creating a review
        return view('reviews.create', ['product' => $product, 'review' => $review]);
    }

    public function store(Request $request, Product $product): \Illuminate\Http\RedirectResponse
    {
        // Validate incoming request
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string'
        ]);
        // Store or update a review
        $product->productReviews()->updateOrCreate(
            [
                'user_id' => auth()->id(),  // search for existing review from this user
            ],
            $request->only('review')  // update with new data, or create if it doesn't exist
        );

        // Now handle the rating
        app(RatingController::class)->store($request, $product);

        // Redirect back
        return redirect()->route('products.prod', ['productId' => $product->id]);
    }

}
