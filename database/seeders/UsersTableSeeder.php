<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Edgar Pinheiro',
            'email' => 'edgarpinheiro3@gmail.com',
            'password' => bcrypt('123456'),
        ]);
    }
}
