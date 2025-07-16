@extends('website.master')

@section('content')

<div class="container py-5">
    <h1 class="mb-4">My Wishlist</h1>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="wishlist-table-body">
                <!-- JS will fill this -->
            </tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // ✅ Safe parse with fallback
    let wishlist = {};
    let cart = {};
    try {
        wishlist = JSON.parse(localStorage.getItem('wishlist')) || {};
    } catch (e) {
        wishlist = {};
        localStorage.removeItem('wishlist');
    }

    try {
        cart = JSON.parse(localStorage.getItem('cart')) || {};
    } catch (e) {
        cart = {};
        localStorage.removeItem('cart');
    }

    const tbody = document.getElementById('wishlist-table-body');

    function renderWishlist() {
        tbody.innerHTML = '';

        if (Object.keys(wishlist).length === 0) {
            tbody.innerHTML = `<tr><td colspan="4" class="text-center">Your wishlist is empty!</td></tr>`;
            return;
        }

        Object.entries(wishlist).forEach(([id, item]) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td style="width:70px">
                    <img src="${item.image}" style="width:70px;height:70px;object-fit:cover;" alt="${item.name}">
                </td>
                <td class="text-start">${item.name}</td>
                <td>₹${item.price.toFixed(2)}</td>
                <td>
                    <button class="btn btn-sm btn-primary add-to-cart" data-id="${id}">
                        <i class="fa fa-shopping-cart"></i> Add to Cart
                    </button>
                    <button class="btn btn-sm btn-danger remove-from-wishlist" data-id="${id}">
                        <i class="fa fa-times"></i>
                    </button>
                </td>
            `;
            tbody.appendChild(row);
        });
    }

    // ✅ Handle button clicks
    tbody.addEventListener('click', function (e) {
        if (e.target.closest('.add-to-cart')) {
            const id = e.target.closest('.add-to-cart').dataset.id;
            if (cart[id]) {
                cart[id].quantity = (cart[id].quantity || 1) + 1;
            } else {
                cart[id] = { ...wishlist[id], quantity: 1 };
            }
            localStorage.setItem('cart', JSON.stringify(cart));
            alert('✅ Added to Cart!');
        }

        if (e.target.closest('.remove-from-wishlist')) {
            const id = e.target.closest('.remove-from-wishlist').dataset.id;
            delete wishlist[id];
            localStorage.setItem('wishlist', JSON.stringify(wishlist));
            renderWishlist();
        }
    });

    renderWishlist();
});
</script>

@endsection
