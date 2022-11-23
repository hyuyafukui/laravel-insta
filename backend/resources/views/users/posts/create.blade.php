@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
    <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <label for="category" class="form-label fw-bold d-block mt-5">Category <span class="text-muted">(up to
                3)</span></label>

        @forelse ($all_categories as $category)
            <div class="form-check form-check-inline">
                <input type="checkbox" name="category[]" value="{{ $category->id }}" id="{{ $category->name}}"
                    class="form-check-input">
                <label for="{{ $category->id }}" class="form-check-label me-3">{{ $category->name }}</label>
            </div>
        @empty
            <p class="text-danger">Not Category</p>
        @endforelse

        @error('category')
            <p class="text-danger small">{{ $message }}</p>
        @enderror


        <label for="description" class="form-label mt-4 fw-bold d-block">Description</label>
        <textarea name="description" id="description" cols="30" rows="5" class="form-control"
            placeholder="What's on your mind">{{ old('description') }}</textarea>

        @error('description')
            <p class="text-danger small">{{ $message }}</p>
        @enderror

        <label for="image" class="form-label mt-4 fw-bold">Image</label>
        <input type="file" name="image" id="image" class="form-control" aria-describedby="image-info">
        @error('image')
            <p class="text-danger small">{{ $message }}</p>
        @enderror
        <div class="form-text" id="image-info">
            Acceptable formats: jpeg, jpg, png, gif only <br>
            Max size is 1048 KB
        </div>



        <button type="submit" class="btn btn-primary mt-4">Post</button>
    </form>
@endsection
