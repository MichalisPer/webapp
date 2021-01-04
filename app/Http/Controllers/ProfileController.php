<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show(Profile $profile){

        $profile->user->posts = $profile->user->posts->sortBy([['created_at', 'desc']]);

        return view('profiles.show', ['profile' => $profile]);
    }

    public function edit(Profile $profile){

        if($profile->user_id != Auth::id()){
            return(abort(404));
        }

        $profile->user->posts = $profile->user->posts->sortBy([['created_at', 'desc']]);

        return view('profiles.edit', ['profile' => $profile]);

    }

    public function update(Request $request, Profile $profile){

        if($profile->user_id != Auth::id()){
            return(abort(403));
        }

        $request->validate([
            'bio' => 'nullable|max:500',
            'age' => 'nullable|numeric|digits_between:0,3',
            'phone' => 'nullable|numeric|digits_between:0,20',
            'country' => 'nullable|max:15',
            'favleague' => 'nullable|max:15',
        ]);

        $profile->update($request->only(['bio','age','phone','country','favleague','user_id']));

        return redirect()->to(route('profiles.show', ['profile' => $profile]));
    }
}
