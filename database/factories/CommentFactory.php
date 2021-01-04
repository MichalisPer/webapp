<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory {

    protected $model = Comment::class;

    public function definition(){

        return [
            'description' => $this->faker->paragraph,
            'user_id' => \App\Models\User::inRandomOrder()->first()->id,
            'post_id' => \App\Models\Post::inRandomOrder()->first()->id,
        ];
    }
}
