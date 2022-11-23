<div class="modal fade" id="hide-post-{{ $post->id }}">
  <div class="modal-dialog">
    <div class="modal-content border-danger">
      <div class="modal-header text-danger border-danger">
        <h3 class="modal-title h5">
          <i class="fa-solid fa-eye-slash"></i> Hide Post
        </h3>
      </div>

      <div class="modal-body">
        Are you sure you want to hide this post?
        <img src="{{ asset('storage/images/'.$post->image) }}" alt="" class="d-block image-xs mt-3">

        <p class="text-secondary mt-1">{{ $post->description }}</p>
      </div>

      <div class="modal-footer border-0">
        <form action="{{ route('admin.posts.hide', $post->id) }}" method="post">
          @csrf
          @method('DELETE')

          <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cansel</button>
          <button type="submit" class="btn btn-danger btn-sm ms-1">Hide</button>
        </form>
      </div>
    </div>
  </div>
</div>