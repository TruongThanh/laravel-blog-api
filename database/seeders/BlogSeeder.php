<?php

namespace Database\Seeders;

use App\Models\Api\Category;
use App\Models\Api\Post;
use App\Models\Api\Tag;
use App\Models\Api\User;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 10 users
        $users = User::factory(10)->create();
        // Create 20 categories
        $categories = Category::factory(20)->create();
        // Create 50 posts
        $tags = Tag::factory(50)->create();
        // Create 50 posts
        $posts = Post::factory(50)->create([
            'author_id' => function () use ($users) {
                return $users->random()->id;
            },
            'category_id' => function () use ($categories) {
                return $categories->random()->id;
            },
        ]);

        $posts->each(function ($post) use ($tags) {
            $post->tags()->attach($tags->random(rand(2, 4))->pluck('id')->toArray());
        });
    }
}
