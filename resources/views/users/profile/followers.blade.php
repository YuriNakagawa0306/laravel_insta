@extends('layouts.app')

@section('title', 'Show followers')

@section('content')
    @include('users.profile.header')

    {{-- show all posts here --}}
    <div class="row mt-5 justify-content-center">
        <div class="col-4">
            @if ($user->followers->isNotEmpty())
                <h4 class="text-center">Follower</h4>
                @foreach ($user->followers as $follower)
                    <div class="row align-items-center">
                        <div class="col-auto">
                            {{-- display icon or avatar --}}
                            <a href="{{route('profile.show', $follower->followerUser->id)}}">
                                @if ($follower->followerUser->avatar)
                                    <img src="{{$follower->followerUser->avatar}}" alt="" class="rounded-circle avatar-sm">
                                @else
                                    <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                @endif
                            </a>
                        </div>
                        <div class="col ps-0 text-truncate">
                            {{-- display the name of the owner --}}
                            <a href="{{route('profile.show', $follower->followerUser->id)}}" class="text-decoration-none text-dark fw-bold">
                                {{$follower->followerUser->name}}
                            </a>
                        </div>
                        <div class="col text-end">
                            @if ($follower->followerUser->isFollowed())
                                <p class="text-secondary">Following</p>
                            @else
                                <form action="{{route('follow.store', $follower->followerUser->id)}}" method="post">
                                    @csrf
                                    <button type="submit" class="btn text-primary shadow-none">Follow</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <h4 class="text-center">No followers yet</h4>
            @endif
        </div>
    </div>
@endsection