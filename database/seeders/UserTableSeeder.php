<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->username = 'admin';
        $user->email = 'admin@admin.com';
        $user->password = bcrypt('admin');
        $user->is_admin = 1;
        $user->save();
        $user->profile()->save(new Profile);

        \App\Models\User::factory(10)->create();
    }

}
