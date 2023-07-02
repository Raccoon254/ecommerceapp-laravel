@component('mail::message')
    # Order Confirmation

    Dear {{ $order->user->name }},

    Thank you for your order. We're getting your order ready to be shipped. We will notify you when it has been sent.

    **Order ID:** {{ $order->order_number }}<br>
    **Order Email:** {{ $order->user->email }}<br>
    **Order Total:** ${{ number_format($order->total_price, 2) }}

    **Items Ordered**

    @foreach ($order->products as $product)
        Name: {{ $product->name }}<br>
        Price: ${{ number_format($product->price, 2) }}<br>
        Quantity: {{ $product->pivot->quantity }}<br>
        ---

    @endforeach

    Thanks again for your order.

    Regards,

    {{ config('app.name') }}
@endcomponent
