@extends('website.master')
@section('content')
	
	<div class="main-container  layout-boxed">
		<div class="container">
		<div class="row">
			<div id="content-top" class="clearfix" >
				<div id="so-slideshow" class="col-lg-9 col-md-9 home-slidershow">
					<div class="module slideshow no-margin">
						<div class="yt-content-slider yt-content-slider--arrow1"  data-autoplay="no" data-autoheight="no" data-delay="4" data-speed="0.6" data-margin="0" data-items_column0="1" data-items_column1="1" data-items_column2="1"  data-items_column3="1" data-items_column4="1" data-arrows="yes" data-pagination="no" data-lazyload="yes" data-loop="no" data-hoverpause="yes">
							<div class="yt-content-slide">
								<a href="#"><img src="{{ asset('website') }}/image/demo/slider/home5/slider-1.jpg" alt="slider1" class="img-responsive"></a>
							</div>
							<div class="yt-content-slide">
								<a href="#"><img src="{{ asset('website') }}/image/demo/slider/home5/slider-2.jpg" alt="slider2" class="img-responsive"></a>
							</div>
							<div class="yt-content-slide">
								<a href="#"><img src="{{ asset('website') }}/image/demo/slider/home5/slider-3.jpg" alt="slider3" class="img-responsive"></a>
							</div>
			
						</div>
						<div class="loadeding"></div>
					</div>
					
				</div>

				<div class="col-lg-3 col-md-3">
					<div class="module  hidden-sm hidden-xs">
						<div class="modcontent clearfix">
							<ul class="htmlcontent-home">		
								<li class="marginbottom__3x">
									<div class="banners">
										<div>
											<a href="#"><img src="{{ asset('website') }}/image/demo/cms/home5/banner1.jpg" alt="banner1"></a>
										</div>
									</div>
								</li>		
								<li>
									<div class="banners">
										<div>
											<a href="#"><img src="{{ asset('website') }}/image/demo/cms/home5/banner2.jpg" alt="banner1"></a>
										</div>
									</div>
								</li>		
								
							</ul>
							
						</div>
					</div>
				</div>


            {{-- categories --}}
<div class="container my-5">
   <div class="module extraslider-home5 titleLine position-relative mb-2">
      <h3 class="modtitle">Categories</h3>
   </div>

   <div class="row" id="category-list">
      @foreach ($paginatedCategories as $categoryObj)
         @php
            $category = $categoryObj->category;

            $product = \App\Models\Product::where('category', $category)
                        ->where('status', 1)
                        ->with('images')
                        ->first();

            $firstImage = $product && $product->images->first()
                         ? $product->images->first()->image
                         : 'default.jpg';
         @endphp

         @if ($product)
            <div class="col-md-3 col-sm-6 mb-4">
               <a href="{{ route('products.filter', $category) }}" class="text-decoration-none">
                  <div class="card border-0 shadow-sm overflow-hidden h-100 hover-zoom">
                     <div class="overflow-hidden">
                        <img 
                           src="{{ asset('uploads/' . $firstImage) }}"
                           alt="{{ $category }}"
                           class="img-fluid w-100"
                           style="height: 200px; object-fit: cover;">
                     </div>
                     <div class="card-body text-center">
                        <h4 class="fw-bolder text-uppercase mb-0 text-dark">
                           <strong>{{ $category }}</strong>
                        </h4>
                     </div>
                  </div>
               </a>
            </div>
         @endif
      @endforeach
   </div>

   <!-- ✅ Category Pagination Buttons -->
   <div class="d-flex justify-content-between align-items-center mt-4 category-pagination-wrapper">
      @if ($paginatedCategories->previousPageUrl())
         <a href="{{ $paginatedCategories->previousPageUrl() }}" 
            class="btn btn-primary category-pagination-link px-4 py-2 d-flex align-items-center gap-2 shadow-sm rounded-pill">
            <i class="bi bi-arrow-left"></i>
            <span>Previous</span>
         </a>
      @else
         <div></div>
      @endif

      @if ($paginatedCategories->nextPageUrl())
         <a href="{{ $paginatedCategories->nextPageUrl() }}" 
            class="btn btn-primary category-pagination-link px-4 py-2 d-flex align-items-center gap-2 shadow-sm rounded-pill">
            <span>Next</span>
            <i class="bi bi-arrow-right"></i>
         </a>
      @endif
   </div>
</div>
<hr>

<!-- ✅ Hover Zoom CSS -->
<style>
   .hover-zoom {
      transition: transform 0.3s ease;
   }
   .hover-zoom:hover {
      transform: scale(1.05);
   }
</style>

<!-- ✅ AJAX Pagination Script (optional) -->
<script>
   $(document).on('click', '.category-pagination-link', function(e) {
      e.preventDefault();
      let button = $(this);
      let url = button.attr('href');

      $.ajax({
         url: url,
         type: "GET",
         beforeSend: function() {
            button.html('<span>Loading...</span>');
         },
         success: function(response) {
            $('#category-list').fadeOut(200, function() {
               $(this).html($(response).find('#category-list').html()).fadeIn(200);
            });
            $('.category-pagination-wrapper').html(
               $(response).find('.category-pagination-wrapper').html()
            );
         },
         error: function() {
            alert("Something went wrong!");
         }
      });
   });
</script>
 {{-- end --}}
								
							</div>
							<!--End extraslider-inner -->
						</div>
					</div>
				<div class="module">
   <div class="modcontent clearfix">
      <ul class="eg-vcenter-td-1 list-unstyled d-flex gap-3">
         <li class="position-relative overflow-hidden">
            <a href="#" class="d-block position-relative overflow-hidden">
               <img 
                  src="{{ asset('website') }}/image/demo/cms/home5/banner6.jpg" 
                  alt="Image"
                  class="w-100 img-fluid transition-transform"
                  style="transition: transform 0.4s ease;"
               >
               <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-0 hover-opacity-50 transition-opacity"></div>
            </a>
         </li>
         <li class="position-relative overflow-hidden">
            <a href="#" class="d-block position-relative overflow-hidden">
               <img 
                  src="{{ asset('website') }}/image/demo/cms/home5/banner7.jpg" 
                  alt="Image"
                  class="w-100 img-fluid transition-transform"
                  style="transition: transform 0.4s ease;"
               >
               <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-0 hover-opacity-50 transition-opacity"></div>
            </a>
         </li>
         <li class="position-relative overflow-hidden">
            <a href="#" class="d-block position-relative overflow-hidden">
               <img 
                  src="{{ asset('website') }}/image/demo/cms/home5/banner8.jpg" 
                  alt="Image"
                  class="w-100 img-fluid transition-transform"
                  style="transition: transform 0.4s ease;"
               >
               <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-0 hover-opacity-50 transition-opacity"></div>
            </a>
         </li>
      </ul>
   </div>
</div>

<!-- ✅ Mini helper CSS for image zoom on hover -->
<style>
   .transition-transform {
      transition: transform 0.4s ease;
   }
   .position-relative:hover img {
      transform: scale(1.05);
   }
</style>


					<!-- ✅ New Arrivals Section -->
<div class="container my-5">
   <div class="module extraslider-home5 titleLine position-relative mb-2">
      <h3 class="modtitle">New Arrivals</h3>
   </div>

   <div class="row" id="new-arrivals-list">
      @foreach ($products as $product)
         @php
            $images = $product->images->count()
               ? $product->images->pluck('image')->map(fn($img) => asset('uploads/'.$img))->toArray()
               : [asset($product->image)];
         @endphp

         <div class="col-md-3 col-sm-6 mb-4">
            <div class="card border-0 shadow-sm overflow-hidden h-100 hover-zoom position-relative">

               <!-- ✅ Discount & New Badges -->
               @if ($product->price > $product->offer_price)
                  @php
                     $discount = round((($product->price - $product->offer_price) / $product->price) * 100);
                  @endphp
                  <span class="label label-sale">-{{ $discount }}% OFF</span>
               @endif

               <span class="label label-new">New</span>

               <!-- ✅ Product Image with Thumbnails -->
               <div class="text-center">
                  <!-- Main Image -->
                  <img 
                     src="{{ $images[0] }}" 
                     id="main-image-{{ $product->id }}" 
                     class="img-fluid w-100 mb-2 main-product-image" 
                     style="height: 250px; object-fit: cover;"
                     alt="{{ $product->name }}"
                  >

                  <!-- Thumbnails -->
                  @if (count($images) > 1)
                     <div class="d-flex justify-content-center gap-2">
                        @foreach ($images as $index => $img)
                           <img 
                              src="{{ $img }}" 
                              data-main="#main-image-{{ $product->id }}" 
                              class="img-thumbnail product-thumbnail" 
                              style="width: 50px; height: 50px; object-fit: cover; cursor: pointer;"
                              alt="thumb"
                           >
                        @endforeach
                     </div>
                  @endif
               </div>

               <!-- ✅ Product Info -->
               <div class="card-body text-start">
                  <h5 class="fw-bolder text-uppercase mb-0 text-dark ms-3 text-center">
                     <strong>{{ $product->name }}</strong>
                  </h5>

                  @if ($product->price > $product->offer_price)
                     <p class="mb-1 text-center">
                        <span class="fw-bold text-danger fs-5">&#8377;{{ number_format($product->offer_price) }}</span>
                        <small class="text-muted ms-2"><del>&#8377;{{ number_format($product->price) }}</del></small>
                     </p>
                  @else
                     <p class="mb-1 fw-bold text-center">&#8377;{{ number_format($product->price) }}</p>
                  @endif

                  <!-- ✅ Buttons: Add to Cart & Wishlist -->
                  <div class="d-flex justify-content-start gap-2 mt-2 text-center">
                     <button 
                        type="button"
                        class="btn btn-sm btn-success add-to-cart-btn d-flex align-items-center gap-1"
                        data-id="{{ $product->id }}"
                        data-name="{{ $product->name }}"
                        data-price="{{ $product->offer_price }}"
                        data-image="{{ $images[0] }}"
                     >
                        <i class="fa fa-shopping-cart"></i> 
                        <span>Add to Cart</span>
                     </button>

                     <button 
                        type="button"
                        class="btn btn-sm btn-warning add-to-wishlist-btn d-flex align-items-center gap-1"
                        data-id="{{ $product->id }}"
                        data-name="{{ $product->name }}"
                        data-price="{{ $product->offer_price }}"
                        data-image="{{ $images[0] }}"
                     >
                        <i class="fa fa-heart"></i> 
                        <span>Wishlist</span>
                     </button>
                  </div>
               </div>

            </div>
         </div>
      @endforeach
   </div>

   <br>
   <!-- ✅ Product Pagination -->
   <div class="d-flex justify-content-between align-items-center mt-4 product-pagination-wrapper">
      @if ($products->previousPageUrl())
         <a href="{{ $products->previousPageUrl() }}"
            class="btn btn-primary product-pagination-link px-4 py-2 d-flex align-items-center gap-2 shadow-sm rounded-pill">
            <i class="bi bi-arrow-left"></i>
            <span>Previous</span>
         </a>
      @else
         <div></div>
      @endif

      @if ($products->nextPageUrl())
         <a href="{{ $products->nextPageUrl() }}"
            class="btn btn-primary product-pagination-link px-4 py-2 d-flex align-items-center gap-2 shadow-sm rounded-pill">
            <span>Next</span>
            <i class="bi bi-arrow-right"></i>
         </a>
      @endif
   </div>
</div>

<!-- ✅ AJAX Pagination Script -->
<script>
   $(document).on('click', '.product-pagination-link', function(e) {
      e.preventDefault();
      let button = $(this);
      let url = button.attr('href');

      $.ajax({
         url: url,
         type: "GET",
         beforeSend: function() {
            button.html('<span>Loading...</span>');
         },
         success: function(response) {
            $('#new-arrivals-list').fadeOut(200, function() {
               $(this).html($(response).find('#new-arrivals-list').html()).fadeIn(200);
            });
            $('.product-pagination-wrapper').html(
               $(response).find('.product-pagination-wrapper').html()
            );
         },
         error: function() {
            alert("Something went wrong!");
         }
      });
   });

   // ✅ Switch Main Image on Thumbnail Click
   $(document).on('click', '.product-thumbnail', function() {
      let mainImageSelector = $(this).data('main');
      let newSrc = $(this).attr('src');
      $(mainImageSelector).attr('src', newSrc);
   });
</script>



{{--  Separate AJAX for Products --}}
<script>
   $(document).on('click', '.product-pagination-link', function(e) {
      e.preventDefault();
      let button = $(this);
      let url = button.attr('href');

      $.ajax({
         url: url,
         type: "GET",
         beforeSend: function() {
            button.html('<span>Loading...</span>');
         },
         success: function(response) {
            $('#new-arrivals-list').fadeOut(200, function() {
               $(this).html($(response).find('#new-arrivals-list').html()).fadeIn(200);
            });
            $('.product-pagination-wrapper').html(
               $(response).find('.product-pagination-wrapper').html()
            );
         },
         error: function() {
            alert("Something went wrong!");
         }
      });
   });
</script>


					
					
								
							</div>
							
						</div>
					</div>
		
				
				</div>
			</div>
		</div>
		</div>
	</div>



	@endsection