@extends('layouts.app')

@section('title', 'Post')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 card">
                <div class="card-body">
                    <h2 class="card-title"><b>Post Title: </b><i>{{$post->title}}</i></h2><br>
                    <p><b>Content: </b>{{ $post->description }}</p><br>
                    @if($post->image != null)
                        <img src= "/images/{{$post->image}}"/><br>
                    @endif
                <div class="card-footer">
                    <footer class="blockquote-footer">Posted by <a href={{ route('profiles.show', ['profile' => $post->user->profile]) }}>{{$post->user->username}}</a> on {{$post->created_at}}<br>&nbsp;&nbsp;&nbsp;
                        @foreach($post->tags as $tag)
                        <a href={{ route('tags.show', ['tag' => $tag]) }}><b><i>{{ $tag->name}}</i></b></a>
                        @endforeach
                    </footer></blockquote></td>
                </div>
                <br>
                @if($post->user_id == Auth::id())
                    <a href={{ route('posts.edit', ['post' => $post]) }} class="btn btn-primary">Edit post</a>
                    <a href={{ route('posts.index') }} class="btn btn-secondary">Back</a>
                @else
                    <a href={{ route('posts.index') }} class="btn btn-secondary">Back</a>
                @endif
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
                        <td>@if($comment->user_id == Auth::id())
                                <a href={{ route('comments.edit', ['comment' => $comment]) }} class="btn btn-primary">Edit</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </table>
                <form id="comment-form">
                    @csrf
                    <div class="form-group">
                        <textarea id="description" type="description" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Add comment" rows="3">{{old('description')}}</textarea>

                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <input id = "post_id" type="hidden" name="post_id" value="{{ $post->id }}" />
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <input id="tags" type="text" class="form-control @error('tags') is-invalid @enderror" name="tags" value="{{ old('tags') }}" placeholder="Add tags(comma seperated)">

                            @error('tags')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Comment</button>
                </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $("#comment-form").submit(function(e){
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });

            e.preventDefault();

            let description = $('#description').val();
            let tags = $('#tags').val();
            let post_id = $('#post_id').val();
            console.log(post_id);
            let _token = $('input[name=_token]').val();


            $.ajax({
                url: "{{route('comments.store')}}",
                type: "POST",
                data:{
                    description: description,
                    tags: tags,
                    post_id: post_id,
                    _token:_token
                },
                success:function(response){
                    if(response){
                        var tags = response.tags.map(a => a.name).join('#');
                        $("#commentTable tbody:last").append('<tr><td>'+ response.description +'</td></tr><tr><td>'+'#'+ tags + '</td></tr>');
                        $("#comment-form")[0].reset();
                    }
                }
            });
            return false;
        });
    </script>
@endsection
