<x-mail::message>
# Order Placed Successfully

Thank you for your order. Your order number is: {{$order->id}}.

The body of your message.

<x-mail::button :url="$url">
View Order
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
