<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            line-height: 1.4;
            padding: 20px;
        }
        h2 {
            text-align: center;
            margin-bottom: 25px;
        }
        .section {
            margin-bottom: 25px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: center;
        }
        td, th {
            padding: 8px;
        }
        .text-end {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>

    <h2>Invoice</h2>

    {{-- Customer & Order Info --}}
    <div class="section">
        <table>
            <tr>
                <th>First Name</th>
                <td>{{ $order->first_name }}</td>
                <th>Last Name</th>
                <td>{{ $order->last_name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $order->email }}</td>
                <th>Phone</th>
                <td>{{ $order->telephone }}</td>
            </tr>
            <tr>
                <th>Address</th>
                <td colspan="3">{{ $order->address }}, {{ $order->city }}, {{ $order->state }}, {{ $order->country }}</td>
            </tr>
            <tr>
                <th>Order Date</th>
                <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y h:i A') }}</td>
                <th>Total Amount</th>
                <td>₹{{ number_format($order->total_amount, 2) }}</td>
            </tr>
        </table>
    </div>

    {{-- Ordered Products --}}
    <div class="section">
        <h4>Ordered Products</h4>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th class="text-center">Qty</th>
                    <th class="text-end">Unit Price</th>
                    <th class="text-end">Total</th>
                </tr>
            </thead>
            <tbody>
                @php 
                    $counter = 1;
                    $grandTotal = 0;
                @endphp
                @foreach($order_items as $item)
                    @php
                        $total = $item->quantity * $item->unit_price;
                        $grandTotal += $total;
                    @endphp
                    <tr>
                        <td class="text-center">{{ $counter++ }}</td>
                        <td>{{ $item->product_name }}</td>
                        <td class="text-center">{{ $item->quantity }}</td>
                        <td class="text-end">₹{{ number_format($item->unit_price, 2) }}</td>
                        <td class="text-end">₹{{ number_format($total, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4" class="text-end">Grand Total</th>
                    <th class="text-end">₹{{ number_format($grandTotal, 2) }}</th>
                </tr>
            </tfoot>
        </table>
    </div>

</body>
</html>
