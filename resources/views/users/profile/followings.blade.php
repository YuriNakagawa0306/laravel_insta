@extends('layouts.app')

@section('title', 'Show followings')

@section('content')
    @include('users.profile.header')

    {{-- show all posts here --}}
    <div class="row mt-5 justify-content-center">
        <div class="col-4">
            @if ($user->followings->isNotEmpty())
                <h4 class="text-center">Following</h4>
                @foreach ($user->followings as $following)
                    <div class="row">
                        <div class="col-auto">
                            {{-- display icon or avatar --}}
                            <a href="{{route('profile.show', $following->followingUser->id)}}">
                                @if ($following->followingUser->avatar)
                                    <img src="{{$following->followingUser->avatar}}" alt="" class="rounded-circle avatar-sm">
                                @else
                                    <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                @endif
                            </a>
                        </div>
                        <div class="col ps-0 text-truncate">
                            {{-- display the name of the owner --}}
                            <a href="{{route('profile.show', $following->followingUser->id)}}" class="text-decoration-none text-dark fw-bold">
                                {{$following->followingUser->name}}
                            </a>
                        </div>
                        <div class="col text-end">
                            <p class="text-secondary">Following</p>
                        </div>
                    </div>
                @endforeach
            @else
                <h4 class="text-center">No followers yet</h4>
            @endif
        </div>
    </div>
@endsection