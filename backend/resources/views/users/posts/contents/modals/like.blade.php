<div class="modal" id="likes-post-{{ $post->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="buttton" class="text-primary ms-auto" data-bs-dismiss="modal">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <div class="modal-body">
                @foreach ($post->likes as $like)
                    <div class="row align-items-center mx-5">
                        <div class="col-auto">
                            <a href="{{ route('profile.show', $like->user->id) }}">
                                @if ($like->user->avatar)
                                    <img src="{{ asset('storage/images/' . $like->user->avatar) }}" alt=""
                                        class="d-block mx-auto avatar-sm rounded-circle">
                                @else
                                    <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                @endif
                            </a>
                        </div>

                        <div class="col-6">
                            <a href="{{ route('profile.show', $like->user->id) }}"
                                class="text-dark text-decoration-none fw-bold">
                                {{ $like->user->name }}</a>
                        </div>
                        <div class="col-auto">
                            @if ($like->user->id != Auth::user()->id)
                                @if ($like->user->isFollowed())
                                    <form action="{{ route('follow.destroy', $like->user->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn text-secondary">Unfollow</button>
                                    </form>
                                @else
                                    <form action="{{ route('follow.store', $like->user->id) }}" method="post">
                                        @csrf

                                        <button type="submit" class="btn text-primary">Follow</button>
                                    </form>
                                @endif
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
