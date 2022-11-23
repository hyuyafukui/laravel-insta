<div class="p-0">
  <a href="{{ route('post.show', $post->id) }}" class="text-decoration-none">
    <img src="{{ asset('storage/images/' . $post->image) }}" alt="" class="w-100">
  </a>
</div>
<div class="card-body">
  <div class="row align-items-center mb-2">
    <div class="col-auto">
      {{-- heart --}}
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

        <button type="submit" class="btn border-none bg-transparent px-0">
          <i class="fa-regular fa-heart px-0"></i>
        </button>
      </form>         
      @endif
    </div>

    <div class="col-auto px-0">
      <button class="border-0 bg-transparent" data-bs-toggle="modal" data-bs-target="#likes-post-{{ $post->id }}">
        {{ $post->likes->count() }}
      </button>
    </div>

    @include('users.posts.contents.modals.like')

    <div class="col text-end">
      {{-- categories --}}
      @forelse ($post->categoryPosts as $categoryPost)
          <div class="badge bg-secondary bg-opacity-50">{{ $categoryPost->category->name }}</div>
      @empty
          <div class="badge bg-dark">Uncategorized</div>
      @endforelse
    </div>
  </div>

  {{-- owner and description --}}
  <a href="{{ route('profile.show', $post->user->id) }}" class="text-dark fw-bold text-decoration-none me-2">{{ $post->user->name }}</a>
  <p class="d-inline">{{ $post->description }}</p>
  <p class="text-muted xsmall text-uppercase">{{ date('M d, Y', strtotime($post->created_at)) }}</p>

  <hr class="my-3">

  {{-- list comments --}}
  @foreach($post->comments->take(3) as $comment)
  <div class="mb-3">
    <a href="{{ route('profile.show', $comment->user->id) }}" class="text-decoration-none text-dark fw-bold me-2">{{ $comment->user->name }}</a>
    <span>{{ $comment->body }}</span>

      <form action="{{ route('comment.destroy', $comment->id) }}" method="post" class="small">
        @csrf
        @method('DELETE')
        <span class="text-muted">{{ date('D, M d, Y', strtotime($comment->created_at)) }}</span>
        @if ($comment->user_id == Auth::user()->id)          
        &middot;
        <button type="submit" class="text-danger border-0 bg-transparent">Delete</button>
        @endif
      </form>
  </div>
  @endforeach
  @if ($post->comments->count() > 3)
  <a href="{{ route('post.show', $post->id) }}" class="small text-decoration-none mb-3">View all comments</a>
  @endif

  {{-- comments form --}}
  <form action="{{ route('comment.store', $post->id) }}" method="post">
    @csrf
    <div class="input-group">
      <textarea name="comment_body{{ $post->id }}" id="comment_body{{ $post->id }}" cols="30" rows="1" class="form-control form-control-sm"></textarea>
      <button type="submit" class="btn btn-sm btn-outline-secondary">Post</button>
    </div>
    @error('comment_body'.$post->id)
    <p class="text-danger small">{{ $message }}</p>
    @enderror
  </form>
</div>