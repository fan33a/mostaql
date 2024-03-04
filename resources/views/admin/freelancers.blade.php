
@extends('admin.master')

@section('title', 'Dashboard')

@section('content')


        @if (session('msg'))    
        <div class="alert alert-{{ session('type') }} alert-dismissible fade show" role="alert">
                {{ session('msg') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>
        @endif
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">All Freelancers</h1>
    
    <table class="table table-bordered table-striped text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td class="d-flex justify-content-around">
                        <form method="POST" action="{{ route('admin.freelancers.destroy', $user->id) }}">
                            @csrf
                            @method('delete')
                            <button onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">
                        No Data Found
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection

@section('script')
@endsection