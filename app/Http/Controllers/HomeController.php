<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;

class HomeController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $tags = Tag::all();

        return view('home', ['tags' => $tags]);
    }

    public function adminIndex(){

        $posts = Post::with('tags')->orderBy('created_at', 'desc')->paginate(5);

        return view('admin.index', ['posts' => $posts]);
    }

    public function adminShow($id){

        $post = Post::findOrFail($id);

        return view('admin.show', ['post' => $post]);
    }
}
