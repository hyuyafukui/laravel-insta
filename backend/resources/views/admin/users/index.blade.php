@extends('layouts.app')

@section('title', 'Admin: Users')

@section('content')
    <form action="{{ route('admin.users') }}" method="get">
        <input type="text" name="search" placeholder="Search name..." style="width:10rem;" class="form-control form-control-sm mb-3 ms-auto" value="{{ $search }}">
    </form>

    <table class="table table-hover text-secondary align-middle mt-3">
        <thead class="table-success text-uppercase small">
            <th></th>
            <th>Name</th>
            <th>Email</th>
            <th>Created At</th>
            <th>Status</th>
            <th></th>
        </thead>
        <tbody>
            @forelse($all_users as $user)
                <tr>
                    <td>
                        @if ($user->avatar)
                            <img src="{{ asset('storage/avatars/' . $user->avatar) }}" alt=""
                                class="d-block mx-auto rounded-circle avatar-md">
                        @else
                            <i class="fa-solid fa-circle-user text-secondary icon-md d-block text-center"></i>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('profile.show', $user->id) }}"
                            class="text-decoration-none text-dark fw-bold">{{ $user->name }}</a>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                        @if ($user->trashed())
                            {{-- ifuserissoft-deleted --}}
                            <i class="fa-regular fa-circle"></i> Inactive
                        @else
                            <i class="fa-solid fa-circle text-success"></i> Active
                        @endif
                    </td>
                    <td>
                        @if ($user->id != Auth::user()->id)
                            @if (!$user->trashed())
                                <div class="dropdown">
                                    <button data-bs-toggle="dropdown" class="btn btn-sm">
                                        <i class="fa-solid fa-ellipsis"></i>
                                    </button>

                                    <div class="dropdown-menu">
                                        <button class="dropdown-item text-danger" data-bs-toggle="modal"
                                            data-bs-target="#deactivate-user-{{ $user->id }}">
                                            <i class="fa-solid fa-user-slash"></i> Deactivate User Name
                                        </button>
                                    </div>
                                </div>

                                {{-- include modal here --}}
                                @include('admin.users.modal.deactivate')
                            @else
                                <div class="dropdown">
                                    <button data-bs-toggle="dropdown" class="btn btn-sm">
                                        <i class="fa-solid fa-ellipsis"></i>
                                    </button>

                                    <div class="dropdown-menu">
                                        <div class="dropdown-item text-dark" data-bs-toggle="modal"
                                            data-bs-target="#active-user-{{ $user->id }}">
                                            <i class="fa-solid fa-user-check"></i> Activate {{ $user->name }}
                                        </div>
                                    </div>
                                </div>

                                {{-- include modal here --}}
                                @include('admin.users.modal.activate')
                            @endif
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">No users found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $all_users->links() }}
@endsection
