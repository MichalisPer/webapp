@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h3><b>Posts tagged with {{$tag->name}}:</b></h3>
                    <hr/>
                </div>
                <table class="table table-striped">
                    <tbody>
                    @foreach($tag->posts->sortBy([['created_at', 'desc']]) as $post)
                        <tr>
                            <td>{{ $post->title }}</td>
                        </tr>
                        <tr>
                            <td>
                                <a href={{ route('posts.show', ['post' => $post]) }} class="btn">{{ $post->description}}</a>
                                <footer class="blockquote-footer">Posted by <a href={{ route('profiles.show', ['profile' => $post->user->profile]) }}>{{$post->user->username}}</a> on {{$post->created_at}} <br>&nbsp;&nbsp;&nbsp;
                                @foreach($post->tags as $tag1)
                                    <a href={{ route('tags.show', ['tag' => $tag1]) }}><b><i>{{ $tag1->name}}</i></b></a>
                                @endforeach
                                </footer></blockquote></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h3><b>Comments tagged with {{$tag->name}}:</b></h3>
                    <hr/>
                </div>
                <table class="table table-striped">
                    <tbody>
                        @foreach($tag->comments->sortBy([['created_at', 'desc']]) as $comment)
                        <tr>
                            <td><b>Post title:</b> {{ $comment->post->title }}</td>
                        </tr>
                        <tr>
                            <td><b>Comment Description:</b><br>
                                {{ $comment->description}}
                                <footer class="blockquote-footer">Comment by <a href={{ route('profiles.show', ['profile' => $post->user->profile]) }}>{{$comment->user->username}}</a> on {{$comment->created_at}}<br>&nbsp;&nbsp;&nbsp;
                                @foreach($comment->tags as $tag2)
                                    <a href={{ route('tags.show', ['tag' => $tag2]) }}><b><i>{{ $tag2->name}}</i></b></a>
                                @endforeach
                                </footer></blockquote>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection
