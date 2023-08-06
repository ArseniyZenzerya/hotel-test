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
         \App\Models\Book::factory(10)->create();

         \App\Models\User::factory()->create([
             'email' => 'admin@admin.com',
             'password' =>  Hash::make('admin'),
         ]);

        \App\Models\Role::factory()->create([
            'name' => 'admin',
        ]);

        \App\Models\UserRole::factory()->create([
            'user_id' => 1,
            'role_id' => 1,
        ]);
    }
}
