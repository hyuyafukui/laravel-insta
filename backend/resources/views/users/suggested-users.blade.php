@extends('layouts.app')

@section('title', 'Followers')

@section('content')

    @if (!empty($suggested_users))

        <div class="row justify-content-center">
            <div class="col-4">

                <form action="{{ route('home.suggested-user') }}" method="get" class="my-4">
                    <input type="text" name="search" class="form-control form-control-sm w-75"
                        placeholder="Serch names...">
                </form>

                @foreach ($suggested_users as $user)
                    <div class="row align-items-center mt-2">
                        {{-- avatar/icon --}}
                        <div class="col-auto">
                            @if ($user->avatar)
                                <a href="">
                                    <img src="{{ asset('storage/avatars/' . $user->avatar) }}" alt=""
                                        class="rounded-circle mx-auto d-block avatar-sm">
                                </a>
                            @else
                                <i class="fa-solid fa-circle-user icon-sm text-secondary"></i>
                            @endif
                        </div>

                        {{-- user name --}}
                        <div class="col">
                            <a href="#" class="text-decoration-none text-dark fw-bold">
                                {{ $user->name }}
                            </a>
                        </div>

                        {{-- follow button --}}
                        <div class="col-auto">

                            <form action="{{ route('follow.store', $user->id) }}" method="post">
                                @csrf
                                <button type="submit" class="shadow-none bg-transparent border-0 text-primary">Follow</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <h3 class="text-muted text-center">No users found.</h3>
    @endif
@endsection
