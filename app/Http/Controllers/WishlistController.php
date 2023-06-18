<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class WishlistController extends Controller
{
    public function add(Request $request): \Illuminate\Http\JsonResponse
    {
        $productId = $request->input('productId');
        $product = Product::find($productId);

        $wishlist = session()->get('wishlist', []);
        if(!isset($wishlist[$productId])) {
            $wishlist[$productId] = [
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
            ];
        }

        session()->put('wishlist', $wishlist);

        return response()->json($wishlist);
    }

    public function index(Request $request)
    {
        $wishlist = $request->session()->get('wishlist', []);

        return view('wishlist', compact('wishlist'));
    }

    public function data(): \Illuminate\Http\JsonResponse
    {
        $wishlist = Session::get('wishlist', []);
        return response()->json($wishlist);
    }

    public function remove($productId): \Illuminate\Http\JsonResponse
    {
        $wishlist = Session::get('wishlist', []);
        unset($wishlist[$productId]);
        Session::put('wishlist', $wishlist);
        return response()->json($wishlist);
    }
}
