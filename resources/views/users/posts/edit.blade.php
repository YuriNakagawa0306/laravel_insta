@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <form action="{{route('post.update', $post->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            @foreach ($all_categories as $category)
                @if (in_array($category->id, $selected_categories))
                    <div class="form-check form-check-inline">
                        <input type="checkbox" name="category[]" id="{{ $category->name }}" value="{{ $category->id }}"
                            class="form-check-input "checked>
                        <label for="{{ $category->name }}" class="form-check-label"> {{ $category->name }} </label>
                    </div>
                @else
                    <div class="form-check form-check-inline">
                        <input type="checkbox" name="category[]" id="{{ $category->name }}" value="{{ $category->id }}"
                            class="form-check-input">
                        <label for="{{ $category->name }}" class="form-check-label"> {{ $category->name }} </label>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="mb-3">
            <label for="description" class="form-label fw-bold mt-3">Description</label>
            <textarea name="description" id="description" cols="30" rows="3" class="form-control" placeholder="What's on your mind?">{{$post->description}}</textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label fw-bold mt-3">Image</label>
            <img src="{{$post->image}}" alt="" class="img-thumbnail d-block mb-2">
            <input type="file" name="image" id="image" class="form-control">
            <p class="text-secondary">
                The accepted formats are: jpg, jpeg, png, gif, svg.<br>
                Maximum size: 1048kB.
            </p>
        </div>

        <button type="submit" class="btn btn-warning px-5">Save</button>
    </form>
@endsection