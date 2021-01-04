@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                  <h5 class="card-title">{{$profile->user->username}}</h5>
                </div>
                <form action={{route('profiles.update', ['profile' => $profile])}} method = "post">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="form-group row">
                                <label for="Bio" class="col-sm-2 col-form-label"><b>Bio:</b></label>
                                <div class="col-sm-10">
                                    <textarea id="bio" type="text" class="form-control @error('bio') is-invalid @enderror" name="bio" placeholder="Add bio" rows="5">{{$profile->bio}}</textarea>
                                    @error('bio')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="form-group row">
                                <label for="Age" class="col-sm-3 col-form-label"><b>Age:</b></label>
                                <div class="col-sm-9">
                                    <input id="age" type="text" class="form-control @error('age') is-invalid @enderror" name="age" value="{{$profile->age}}" placeholder="Add age" autofocus>
                                    @error('age')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="form-group row">
                                <label for="Phone" class="col-sm-3 col-form-label"><b>Phone:</b></label>
                                <div class="col-sm-9">
                                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{$profile->phone}}" placeholder="Add phone" autofocus>
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="form-group row">
                                <label for="Country" class="col-sm-4 col-form-label"><b>Country:</b></label>
                                <div class="col-sm-8">
                                    <input id="counry" type="text" class="form-control @error('country') is-invalid @enderror" name="country" value="{{$profile->country}}" placeholder="Add country" autofocus>
                                    @error('country')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="form-group row">
                                <label for="Country" class="col-sm-4 col-form-label"><b>Favourite League:</b></label>
                                <div class="col-sm-8">
                                    <input id="favleague" type="text" class="form-control @error('favleague') is-invalid @enderror" name="favleague" value="{{$profile->favleague}}" placeholder="Add favourite league" autofocus>
                                    @error('favleague')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </li>
                    </ul>
                    <input type="hidden" name="user_id" value="{{ $profile->user_id }}" />
                    <div class="card-body">
                        @csrf
                        <button type="submit" class="btn btn-primary">Done</button>
                    </div>
                </form>
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
                                @if($post->image != null)
                                    <img src= "/images/{{$post->image}}" /><br><br>
                                @endif
                                {{ $post->description}}
                                <footer class="blockquote-footer">Posted by {{$post->user->username}} on {{$post->created_at}} <br>&nbsp;&nbsp;&nbsp;
                                @foreach($post->tags as $tag)
                                    <b><i>{{ $tag->name}}</i></b>
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
