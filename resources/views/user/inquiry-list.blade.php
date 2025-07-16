@extends('user.master2')
@section('content')


    <div class="container mt-4">
   <h1 class="text-center">Inquiry's Data</h1>

 @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($inquiries->isEmpty())
        <p class="text-center">No data available.</p>
    @else
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="table-container">
                <div class="t-header" style="text-align: center; font-size: 18px;"> Heading</div>

                <div class="table-responsive">
                    <div id="copy-print-csv_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <table id="copy-print-csv" class="table custom-table dataTable no-footer" role="grid" aria-describedby="copy-print-csv_info">
                            <thead>
                                <tr role="row">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                    <th>Reply</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($inquiries as $inquiry)
                            <tr>
                                <td>{{ $inquiry->id }}</td>
                                <td>{{ $inquiry->name }}</td>
                                <td>{{ $inquiry->email }}</td>
                                <td>{{ $inquiry->subject }}</td>
                                <td>{{ $inquiry->message }}</td>
                                <td>{{ ucfirst($inquiry->status) }}</td>
                                <td>{{ $inquiry->reply }}</td>
                                <td>{{ $inquiry->created_at->format('Y-m-d H:i') }}</td>
                                <td>
                                @if($inquiry->status !== 'approved')
                                    <a href="{{ route('user.edit', $inquiry->id) }}" class="btn btn-warning btn-sm mb-1">Edit</a>

                                    <form method="POST" action="{{ route('user.delete', $inquiry->id) }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                @else
                                    <span class="badge bg-success">Approved</span>
                                @endif
                            </td>

                            </tr>
                            @endforeach
                     
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
@endsection
