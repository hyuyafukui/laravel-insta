@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
<form action="{{ route('post.update', $post->id) }}" method="post" enctype="multipart/form-data">
    @csrf 
    @method('PATCH')

    <label for="category" class="form-label fw-bold d-block">Category <span class="text-muted">(up to 3)</span></label>
    @foreach($all_categories as $category)
    <div class="form-check form-check-inline">
      @if (in_array($category->id, $selected_categories))
      <input type="checkbox" name="category[]" id="{{ $category->name }}" value="{{ $category->id }}" class="form-check-input" checked>          
      @else
      <input type="checkbox" name="category[]" id="{{ $category->name }}" value="{{ $category->id }}" class="form-check-input">          
      @endif
      <label for="{{ $category->name }}" class="form-check-label">{{ $category->name }}</label>
    </div>
    @endforeach
    @error('category')
    <p class="text-danger small">{{ $message }}</p>
    @enderror

    <label for="description" class="form-label mt-3 fw-bold d-block">Description</label>
    <textarea name="description" id="description" cols="30" rows="5" class="form-control" placeholder="What's on your mind">{{ old('description', $post->description) }}</textarea>
    @error('description')
    <p class="text-danger small">{{ $message }}</p>
    @enderror

    <div class="w-50">
        <label for="image" class="form-label mt-3 fw-bold">Image</label>
        <img src="{{ asset('storage/images/'.$post->image) }}" alt="" class="img-thumbnail mb-1 d-block">
        <input type="file" name="image" id="image" class="form-control" aria-describedby="image-info">
        @error('image')
        <p class="text-danger small">{{ $message }}</p>
        @enderror
        <div id="image-info" class="form-text">
            Acceptable formats: jpeg, jpg, png, gif only <br>
            Max size is 1048 KB
        </div>
    </div>

    <button type="submit" class="btn btn-warning mt-4">Save</button>
</form>

@endsection