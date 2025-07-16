@extends('admin.master2')

@section('content')

<div class="container mt-4">
    <h1 class="text-center text-capitalize">{{ $status }} Users</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($users->isEmpty())
        <p class="text-center">No data available.</p>
    @else

    
        <form method="POST" action="{{ route('admin.users.bulk.status.update') }}">
            @csrf
            <input type="hidden" name="status" value="{{ $status === 'pending' ? 'approved' : 'pending' }}">

            {{-- Mark As selected --}}
            <button type="submit" class="btn btn-{{ $status === 'pending' ? 'success' : 'success' }} mb-3">
                Mark Selected as {{ $status === 'pending' ? 'Approved' : 'Pending' }}
            </button>

       {{-- Mark All --}}
            <button type="submit" class="btn btn-{{ $status === 'pending' ? 'warning' : 'warning' }} mb-3">
                Mark All as {{ $status === 'pending' ? 'Approved' : 'Pending' }}
            </button>

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="table-container">

                                <div class="table-responsive">
                                    <div id="copy-print-csv_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                       
                                        <table id="copy-print-csv" class="table custom-table dataTable no-footer" role="grid" aria-describedby="copy-print-csv_info">
                                            <thead>
                        <tr>
                            <th>Select</th>
                            <th>#</th>
                            <th>User's Name</th>
                            <th>User's Email</th>
                            <th>User's Phone</th>
                            <th>Status</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach($users as $user)
                        <tr>
                            <td>
                                <div class="form-check text-center mb-3">
                                    <input type="checkbox" class="form-check-input user-checkbox" name="user_ids[]" value="{{ $user->id }}">
                                </div>
                            </td>
                            <td>{{ $i++ }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td class="status-cell">{{ $user->status }}</td>
                            <td>{{ $user->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    @endif
</div>

@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Show "Mark Selected" button when checkboxes are selected
    $(document).on('change', '.user-checkbox', function () {
        const checkedCount = $('.user-checkbox:checked').length;
        if (checkedCount > 0) {
            $('#bulk-status-btn').removeClass('d-none');
        } else {
            $('#bulk-status-btn').addClass('d-none');
        }
    });

    // AJAX toggle status
    $(document).on('change', '.status-toggle', function () {
        const userId = $(this).data('id');
        const row = $(this).closest('tr');

        $.ajax({
            url: '{{ route("admin.user.ajax.toggle") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                user_id: userId
            },
            success: function (response) {
                if (response.success) {
                    row.find('.status-cell').text(response.new_status);
                } else {
                    alert('Something went wrong.');
                }
            },
            error: function () {
                alert('Error while updating status.');
            }
        });
    });
</script>
@endsection
