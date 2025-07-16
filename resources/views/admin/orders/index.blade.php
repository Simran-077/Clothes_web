@extends('admin.master2')

@section('content')
<div class="container mt-4">
    <h2 class="text-center text-capitalize">All Orders</h2>

     @if(session('success'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $errors->first() }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

   <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="table-container">

                                <div class="table-responsive">
                                    <div id="copy-print-csv_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                       
                                        <table id="copy-print-csv" class="table custom-table dataTable no-footer" role="grid" aria-describedby="copy-print-csv_info">
                                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Order ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>State</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Total Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                 @php $i = 1; @endphp
                                @foreach($orders as $order)
                                @foreach($order->items as $index => $item)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->first_name }}</td>
                                        <td>{{ $order->last_name }}</td>
                                        <td>{{ $order->email }}</td>
                                        <td>{{ $order->telephone }}</td>
                                        <td>{{ $order->state }}</td>
                                        <td>{{ $item->product_name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ number_format($item->unit_price, 2) }}</td>

                                        @if($loop->last)
                                            <td>{{ number_format($order->total_amount, 2) }}</td>
                                        @else
                                            <td></td>
                                        @endif
                                        @if($loop->last)
                                        <td>
                                            <a href="{{ route('admin.invoice.pdf', ['orderId' => $order->id]) }}" class="btn btn-sm btn-danger" target="_blank">
                                                Invoice PDF
                                            </a>
                                        </td>
                                         @else
                                          <td></td>
                                        @endif

                                    </tr>
                                @endforeach
                            @endforeach

                                @if($orders->isEmpty())
                                    <tr>
                                        <td colspan="10" class="text-center">No Orders Found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
