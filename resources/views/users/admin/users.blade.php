@extends('layouts.app')

@section('title', 'Admin Show Users')

@section('content')
    <div class="row">
        {{-- <div class="col-4">
            @include('users.admin.lists')
        </div> --}}
        <div class="col-4">
            <div class="row">
                <a href="{{route('admin.users')}}" class="p-2 ps-3 border-0 rounded-top bg-primary text-white text-decoration-none">
                    <i class="fa-solid fa-users"></i> Users
                </a>
            </div>
            <div class="row">
                <a href="{{route('admin.posts')}}" class="p-2 ps-3 border text-decoration-none text-dark">
                    <i class="fa-solid fa-images"></i> Posts
                </a>
            </div>
            <div class="row">
                <a href="{{route('admin.categories')}}" class="p-2 ps-3 border border-top-0 rounded-bottom text-decoration-none text-dark">
                    <i class="fa-solid fa-tags"></i> Categories
                </a>
            </div>
        </div>
        <div class="col-8">
            <table class="table">
                <thead class="table-success">
                    <tr>
                        <th></th>
                        <th>NAME</th>
                        <th>EMAIL</th>
                        <th>CREATED AT</th>
                        <th>STATUS</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all_users as $user)
                        <tr>
                            <td class="text-center">
                                @if ($user->avatar)
                                    <img src="{{ $user->avatar }}" alt="{{ $user->name }}"
                                        class="rounded-circle d-block mx-auto avatar-md">
                                @else
                                    <i class="fa-solid fa-circle-user text-secondary icon-md"></i>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('profile.show', $user->id) }}"
                                    class="text-decoration-none text-dark fw-bold">
                                    {{ $user->name }}
                                </a>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->format('d/m/y') }}</td>
                            <td>
                                @if ($user->trashed())
                                    <i class="fa-solid fa-circle text-secondary"></i> Inactive
                                @else
                                    <i class="fa-solid fa-circle text-success"></i> Active
                                @endif
                            </td>
                            <td>
                                @if ($user->id !== Auth::user()->id)
                                    <div class="dropdown">
                                        <a id="dropdown" class="text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end px-3" aria-labelledby="dropdown">
                                            <!-- Modal trigger button -->
                                            @if ($user->trashed())
                                                <a class="btn text-primary" data-bs-toggle="modal" data-bs-target="#modalActivate{{ $user->id }}">
                                                    <i class="fa-solid fa-user"></i> Activate {{ $user->name }}
                                                </a>
                                            @else
                                                <a class="btn text-danger" data-bs-toggle="modal" data-bs-target="#modalDeactivate{{ $user->id }}">
                                                    <i class="fa-solid fa-user-slash"></i> Deactivate {{ $user->name }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </td>
                        </tr>

                        <!-- Modal Body Activate -->
                        <div class="modal fade" id="modalActivate{{ $user->id }}" tabindex="-1" data-bs-backdrop="static"
                            data-bs-keyboard="false" role="dialog" aria-labelledby="modalActivate{{ $user->id }}"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
                                <div class="modal-content border-primary">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-primary" id="modalActivate{{ $user->id }}">
                                            <i class="fa-solid fa-user"></i> Activate {{ $user->name }}
                                        </h5>
                                    </div>
                                    <div class="modal-body border-primary">
                                        Are you sure you want to activate <span
                                            class="fw-bold">{{ $user->name }}</span>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-primary"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <form action="{{ route('admin.activate.users', $user->id) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Activate</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Body Deactivate -->
                        <div class="modal fade" id="modalDeactivate{{ $user->id }}" tabindex="-1" data-bs-backdrop="static"
                            data-bs-keyboard="false" role="dialog" aria-labelledby="modalDeactivate{{ $user->id }}"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
                                <div class="modal-content border-danger">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-danger" id="modalDeactivate{{ $user->id }}">
                                            <i class="fa-solid fa-user-slash"></i> Deactivate {{ $user->name }}
                                        </h5>
                                    </div>
                                    <div class="modal-body border-danger">
                                        Are you sure you want to deactivate <span
                                            class="fw-bold">{{ $user->name }}</span>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-danger"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <form action="{{ route('admin.deactivate.users', $user->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Deactivate</button>
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
