@component('mail::message')
    # New Order Received

    A new order has been received in your store.

    **Order ID:** {{ $order->order_number }}<br>
    **User:** {{ $order->user->name }}<br>
    **User Email:** {{ $order->user->email }}<br>
    **Order Total:** ${{ number_format($order->total_price, 2) }}

    **Items Ordered**

    @foreach ($order->products as $product)
        Name: {{ $product->name }}<br>
        Price: ${{ number_format($product->price, 2) }}<br>
        Quantity: {{ $product->pivot->quantity }}<br>
        ---

    @endforeach

    Please process the order as soon as possible.

    Regards,

    {{ config('app.name') }}
@endcomponent
