@extends('layouts.app')

@section('title', 'Posts')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-auto mr-auto">
                            <h2 class="card-title">Posts</h2>
                        </div>
                        <div class="col-auto">
                            @guest
                            @else
                                @if(Auth::user()->is_admin == 1)
                                    <a href={{ route('admin.index') }} class="btn btn-primary">Admin View</a>
                                @endif
                                <a href={{ route('posts.create') }} class="btn btn-primary">Create post</a>
                            @endguest
                        </div>
                    </div>
                    <table class="table table-striped">
                        <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td><b>Title: </b> {{ $post->title }}</td>
                            </tr>
                            <tr>
                                <td>
                                    @if($post->image != null)
                                        <a href={{ route('posts.show', ['post' => $post]) }} class="btn"><img src= "/images/{{$post->image}}" /></a><br><br>
                                    @endif
                                    <a href={{ route('posts.show', ['post' => $post]) }} class="btn">{{$post->description}}</a>
                                    <footer class="blockquote-footer">Posted by <a href={{ route('profiles.show', ['profile' => $post->user->profile]) }}>{{$post->user->username}}</a> on {{$post->created_at}}<br>&nbsp;&nbsp;&nbsp;
                                    @foreach($post->tags as $tag)
                                        <a href={{ route('tags.show', ['tag' => $tag]) }}><b><i>{{$tag->name}}</i></b></a>
                                    @endforeach
                                    </footer></blockquote></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br>
        <div class="d-flex justify-content-center">
            {!! $posts->links() !!}
        </div>
    </div>
@endsection
