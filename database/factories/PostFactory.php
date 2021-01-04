<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory {

    public function definition(){
        return [
            'title' => $this->faker->text($maxNbChars = 30),
            'description' => $this->faker->paragraph,
            'user_id' => \App\Models\User::inRandomOrder()->first()->id,
        ];
    }
}
