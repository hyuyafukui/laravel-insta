@extends('layouts.app')

@section('title', 'Followers')

@section('content')
    @include('users.profile.header')

    @if ($user->followers->isNotEmpty())
        <h3 class="text-secondary text-center mt-5">Followers</h3>
        <div class="row justify-content-center">
            <div class="col-4">
                @foreach ($user->followers as $follower)
                    <div class="row align-items-center mt-2">
                        {{-- avatar/icon --}}
                        <div class="col-auto">
                          @if ($follower->follower->avatar)
                            <a href="">
                                    <img src="{{ asset('storage/avatars/' . $follower->follower->avatar) }}" alt=""
                                        class="rounded-circle mx-auto d-block avatar-sm">
                            </a>
                          @else
                    <i class="fa-solid fa-circle-user icon-sm text-secondary"></i>

                          @endif
                        </div>

                        {{-- user name --}}
                        <div class="col">
                            <a href="#" class="text-decoration-none text-dark fw-bold">
                                {{ $follower->follower->name }}
                            </a>
                        </div>

                        {{-- follow button --}}
                        <div class="col-auto">
                          @if($follower->follower->isFollowed())
                          {{-- unfollow --}}
                          <form action="{{ route('follow.destroy', $follower_id) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="shadow-none bg-transparent border-0 text-secondary">Unfollow</button>
                          </form>
                          @else
                          <form action="{{ route('follow.store', $follower->follower_id) }}" method="post">
                          @csrf
                          <button type="submit" class="shadow-none bg-transparent border-^ text-primary">Follow</button>
                        </form>
                          @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <h3 class="text-muted text-center">No followers</h3>
    @endif
@endsection
