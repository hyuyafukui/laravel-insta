@extends('layouts.app')

@section('title', 'Following')

@section('content')
    @include('users.profile.header')

    @if ($user->follows->isNotEmpty())
        <h3 class="text-secondary text-center mt-5">Following</h3>
        <div class="row justify-content-center">
            <div class="col-4">
                @foreach ($user->follows as $follow)
                    <div class="row align-items-center mt-2">
                        {{-- avatar/icon --}}
                        <div class="col-auto">
                            @if ($follow->followed->avatar)
                                <a href="{{ route('profile.show', $follow->followed_id) }}">
                                    <img src="{{ asset('storage/avatars/' . $follow->followed->avatar) }}" alt=""
                                        class="rounded-circle mx-auto d-block avatar-sm">
                                </a>
                            @else
                                <i class="fa-solid fa-circle-user mx-auto d-block icon-sm text-secondary"></i>
                            @endif
                        </div>

                        {{-- user name --}}
                        <div class="col">
                            <a href="{{ route('profile.show', $follow->followed_id) }}" class="text-decoration-none text-dark fw-bold">
                                {{ $follow->followed->name }}
                            </a>
                        </div>

                        {{-- follow button --}}
                        <div class="col-auto">
                            @if ($follow->followed->isFollowed())
                                {{-- unfollow --}}
                                <form action="{{ route('follow.destroy', $follow->followed_id) }}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="shadow-none bg-transparent border-0 text-secondary">Unfollow</button>
                                </form>
                            @else
                                <form action="{{ route('follow.store', $follow->followed_id) }}" method="post">
                                    @csrf
                                    <button type="submit"
                                        class="shadow-none bg-transparent border-^ text-primary">Follow</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <h3 class="text-muted text-center">Not following anyone</h3>
    @endif


@endsection
