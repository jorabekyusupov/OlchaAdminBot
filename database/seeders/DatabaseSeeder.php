<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $password = Hash::make("admin");
        \App\Models\User::factory()->create([
            'first_name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => $password,
        ]);
    }
}
