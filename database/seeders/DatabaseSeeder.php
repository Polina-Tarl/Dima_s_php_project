<?php

namespace Database\Seeders;

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
        \App\Models\User::factory(10)->create()->each(function ($user) {
            \App\Models\Post::factory(3)->create([
                'user_id' => $user->id,
            ])->each(function ($post) use ($user) {
                \App\Models\Comment::factory(5)->create([
                    'user_id' => $user->id,
                    'post_id' => $post->id,
                ]);
            });
        });
    }
}
