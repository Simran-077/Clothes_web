@extends('website.master')

@section('content')

<div class="container py-5">
   <h1 class="mb-4 text-center">Your Cart</h1>

   <div class="table-responsive">
      <table class="table table-bordered table-hover align-middle text-center">
         <thead class="table-dark">
            <tr>
               <th>Product</th>
               <th>Qty</th>
               <th>Price</th>
               <th>Unit Price</th>
               <th>Action</th>
            </tr>
         </thead>
         <tbody id="cart-table-body"></tbody>
      </table>
   </div>

   <div class="text-end">
      <h4 class="fw-bold">Total: ₹<span id="cart-page-total">0</span></h4>
      <a href="{{route('checkout.page')}}" class="btn btn-primary mt-3">Proceed to Checkout</a>
   </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
   let cart = JSON.parse(localStorage.getItem('cart')) || {};
   const tbody = document.getElementById('cart-table-body');
   let total = 0;

   function renderTable() {
      tbody.innerHTML = '';
      total = 0;

      if (Object.keys(cart).length === 0) {
         tbody.innerHTML = `<tr><td colspan="5" class="text-center">Your cart is empty!</td></tr>`;
         document.getElementById('cart-page-total').innerText = '0';
         return;
      }

      Object.entries(cart).forEach(([id, item]) => {
         const sub = item.price * item.quantity;
         total += sub;

         const row = document.createElement('tr');
         row.innerHTML = `
            <td class="text-start">
               <img src="${item.image}" style="width:50px; height:50px; object-fit:cover;">
               ${item.name}
            </td>
            <td>
               <input type="number" min="1" value="${item.quantity}" class="form-control quantity-input" data-id="${id}" style="width:80px; margin:auto;">
            </td>
            <td>₹${item.price.toFixed(2)}</td>
            <td class="item-subtotal">₹${sub.toFixed(2)}</td>
            <td><button class="btn btn-sm btn-danger remove-item" data-id="${id}">Remove</button></td>
         `;
         tbody.appendChild(row);
      });

      document.getElementById('cart-page-total').innerText = total.toFixed(2);
   }

   renderTable();

   // Remove item
   tbody.addEventListener('click', function(e) {
      if (e.target.classList.contains('remove-item')) {
         const id = e.target.dataset.id;
         delete cart[id];
         localStorage.setItem('cart', JSON.stringify(cart));
         renderTable();
      }
   });

   // Update quantity
   tbody.addEventListener('change', function(e) {
      if (e.target.classList.contains('quantity-input')) {
         const id = e.target.dataset.id;
         let newQty = parseInt(e.target.value);
         if (isNaN(newQty) || newQty < 1) {
            newQty = 1;
            e.target.value = 1;
         }
         cart[id].quantity = newQty;
         localStorage.setItem('cart', JSON.stringify(cart));
         renderTable();
      }
   });

});
</script>

@endsection
