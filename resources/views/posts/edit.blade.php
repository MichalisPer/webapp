@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 card">
                <div class="card-body">
                    <h2 class="card-title">Editting post</h2>
                    <form action={{route('posts.update', ['post' => $post])}} enctype='multipart/form-data' method = "post">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $post->title }}" placeholder="Add title (Football Game)" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <textarea id="description" type="description" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Add content" rows="5">{{$post->description}}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="file"><b>Choose Image:</b></label>
                                <input id="file" type="file" class="form-control @error('file') is-invalid @enderror" name="file" onchange="previewFile(this)"/>
                                <img id="previewImg" alt="post image" src="/images/{{$post->image}}" style="max-width:500px;margin-top:10px;"/>

                                @error('file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <input id="tags" type="text" class="form-control @error('tags') is-invalid @enderror" name="tags" value="{{ str_replace('#', '',$post->tags->pluck('name')->implode(',')) }}" placeholder="Add tags(comma seperated)" autofocus>

                                @error('tags')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-12">
                            @csrf
                            <button type="submit" class="btn btn-primary">Edit Post</button>
                            <button type="button" class="btn btn-danger" onclick="event.preventDefault();
                            document.getElementById('delete-form').submit();">Delete</button>
                        </div>
                    </div>
                    </form>
                    <form id='delete-form' action={{route('posts.update', ['post' => $post])}} method = "post">
                        @csrf
                        @method('DELETE')
                </div>
            </div>
        </div>
    </div>
    <script>
        function previewFile(input){
            var file=$("input[type =file]").get(0).files[0];
            if(file){
                var reader = new FileReader();
                reader.onload = function(){
                    $("#previewImg").attr("src", reader.result);
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
