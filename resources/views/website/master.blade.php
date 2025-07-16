
<!DOCTYPE html>
<html lang="en">
<head>
    
    <!-- Basic page needs
	============================================ -->
	<title>Market - Premium Multipurpose </title>
	<meta charset="utf-8">
    <meta name="keywords" content="boostrap, responsive, html5, css3, jquery, theme, multicolor, parallax, retina, business" />
    <meta name="author" content="Magentech">
    <meta name="robots" content="index, follow" />
   
	<!-- Mobile specific metas
	============================================ -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	
	<!-- Favicon
	============================================ -->
    <link rel="shortcut icon" href="{{ asset('website') }}/ico/favicon.png">
	
	<!-- Google web fonts
	============================================ -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
	
    <!-- Libs CSS
	============================================ -->
    <link rel="stylesheet" href="{{ asset('website') }}/css/bootstrap/css/bootstrap.min.css">
	<link href="{{ asset('website') }}/css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="{{ asset('website') }}/js/datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="{{ asset('website') }}/js/owl-carousel/owl.carousel.css" rel="stylesheet">
	<link href="{{ asset('website') }}/css/themecss/lib.css" rel="stylesheet">
	<link href="{{ asset('website') }}/js/jquery-ui/jquery-ui.min.css" rel="stylesheet">
	
	<!-- Theme CSS
	============================================ -->
   	<link href="{{ asset('website') }}/css/themecss/so_megamenu.css" rel="stylesheet">
    <link href="{{ asset('website') }}/css/themecss/so-categories.css" rel="stylesheet">
	<link href="{{ asset('website') }}/css/themecss/so-listing-tabs.css" rel="stylesheet">
	<link href="{{ asset('website') }}/css/header5.css" rel="stylesheet">
	<link href="{{ asset('website') }}/css/footer2.css" rel="stylesheet">
	<link id="color_scheme" href="{{ asset('website') }}/css/home5.css" rel="stylesheet">
	<link href="{{ asset('website') }}/css/responsive.css" rel="stylesheet">
	
	<!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body class="common-home res layout-home5 ">
	


    <div id="wrapper">
	
	<!-- Preloading Screen -->
	<div class="ip-header">
		<h1 class="ip-logo">
			<a href="{{route('welcome')}}">
				<img src="{{ asset('website') }}/image/demo/logos/theme_logo.png" alt="SW Shoppy">
			</a>
		</h1>
		{{-- <div class="ip-loader">
			<svg class="ip-inner" width="60px" height="60px" viewBox="0 0 80 80">
				<path class="ip-loader-circlebg" d="M40,10C57.351,10,71,23.649,71,40.5S57.351,71,40.5,71 S10,57.351,10,40.5S23.649,10,40.5,10z"></path>
				<path id="ip-loader-circle" class="ip-loader-circle" d="M40,10C57.351,10,71,23.649,71,40.5S57.351,71,40.5,71 S10,57.351,10,40.5S23.649,10,40.5,10z" style="stroke-dashoffset: 0; stroke-dasharray: 192.617;"></path>
			</svg>
		</div> --}}
	</div>
	<!-- End Preloading Screen -->
	
	<!-- TopBar Container  -->
	<div class="topbar hidden-xs">
		<div class="container">
			<div class="row">
				<div class="block-policy-top ">
					<div class="policy policy1 col-sm-4 col-xs-12">
						<div class="policy-inner">
							<i class="ico-policy"></i>
							<h4>30 days return</h4>
							<span>Money back guarantee</span>
						</div>
					</div>
					<div class="policy policy2 col-sm-4 col-xs-12">
						<div class="policy-inner">
						<i class="ico-policy"></i>
						<h4>free shipping on $30</h4>
						<span>on all orders over $99</span>
						</div>
					</div>
					<div class="policy policy3 col-sm-4 col-xs-12">
						<div class="policy-inner">
						<i class="ico-policy"></i>
						<h4>Safe shopping</h4>
						<span>Save up to 50% now  </span>
						</div>
					</div>
					
				</div>
					
			</div>
		</div>
		
	</div>
	<!-- //TopBar Container  -->
	
	<!-- Header Container  -->
	<header id="header" class="layout-boxed variantleft type_5">
	
		<!-- Header Top -->
		<div class="header-top compact-hidden">
			<div class="container">
				<div class="row">
					<div class="header-top-left form-inline col-md-6 col-sm-4 col-xs-12 compact-hidden">
					</div>
					<div class="header-top-right collapsed-block text-right  col-md-6 col-sm-8 col-xs-12 compact-hidden">
						<h5 class="tabBlockTitle visible-xs">More<a class="expander " href="#TabBlock-1"><i class="fa fa-angle-down"></i></a></h5>
						<div class="tabBlock" id="TabBlock-1">
							<ul class="top-link list-inline">
								{{-- Logout --}}
								<li class="wishlist"><a href="{{ route('website.logout') }}" class="top-link-wishlist" title="Logout"> <i class="fa fa-back"></i> Logout</a>	</li>
								{{-- wishlist --}}
								<li class="wishlist"><a href="{{ route('wishlist') }}" class="top-link-wishlist" title="Wishlist"> <i class="fa fa-heart"></i> My Wish List</a>	</li>
								{{-- signin --}}
								<li class="signin"><a href="{{route('website.login')}}" class="top-link-checkout" title="login"><i class="fa fa-lock" ></i> Sign In</a></li>
								<li class="signup"><a href="{{route('website.register')}}" class="top-link-checkout" title="Regsiter"><i class="fa fa-lock" ></i> Sign Up</a></li>
								<li class="shopping_cart">
									
								{{-- Add to cart code start --}}
						    <div id="cart" class="btn-group btn-shopping-cart">
							<a data-loading-text="Loading..." class="top_cart dropdown-toggle" data-toggle="dropdown">
								<div class="shopcart">
									<span class="handle pull-left"></span>
									<p class="text-shopping-cart cart-total-full" id="cart-count">0</p>
								</div>
							</a>
								<ul id="cart-items" class="tab-content content dropdown-menu pull-right shoppingcart-box" role="menu">
									<li id="cart-empty">
										<p class="text-center">Your cart is empty!</p>
									</li>
								</ul>
							</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!--  One-time jQuery (only once on page) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {

  //  Safe fallback JSON parse
  let cart = {};
  try {
    cart = JSON.parse(localStorage.getItem('cart')) || {};
  } catch (e) {
    cart = {};
    localStorage.removeItem('cart');
  }

  let wishlist = {};
  try {
    wishlist = JSON.parse(localStorage.getItem('wishlist')) || {};
  } catch (e) {
    wishlist = {};
    localStorage.removeItem('wishlist');
  }

  renderCart();

  //  Add to Cart
  $(document).on('click', '.add-to-cart-btn', function() {
    let btn = $(this);
    let id = btn.data('id');
    let name = btn.data('name');
    let price = parseFloat(btn.data('price'));
    let image = btn.data('image');

    if (cart[id]) {
      cart[id].quantity += 1;
    } else {
      cart[id] = { name, price, image, quantity: 1 };
    }

    localStorage.setItem('cart', JSON.stringify(cart));
    renderCart();
    alert(' Added to Cart!');
  });

  // Add to Wishlist
  $(document).on('click', '.add-to-wishlist-btn', function() {
    let btn = $(this);
    let id = btn.data('id');
    let name = btn.data('name');
    let price = parseFloat(btn.data('price'));
    let image = btn.data('image');

    if (!wishlist[id]) {
      wishlist[id] = { name, price, image };
      localStorage.setItem('wishlist', JSON.stringify(wishlist));
      alert('❤️ Added to Wishlist!');
    } else {
      alert('Already in Wishlist!');
    }
  });

  //  Remove from Cart
  $(document).on('click', '.cart-remove', function(e) {
    e.preventDefault();
    let id = $(this).data('id');
    delete cart[id];
    localStorage.setItem('cart', JSON.stringify(cart));
    renderCart();
  });

  // Render Cart in mini dropdown
  function renderCart() {
    let cartItems = $('#cart-items');
    let items = Object.values(cart);
    let count = items.reduce((s, i) => s + i.quantity, 0);
    $('#cart-count').text(count);

    if (items.length === 0) {
      cartItems.html('<li><p class="text-center">Your cart is empty!</p></li>');
    } else {
      let rows = '';
      let subTotal = 0;
      $.each(cart, function(id, item) {
        let total = item.price * item.quantity;
        subTotal += total;
        rows += `<tr>
          <td><img src="${item.image}" style="width:40px;"></td>
          <td>${item.name}</td>
          <td>x${item.quantity}</td>
          <td>₹${total.toFixed(2)}</td>
          <td><a href="#" data-id="${id}" class="fa fa-times cart-remove"></a></td>
        </tr>`;
      });
      cartItems.html(`
        <li><table class="table"><tbody>${rows}</tbody></table></li>
        <li><p class="text-end m-2"><strong>Total:</strong> ₹${subTotal.toFixed(2)}</p>
          <a href="{{ route('cart.view') }}" class="btn btn-sm btn-primary">View Cart</a></li>
      `);
    }
  }

});
</script>



									{{-- End of the cart code --}}
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- //Header Top -->

		<!-- Header center -->
		<div class="header-center left">
			<div class="container">
				<div class="row">
					<!-- Logo -->
					<div class="navbar-logo col-md-offset-4 col-md-4 col-sm-12 col-xs-12">
						<a href="{{route('welcome')}}"><img src="{{ asset('website') }}/image/demo/logos/logo_5.png" title="Your Store" alt="Your Store" /></a>
					</div>
					<!-- //end Logo -->

					<!-- Search -->
					<div id="sosearchpro" class="col-md-offset-1 col-md-3 col-sm-12 search-pro">
						<form action="{{ route('search.products') }}">
							<div id="search0" class="search input-group">
								<input class="autosearch-input form-control" type="text" value="" size="50" autocomplete="off" placeholder="Enter keywords to search..." name="search">
								<span class="input-group-btn">
									<button type="submit" class="button-search btn btn-primary" name="submit_search"><i class="fa fa-search"></i></button>
								</span>
							</div>
							<input type="hidden" name="route" value="product/search" />
						</form>
					</div>
					<!-- //end Search -->

					<!-- Secondary menu -->
					
					
				</div>

			</div>
		</div>
		<!-- //Header center -->

		<!-- Header Bottom -->
		<div class="header-bottom">
			<div class="container">
				<div class="row">
					
					
					<!-- Main menu -->
					<div class="megamenu-hori col-xs-12 ">
						<div class="responsive so-megamenu ">
			<nav class="navbar-default">
				<div class=" container-megamenu  horizontal">
					<div class="navbar-header">
						<button type="button" id="show-megamenu" data-toggle="collapse" class="navbar-toggle">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						Navigation		
					</div>
					
					<div class="megamenu-wrapper">
						<span id="remove-megamenu" class="fa fa-times"></span>
						<div class="megamenu-pattern">
							<div class="container">
								<ul class="megamenu " data-transition="slide" data-animationtime="250">
									<li class="home hover">
										<a href="{{route('welcome')}}">Home <b class="caret"></b></a>
										<div class="sub-menu" style="width:100%;" >
											<div class="content" >
												<div class="row">
													<div class="col-md-15">
														<a href="{{route('welcome')}}" class="image-link"> 
															<span class="thumbnail">
																<img class="img-responsive img-border" src="{{ asset('website') }}/image/demo/feature/home-1.jpg" alt="">
																<span class="btn btn-default">Read More</span>
															</span> 
															<h3 class="figcaption">Home page - (Default)</h3> 
														</a> 
														
													</div>
													<div class="col-md-15">
														<a href="home2.html" class="image-link"> 
															<span class="thumbnail">
																<img class="img-responsive img-border" src="{{ asset('website') }}/image/demo/feature/home-2.jpg" alt="">
																<span class="btn btn-default">Read More</span>
															</span> 
															<h3 class="figcaption">Home page - Layout 2</h3> 
														</a> 
														
													</div>
													<div class="col-md-15">
														<a href="home3.html" class="image-link"> 
															<span class="thumbnail">
																<img class="img-responsive img-border" src="{{ asset('website') }}/image/demo/feature/home-3.jpg" alt="">
																<span class="btn btn-default">Read More</span>
															</span> 
															<h3 class="figcaption">Home page - Layout 3</h3> 
														</a> 
														
													</div>
													<div class="col-md-15">
														<a href="home4.html" class="image-link"> 
															<span class="thumbnail">
																<img class="img-responsive img-border" src="{{ asset('website') }}/image/demo/feature/home-4.jpg" alt="">
																<span class="btn btn-default">Read More</span>
															</span> 
															<h3 class="figcaption">Home page - Layout 4</h3> 
														</a> 
														
													</div>
													<div class="col-md-15">
														<a href="home5.html" class="image-link"> 
															<span class="thumbnail">
																<img class="img-responsive img-border" src="{{ asset('website') }}/image/demo/feature/home-5.jpg" alt="">
																<span class="btn btn-default">Read More</span>
															</span> 
															<h3 class="figcaption">Home page - Layout 5</h3> 
														</a> 
														
													</div>
													<div class="col-md-15">
														<a href="home6.html" class="image-link"> 
															<span class="thumbnail">
																<img class="img-responsive img-border" src="{{ asset('website') }}/image/demo/feature/home-6.jpg" alt="">
																<span class="btn btn-default">Read More</span>
															</span> 
															<h3 class="figcaption">Home page - Layout 6</h3> 
														</a> 
														
													</div>
													<div class="col-md-15">
														<a href="home7.html" class="image-link"> 
															<span class="thumbnail">
																<img class="img-responsive img-border" src="{{ asset('website') }}/image/demo/feature/home-7.jpg" alt="">
																<span class="btn btn-default">Read More</span>
															</span> 
															<h3 class="figcaption">Home page - Layout 7</h3> 
														</a> 
														
													</div>
													<div class="col-md-15">
														<a href="home8.html" class="image-link"> 
															<span class="thumbnail">
																<img class="img-responsive img-border" src="{{ asset('website') }}/image/demo/feature/home-8.jpg" alt="">
																<span class="btn btn-default">Read More</span>
															</span> 
															<h3 class="figcaption">Home page - Layout 8</h3> 
														</a> 
														
													</div>
													<div class="col-md-15">
														<a href="html_width_RTL/{{route('welcome')}}" class="image-link"> 
															<span class="thumbnail">
																<img class="img-responsive img-border" src="{{ asset('website') }}/image/demo/feature/home-rtl.jpg" alt="">
																<span class="btn btn-default">Read More</span>
															</span> 
															<h3 class="figcaption">Home page - Layout RTL</h3> 
														</a> 
														
													</div>
													<div class="col-md-15">
														<a href="#" class="image-link"> 
															<span class="thumbnail">
																<img class="img-responsive img-border" src="{{ asset('website') }}/image/demo/feature/comming-soon.png" alt="">
																
															</span> 
															<h3 class="figcaption">Comming soon</h3> 
														</a> 
														
													</div>
												</div>
											</div>
										</div>
									</li>
									<li class="with-sub-menu hover">
										<p class="close-menu"></p>
										<a href="#" class="clearfix">
											<strong>Features</strong>
											<img class="label-hot" src="{{ asset('website') }}/image/theme/icons/hot-icon.png" alt="icon items">
											<b class="caret"></b>
										</a>
										<div class="sub-menu" style="width: 100%; right: auto;">
											<div class="content" >
												<div class="row">
													<div class="col-md-3">
														<div class="column">
															<a href="#" class="title-submenu">Listing pages</a>
															<div>
																<ul class="row-list">
																	<li><a href="category.html">Category Page 1 </a></li>
																	<li><a href="category-v2.html">Category Page 2</a></li>
																	<li><a href="category-v3.html">Category Page 3</a></li>
																</ul>
																
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<div class="column">
															<a href="#" class="title-submenu">Product pages</a>
															<div>
																<ul class="row-list">
																	<li><a href="product.html">Image size - big</a></li>
																	<li><a href="product-v2.html">Image size - medium</a></li>
																	<li><a href="product-v3.html">Image size - small</a></li>
																</ul>
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<div class="column">
															<a href="#" class="title-submenu">Shopping pages</a>
															<div>
																<ul class="row-list">
																	<li><a href="cart.html">Shopping Cart Page</a></li>
																	<li><a href="checkout.html">Checkout Page</a></li>
																	<li><a href="compare.html">Compare Page</a></li>
																	<li><a href="#">Wishlist Page</a></li>
																
																</ul>
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<div class="column">
															<a href="#" class="title-submenu">My Account pages</a>
															<div>
																<ul class="row-list">
																	<li><a href="login.html">Login Page</a></li>
																	<li><a href="register.html">Register Page</a></li>
																	<li><a href="my-account.html">My Account</a></li>
																	<li><a href="order-history.html">Order History</a></li>
																	<li><a href="order-information.html">Order Information</a></li>
																	<li><a href="return.html">Product Returns</a></li>
																	<li><a href="gift-voucher.html">Gift Voucher</a></li>
																</ul>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</li>
									<li class="with-sub-menu hover">
										<p class="close-menu"></p>
										<a href="#" class="clearfix">
											<strong>Pages</strong>
											<img class="label-hot" src="{{ asset('website') }}/image/theme/icons/hot-icon.png" alt="icon items">
											<b class="caret"></b>
										</a>
										<div class="sub-menu" style="width: 40%; ">
											<div class="content" >
												<div class="row">
													<div class="col-md-6">
														<ul class="row-list">
															<li><a class="subcategory_item" href="faq.html">FAQ</a></li>
															<li><a class="subcategory_item" href="typography.html">Typography</a></li>
															<li><a class="subcategory_item" href="sitemap.html">Site Map</a></li>
															<li><a class="subcategory_item" href="contact.html">Contact us</a></li>
															<li><a class="subcategory_item" href="banner-effect.html">Banner Effect</a></li>
														</ul>
													</div>
													<div class="col-md-6">
														<ul class="row-list">
															<li><a class="subcategory_item" href="about-us.html">About Us 1</a></li>
															<li><a class="subcategory_item" href="about-us-2.html">About Us 2</a></li>
															<li><a class="subcategory_item" href="about-us-3.html">About Us 3</a></li>
															<li><a class="subcategory_item" href="about-us-4.html">About Us 4</a></li>
														</ul>
													</div>
												</div>
											</div>
										</div>
									</li>									
									<li class="with-sub-menu hover">
										<p class="close-menu"></p>
										<a href="#" class="clearfix">
											<strong>Accessories</strong>
											
											<b class="caret"></b>
										</a>
										<div class="sub-menu" style="width: 100%; display: none;">
											<div class="content" style="display: none;">
												<div class="row">
													<div class="col-md-8">
														<div class="row">
															<div class="col-md-6 static-menu">
																<div class="menu">
																	<ul>
																		<li>
																			<a href="#"  class="main-menu">Automotive</a>
																			<ul>
																				<li><a href="#">Car Alarms and Security</a></li>
																				<li><a href="#" >Car Audio &amp; Speakers</a></li>
																				<li><a href="3#" >Gadgets &amp; Auto Parts</a></li>
																			</ul>
																		</li>
																		<li>
																			<a href="#"  class="main-menu">Smartphone &amp; Tablets</a>
																			<ul>
																				<li><a href="#" >Accessories for i Pad</a></li>
																				<li><a href="#" >Apparel</a></li>
																				<li><a href="#" >Accessories for iPhone</a></li>
																			</ul>
																		</li>
																	</ul>
																</div>
															</div>
															<div class="col-md-6 static-menu">
																<div class="menu">
																	<ul>
																		<li>
																			<a href="#" class="main-menu">Sports &amp; Outdoors</a>
																			<ul>
																				<li><a href="#" >Camping &amp; Hiking</a></li>
																				<li><a href="#" >Cameras &amp; Photo</a></li>
																				<li><a href="#" >Cables &amp; Connectors</a></li>
																			</ul>
																		</li>
																		<li>
																			<a href="#"  class="main-menu">Electronics</a>
																			<ul>
																				<li><a href="#" >Battereries &amp; Chargers</a></li>
																				<li><a href="#" >Bath &amp; Body</a></li>
																				<li><a href="#" >Outdoor &amp; Traveling</a></li>
																			</ul>
																		</li>
																	</ul>
																</div>
															</div>
														</div>
													</div>
													<div class="col-md-4">
														<span class="title-submenu">Bestseller</span>
														<div class="col-sm-12 list-product">
															<div class="product-thumb">
																<div class="image pull-left">
																	<a href="#"><img src="{{ asset('website') }}/image/demo/shop/product/35.jpg" width="80" alt="Filet Mign" title="Filet Mign" class="img-responsive"></a>
																</div>
																<div class="caption">
																	<h4><a href="#">Filet Mign</a></h4>
																	<div class="rating-box">
																		<span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
																	   <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
																	   <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
																	   <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
																	   <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
																	</div>
																	<p class="price">$1,202.00</p>
																</div>
															</div>
														</div>
														<div class="col-sm-12 list-product">
															<div class="product-thumb">
																<div class="image pull-left">
																	<a href="#"><img src="{{ asset('website') }}/image/demo/shop/product/W1.jpg" width="80" alt="Dail Lulpa" title="Dail Lulpa" class="img-responsive"></a>
																</div>
																<div class="caption">
																	<h4><a href="#">Dail Lulpa</a></h4>
																	<div class="rating-box">
																		<span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
																	   <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
																	   <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
																	   <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
																	   <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
																	</div>
																	<p class="price">$78.00</p>
																</div>
															</div>
														</div>
														<div class="col-sm-12 list-product">
															<div class="product-thumb">
																<div class="image pull-left">
																	<a href="#"><img src="{{ asset('website') }}/image/demo/shop/product/141.jpg" width="80" alt="Canon EOS 5D" title="Canon EOS 5D" class="img-responsive"></a>
																</div>
																<div class="caption">
																	<h4><a href="#">Canon EOS 5D</a></h4>
																	
																	<div class="rating-box">
																		<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
																		<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
																		<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
																		<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
																		<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
																	</div>
																	<p class="price">
																		<span class="price-new">$60.00</span>
																		<span class="price-old">$145.00</span>
																		
																	</p>
																</div>
															</div>
														</div>
														
													</div>
												</div>
											</div>
										</div>
									</li>
									<li class="">
										<p class="close-menu"></p>
										<a href="blog-page.html" class="clearfix">
											<strong>Blog</strong>
											<span class="label"></span>
										</a>
									</li>
								
								</ul>
								
							</div>
						</div>
					</div>
				</div>
			</nav>
		</div>
											</div>
					<!-- //end Main menu -->
					
				</div>
			</div>

		</div>

	<!-- Navbar switcher -->
	<!-- //end Navbar switcher -->
	</header>
	<!-- //Header Container  -->
	
	
	
	<!-- Main Container  -->
    @yield('content')

	<section class="so-spotlight2">
		<div class="container">
			<div class="row">
					<div class="col-md-6 col-sm-6 list-info-bottom">
						<div class="module clearfix text-center">
							<h3 class="modtitle">THIS WEEK</h3>
							<div class="modcontent">
								<ul class="blank">
									<li>
										Introducing James Jagger for AW16 Men’s<br>
										<a href="#" title="View More">View More</a>
									</li>
									
									<li>
										Autumn Winter 2016<br>
										<a href="#" title="View More">View More</a>
									</li>
									
									<li>
										Introducing James Jagger for AW16 Men’s<br>
										<a href="#" title="View More">View More</a>
									</li>
								</ul>
							</div>
							
						</div>
					</div>
					
					<div class="col-md-6 col-sm-6 ">
						<div class="module clearfix text-center">
							<h3 class="modtitle">KEEP IN TOUCH</h3>
							<div class="modcontent align-center">
								<div class="col-md-offset-2 col-md-9">
								<p class="des-newsletter marginbottom__3x">Get style updates straight to your inbox. Simply enter your details below to keep up-to-date with the latest news on collections and exclusive events.</p>
								<div class="subscribe-home">
									<form class="form subscribe" novalidate="novalidate" action="http://magento2.magentech.com/themes/sm_market/newsletter/subscriber/new/" method="post" id="newsletter-validate-detail">
										<div class="input-group">
											<input name="email" type="email" class="form-control" onfocus="if(this.value=='Your email address') this.value='';" onblur="if(this.value=='') this.value='Your email address';" value="Your email address" data-validate="{required:true, 'validate-email':true}">
											<span class="input-group-btn">
												<button type="submit" class="button-search btn btn-primary" name="submit_search">Subscribe</button>
											</span>
										</div>
										
									</form>
								</div>
								</div>
							</div>
						</div>
						
					</div>
				
			</div>
		</div>
	</section>
	<!-- //Block Spotlight3  -->
<script type="text/javascript"><!--
	var $typeheader = 'header-home1';
	//-->
</script>

	<!-- Footer Container -->
	<footer class="footer-container type_footer2">
		<!-- Footer Top Container -->
		<section class="footer-top">
			<div class="container content">
				<div class="row">
					<div class="col-sm-12 collapsed-block footer-links">
						<div class="module clearfix">
							<div class="modcontent">
								
								<div class="icons-social">
										<h3 class="modtitle">Follow Us</h3>
										<div class="list-inline">
											<a title="Facebook" href="http://www.facebook.com/MagenTech" target="_blank"> 
												<span class="fa fa-facebook icon-circled icon-color"></span> 
											</a>
										
											<a title="Twitter" href="https://twitter.com/magentech" target="_blank"> 
												<span class="fa fa-twitter icon-circled icon-color"></span> 
											</a>
									
											<a title="Google+" href="https://plus.google.com/u/0/+Smartaddons" target="_blank"> 
												<span class="fa fa-google-plus icon-circled icon-color"></span>
											</a>
										
											<a title="Linkedin" href="#" target="_blank"> 
												<span class="fa fa-linkedin icon-circled icon-color"></span>
											</a>
										
											<a title="Pinterest" href="#" target="_blank"> 
												<span class="fa fa-instagram icon-circled icon-color"></span>
											</a>
											
											<a title="Pinterest" href="#" target="_blank"> 
												<span class="fa fa-youtube icon-circled icon-color"></span>
											</a>
										</div>
									
								</div>
								<hr class="footer-lines">
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-3 box-information">
						<div class="module clearfix">
							<h3 class="modtitle">Information</h3>
							<div class="modcontent">
								<ul class="menu">
									<li><a href="about-us.html">About Us</a></li>
									<li><a href="faq.html">FAQ</a></li>
									<li><a href="order-history.html">Order history</a></li>
									<li><a href="order-information.html">Order information</a></li>
								</ul>
							</div>
						</div>
					</div>

					<div class="col-sm-6 col-md-3 box-service">
						<div class="module clearfix">
							<h3 class="modtitle">Customer Service</h3>
							<div class="modcontent">
								<ul class="menu">
									<li><a href="contact.html">Contact Us</a></li>
									<li><a href="return.html">Returns</a></li>
									<li><a href="sitemap.html">Site Map</a></li>
									<li><a href="my-account.html">My Account</a></li>
								</ul>
							</div>
						</div>
					</div>

					<div class="col-sm-6 col-md-3 box-account">
						<div class="module clearfix">
							<h3 class="modtitle">My Account</h3>
							<div class="modcontent">
								<ul class="menu">
									<li><a href="#">Brands</a></li>
									<li><a href="gift-voucher.html">Gift Vouchers</a></li>
									<li><a href="#">Affiliates</a></li>
									<li><a href="#">Specials</a></li>
									<li><a href="#" target="_blank">Our Blog</a></li>
								</ul>
							</div>
						</div>
					</div>

					<div class="col-sm-6 col-md-3 collapsed-block ">
						<div class="module clearfix">
							<h3 class="modtitle">Contact Us	</h3>
							<div class="modcontent">
								<ul class="contact-address">
									<li><span class="fa fa-map-marker"></span> My Company, 42 avenue des Champs Elysées 75000 Paris France</li>
									<li><span class="fa fa-envelope-o"></span> Email: <a href="#"> sales@yourcompany.com</a></li>
									<li><span class="fa fa-phone">&nbsp;</span> Phone 1: 0123456789 <br>Phone 2: (123) 4567890</li>
								</ul>
							</div>
						</div>
					</div>

					
				</div>
			</div>
		</section>
		<!-- /Footer Top Container -->
		
		<!-- Footer Bottom Container -->
		<div class="footer-bottom-block ">
			<div class=" container">
				<div class="row">
					<div class="col-sm-5 copyright-text"> © 2016 Market. All Rights Reserved. </div>
					<div class="col-sm-7">
						<div class="block-payment text-right"><img src="{{ asset('website') }}/image/demo/content/payment.png" alt="payment" title="payment" ></div>
					</div>
					<!--Back To Top-->
					<div class="back-to-top"><i class="fa fa-angle-up"></i><span> Top </span></div>

				</div>
			</div>
		</div>
		<!-- /Footer Bottom Container -->
		
		
	</footer>
	<!-- //end Footer Container -->

    </div>
	<!-- Social widgets -->
	<section class="social-widgets visible-lg">
	<ul class="items">
		<li class="item item-01 facebook"> <a href="php/facebook.php?account=envato" class="tab-icon"><span class="fa fa-facebook"></span></a>
			<div class="tab-content">
				<div class="title">
					<h5>FACEBOOK</h5>
				</div>
				<div class="loading">
					<img src="{{ asset('website') }}/image/theme/lazy-loader.gif" class="ajaxloader" alt="loader">
				</div>
			</div>
		</li>
		<li class="item item-02 twitter"> <a href="php/twitter.php?account_twitter=envato" class="tab-icon"><span class="fa fa-twitter"></span></a>
			<div class="tab-content">
				<div class="title">
					<h5>TWITTER FEEDS</h5> 
				</div>
				<div class="loading">
					<img src="{{ asset('website') }}/image/theme/lazy-loader.gif" class="ajaxloader" alt="loader">
				</div>
			</div>
		</li>
		<li class="item item-03 youtube"> <a href="php/youtubevideo.php?account_video=PY2RLgTmiZY" class="tab-icon"><span class="fa fa-youtube"></span></a>
			<div class="tab-content">
				<div class="title">
					<h5>YouTube</h5>
				</div>
				<div class="loading"> <img src="{{ asset('website') }}/image/theme/lazy-loader.gif" class="ajaxloader" alt="loader"></div>
			</div>
		</li>
	</ul>
</section>	<!-- End Social widgets -->
	
<!-- Cpanel Block -->

<link rel='stylesheet' property='stylesheet'  href='{{ asset('website') }}/css/themecss/cpanel.css' type='text/css' media='all' />
	
<!-- Include Libs & Plugins
============================================ -->
<!-- Placed at the end of the document so the pages load faster -->
<script type="text/javascript" src="{{ asset('website') }}/js/jquery-2.2.4.min.js"></script>
<script type="text/javascript" src="{{ asset('website') }}/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{ asset('website') }}/js/owl-carousel/owl.carousel.js"></script>
<script type="text/javascript" src="{{ asset('website') }}/js/themejs/libs.js"></script>
<script type="text/javascript" src="{{ asset('website') }}/js/unveil/jquery.unveil.js"></script>
<script type="text/javascript" src="{{ asset('website') }}/js/countdown/jquery.countdown.min.js"></script>
<script type="text/javascript" src="{{ asset('website') }}/js/dcjqaccordion/jquery.dcjqaccordion.2.8.min.js"></script>
<script type="text/javascript" src="{{ asset('website') }}/js/datetimepicker/moment.js"></script>
<script type="text/javascript" src="{{ asset('website') }}/js/datetimepicker/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="{{ asset('website') }}/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="{{ asset('website') }}/js/modernizr/modernizr-2.6.2.min.js"></script>


<!-- Theme files
============================================ -->
<script type="text/javascript" src="{{ asset('website') }}/js/themejs/application.js"></script>
<script type="text/javascript" src="{{ asset('website') }}/js/themejs/homepage.js"></script>
<script type="text/javascript" src="{{ asset('website') }}/js/themejs/so_megamenu.js"></script>
<script type="text/javascript" src="{{ asset('website') }}/js/themejs/addtocart.js"></script>	
<script type="text/javascript" src="{{ asset('website') }}/js/themejs/pathLoader.js"></script>	
<!--<script type="text/javascript" src="{{ asset('website') }}/js/themejs/toppanel.js"></script>-->
<script type="text/javascript" src="{{ asset('website') }}/js/themejs/cpanel.js"></script>
<script type="text/javascript">
<!--
var $typeheader = 'header-home5';

//-->
</script>
</body>
</html>