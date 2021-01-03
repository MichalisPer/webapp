<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Comment::factory(50)->create();

        foreach(\App\Models\Comment::all() as $comment){
            $comment->tags()->attach(\App\Models\Tag::inRandomOrder()->first());
            $comment->tags()->attach(\App\Models\Tag::inRandomOrder()->first());
        }
    }
}
