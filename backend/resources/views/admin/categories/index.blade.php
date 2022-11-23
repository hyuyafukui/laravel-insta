@extends('layouts.app')

@section('title', 'Admin: Categories')

@section('content')
    <form action="{{ route('admin.categories.store') }}" method="post" class="w-50 my-4 row gx-2">
      @csrf
        <div class="col">
            <input type="text" name="name" placeholder="Add a category..." class="form-control">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary px-4"><i class="fa-solid fa-plus"></i>Add</button>
        </div>
    </form>

    <table class="table table-hover text-secondary align-middle text-center">
        <thead class="table-warning small text-uppercase text-secondary">
            <th>#</th>
            <th>Name</th>
            <th>Count</th>
            <th>Last Update</th>
            <th></th>
        </thead>
        <tbody>
            @forelse($all_categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td class="text-dark text-center">{{ $category->name }}</td>
                    <td>{{ $category->categoryPosts->count() }}</td>
                    <td>{{ $category->updated_at }}</td>
                    <td>
                        {{-- edit button --}}
                        <button data-bs-toggle="modal" data-bs-target="#edit-categ-{{ $category->id }}"
                            class="btn btn-sm btn-outline-warning">
                            <i class="fa-solid fa-pencil"></i>
                        </button>

                        {{-- delete button --}}
                        <button data-bs-toggle="modal" data-bs-target="#delete-categ-{{ $category->id }}"
                            class="btn btn-sm btn-outline-danger ms-2">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>

                        {{-- include modals here --}}
                    @include('admin.categories.modal.edit')
                    @include('admin.categories.modal.delete')
                    </td>
                @empty
                    <td colspan="5" class="text-center text-munted">No categories found.</td>
                </tr>
            @endforelse
            <tr>
                <td>0</td>
                <td>Uncategorized</td>
                <td>{{ $uncategorized_count }}</td>
            </tr>
        </tbody>
    </table>

@endsection
