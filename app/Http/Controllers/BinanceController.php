<?php

namespace App\Http\Controllers;

use Binance\API;
use Illuminate\Http\Request;
use App\Models\Order;

class BinanceController extends Controller
{
    public function pay(Order $order): \Illuminate\Http\RedirectResponse
    {
        // Find the order in the database
        $order = Order::findOrFail($order->id);

        // Get the total price of the order
        $totalPrice = $order->total_price;

        $apiKey = env('BINANCE_API_KEY');
        $apiSecret = env('BINANCE_SECRET_KEY');

        $api = new API($apiKey, $apiSecret);

        // For this example, let's say we want the user to pay in BTC
        $symbol = "BTCUSDT"; // BTC to USDT pair

        // You need to convert your total price to the BTC equivalent
        // This is just a placeholder and you should use a method that gives you the actual current price
        $btcPrice = $api->price($symbol);
        $quantity = $totalPrice / $btcPrice;

        // Create a new order on Binance
        // Please note that the 'LIMIT_MAKER' type means the order will be cancelled if it would immediately be filled.
        $order = $api->order("LIMIT_MAKER", $symbol, $quantity, $btcPrice);

        // TODO: You need to check the $order object and update your order status accordingly.
        // If successful, mark your order as paid
        $order->status = 'Paid';
        $order->save();

        return redirect()->back()->with('status', 'Payment initiated. Please check your Binance account.');
    }
}
