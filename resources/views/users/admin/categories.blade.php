@extends('layouts.app')

@section('title', 'Admin Show Categories')

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
            <form action="{{route('admin.store.category')}}" method="post">
                @csrf
                <div class="row mb-3">
                    <div class="col-10">
                        <input type="text" name="name" id="name" class="form-control" placeholder="Add a category...">
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-plus"></i> Add
                        </button>
                    </div>
                </div>
            </form>
            <table class="table">
                <thead class="table-warning">
                    <tr>
                        <th>#</th>
                        <th>NAME</th>
                        <th>COUNT</th>
                        <th>LAST UPDATED</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all_categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td></td>
                            <td>
                                @if ($category->updated_at)
                                    {{ $category->updated_at->diffForHumans() }}
                                @else
                                    <span class="text-danger">Date not found.</span>
                                @endif
                            </td>
                            <td class="d-flex">
                                {{-- Edit --}}
                                <!-- Modal trigger button -->
                                <a class="btn btn-outline-warning me-2" data-bs-toggle="modal" data-bs-target="#modal{{ $category->id }}">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                {{-- Delete --}}
                                <form action="" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                    <input type="hidden" name="category_id" value="{{ $category->id }}">
                                </form>
                            </td>
                        </tr>

                        <!-- Modal Body -->
                        <div class="modal fade" id="modal{{ $category->id }}" tabindex="-1" data-bs-backdrop="static"
                            data-bs-keyboard="false" role="dialog" aria-labelledby="modal{{ $category->id }}"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
                                <div class="modal-content border-warning">
                                    <div class="modal-header">
                                        <i class="fa-regular fa-pen-to-square"></i> Edit Category
                                    </div>
                                    <div class="modal-body border-warning">
                                        <form action="" method="post">
                                            @csrf
                                            <input type="text" name="name" id="name" value="{{$category->name}}" class="form-control">
                                    </div>
                                    <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-warning">Update</button>
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
