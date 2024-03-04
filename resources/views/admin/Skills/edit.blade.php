
@extends('admin.master')

@section('title', 'Edit {{ $skill->name }}')

@section('content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit: {{ $skill->trans_name }}</h1>

    <form action="{{ route('admin.skills.update', $skill->id) }}" method="POST">
        @csrf
        @method('put')
        <div class="row">

            <div class="col-6 mb-3">
                <label>English Name</label>
                <input class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}" type="text" name="name_en" placeholder="skill name" value="{{ old('name_en', $skill->en_name) }}">
                @error('name_en')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-6 mb-3">
                <label>Arabic Name</label>
                <input class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}" type="text" name="name_ar" placeholder="skill name" value="{{ old('name_ar', $skill->ar_name) }}">
                @error('name_ar')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <button class="btn btn-success me-1">Save<i class="fas fa-save m-2"></i></button>
    </form>
    
@endsection
