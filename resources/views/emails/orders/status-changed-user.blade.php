@component('mail::message')
    # Order Status Update

    Hello {{ $order->user->name }},

    The status of your order (Order Number: {{ $order->order_number }}) has been updated. Here are the details:

    Order Number: {{ $order->order_number }}
    New Status: {{ $order->status }}
    Total Price: ${{ number_format($order->total_price, 2) }}

    Thank you for your patience.

    Best regards,
    {{ config('app.name') }} Team
@endcomponent
