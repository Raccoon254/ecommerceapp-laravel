<?php

namespace App\Http\Controllers;

use App\Models\ShippingDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShippingDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        // Retrieve the authenticated user
        $user = auth()->user();

        // Retrieve the shipping details for the authenticated user
        $shippingDetails = ShippingDetails::where('user_id', $user->id)->first();

        // Retrieve the cart from the session
        $cart = $request->session()->get('cart', []);
        $totalAmount = $this->calculateTotalAmount($cart);

        // Return the view with the shipping details and cart
        return view('checkout', compact('shippingDetails', 'cart', 'totalAmount'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'zip_code' => 'required',
            'telephone' => 'required',
        ]);

        $shippingDetails = new ShippingDetails([
            'user_id' => Auth::id(),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'country' => $request->input('country'),
            'zip_code' => $request->input('zip_code'),
            'telephone' => $request->input('telephone'),
        ]);

        // Save the shipping details
        $shippingDetails->save();

        // Redirect back to the checkout page with a success message
        return redirect()->back()->with('success', 'Shipping details saved successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ShippingDetails $shippingDetail): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'zip_code' => 'required',
            'telephone' => 'required',
        ]);

        // Retrieve the authenticated user
        $user = auth()->user();

        // Check if the shipping detail belongs to the authenticated user
        if ($shippingDetail->user_id !== $user->id) {
            abort(403); // Return a forbidden error if the shipping detail does not belong to the user
        }

        $shippingDetail->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'country' => $request->input('country'),
            'zip_code' => $request->input('zip_code'),
            'telephone' => $request->input('telephone'),
        ]);

        // Redirect back to the checkout page with a success message
        return redirect()->back()->with('success', 'Shipping details updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Get the shipping details for the authenticated user.
     */
    public function getShippingDetails(): \Illuminate\Http\JsonResponse
    {
        $shippingDetails = ShippingDetails::where('user_id', Auth::id())->first();
        return response()->json($shippingDetails);
    }

    private function calculateTotalAmount(mixed $cart): float|int
    {
        $totalAmount = 0;
        foreach ($cart as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
        }
        return $totalAmount;
    }
}
