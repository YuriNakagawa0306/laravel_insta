@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
    <form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="category" class="form-label fw-bold d-block">Category <span class="fw-normal">(up to 3)</span></label>
            @forelse ($all_categories as $category)
                <input type="checkbox" name="category[]" id="{{$category->name}}" value="{{$category->id}}">
                <label for="{{$category->name}}" class="me-3">{{$category->name}}</label>
            @empty
                <p>No categories found.</p>
            @endforelse
        </div>
        <div class="mb-3">
            <label for="description" class="form-label fw-bold mt-3">Description</label>
            <textarea name="description" id="description" cols="30" rows="3" class="form-control" placeholder="What's on your mind?"></textarea> 
        </div>
        <div class="mb-3">
            <label for="image" class="form-label fw-bold mt-3">Image</label>
            <input type="file" name="image" id="image" class="form-control">
            <p class="text-secondary">
                The accepted formats are: jpg, jpeg, png, gif, svg.<br>
                Maximum size: 1048kB.
            </p>
        </div>

        <button type="submit" class="btn btn-primary">Post</button>
    </form>
@endsection
