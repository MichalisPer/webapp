@extends('layouts.app')

@section('title', 'Post')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-auto mr-auto">
                            <h2 class="card-title"><b>Post Title:</b><i>{{$post->title}}</i></h2><br>
                        </div>
                        <div class="col-auto">
                            <a href={{ route('posts.show', ['post' => $post]) }} class="btn btn-primary">Normal View</a>
                        </div>
                    </div>
                    <p><b>Content: </b> {{ $post->description }}</p>
                <div class="card-footer">
                    <footer class="blockquote-footer">Posted by <a href={{ route('profiles.show', ['profile' => $post->user->profile]) }}>{{$post->user->username}}</a> on {{$post->created_at}}<br>&nbsp;&nbsp;&nbsp;
                        @foreach($post->tags as $tag)
                        <a href={{ route('tags.show', ['tag' => $tag]) }}><b><i>{{ $tag->name}}</i></b></a>
                        @endforeach
                    </footer></blockquote></td>
                </div>
                <br>
                <a href={{ route('posts.edit', ['post' => $post]) }} class="btn btn-primary">Edit post</a>
                <a href={{ route('posts.index') }} class="btn btn-secondary">Back</a>
                <hr />
                <h4 id="ff">Comments</h4>
                <table id="commentTable" class="table table-striped">
                @foreach($post->comments as $comment)
                    <tr>
                        <td>{{ $comment->description}}
                            <footer class="blockquote-footer">Comment by <a href={{ route('profiles.show', ['profile' => $post->user->profile]) }}>{{$comment->user->username}}</a> on {{$comment->created_at}}<br>&nbsp;&nbsp;&nbsp;
                            @foreach($comment->tags as $tag)
                                <a href={{ route('tags.show', ['tag' => $tag]) }}><b><i>{{ $tag->name}}</i></b></a>
                            @endforeach
                            </footer></blockquote>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href={{ route('comments.edit', ['comment' => $comment]) }} class="btn btn-primary">Edit</a>
                        </td>
                    </tr>
                @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
