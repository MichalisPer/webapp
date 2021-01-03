<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
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
