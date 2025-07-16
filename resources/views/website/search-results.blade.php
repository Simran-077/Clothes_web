@extends('website.master')

@section('content')

<div class="container my-5">
    <h2>Search results for: <strong>{{ $query }}</strong></h2>

    @if ($products->count())
        <div class="row">
            @foreach ($products as $product)
                @php
                    $image = $product->image
                        ? asset('/' . $product->image)
                        : asset('website/images/no-image.png');
                @endphp

                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ $image }}" alt="{{ $product->name }}"
                             class="card-img-top" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5>{{ $product->name }}</h5>
                            <p>
                                @if ($product->price > $product->offer_price)
                                    <span class="text-danger">&#8377;{{ number_format($product->offer_price) }}</span>
                                    <small class="text-muted"><del>&#8377;{{ number_format($product->price) }}</del></small>
                                @else
                                    <span class="fw-bold">&#8377;{{ number_format($product->price) }}</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $products->withQueryString()->links() }}
        </div>
    @else
        <p>No products found.</p>
    @endif
</div>

@endsection
