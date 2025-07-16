@extends('admin.master2')
@section('content')

<div class="container">
    <h2>Product List</h2>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">Add Product</a>

    <button type="button" class="btn btn-danger mb-3 ml-2" id="bulk-delete">Delete Selected</button>
    <button type="button" class="btn btn-success mb-3 ml-2" id="bulk-activate">Activate Selected</button>
    <button type="button" class="btn btn-warning mb-3 ml-2" id="bulk-deactivate">Deactivate Selected</button>

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
                <table id="copy-print-csv" class="table custom-table dataTable no-footer" role="grid" aria-describedby="copy-print-csv_info">
                    <thead>
                        <tr>
                            <th>Select</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Offer Price</th>
                            <th>Discount</th> 
                            <th>Description</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $index => $product)
                            @php
                                $discount = 0;
                                if ($product->price > $product->offer_price && $product->price > 0) {
                                    $discount = round( ( ($product->price - $product->offer_price) / $product->price ) * 100 );
                                }
                            @endphp
                            <tr>
                                <td>
                                    <div class="form-check text-center mb-3">
                                        <input type="checkbox" class="form-check-input user-checkbox" name="product_ids[]" value="{{ $product->id }}">
                                    </div>
                                </td>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->brand }}</td>
                                <td>{{ $product->category }}</td>
                                <td>₹{{ $product->price }}</td>
                                <td>₹{{ $product->offer_price }}</td>
                                <td>
                                    @if($discount > 0)
                                        <span class="badge badge-danger">-{{ $discount }}%</span>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>{{ $product->description }}</td>
                                <td>
                                    @if($product->image)
                                        <img src="{{ asset($product->image) }}" width="50" height="50">
                                    @endif
                                </td>
                                <td>{{ $product->status ? 'Active' : 'Inactive' }}</td>
                                <td>{{ $product->created_at->format('Y-m-d H:i') }}</td>
                                <td>
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                        @csrf @method('DELETE')
                                        <button onclick="return confirm('Delete this product?')" class="btn btn-sm btn-danger">Delete</button>
                                    </form>

                                    @if($product->status != 1)
                                        <form method="POST" action="{{ route('admin.active', $product->id) }}" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Active</button>
                                        </form>
                                    @else
                                        <span class="badge bg-success">Activated</span>
                                    @endif

                                    <!-- Upload Images Modal Trigger -->
                                    <button type="button" class="btn btn-primary btn-sm mt-1" data-toggle="modal" data-target="#uploadModal{{ $product->id }}">
                                        Upload Images
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="uploadModal{{ $product->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $product->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">{{ $product->name }} - Upload Images</h5>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <div class="modal-body">
                                                    <!-- Upload Form -->
                                                    <form class="upload-form" data-product-id="{{ $product->id }}" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="file" name="images[]" multiple accept="image/*" class="form-control mb-3">
                                                        <button type="submit" class="btn btn-success">Upload</button>
                                                    </form>

                                                    <hr>

                                                    <!-- Uploaded Images Grid -->
                                                    <h6 class="mt-4">Uploaded Images:</h6>
                                                    <div class="row image-grid" id="image-grid-{{ $product->id }}">
                                                        @forelse($product->images as $img)
                                                            <div class="col-md-3 mb-4 text-center image-card" data-image-id="{{ $img->id }}">
                                                                <div class="card">
                                                                    <img src="{{ asset('uploads/' . $img->image) }}" class="card-img-top" style="height:150px; object-fit:cover;">
                                                                    <div class="card-body p-2">
                                                                        <button class="btn btn-danger btn-sm w-100 delete-image-btn" data-id="{{ $img->id }}">Delete</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @empty
                                                            <div class="col-12"><p>No images uploaded yet.</p></div>
                                                        @endforelse
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {

    // UPLOAD IMAGES
    $(document).on('submit', '.upload-form', function(e) {
        e.preventDefault();
        let form = $(this);
        let productId = form.data('product-id');
        let formData = new FormData(this);
        formData.append('_token', '{{ csrf_token() }}');

        $.ajax({
            url: "{{ url('admin/product/images/upload') }}/" + productId,  // ✅ COMMA FIXED BELOW
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(res) {
                let grid = $("#image-grid-" + productId);
                grid.empty();
                if (res.images.length === 0) {
                    grid.append('<div class="col-12"><p>No images uploaded yet.</p></div>');
                } else {
                    res.images.forEach(function(img) {
                        grid.append(`
                            <div class="col-md-3 mb-4 text-center image-card" data-image-id="${img.id}">
                                <div class="card">
                                    <img src="/uploads/${img.image}" class="card-img-top" style="height:150px; object-fit:cover;">
                                    <div class="card-body p-2">
                                        <button class="btn btn-danger btn-sm w-100 delete-image-btn" data-id="${img.id}">Delete</button>
                                    </div>
                                </div>
                            </div>
                        `);
                    });
                }
                form[0].reset();
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                alert('Upload failed. Please try again.');
            }
        });
    });

    // DELETE IMAGE
    $(document).on('click', '.delete-image-btn', function(e) {
        e.preventDefault();
        if (!confirm('Delete this image?')) return;

        let btn = $(this);
        let imageId = btn.data('id');

        $.ajax({
            url: "{{ url('admin/product/images/destroy') }}/" + imageId,  // ✅ COMMA FIXED BELOW
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                _method: "DELETE"
            },
            success: function(res) {
                btn.closest('.image-card').remove();
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                alert('Delete failed. Please try again.');
            }
        });
    });

    // BULK DELETE
    $('#bulk-delete').click(function() {
        let selected = [];
        $('input.user-checkbox:checked').each(function() {
            selected.push($(this).val());
        });

        if (selected.length === 0) {
            alert('Please select at least one product.');
            return;
        }

        if (!confirm('Are you sure you want to delete selected products?')) return;

        $.ajax({
            url: "{{ route('admin.bulkDelete') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                ids: selected
            },
            success: function(res) {
                location.reload();
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                alert('Bulk delete failed.');
            }
        });
    });

    // BULK ACTIVATE
    $('#bulk-activate').click(function() {
        let selected = [];
        $('input.user-checkbox:checked').each(function() {
            selected.push($(this).val());
        });

        if (selected.length === 0) {
            alert('Please select at least one product.');
            return;
        }

        $.ajax({
            url: "{{ route('admin.bulkActivate') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                ids: selected
            },
            success: function(res) {
                location.reload();
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                alert('Bulk activate failed.');
            }
        });
    });

    // BULK DEACTIVATE
    $('#bulk-deactivate').click(function() {
        let selected = [];
        $('input.user-checkbox:checked').each(function() {
            selected.push($(this).val());
        });

        if (selected.length === 0) {
            alert('Please select at least one product.');
            return;
        }

        $.ajax({
            url: "{{ route('admin.bulkDeactivate') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                ids: selected
            },
            success: function(res) {
                location.reload();
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                alert('Bulk deactivate failed.');
            }
        });
    });

});
</script>

@endsection
