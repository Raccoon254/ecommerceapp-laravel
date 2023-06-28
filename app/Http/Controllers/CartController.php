<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class CartController extends Controller
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function add(Request $request): \Illuminate\Http\JsonResponse
    {
        $productId = $request->input('productId');
        $product = Product::find($productId);

        $cart = session()->get('cart', []);
        if(isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image, // Adding the image to the array
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);

        return response()->json($cart);
    }



    public function index(Request $request)
    {
        $cart = $request->session()->get('cart', []);

        return view('cart', compact('cart'));
    }

    public function data(): \Illuminate\Http\JsonResponse
    {
        $cart = Session::get('cart', []);
        return response()->json($cart);
    }


    public function increment($productId): \Illuminate\Http\RedirectResponse
    {
        $cart = Session::get('cart', []);
        $cart[$productId]['quantity']++;
        Session::put('cart', $cart);
        return Redirect::back();
    }

    function calculateTotalAmount($cart): float|int
    {
        $totalAmount = 0;

        foreach ($cart as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
        }

        return $totalAmount;
    }


    public function decrement($productId): \Illuminate\Http\RedirectResponse
    {
        $cart = Session::get('cart', []);
        if ($cart[$productId]['quantity'] > 1) {
            $cart[$productId]['quantity']--;
        }
        Session::put('cart', $cart);
        return Redirect::back();
    }

    public function clear(): \Illuminate\Http\RedirectResponse
    {
        Session::forget('cart');
        return Redirect::back();
    }

    public function remove($productId): \Illuminate\Http\JsonResponse
    {
        $cart = Session::get('cart', []);
        unset($cart[$productId]);
        Session::put('cart', $cart);
        return response()->json($cart);
    }

    public function checkout(Request $request): \Illuminate\Http\RedirectResponse
    {
        $cart = $request->session()->get('cart', []);

        // Create a simple email body with cart content
        $email_body = "Checkout Details:\n\n";
        foreach ($cart as $productId => $details) {
            $email_body .= "Product ID: {$productId}, Name: {$details['name']}, Price: {$details['price']}, Quantity: {$details['quantity']}\n";
        }

        // Send email using Laravel's Mailing feature
        Mail::raw($email_body, function ($message) {
            $message->to('tomsteve187@gmail.com')->subject('Checkout Details');
        });

        // Clear cart
        $request->session()->forget('cart');

        // Redirect back or to another page
        return redirect()->back()->with('status', 'Checkout completed, email sent.');
    }

}

