@extends('website.master')

@section('content')

<form method="POST" action="{{ route('checkout.store') }}">
@csrf
<input type="hidden" name="cart_data" id="cart-data">

<div class="main-container container">
    <ul class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i></a></li>
        <li><a href="#">Checkout</a></li>
    </ul>

    <div class="row">
        <div id="content" class="col-sm-12">
            <h2 class="title">Checkout</h2>
            <div class="so-onepagecheckout ">
                <div class="col-left col-sm-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><i class="fa fa-sign-in"></i> Create an Account or Login</h4>
                        </div>
                        <div class="panel-body">
                            <div class="radio">
                                <label><input type="radio" value="register" name="account"> Register Account</label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" checked value="guest" name="account"> Guest Checkout</label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" value="returning" name="account"> Returning Customer</label>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><i class="fa fa-user"></i> Your Personal Details</h4>
                        </div>
                        <div class="panel-body">
                            <div class="form-group required">
                                <label>First Name</label>
                                <input type="text" class="form-control" name="firstname" required>
                            </div>
                            <div class="form-group required">
                                <label>Last Name</label>
                                <input type="text" class="form-control" name="lastname" required>
                            </div>
                            <div class="form-group required">
                                <label>E-Mail</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <div class="form-group required">
                                <label>Telephone</label>
                                <input type="text" class="form-control" name="telephone" required>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><i class="fa fa-book"></i> Your Address</h4>
                        </div>
                        <div class="panel-body">
                            <div class="form-group required">
                                <label>Address</label>
                                <input type="text" class="form-control" name="address" required>
                            </div>
                            <div class="form-group required">
                                <label>City</label>
                                <input type="text" class="form-control" name="city" required>
                            </div>
                            <div class="form-group required">
                                <label>Country</label>
                                <select class="form-control" name="country" required>
                                    <option value="India">India</option>
                                    <option value="Afghanistan">Afghanistan</option>
                                    <option value="USA">USA</option>
                                    <!-- Add more if needed -->
                                </select>
                            </div>
                            <div class="form-group required">
                                <label>State</label>
                                <select class="form-control" name="state" required>
                                    <option value="Haryana">Haryana</option>
                                    <option value="Punjab">Punjab</option>
                                    <option value="Delhi">Delhi</option>
                                    <!-- Add more if needed -->
                                </select>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" checked value="1" name="shipping_address"> My delivery and billing addresses are the same.</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-right col-sm-9">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><i class="fa fa-shopping-cart"></i> Shopping Cart</h4>
                        </div>
                        <div class="panel-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td>Image</td>
                                        <td>Product Name</td>
                                        <td>Quantity</td>
                                        <td>Unit Price</td>
                                        <td>Total</td>
                                    </tr>
                                </thead>
                                <tbody id="checkout-cart-body">
                                    <tr><td colspan="5">Loading cart...</td></tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4" class="text-right"><strong>Sub-Total:</strong></td>
                                        <td class="text-right">₹<span id="sub-total">0</span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-right"><strong>Flat Shipping Rate:</strong></td>
                                        <td class="text-right">₹<span id="shipping-cost">50</span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-right"><strong>Total:</strong></td>
                                        <td class="text-right">₹<span id="grand-total">0</span></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><i class="fa fa-pencil"></i> Order Comments</h4>
                        </div>
                        <div class="panel-body">
                            <textarea rows="4" class="form-control" name="comment"></textarea>
                            <br>
                            <label><input type="checkbox" checked required> I agree to the <a href="#">Terms & Conditions</a></label>
                            <div class="buttons pull-right">
                                <input type="submit" class="btn btn-primary" value="Confirm Order">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const cart = JSON.parse(localStorage.getItem('cart')) || {};
        const tbody = document.getElementById('checkout-cart-body');
        const subTotalEl = document.getElementById('sub-total');
        const shippingEl = document.getElementById('shipping-cost');
        const grandTotalEl = document.getElementById('grand-total');

        let subTotal = 0;
        let shipping = 50;

        tbody.innerHTML = '';

        if (Object.keys(cart).length === 0) {
            tbody.innerHTML = `<tr><td colspan="5" class="text-center">Your cart is empty!</td></tr>`;
            subTotalEl.innerText = '0';
            grandTotalEl.innerText = '0';
            return;
        }

        Object.entries(cart).forEach(([id, item]) => {
            const itemTotal = item.price * item.quantity;
            subTotal += itemTotal;

            const row = document.createElement('tr');
            row.innerHTML = `
                <td><img src="${item.image}" width="60px" class="img-thumbnail"></td>
                <td>${item.name}</td>
                <td><input type="text" value="${item.quantity}" readonly class="form-control"></td>
                <td>₹${item.price.toFixed(2)}</td>
                <td>₹${itemTotal.toFixed(2)}</td>
            `;
            tbody.appendChild(row);
        });

        subTotalEl.innerText = subTotal.toFixed(2);
        grandTotalEl.innerText = (subTotal + shipping).toFixed(2);

        document.getElementById('cart-data').value = JSON.stringify(cart);
    });
    </script>
</div>
</form>

@endsection
