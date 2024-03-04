
@extends('admin.master')

@section('title', 'Create New Category')

@section('content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Create New Category</h1>

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <div class="row">

            <div class="col-6 mb-3">
                <label>English Name</label>
                <input class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}" type="text" name="name_en" placeholder="Category name" value="{{ old('name_en') }}">
                @error('name_en')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-6 mb-3">
                <label>Arabic Name</label>
                <input class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}" type="text" name="name_ar" placeholder="Category name" value="{{ old('name_ar') }}">
                @error('name_ar')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <button class="btn btn-success me-1">Add<i class="fas fa-save m-2"></i></button>
    </form>
    
@endsection
