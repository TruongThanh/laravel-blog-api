<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Categories
        $categories = [
            ['name' => 'Technology', 'slug' => 'technology'],
            ['name' => 'Lifestyle', 'slug' => 'lifestyle'],
            ['name' => 'Travel', 'slug' => 'travel'],
            ['name' => 'Weather', 'slug' => 'weather'],
        ];
        DB::table('categories')->insert($categories);
        
        // Tags
        $tags = [
            ['name' => 'Laravel', 'slug' => 'laravel'],
            ['name' => 'VueJS', 'slug' => 'vuejs'],
            ['name' => 'Tips', 'slug' => 'tips'],
        ];
        DB::table('tags')->insert($tags);

        // Posts
        $posts = [
            [
                'title' => 'Getting Started with Laravel',
                'slug' => 'getting-started-with-laravel',
                'excerpt' => 'This is a beginner guide to Laravel...',
                'content' => 'Full content about Laravel basics...',
                'thumbnail' => 'https://plus.unsplash.com/premium_photo-1669357657874-34944fa0be68?q=80&w=870',
                'status' => 'published',
                'views' => 120,
                'likes' => 45,
                'comments' => 12,
                'read_time' => 5,
                'publish_at' => now()->subDays(2),
                'author_id' => 1, // đảm bảo có user id=1
                'category_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Top 10 Travel Destinations in 2025',
                'slug' => 'top-10-travel-destinations-2025',
                'excerpt' => 'Explore the best places to visit...',
                'content' => 'Full content about travel destinations...',
                'thumbnail' => "https://plus.unsplash.com/premium_photo-1682091872078-46c5ed6a006d?q=80&w=774",
                'status' => 'published',
                'views' => 250,
                'likes' => 89,
                'comments' => 23,
                'read_time' => 8,
                'publish_at' => now()->subDays(1),
                'author_id' => 1,
                'category_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        DB::table('posts')->insert($posts);
        // Post - Tag relations
        DB::table('post_tag')->insert([
            ['post_id' => 1, 'tag_id' => 1],
            ['post_id' => 1, 'tag_id' => 3],
            ['post_id' => 2, 'tag_id' => 2],
        ]);

    }
}
