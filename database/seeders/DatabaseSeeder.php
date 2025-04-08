<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@test.com',
        ]);

        User::factory(10)->create();

        User::all()->each(function($user){
            for ($i=0; $i < rand(5, 10); $i++) { 
                $user->posts()->create(
                    Post::factory()->make()->toArray()
                );
            }
        });
    }
}
