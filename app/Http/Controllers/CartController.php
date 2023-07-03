<?php

namespace App\Http\Controllers;

use App\Mail\AdminOrderReceived;
use App\Mail\OrderReceived;
use App\Mail\UserOrderReceived;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
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



    public function index(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $cart = $request->session()->get('cart', []);
        $categories = Category::all();  // Fetch all categories from Category model


        return view('cart', compact('cart', 'categories'));
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

        if (count($cart) == 0) {
            return redirect()->back()->with('error', 'Your cart is empty. Please add some products before checking out.');
        }

        $user = Auth::user();

        $order = new Order();
        $order->user_id = $user->id;
        $order->status = 'Processing';
        $order->delivery_location = $user->shippingDetails->address; // Assuming you have set up a relationship between user and shipping details
        $order->total_price = $this->calculateTotalAmount($cart);
        $order->order_number = 'ORD-' . strtoupper(uniqid()); // Generates a unique order number

        $order->save();

        foreach ($cart as $productId => $details) {
            $order->products()->attach($productId, ['quantity' => $details['quantity'], 'price_at_the_time_of_purchase' => $details['price']]);
        }

        // Send email to the user
        Mail::to($user->email)->send(new UserOrderReceived($order));

        // Send email to all admins
        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new AdminOrderReceived($order));
        }

        // Clear the cart
        $request->session()->forget('cart');

        return redirect()->back()->with('status', 'Order placed successfully. Check your email for details.');
    }


}

