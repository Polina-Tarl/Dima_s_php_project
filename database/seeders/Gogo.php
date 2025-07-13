<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class Gogo extends Seeder
{

    public function run(): void
    {
        \App\Models\User::factory(10)->create()->each(function ($user) {
            \App\Models\Post::factory(3)->create([
                'user_id' => $user->id
            ])->each(function ($post) use ($user) {
                \App\Models\Comment::factory(5)->create([
                    'post_id' => $post->id,
                    'user_id' => User::inRandomOrder()->first()->id
                ]);
            });
        });
    }

}
