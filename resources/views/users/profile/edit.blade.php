@extends('layouts.app')

@section('title', 'Edit profile')

@section('content')
    <div class="mt-3 border shadow rounded p-5">
        <h3 class="text-secondary fw-bold">Update Profile</h3>

        <form action="{{route('profile.update')}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-auto">
                    @if ($user->avatar)
                        <img src="{{$user->avatar}}" alt="{{$user->name}}" class="rounded-circle d-block mx-auto mt-3 avatar-lg">
                    @else
                        <i class="fa-solid fa-circle-user text-secondary icon-lg m-3"></i>
                    @endif
                </div>
                <div class="col-auto mt-5">
                    <input type="file" name="avatar" id="avatar" class="form-control">
                    <p class="text-secondary">
                        Acceptable formats: jpeg, jpg, png, gif only<br>
                        Max file size is 1048kb
                    </p>
                </div>
            </div>
            <label for="name" class="form-label fw-bold mt-3">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{$user->name}}">

            <label for="email" class="form-label fw-bold mt-3">E-Mail Address</label>
            <input type="email" name="email" id="email" class="form-control" value="{{$user->email}}">

            <label for="introduction" class="form-label fw-bold mt-3">Introduction</label>
            <textarea name="introduction" id="introduction" cols="" rows="5"  class="form-control">{{$user->introduction}}</textarea>

            <button type="submit" class="btn btn-warning fw-bold px-5 mt-3">Save</button>
        </form>
    </div>
@endsection