<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class myUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'Hardik',
            'email' => 'admin@gmail.com',
            'mobile' => "1234567",
            'password' => bcrypt('123456'),
        ]);
    }
}
