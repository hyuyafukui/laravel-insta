<div class="modal fade" id="edit-categ-{{ $category->id }}">
    <div class="modal-dialog">
        <form action="{{ route('admin.categories.update', $category->id) }}" method="post"
            class="modal-content border-warning">
            @csrf
            @method('PATCH')
            <div class="modal-header border-warning text-dark">
                <h3 class="modal-title h5">
                    <i class="fa-regular fa-pen-to-square me-1"></i>Edit Category
                </h3>
            </div>

            <div class="modal-body">
                <input type="text" name="new_name" class="form-control" value="{{ $category->name }}">
            </div>

            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-warning btn-sm">Update</button>
            </div>
        </form>
    </div>
</div>
