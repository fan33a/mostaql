
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
    <h1 class="h3 mb-4 text-gray-800">All skills</h1>
    
    <table class="table table-bordered table-striped text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Created at</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($skills as $skill)
                <tr>
                    <td>{{ $skill->id }}</td>
                    <td>{{ $skill->trans_name }}</td>
                    <td>{{ $skill->created_at->format('M d,Y') }}</td>
                    <td class="d-flex justify-content-around">
                        <a href="{{ route('admin.skills.edit', $skill->id) }}" class="btn btn-success btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.skills.destroy', $skill->id) }}">
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