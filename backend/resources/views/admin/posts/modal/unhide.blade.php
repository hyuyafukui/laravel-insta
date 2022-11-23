<div class="modal fade" id="unhide-post-{{ $post->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-primary">
            <div class="modal-header border-primary">
                <h3 class="h5, modal-title text-primary">
                    <i class="fa-solid fa-eye"></i> Unhide Post
                </h3>
            </div>

            <div class="modal-body">
                Are you sure you want to unhide this post?
                <img src="{{ asset('storage/images/' . $post->image) }}" alt="" class="d-block image-xs mt-3">
                <p class="text-secondary mt-2">{{ $post->description }}</p>
            </div>

            <div class="modal-footer border-0">
                <form action="{{ route('admin.posts.unhide', $post->id) }}" method="post">
                    @csrf
                    @method('PATCH')

                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Unhide</button>
                </form>
            </div>
        </div>
    </div>
</div>
