<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run() {
        \App\Models\User::factory()->create([
            'name' => 'Leonard H',
            'email' => 'stock@example.com',
            // password is: password
        ]);
    }
}
