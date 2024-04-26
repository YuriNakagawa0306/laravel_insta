@extends('layouts.app')

@section('title', 'Admin Show Posts')

@section('content')
    <div class="row">
        <div class="col-4">
            <div class="row">
                <a href="{{route('admin.users')}}" class="p-2 ps-3 border rounded-top text-decoration-none text-dark">
                    <i class="fa-solid fa-users"></i> Users
                </a>
            </div>
            <div class="row">
                <a href="{{route('admin.posts')}}" class="p-2 ps-3 border-0 bg-primary text-white text-decoration-none">
                    <i class="fa-solid fa-images"></i> Posts
                </a>
            </div>
            <div class="row">
                <a href="{{route('admin.categories')}}" class="p-2 ps-3 border border-top-0 rounded-bottom text-decoration-none text-dark">
                    <i class="fa-solid fa-tags"></i> Categories
                </a>
            </div>
        </div>
        <div class="col-8 justify-content-center">
            <table class="table">
                <thead class="table-success">
                    <tr>
                        <th></th>
                        <th></th>
                        <th>CATEGORY</th>
                        <th>OWNER</th>
                        <th>CREATED AT</th>
                        <th>STATUS</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all_posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>
                                <a href="{{route('post.show', $post->id)}}">
                                    <img src="{{$post->image}}" alt="" class="w-100 img">
                                </a>
                            </td>
                            <td>
                                @foreach ($post->category_post as $categoryPost)
                                    <div class="badge bg-opacity-50 bg-secondary">
                                        {{ $categoryPost->category->name }}
                                    </div>
                                @endforeach
                            </td>
                            <td>{{ $post->user->name }}</td>
                            <td>{{ $post->created_at->format('d/m/y') }}</td>
                            <td>
                                @if ($post->trashed())
                                    <i class="fa-solid fa-circle text-secondary"></i> Hidden
                                @else
                                    <i class="fa-solid fa-circle text-primary"></i> Visible
                                @endif
                            </td>
                            <td>
                                {{-- @if ($post->id !== Auth::user()->id) --}}
                                    <div class="dropdown">
                                        <a id="dropdown" class="text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end px-3" aria-labelledby="dropdown">
                                            <!-- Modal trigger button -->
                                            @if ($post->trashed())
                                                <a class="btn text-primary" data-bs-toggle="modal" data-bs-target="#modalActivate{{ $post->id }}">
                                                    <i class="fa-solid fa-images"></i> Activate {{ $post->id }}
                                                </a>
                                            @else
                                                <a class="btn text-danger" data-bs-toggle="modal" data-bs-target="#modalDeactivate{{ $post->id }}">
                                                    <i class="fa-regular fa-eye-slash"></i> Deactivate {{ $post->id }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                {{-- @endif --}}
                            </td>
                        </tr>

                        <!-- Modal Body Activate -->
                        <div class="modal fade" id="modalActivate{{ $post->id }}" tabindex="-1" data-bs-backdrop="static"
                            data-bs-keyboard="false" role="dialog" aria-labelledby="modalActivate{{ $post->id }}"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
                                <div class="modal-content border-primary">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-primary" id="modalActivate{{ $post->id }}">
                                            <i class="fa-solid fa-imagas"></i> Activate
                                        </h5>
                                    </div>
                                    <div class="modal-body border-primary">
                                        Are you sure you want to activate?
                                        <img src="{{$post->image}}" alt="" class="w-100 img">
                                        {{$post->description}}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                                        <form action="{{ route('admin.activate.posts', $post->id) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Activate</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Body Deactivate -->
                        <div class="modal fade" id="modalDeactivate{{ $post->id }}" tabindex="-1" data-bs-backdrop="static"
                            data-bs-keyboard="false" role="dialog" aria-labelledby="modalDeactivate{{ $post->id }}"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
                                <div class="modal-content border-danger">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-danger" id="modalDeactivate{{ $post->id }}">
                                            <i class="fa-regular fa-eye-slash"></i> Hide Post
                                        </h5>
                                    </div>
                                    <div class="modal-body border-danger">
                                        Are you sure you want to hide?
                                        <img src="{{$post->image}}" alt="" class="w-100 img">
                                        {{$post->description}}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-danger"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <form action="{{ route('admin.deactivate.posts', $post->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hide</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
