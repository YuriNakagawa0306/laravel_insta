@extends('layouts.app')

@section('title', 'Show profile')

@section('content')
    @include('users.profile.header')

    {{-- show all posts here --}}
    <div class="row mt-5">
        @if ($user->posts->isNotEmpty())
            <div class="row">
                @foreach ($all_posts as $post)
                    <div class="col-lg-4 col-md-6 mt-4">
                        <a href="{{route('post.show', $post->id)}}">
                            <img src="{{$post->image}}" alt="{{$post->description}}" class="grid-img">
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <h4 class="text-center">No posts yet</h4>
        @endif

        {{-- Kurt one --}}
        {{-- @forelse ($all_posts as $post)
            <div class="col-4 m-2">
                <a href="#">
                    <img src="{{$post->image}}" class="img-thumbnail" alt="">
                </a>
            </div>
        @empty
            <h4 class="text-center">No posts yet</h4>
        @endforelse --}}
    </div>
@endsection