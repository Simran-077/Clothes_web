@extends('admin.master2')

@section('content')


<div class="container mt-3">
    <h2>Category List</h2>

    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3">Add New Category</a>

    <button type="button" class="btn btn-danger mb-3 ml-2" id="delete">Delete Selected</button>
    <button type="button" class="btn btn-success mb-3 ml-2" id="activate-bulk">Activate Selected</button>
    <button type="button" class="btn btn-warning mb-3 ml-2" id="deactivate-bulk">Deactivate Selected</button>


    

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
                <th>#</th>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Update</th>
                {{-- <th>Actions</th> --}}
            </tr>
        </thead>
        <tbody>
             @foreach($categories_data as $index => $cat)
             
            <tr>
                  <td>
                                <div class="form-check text-center mb-3">
                                    <input type="checkbox" class="form-check-input user-checkbox" name="cat_ids[]" value="{{ $cat->id }}">
                                </div>
                            </td>

                <td>{{ $index + 1 }}</td>
                <td>
                    @if($cat->image)
                        <img src="{{ asset('uploads/categories/' . $cat->image) }}" width="50">
                    @else
                        N/A
                    @endif
                </td>
                <td>{{ $cat->name }}</td>
               <td>{{ $cat->status ? 'Active' : 'Inactive' }}</td>
                <td>{{ $cat->created_at }}</td>
                <td>
                    <form action="{{ route('admin.categories.update', $cat->id) }}" method="POST" enctype="multipart/form-data" class="d-inline">
                        @csrf
                        <input type="text" name="name" required>
                        <input type="file" name="image" accept="image/*">
                        <button class="btn btn-success btn-sm">Update</button>
                    </form>
                    
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

// BULK DELETE
$('#delete').click(function() {
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
        url: "{{ route('admin.Delete') }}",
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
$('#activate-bulk').click(function() {
    let selected = [];
    $('input.user-checkbox:checked').each(function() {
        selected.push($(this).val());
    });

    if (selected.length === 0) {
        alert('Please select at least one product.');
        return;
    }

    $.ajax({
        url: "{{ route('admin.ActivateBulk') }}",
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
$('#deactivate-bulk').click(function() {
    let selected = [];
    $('input.user-checkbox:checked').each(function() {
        selected.push($(this).val());
    });

    if (selected.length === 0) {
        alert('Please select at least one product.');
        return;
    }

    $.ajax({
        url: "{{ route('admin.DeactivateBulk') }}",
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

</script>

@endsection








    