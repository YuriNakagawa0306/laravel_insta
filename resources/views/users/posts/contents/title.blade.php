<div class="card-header bg-white py-3">
    <div class="row align-items-center">
        <div class="col-auto">
            {{-- display icon or avatar --}}
            @if ($post->user->avatar)
                <img src="{{$post->user->avatar}}" alt="" class="rounded-circle avatar-sm">
            @else
                <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
            @endif
        </div>
        <div class="col ps-0">
            {{-- display the name of the owner --}}
            <a href="{{route('profile.show', $post->user->id)}}" class="text-decoration-none text-dark">
                {{$post->user->name}}
            </a>
        </div>
        
        <div class="col-auto">
            {{-- the option to edit or delete, or to follow/unfollow --}}
            {{-- if you own the post, you can delete and edit --}}
            {{-- if you dont own the post, you can only follow  --}}
            <div class="dropdown">
                <button class="btn btn-sm shadow-none border-0" data-bs-toggle="dropdown">
                    <i class="fa-solid fa-ellipsis"></i>
                </button>
                <div class="dropdown-menu">
                    @if ($post->user->id == Auth::id())
                        {{-- edit and delete --}}
                        <a href="{{route('post.edit', $post->id)}}" class="dropdown-item text-warning">
                            <i class="fa-solid fa-pen-to-square"></i> Edit
                        </a>
                        <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#delete-post-{{$post->id}}" >
                            <i class="fa-solid fa-trash"></i> Delete
                        </button>
                    @else
                        @if ($post->user->isFollowed())
                            <form action="{{route('follow.delete', $post->user->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn text-danger shadow-none">Unfollow</button>
                            </form>
                        @else
                            <form action="{{route('follow.store', $post->id)}}" method="post">
                                @csrf
                                <button type="submit" class="btn text-primary shadow-none">Follow</button>
                            </form>
                        @endif
                    @endif
                </div>
                @include('users.posts.contents.modals.delete')
            </div>
        </div>
    </div>
</div>