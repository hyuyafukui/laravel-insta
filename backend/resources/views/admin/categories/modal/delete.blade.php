<div class="modal fade" id="delete-categ-{{ $category->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h3 class="modal-title text-dark h5">
                    <i class="fa-solid fa-trash-can me-1"></i>Delete Category
                </h3>
            </div>

            <div class="modal-body text-start">
                <p>Are you sure you want to delete <span class="fw-bold">{{ $category->name }}</span> category?</p>
                <p>This action will affect allthe posts under this category. Posts without a category will fall under
                    Uncategorized.</p>
            </div>

            <div class="modal-footer border-0">
                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="post">
                  @csrf
                  @method('DELETE')
                    <button type="button" class="btn btn-outline-secondary btn-sm"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>

            </div>

        </div>
    </div>
</div>
