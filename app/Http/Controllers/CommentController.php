<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller{

    public function store(Request $request){

        $request->validate([
            'description' => 'required|max:500',
            'tags' => [function ($attribute, $value, $fail) {
                        $tagNames = explode(',',$value);
                        foreach($tagNames as $tagName){
                            if(strlen($tagName) > 14){
                                $fail('The '.$attribute.' is invalid.');
                            }
                        }
                    }],
        ]);

        $comment = Auth::user()->comments()
                ->create($request->only(['description', 'post_id' ]));


        if($comment){
            $tagNames = explode(',',$request->get('tags'));
            $tagIds = [];
            foreach($tagNames as $tagName){
                    $tag = Tag::firstOrCreate(['name'=>'#'.$tagName]);
                    if($tag){
                        $tagIds[] = $tag->id;
                    }
                }
            }
        $comment->tags()->sync($tagIds);



        return response()->json(Comment::with('tags')->find($comment->id));
    }

    public function edit(Comment $comment){
        if(($comment->user_id != Auth::id()) && (Auth::user()->is_admin != 1)){
            return(abort(404));
        }

        return view('comments.edit', ['comment' => $comment]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment){

        if(($comment->user_id != Auth::id()) && (Auth::user()->is_admin != 1)){
            return(abort(403));
        }

        $request->validate([
            'description' => 'required|max:500',
            'tags' => [function ($attribute, $value, $fail) {
                $tagNames = explode(',',$value);
                foreach($tagNames as $tagName){
                    if(strlen($tagName) > 14){
                        $fail('The '.$attribute.' is invalid.');
                    }
                }
            }],
        ]);

        if($comment){
            $tagNames = explode(',',$request->get('tags'));
            $tagIds = [];
            foreach($tagNames as $tagName){
                    $tag = Tag::firstOrCreate(['name'=>'#'.$tagName]);
                    if($tag){
                        $tagIds[] = $tag->id;
                    }
                }
            }
        $comment->tags()->sync($tagIds);

        $comment->update($request->only(['description', 'post_id']));

        if(Auth::user()->is_admin == 1){
            return redirect()->to(route('admin.show', ['post' => $comment->post]));
        }

        return redirect()->to(route('posts.show', ['post' => $comment->post]));
    }

    public function destroy(Request $request, Comment $comment){
        if(($comment->user_id != Auth::id()) && (Auth::user()->is_admin != 1)){
            return(abort(403));
        }

        $comment->delete();

        if(Auth::user()->is_admin == 1){
            return redirect()->to(route('admin.show', ['post' => $comment->post]));
        }

        return redirect()->to(route('posts.show', ['post' => $comment->post]));
    }
}
