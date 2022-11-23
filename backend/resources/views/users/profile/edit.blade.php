@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <div class="row justify-content-center">

        <div class="col-8">
            <form action="{{ route('profile.update') }}" method="post" class="bg-white rounded-3 shadow p-5 mb-5" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <h3 class="text-secondary">Update Profile</h3>
                <div class="row align-items-end mb-3">
                    <div class="col-auto">
                        @if ($user->avatar)
                            <img src="{{ asset('storage/avatars/'.$user->avatar) }}" alt="" class="rounded-circle d-block avatar-lg">
                        @else
                        <i class="fa-solid fa-circle-user text-secondary d-block text-center icon-lg"></i>                      
                        @endif
                    </div>
                    <div class="col-8">
                        <input type="file" name="avatar" id="avatar" class="form-control form-control-sm"
                            aria-describedby="image-info">
                        <div class="form-text" id="image-info">
                            Acceptable formats: jpeg, jpg, png, gif only <br>
                            Max size is 1048 KB
                        </div>
                        @error('avatar')
                            <p class="text-danger small">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <label for="name" class="form-label text-dark fw-bold">Name</label>
                <input type="text" name="name"  value="{{ old('name', $user->name) }}" id="name" class="form-control mb-3">
                @error('name')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror

                <label for="email" class="form-label text-dark fw-bold">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" id="email" class="form-control mb-3">
                @error('email')
                <p class="text-danger small">{{ $message }}</p>                  
                @enderror

                <label for="introduction" class="form-label text-dark fw-bold">Introduction</label>
                <textarea name="introduction" id="introduction" cols="30" rows="5" class="form-control mb-3">{{ old('introduction', $user->introduction) }}</textarea>
                @error('introduction')
                <p class="text-danger small">{{ $message }}</p>
                @enderror

                <button type="submit" class="btn btn-warning fw-bold px-5">Save</button>
            </form>

            {{-- update password --}}
            <form action="{{ route('profile.updatePassword') }}" method="post" class="bg-white shadow rounded-3 p-5 mt-5">
                @csrf
                @method('PATCH')

                @if (session('success_message'))
                <p class="text-success fw-bold">{{ session('success_message') }}</p>                
                @endif

                <h3 class="h3 text-secondary">Update Password</h3>

                <label for="old-password" class="form-label fw-bold">Old Password</label>
                <input type="password" name="old_password" id="old-password" class="form-control">
                {{-- error --}}
                @if (session('old_password_error'))
                <p class="text-danger small">{{ session('old_password_error') }}</p>
                @endif

                <label for="new-password" class="form-label fw-bold mt-3">New Password</label>
                <input type="password" name="new_password" id="new-password" class="form-control">
                {{-- error --}}
                @if (session('same_password_error'))
                <p class="text-danger small">{{ session('same_password_error') }}</p> 
                @endif

                <label for="new-password-confirmation" class="form-label fw-bold mt-3">Confirm New Password</label>
                <input type="password" name="new_password_confirmation" id="new-password-confirmation" class="form-control">
                @error('new_password')
                <p class="text-danger small">{{ $message }}</p>           
                @enderror

                <button type="submit" class="btn btn-warning mt-4 px-4 fw-bold">Update Password</button>
            </form>
        </div>
    </div>
@endsection
