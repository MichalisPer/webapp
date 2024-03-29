<?php

namespace Database\Factories;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory {

    protected $model = Profile::class;

    public function definition(){

        static $count = 2;

        return [
            'age' => (string)$this->faker->numberBetween(0,100),
            'phone' => $this->faker->phoneNumber,
            'country' => $this->faker->country,
            'favleague' => $this->faker->country,
            'bio' => $this->faker->paragraph,
            'user_id' => \App\Models\User::find($count++)->id,
        ];
    }
}
