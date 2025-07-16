@extends('website.master')

@section('content')

@php
    $selectedCategories = request('category', []);
    $minPrice = $minPrice ?? 0;
    $maxPrice = $maxPrice ?? 0;
    $allCategories = $allCategories ?? [];
    $category = $category ?? '';
@endphp

<style>
    .hover-border {
        border: 2px solid #ddd;
        transition: all 0.3s ease-in-out;
    }

    .hover-border:hover {
        border: 2px solid #000;
        box-shadow: 0 0 12px rgba(0, 0, 0, 0.15);
    }

    .product-thumbnail {
        margin: 4px;
        border: 1px solid #ccc;
        transition: transform 0.2s ease-in-out;
    }

    .product-thumbnail:hover {
        transform: scale(1.05);
    }

    .label-sale, .label-new {
        position: absolute;
        top: 10px;
        left: 10px;
        background: red;
        color: white;
        font-size: 12px;
        padding: 4px 6px;
        z-index: 10;
        border-radius: 3px;
    }

    .label-new {
        top: 10px;
        right: 10px;
        left: auto;
        background: green;
    }

    .main-product-image {
        object-fit: cover;
        width: 100%;
        height: 250px;
        border-radius: 5px;
    }
</style>

<div class="main-container container mt-4">
    <div class="row">

        <!-- Product List -->
        <div class="col-md-9">
            <h2 class="mb-4">Products{{ $category ? ' in: ' . $category : '' }}</h2>

            @if($products->count())
                <div class="row">
                    @foreach($products as $product)
                        @php
                            $images = $product->images->count()
                                ? $product->images->pluck('image')->map(fn($img) => asset('uploads/'.$img))->toArray()
                                : [asset($product->image)];
                            $firstImage = $images[0];
                        @endphp
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card hover-border h-100 rounded-3 p-2 position-relative">

                                @if ($product->price > $product->offer_price)
                                    @php
                                        $discount = round((($product->price - $product->offer_price) / $product->price) * 100);
                                    @endphp
                                    <span class="label label-sale">-{{ $discount }}% OFF</span>
                                @endif

                                <span class="label label-new">New</span>

                                <div class="text-center mb-2">
                                    <img src="{{ $firstImage }}" id="main-image-{{ $product->id }}" class="main-product-image">

                                    @if (count($images) > 1)
                                        <div class="d-flex justify-content-center flex-wrap mt-2">
                                            @foreach ($images as $index => $img)
                                                <img src="{{ $img }}" data-main="#main-image-{{ $product->id }}"
                                                    class="img-thumbnail product-thumbnail"
                                                    style="width: 50px; height: 50px; cursor: pointer;">
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                                <div class="card-body text-center">
                                    <h5 class="fw-bolder text-uppercase mb-2">{{ $product->name }}</h5>

                                    @if ($product->price > $product->offer_price)
                                        <p>
                                            <span class="fw-bold text-danger fs-5">&#8377;{{ number_format($product->offer_price) }}</span>
                                            <small class="text-muted ms-2"><del>&#8377;{{ number_format($product->price) }}</del></small>
                                        </p>
                                    @else
                                        <p class="fw-bold">&#8377;{{ number_format($product->price) }}</p>
                                    @endif

                                    <div class="d-flex justify-content-center gap-2">
                                        <button class="btn btn-sm btn-success add-to-cart-btn"
                                            data-id="{{ $product->id }}"
                                            data-name="{{ $product->name }}"
                                            data-price="{{ $product->offer_price }}"
                                            data-image="{{ $firstImage }}">
                                            <i class="fa fa-shopping-cart"></i> Add to Cart
                                        </button>

                                        <button class="btn btn-sm btn-warning add-to-wishlist-btn"
                                            data-id="{{ $product->id }}"
                                            data-name="{{ $product->name }}"
                                            data-price="{{ $product->offer_price }}"
                                            data-image="{{ $firstImage }}">
                                            <i class="fa fa-heart"></i> Wishlist
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-4">
                    {{ $products->appends(request()->query())->links() }}
                </div>
            @else
                <div class="alert alert-warning">No products found.</div>
            @endif
        </div>

        <!-- Sidebar Filter -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header text-dark fw-bolder">
                    <h2 class="mb-0" style="font-size: 30px;">Filter</h2>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('products.filter') }}">
                        <div class="mb-4">
                            <label class="form-label fw-bold" style="font-size: 16px;">Search</label>
                            <input class="form-control" type="text" name="search" placeholder="Search" value="{{ request('search') }}">
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold" style="font-size: 16px;">Category</label>
                            <div class="form-check" style="max-height: 150px; overflow-y: auto;">
                                @foreach ($allCategories as $cat)
                                    <div class="form-check">
                                        <input type="checkbox" name="category[]" value="{{ $cat }}" class="form-check-input" id="cat_{{ $loop->index }}"
                                            {{ in_array($cat, $selectedCategories) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="cat_{{ $loop->index }}">{{ $cat }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                      <div class="mb-4">
                        <label class="form-label fw-bold" style="font-size: 16px;">Sort By</label>
                        <select name="sort" class="form-select">
                            <option value="">-- Select --</option>
                            <option value="low_to_high" {{ request('sort') == 'low_to_high' ? 'selected' : '' }}> Low to High </option>
                            <option value="high_to_low" {{ request('sort') == 'high_to_low' ? 'selected' : '' }}> High to Low </option>
                        </select>
                    </div>


                        <div class="d-grid gap-2 mt-3">
                            <button type="submit" class="btn btn-success btn-lg fw-bold">Search</button>
                            <a href="{{ route('products.filter') }}" class="btn btn-outline-secondary btn-lg fw-bold">Reset</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- AJAX Thumbnail Switch -->
<script>
    $(document).on('click', '.product-thumbnail', function() {
        const mainImageSelector = $(this).data('main');
        const newSrc = $(this).attr('src');
        $(mainImageSelector).attr('src', newSrc);
    });
</script>

@endsection
