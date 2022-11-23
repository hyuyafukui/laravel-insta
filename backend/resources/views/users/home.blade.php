@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="row gx-5">
        <div class="col-8">
            @if ($search)
                <p class="h5 text-muted mb-4">Seach results for <span class="fw-bold">{{ $search }}</span></p>
            @endif
            @forelse ($all_posts as $post)
                <div class="card mb-4 mt-5">
                    {{-- title --}}
                    @include('users/posts/contents.title')
                    {{-- body --}}
                    @include('users/posts/contents.body')
                </div>
            @empty
                <div class="text-center mt-5">
                    <h2>Share Photos</h2>
                    <p class="text-muted">When you share photos, they'll appear on your profile.</p>
                    <p><a href="{{ route('post.create') }}" class="text-decoration-none">Share your first photo</a></p>
                </div>
            @endforelse
        </div>

        <div class="col-4 mt-5">
            <div class="row align-items-start rounded-3 shadow-sm">
                <div class="col-auto p-3">
                    <a href="{{ route('profile.show', Auth::user()->id) }}">
                        @if (Auth::user()->avatar)
                            <img src="{{ asset('storage/avatars/' . Auth::user()->avatar) }}" alt=""
                                class="rounded-circle d-block mx-auto avatar-md">
                        @else
                            <i class="fa-solid fa-circle-user text-secondary icon-md"></i>
                        @endif
                    </a>
                </div>

                <div class="col py-3">
                    <a href="{{ route('profile.show', Auth::user()->id) }}" class="text-decoration-none text-dark fw-bold">
                        {{ Auth::user()->name }}
                    </a>
                    <p class="text-muted small">{{ Auth::user()->email }}</p>
                </div>
            </div>

            {{-- suggestions --}}
            <div class="row mt-5 mb-3">
                <div class="col">
                    <h3 class="h6 text-secondary">Suggestion For You</h3>
                </div>
                <div class="col-auto">
                    <a href="{{ route('home.suggested-user') }}" class="text-decoration-none fw-bold text-dark">See all</a>
                </div>
            </div>


            @foreach (array_slice($suggested_users, 0, 10) as $u)
                <div class="row align-items-center mt-3 gx-2">
                    <div class="col-auto">
                        <a href="{{ route('profile.show', $u->id) }}">
                            @if ($u->avatar)
                                <img src="{{ asset('storage/avatars/' . $u->avatar) }}" alt=""
                                    class="rounded-circle d-block mx-auto avatar-sm">
                            @else
                                <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                            @endif
                        </a>
                    </div>
                    <div class="col">
                        <a href="{{ route('profile.show', $u->id) }}" class="text-decoration-none text-dark fw-bold">
                            {{ $u->name }}
                        </a>
                    </div>
                    <div class="col-auto">
                        <form action="{{ route('follow.store', $u->id) }}" method="post">
                            @csrf
                            <button type="submit" class="shadow-none border-0 bg-transparent text-primary">Follow</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
