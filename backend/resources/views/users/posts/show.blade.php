@extends('layouts.app')

@section('title', 'Show Post')

@section('content')
<style>
  .col-4 {
    overflow-y: scroll;
  }
  .card-body {
    position:absolute;
    top:65px;
  }
</style>

    <div class="row mt-5">
        <!-- image -->
        <div class="col border-end p-0">
            <img src="{{ asset('storage/images/' . $post->image) }}" alt="" class="w-100">
        </div>

        <!-- post data -->
        <div class="col-4 px-0">
            <div class="card border-0">
                @include('users.posts.contents.title')

                <div class="card-body w-100">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <!-- heart -->
                            @if ($post->isLiked())
                            {{-- unlike --}}
                            <form action="{{ route('like.destroy', $post->id) }}" method="post">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn shadow-none p-0">
                                    <i class="fa-solid fa-heart text-danger"></i>
                                </button>
                            </form>
                            @else                               
                            <form action="{{ route('like.store', $post->id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn shadow-none p-0">
                                    <i class="fa-regular fa-heart"></i>
                                </button>
                            </form>
                            @endif
                        </div>

                        <div class="col-auto px-0">
                            {{  $post->likes->count() }}
                        </div>

                        <div class="col text-end">
                            <!-- categories -->
                            @forelse($post->categoryPosts as $categoryPost)
                                <div class="badge bg-secondary bg-opacity-50">{{ $categoryPost->category->name }}</div>

                            @empty
                                <div class="badge bg-dark">Uncategorized</div>
                            @endforelse
                        </div>
                    </div>

                    <!-- owner and description -->
                    <a href="{{ route('profile.show', $post->user->id) }}" class="text-dark fw-bold text-decoration-none me-2">{{ $post->user->name }}</a>
                    <p class="d-inline">{{ $post->description }}</p>
                    <p class="text-muted xsmall text-uppercase">{{ date('M d, Y', strtotime($post->created_at)) }}</p>

                    {{-- list comments --}}
                    @foreach ($post->comments as $comment)
                        <div class="mb-3">
                            <a href="{{ route('profile.show', $comment->user->id) }}"
                                class="text-decoration-none text-dark fw-bold me-2">{{ $comment->user->name }}</a>
                            <span>{{ $comment->body }}</span>

                            <form action="{{ route('comment.destroy', $comment->id) }}" method="post" class="small">
                                @csrf
                                @method('DELETE')
                                &middot;
                                <span class="text-muted">{{ date('D, M d, Y', strtotime($comment->created_at)) }}</span>
                                <button type="submit" class="text-danger border-0 bg-transparent">Delete</button>
                            </form>
                        </div>
                    @endforeach

                    <form action="{{ route('comment.store', $post->id) }}" method="post" class="mt-3">
                        @csrf
                        <div class="input-group">
                            <textarea name="comment_body{{ $post->id }}" id="comment_body{{ $post->id }}" cols="30" rows="1"
                                class="form-control form-control-sm"></textarea>
                            <button type="submit" class="btn btn-sm btn-outline-secondary">Post</button>
                        </div>
                        @error('comment_body' . $post->id)
                            <p class="text-danger small">{{ $message }}</p>
                        @enderror
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
