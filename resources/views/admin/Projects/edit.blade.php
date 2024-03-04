
@extends('admin.master')

@section('title', 'Edit {{ $project->name }}')

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.3/tinymce.min.js" integrity="sha512-VCEWnpOl7PIhbYMcb64pqGZYez41C2uws/M/mDdGPy+vtEJHd9BqbShE4/VNnnZdr7YCPOjd+CBmYca/7WWWCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function(){
            tinymce.init({
                selector: 'textarea.desc'
            });
        });
    </script>
@stop

@section('content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit: {{ $project->trans_name }}</h1>
    <form action="{{ route('admin.projects.update', $project->id) }}" method="POST">
        @csrf
        @method('put')
        <div class="row">

            <div class="col-6 mb-3">
                <label>English Name</label>
                <input class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}" type="text" name="name_en" placeholder="project name" value="{{ old('name_en', $project->en_name) }}">
                @error('name_en')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-6 mb-3">
                <label>Arabic Name</label>
                <input class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}" type="text" name="name_ar" placeholder="project name" value="{{ old('name_ar', $project->ar_name) }}">
                @error('name_ar')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-6 mb-3">
                <label>English Description</label>
                <textarea class="desc" name="description_en">{{ old('description_en', $project->description_en) }}</textarea>
                @error('description_en')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-6 mb-3">
                <label>Arabic Description</label>
                <textarea class="desc" name="description_ar">{{ old('description_ar', $project->description_ar) }}</textarea>
                @error('description_ar')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-4 mb-3">
                <label>Budget</label>
                <input class="form-control {{ $errors->has('budget') ? 'is-invalid' : '' }}" type="text" name="budget" placeholder="project name" value="{{ old('budget', $project->budget) }}">
                @error('budget')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-4 mb-3">
                <label>Time</label>
                <input class="form-control {{ $errors->has('time') ? 'is-invalid' : '' }}" type="text" name="time" placeholder="project name" value="{{ old('time', $project->time) }}">
                @error('time')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-4 mb-3">
                <label>Category</label>
                <select name="category_id" class="form-control {{ $errors->has('category_id') ? 'is-invalid' : '' }}">
                    <option disabled selected value="" hidden> -- Select Category -- </option>
                    @foreach ($categories as $category)
                        <option {{ old('category_id', $project->category_id) == $category->id ? 'selected' : '' }} value="{{ $category->id }}">
                            {{ $category->trans_name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-success me-1">Add<i class="fas fa-save m-2"></i></button>
    </form>
    
@endsection
