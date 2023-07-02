@component('mail::message')
    # Order Status Update

    Hello Admin,

    The status of an order (Order Number: {{ $order->order_number }}) has been updated. Here are the details:

    Username: {{ $order->user->name }}
    User Email: {{ $order->user->email }}
    Order Number: {{ $order->order_number }}
    New Status: {{ $order->status }}
    Total Price: ${{ number_format($order->total_price, 2) }}

    Please review the order details in the administration panel.

    Best regards,
    {{ config('app.name') }} Team
@endcomponent
