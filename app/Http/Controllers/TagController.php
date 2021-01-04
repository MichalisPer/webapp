<?php

namespace App\Http\Controllers;
use App\Models\Tag;

class TagController extends Controller
{
    public function show($id){

        $tag = Tag::findOrFail($id);

        return view('tags.show', ['tag' => $tag]);
    }
}
