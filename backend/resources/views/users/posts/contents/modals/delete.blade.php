
<div class="modal fade" id="delete-post-{{ $post->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h3 class="h5 modal-title text-danger">Delete Post</h3>
            </div>

            <div class="modal-body">
                <p>Are you sure you want to delete this post?</p>
                <img class="image-sm mt-3" src="{{ asset('storage/images/' . $post->image) }}" alt="">
                <p class="text-muted">{{ $post->description }}</p>
            </div>

            <div class="modal-footer border-0">
                <form action="{{ route('post.destroy', $post->id) }}" method="post">
                    @csrf
                    @method('DELETE')

                    <button type="button" class="btn btn-outline-secondary btn-sm"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger ms-2 btn-sm">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
