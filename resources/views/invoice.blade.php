@extends('admin.master2')

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">Invoice</h2>

    {{-- Order Details --}}
    <div class="card mb-4">
        <div class="card-body">
            <h5><strong>Customer & Order Information</strong></h5>
            <p><strong>First Name:</strong> {{ $order->first_name }}</p>
            <p><strong>Last Name:</strong> {{ $order->last_name }}</p>
            <p><strong>Email:</strong> {{ $order->email }}</p>
            <p><strong>Phone Number:</strong> {{ $order->phone_number }}</p>
            <p><strong>Address:</strong> {{ $order->address }}, {{ $order->city }}, {{ $order->state }}, {{ $order->country }}</p>
            <p><strong>Order Date:</strong> {{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y h:i A') }}</p>
            <p><strong>Total Amount:</strong> ₹{{ number_format($order->total_amount, 2) }}</p>
        </div>
    </div>

    {{-- Order Items --}}
    <div class="card">
        <div class="card-body">
            <h5><strong>Ordered Products</strong></h5>
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Image</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total</th>
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
                            <td>{{ $counter++ }}</td>
                            <td>{{ $item->product_name }}</td>
                            <td>
                              <img src="{{ $item->image }}" width="60" alt="Product Image">
                            </td>
                            <td>{{ $item->quantity }}</td>
                            <td>₹{{ number_format($item->unit_price, 2) }}</td>
                            <td>₹{{ number_format($total, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5" class="text-end">Grand Total:</th>
                        <th>₹{{ number_format($grandTotal, 2) }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
