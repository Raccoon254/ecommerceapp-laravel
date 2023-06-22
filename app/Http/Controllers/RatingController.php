<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * Store a new rating.
     *
     * @param  Request  $request
     * @param  Product  $product
     * @return RedirectResponse
     */
    public function store(Request $request, Product $product): RedirectResponse
    {
        // Checking if the user has already rated this product
        $previousRating = Rating::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($previousRating) {
            // If the user has already rated, delete the previous rating
            $previousRating->delete();
        }

        // Create a new rating
        $rating = new Rating;
        $rating->user_id = auth()->id();
        $rating->product_id = $product->id;
        $rating->rating = $request->rating;
        $rating->save();

        return back()->with('success', 'You have successfully rated this product.');
    }
}
