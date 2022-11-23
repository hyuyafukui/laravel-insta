<div class="modal fade" id="active-user-{{ $user->id }}">
  <div class="modal-dialog">
    <div class="modal-content border-success">
      <div class="modal-header border-success text-success">
        <h3 class="h5 modal-title"><i class="fa-solid fa-user-check"></i> Activate User</h3>
      </div>

      <div class="modal-body">
        Are you sure you want to activate <span class="fw-bold">{{ $user->name }}</span>?
      </div>

      <div class="modal-footer border-0">
        <form action="{{ route('admin.users.activate', $user->id) }}" method="post">
          @csrf
          @method('PATCH')

          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success">Activate</button>
        </form>
      </div>
    </div>
  </div>
</div>