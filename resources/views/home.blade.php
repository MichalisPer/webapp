@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Beat the booker</h5>
                    <p class="card-text">Share your own predictions about a specific game and discuss it with the community in order to beat the booker!</p>
                    <a class="nav-link" href="{{ route('posts.index') }}"><b>Posts and Predictions</b></a>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Interact with the community</h5>
                    <p class="card-text">A website with people with same interests as you trying to help each other in order to predict the correct result by sharing news and facts that you may dont know.</p>
                </div>
            </div>
            <br>
            @guest
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Already have account?</h5>
                    <p class="card-text">Log into your account in order to be able to post and comment your own thoughts and predictions!</p>
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                    @endif
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Dont have account?</h5>
                    <p class="card-text">Create an account in order to interact with the community!</p>
                    @if (Route::has('login'))
                        <a href="{{ route('register') }}" class="btn btn-success">Create New Account</a>
                    @endif
                </div>
            </div>
            @endguest
        </div>
    </div>
</div>
@endsection
