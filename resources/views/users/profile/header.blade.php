<div class="row">
    <div class="col-4">
        @if ($user->avatar)
            <img src="{{$user->avatar}}" alt="{{$user->name}}" class="rounded-circle d-block mx-auto avatar-lg">
        @else
            <i class="fa-solid fa-circle-user text-secondary icon-lg"></i>
        @endif
    </div>
    <div class="col-8">
        <div class="row">
            <div class="col-auto">
                <h1 class="mb-0">{{$user->name}}</h1>
            </div>
            <div class="col-auto p-2">
                @if ($user->id == Auth::id())
                    <a href="{{route('profile.edit', $user->id)}}" class="btn btn-outline-secondary btn-sm fw-bold">Edit Profile</a>
                @else
                    <form action="#" method="post">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm fw-bold">Follow</button>
                    </form>
                @endif
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-auto">
                <a href="{{route('profile.show', $user->id)}}" class="text-decoration-none text-dark">
                    <strong>{{$user->posts->count()}}</strong> posts
                </a>
            </div>
            <div class="col-auto">
                <a href="{{route('show.followers', $user->id)}}" class="text-decoration-none text-dark">
                    <strong>{{$user->followers->count()}}</strong> followers
                </a>
            </div>
            <div class="col-auto">
                <a href="{{route('show.followings', $user->id)}}" class="text-decoration-none text-dark">
                    <strong>{{$user->followings->count()}}</strong> following
                </a>
            </div>
        </div>
        <div class="row mt-3">
            <p class="fw-bold">{{$user->introduction}}</p>
        </div>
    </div>
</div>