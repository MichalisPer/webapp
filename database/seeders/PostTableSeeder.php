<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Post::factory(20)->create();

        foreach(\App\Models\Post::all() as $post){
            $post->tags()->attach(\App\Models\Tag::inRandomOrder()->first());
            $post->tags()->attach(\App\Models\Tag::inRandomOrder()->first());
        }
    }
}
