<h2>Hello {{ $order->first_name }},</h2>
<p>Thanks for your order! Please find your invoice attached.</p>
<p><strong>Total:</strong> ₹{{ number_format($order->total_amount, 2) }}</p>
