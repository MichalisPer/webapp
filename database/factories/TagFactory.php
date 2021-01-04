<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory {

    protected $model = Tag::class;

    public function definition(){

        return [
            'name' => '#'.$this->faker->randomElement(['PremierLeague','SerieA','Championship','League1', 'League2', 'EuropaLeague','ChampionsLeague', 'Ligue1', 'LaLiga'])
        ];
    }
}
