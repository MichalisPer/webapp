<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller {

    public function index(){
        $posts = Post::with('tags')->orderBy('created_at', 'desc')->paginate(5);
        return view('posts.index', ['posts' => $posts]);
    }

    public function create(){
        return view('posts.create');
    }

    public function store(Request $request){

        $request->validate([
            'title' => 'required|max:50',
            'description' => 'required|max:500',
            'file' => 'nullable|file',
            'tags' => [function ($attribute, $value, $fail) {
                        $tagNames = explode(',',$value);
                        foreach($tagNames as $tagName){
                            if(strlen($tagName) > 14){
                                $fail('The '.$attribute.' is invalid.');
                            }
                        }
                    }],
        ]);

        $post = Auth::user()->posts()
                ->create($request->only(['title','description']));

        $image0 = $request->file('file');
        $imageName = time().'.'.$image0->extension();
        $image0->move(public_path('images'),$imageName);

        $post->image = $imageName;

        $post->save();

        if($post){
            $tagNames = explode(',',$request->get('tags'));
            $tagIds = [];
            foreach($tagNames as $tagName){
                $tag = Tag::firstOrCreate(['name'=>'#'.$tagName]);
                if($tag){
                    $tagIds[] = $tag->id;
                }
            }
        }

        $post->tags()->sync($tagIds);

        if($post){
            return redirect()->to(route('posts.index'));
        }

        return redirect()->back();
    }

    public function show($id){

        $post = Post::findOrFail($id);

        return view('posts.show', ['post' => $post]);
    }

    public function edit(Post $post){

        if(($post->user_id != Auth::id()) && (Auth::user()->is_admin != 1)){
            return(abort(404));
        }

        return view('posts.edit', ['post' => $post]);

    }

    public function update(Request $request, Post $post){

        if(($post->user_id != Auth::id()) && (Auth::user()->is_admin != 1)){
            return(abort(403));
        }

        $request->validate([
            'title' => 'required|max:50',
            'description' => 'required|max:500',
            'file' => 'nullable|file',
            'tags' => [function ($attribute, $value, $fail) {
                $tagNames = explode(',',$value);
                foreach($tagNames as $tagName){
                    if(strlen($tagName) > 14){
                        $fail('The '.$attribute.' is invalid.');
                    }
                }
            }],
        ]);

        if($post){
            $tagNames = explode(',',$request->get('tags'));
            $tagIds = [];
            foreach($tagNames as $tagName){
                    $tag = Tag::firstOrCreate(['name'=>'#'.$tagName]);
                    if($tag){
                        $tagIds[] = $tag->id;
                    }
                }
            }

        $post->tags()->sync($tagIds);

        $post->update($request->only(['title','description']));

        $image0 = $request->file('file');
        $imageName = time().'.'.$image0->extension();
        $image0->move(public_path('images'),$imageName);

        $post->image = $imageName;

        $post->update();

        if(Auth::user()->is_admin == 1){
            return redirect()->to(route('admin.show', ['post' => $post]));
        }

        return redirect()->to(route('posts.show', ['post' => $post]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Post $post){

        if(($post->user_id != Auth::id()) && (Auth::user()->is_admin != 1)){
            return(abort(403));
        }

        if($post->image != null){
            unlink(public_path('images').'/'.$post->image);
        }

        $post->delete();

        if(Auth::user()->is_admin == 1){
            return redirect()->to(route('admin.index'));
        }

        return redirect()->to(route('posts.index'));
    }
}
