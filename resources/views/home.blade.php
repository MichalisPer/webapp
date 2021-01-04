@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <div id="football" class="card">
                <div class="card-body">
                    <h5 class="card-title">Beat the booker</h5>
                    <p class="card-text">Share your own predictions about a specific game and discuss it with the community in order to beat the booker!</p>
                    <a class="nav-link" href="{{ route('posts.index') }}"><b>Posts and Predictions</b></a>
                    <button id='api-button' type="button" class="btn btn-primary"><b>Get Quote of the day</b></button>
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
<script>
    function getRandomInt(max) {
        return Math.floor(Math.random() * Math.floor(max));
    }
    $("#api-button").click(function(e){

        let d = document.getElementById("football");
        var elements = document.getElementsByClassName('val');

        if (elements.length == 0 ){

        }
        else {
            var requiredElement = elements[0];
            let throwawayNode = d.removeChild(requiredElement);
        }

        // Set up the HTTP request
        var xhr = new XMLHttpRequest();
        // Setup the listener to process completed requests
        xhr.onreadystatechange = function() {
            // Only run if the request is complete
            if (xhr.readyState !== 4) return;
            // Process the return data
            if (xhr.status >= 200 && xhr.status < 300) { //the request is successful
                var JSONdata = xhr.responseText; /*JSON String*/
                var response = JSON.parse(JSONdata); /* Javascript object*/

                var num = response.length; /*number of places returned*/
                const el1 = document.querySelector('#football');

                var index = getRandomInt(num);
                res = document.createElement('div');
                res.textContent = response[index].text
                //res.classList.add('val');
                res.setAttribute("class", 'val');
                el1.appendChild(res);
                //console.log(response.result[i].league_name);



                /*If the user does not provide the correct address and province, more than one options - locations may be returned. We always choose the first one because it is usually the expected.*/

            } else { //the request has failed

                console.log('error', xhr);
                        }
            };

            xhr.open('GET','https://type.fit/api/quotes');
            xhr.send();
    });
</script>
@endsection
