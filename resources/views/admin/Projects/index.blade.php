
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
    <h1 class="h3 mb-4 text-gray-800">All projects</h1>
    
    <table class="table table-bordered table-striped text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Owner</th>
                <th>Created at</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($projects as $project)
                <tr>
                    <td>{{ $project->id }}</td>
                    <td>{{ $project->trans_name }}</td>
                    <td>{{ $project->category->trans_name }}</td>
                    <td>{{ $project->User->name }}</td>
                    <td>{{ $project->created_at->format('M d,Y') }}</td>
                    <td class="d-flex justify-content-around">
                        <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-success btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.projects.destroy', $project->id) }}">
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
                    <td colspan="4">
                        No Data Found
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection

@section('script')
    <script>
        setTimeout(function() {
            $('.alert').fadeOut();
        }, 3000);
    </script>
    
@endsection