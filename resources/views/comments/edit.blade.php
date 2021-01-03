@extends('layouts.app')

@section('title', 'Edit Comment')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 card">
                <div class="card-body">
                    <h2 class="card-title">Editting comment</h2>
                    <form action={{route('comments.update', ['comment' => $comment])}} method = "post">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-12">
                                <textarea id="description" type="description" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Add content" rows="5">{{$comment->description}}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <input id="tags" type="text" class="form-control @error('tags') is-invalid @enderror" name="tags" value="{{ str_replace('#', '',$comment->tags->pluck('name')->implode(',')) }}" placeholder="Add tags(comma seperated)" autofocus>

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
                            <button type="submit" class="btn btn-primary">Edit Comment</button>
                            <button type="button" class="btn btn-danger" onclick="event.preventDefault();
                            document.getElementById('delete-form').submit();">Delete</button>
                        </div>
                    </div>
                    </form>
                    <form id='delete-form' action={{route('comments.update', ['comment' => $comment])}} method = "post">
                        @csrf
                        @method('DELETE')
                </div>
            </div>
        </div>
    </div>

@endsection
