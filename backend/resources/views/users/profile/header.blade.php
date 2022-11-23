<div class="row mt-5">
    {{-- avatar --}}
    <div class="col-4">
        @if ($user->avatar)
            <img src="{{ asset('storage/avatars/' . $user->avatar) }}" alt=""
                class="rounded-circle d-block mx-auto avatar-lg">
        @else
            <i class="fa-solid fa-circle-user text-secondary icon-lg"></i>
        @endif
    </div>

    {{-- user info --}}
    <div class="col-8">
        <div class="row align-items-center mb-3">
            <div class="col-auto">
                <h2 class="display-6 mb-0">{{ $user->name }}</h2>
            </div>

            <div class="col">
                @if ($user->id == Auth::user()->id)
                    <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-outline-secondary">Edit Profile</a>
                @else
                    @if ($user->isFollowed())
                        {{-- unfollow --}}
                        <form action="{{ route('follow.destroy', $user->id) }}" method="post" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-secondaty">Unfollow</button>
                        </form>
                    @else
                        <form action="{{ route('follow.store', $user->id) }}" method="post" class="d-inline">
                            @csrf

                            <button type="submit" class="btn btn-primary">Follow</button>
                        </form>
                    @endif
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-auto">
                <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none text-dark">
                    <span class="fw-bold">{{ $user->posts->count() }}</span>
                    {{ $user->posts->count() == 1 ? 'post' : 'posts' }}
                    {{-- if statement ? true : else --}}
                </a>
            </div>

            <div class="col-auto">
                <a href="{{ route('profile.followers', $user->id) }}" class="text-decoration-none text-dark">
                    <span class="fw-bold">{{ $user->followers->count() }}</span>
                    {{ $user->followers->count() == 1 ? 'follower' : 'followers' }}
                </a>
            </div>

            <div class="col-auto">
                <a href="{{ route('profile.following', $user->id) }}" class="text-decoration-none text-dark">
                    <span class="fw-bold">{{ $user->follows->count() }}</span>
                    {{ $user->follows->count()  == 1 ? 'following' : 'following' }}
                </a>
            </div>
        </div>

        <p class="fw-bold">{{ $user->introduction }}</p>
    </div>
</div>
