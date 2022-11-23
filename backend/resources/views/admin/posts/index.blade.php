@extends('layouts.app')

@section('title', 'Admin: Posts')

@section('content')
    <form action="{{ route('admin.posts') }}" method="get">
        <input type="text" name="search" placeholder="Search for posts" class="form-control form-control-sm mb-3 ms-auto" style="width:10rem;" value="{{ $search }}">
    </form>

    <table class="table table-hover text-secondary align-middle mt-3">
        <thead class="table-primary text-uppercase small text-secondary">
            <th></th>
            <th></th>
            <th>category</th>
            <th>owner</th>
            <th>creted at</th>
            <th>status</th>
            <th></th>
        </thead>

        <tbody>
            @forelse ($all_posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>
                        <a href="{{ route('post.show', $post->id) }}">
                            <img src="{{ asset('storage/images/' . $post->image) }}" alt="" class="d-block image-xs">
                        </a>
                    </td>
                    <td>
                        @forelse ($post->categoryPosts as $categoryPost)
                            <div class="badge bg-secondary bg-opacity-50">{{ $categoryPost->category->name }}</div>
                        @empty
                            <div class="badge bg-dark">Uncategorized</div>
                        @endforelse
                    </td>
                    <td>
                        <a href="{{ route('profile.show', $post->user->id) }}" class="text-decoration-none text-dark fw-bold">
                            {{ $post->user->name }}
                        </a>
                    </td>
                    <td>{{ $post->created_at }}</td>
                    <td>
                        @if ($post->trashed())
                            <i class="fa-solid fa-circle-minus"></i> Hidden
                        @else
                            <i class="fa-solid fa-circle text-primary"></i> Visible
                        @endif
                    </td>
                    <td>
                        @if (!$post->trashed())
                            <div class="dropdown">
                                <button data-bs-toggle="dropdown" class="btn btn-sm">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </button>

                                {{-- dropdown-menu --}}
                                <div class="dropdown-menu">
                                    <button class="dropdown-item text-danger" data-bs-toggle="modal"
                                        data-bs-target="#hide-post-{{ $post->id }}"><i
                                            class="fa-solid fa-eye-slash"></i>Hide Post
                                        {{ $post->id }}</button>
                                </div>
                            </div>

                            {{-- include modal --}}
                            @include('admin.posts.modal.hide')
                        @else
                            <div class="dropdown">
                                <button data-bs-toggle="dropdown" class="btn btn-sm">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </button>

                                <div class="dropdown-menu">
                                    <div class="dropdown-item text-dark" data-bs-toggle="modal" data-bs-target="#unhide-post-{{ $post->id }}">
                                        <i class="fa-solid fa-eye"></i> Unhide Port {{ $post->id }}
                                    </div>
                                </div>
                            </div>

                            {{-- include modal --}}
                            @include('admin.posts.modal.unhide')
                        @endif
                    </td>
                </tr>
            @empty
                <td colspan="7" class="text-center text-muted">No posts found.</td>
            @endforelse
        </tbody>
    </table>
    {{ $all_posts->links() }}
@endsection
