<div class="card-header bg-white py-3">
    <div class="row align-items-center">
        <div class="col-auto">
            <a href="{{ route('profile.show', $post->user->id) }}" class="text-decoration-none">
                @if ($post->user->avatar)
                    {{-- display avatar here --}}
                    <img src="{{ asset('storage/avatars/' . $post->user->avatar) }}" alt=""
                        class="rounded-circle d-block mx-auto avatar-sm">
                @else
                    <i class="fa-solid fa-circle-user icon-sm text-secondary"></i>
                @endif
            </a>
        </div>
        <div class="col ps-0">
            <a href="{{ route('profile.show', $post->user->id) }}"
                class="text-decoration-none text-dark">{{ $post->user->name }}</a>
        </div>
        <div class="col-auto">
            <div class="dropdown">
                <button class="btn btn-sm shadow-none" data-bs-toggle="dropdown">
                    <i class="fa-solid fa-ellipsis"></i>
                </button>

                @if ($post->user_id == Auth::user()->id)
                    <div class="dropdown-menu">
                        {{-- edit and delete --}}
                        <a href="{{ route('post.edit', $post->id) }}" class="dropdown-item">
                            <i class="fa-regular fa-pen-to-square me-1"></i>Edit
                        </a>

                        <button class="dropdown-item text-danger" data-bs-toggle="modal"
                            data-bs-target="#delete-post-{{ $post->id }}">
                            <i class="fa-regular fa-trash-can me-1"></i>Delete
                        </button>
                    </div>
                @else
                    <div class="dropdown-menu">
                        @if ($post->user->isFollowed())
                            {{-- unfollow --}}
                            <form action="{{ route('follow.destroy', $post->user->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button tupe="sumbit" class="dropdown-item text-danger">Unfollow</button>
                            </form>
                        @else
                            <form action="{{ route('follow.store', $post->user->id) }}" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item text-primary">Follow</button>
                            </form>
                        @endif
                    </div>
                @endif


            </div>
        </div>
    </div>
</div>

{{-- include modal window here --}}
@include('users.posts.contents.modals.delete')
