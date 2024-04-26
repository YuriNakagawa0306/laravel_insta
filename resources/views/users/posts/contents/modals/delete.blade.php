<div class="modal fade" id="delete-post-{{ $post->id }}">
    <div class="modal-dialog ">
        <div class="modal-content border-danger">
            <div class="modal-header  border-danger">
                <h5 class="modal-title text-danger" id="modalTitleId">
                    Delete post
                </h5>

            </div>
            <div class="modal-body">
                <div class="mt-3">
                    <p>Are you sure you to delete this post</p>

                    <div class="mt-3">
                        <img src="{{ $post->image }}" class="img-thumbnail" alt="">
                        <p class="text-muted mt-1">{{ $post->description }}</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <form action="{{route('post.destroy', $post->id)}}" method="post">
                    @csrf
                    @method('DELETE')

                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>