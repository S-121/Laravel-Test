<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'Testing 2',
            'email' => 'test2@gmail.com',
            'mobile' => "0000000",
            'password' => bcrypt('123456'),
        ]);
    }
}
