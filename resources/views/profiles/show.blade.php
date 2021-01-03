@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-header">
                  <h5 class="card-title">{{$profile->user->username}}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>Bio:</b> {{$profile->bio}}</li>
                    <li class="list-group-item"><b>Age:</b> {{$profile->age}}</li>
                    <li class="list-group-item"><b>Phone:</b> {{$profile->phone}}</li>
                    <li class="list-group-item"><b>Country:</b> {{$profile->country}}</li>
                    <li class="list-group-item"><b>Favourite League:</b> {{$profile->favleague}}</li>
                </ul>
                <div class="card-body">
                    @if($profile->user_id == Auth::id())
                        <a href="{{ route('profiles.edit', ['profile' => $profile]) }}" class="btn btn-primary">Edit Profile</a>
                        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back</a>
                    @else
                        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header">
                    <h3><b>Posts of {{$profile->user->username}}:</b></h3>
                    <hr/>
                </div>
                <table class="table table-striped">
                    <tbody>
                    @foreach($profile->user->posts as $post)
                        <tr>
                            <td>{{ $post->title }}</td>
                        </tr>
                        <tr>
                            <td>
                                <a href={{ route('posts.show', ['post' => $post]) }} class="btn">{{ $post->description}}</a>
                                <footer class="blockquote-footer">Posted by <a href={{ route('profiles.show', ['profile' => $post->user->profile]) }}>{{$post->user->username}}</a> on {{$post->created_at}} <br>&nbsp;&nbsp;&nbsp;
                                @foreach($post->tags as $tag)
                                    <a href={{ route('tags.show', ['tag' => $tag]) }}><b><i>{{ $tag->name}}</i></b></a>
                                @endforeach
                                </footer></blockquote></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection
