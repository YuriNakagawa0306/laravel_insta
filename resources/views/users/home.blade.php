@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="row">
        <div class="col-8">
          
            @forelse ($home_posts as $post)
                <div class="card mb-3">
                    {{-- title --}}
                    @include('users.posts.contents.title')
                    {{-- body --}}
                    @include('users.posts.contents.body')
                </div>
            @empty
                <div class="text-center">
                    <h2>Share Photos</h2>
                    <p class="text-muted">
                        When you share photos, they'll appear on your profile
                        <a href="{{ route('post.create') }}" class="text-decoration-none">Share your first post</a>
                    </p>
                </div>
            @endforelse
        </div>
        <div class="col-4">
            <div class="row border py-3 shadow rounded bg-white">
                <div class="col-auto">
                    @if (Auth::user()->avatar)
                        <img src="{{Auth::user()->avatar}}" alt="" class="rounded-circle avatar-sm">
                    @else
                        <i class="fa-solid fa-circle-user text-secondary icon-md"></i>
                    @endif
                </div>
                <div class="col-auto">
                    <span class="fw-bold">{{Auth::user()->name}}</span><br>
                    <span class="text-secondary">{{Auth::user()->email}}</span>
                </div>
            </div>
            @if ($suggested_users)
                <div class="row py-3">
                    <div class="col-auto">
                        <span class="text-secondary fw-bold">Suggestion For You</span>
                    </div>
                    <div class="col text-end">
                        <a href="#" class="fw-bold text-dark text-decoration-none">See All</a>
                    </div>
                    @foreach ($suggested_users as $user)
                        <div class="row align-items-center mt-3">
                            <div class="col-auto">
                                {{-- display icon or avatar --}}
                                <a href="{{route('profile.show', $user->id)}}">
                                    @if ($user->avatar)
                                        <img src="{{$user->avatar}}" alt="" class="rounded-circle avatar-sm">
                                    @else
                                        <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                    @endif
                                </a>
                            </div>
                            <div class="col ps-0 text-truncate">
                                {{-- display the name of the owner --}}
                                <a href="{{route('profile.show', $user->id)}}" class="text-decoration-none text-dark fw-bold">
                                    {{$user->name}}
                                </a>
                            </div>
                            <div class="col text-end">
                                <form action="{{route('follow.store', $user->id)}}" method="post">
                                    @csrf
                                    <button type="submit" class="btn text-primary shadow-none">Follow</button>
                                </form>
                            </div>
                       </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
