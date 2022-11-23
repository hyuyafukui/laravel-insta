@extends('layouts.app')

@section('title', 'Profile')

@section('content')
@include('users.profile.header')

<div class="mt-5 w-100">
  <div class="row mt-5">
    @forelse ($user->posts as $post)
        <div class="col-lg-4 col-md-6 mb-4">
          <a href="{{ route('post.show', $post->id) }}" class="text-decoration-none">
            <img src="{{ asset('storage/images/'. $post->image) }}" alt="" class="grid-img">
          </a>
        </div>
    @empty
        <h3 class="text-muted text-center">No posts yet.</h3>
    @endforelse
  </div>
</div>

    
@endsection