<?php

namespace Database\Seeders;

use App\Models\Profile;
use Database\Factories\TaggableFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserTableSeeder::class,
            ProfileTableSeeder::class,
            TagTableSeeder::class,
            PostTableSeeder::class,
            CommentTableSeeder::class,
            ]);
    }
}
