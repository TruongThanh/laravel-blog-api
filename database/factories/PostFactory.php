<?php

namespace Database\Factories;

use App\Models\Api\Category;
use App\Models\Api\Post;
use App\Models\Api\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Api\Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence();
        
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'excerpt' => fake()->paragraph(),
            'content' => fake()->paragraphs(3, true),
            'thumbnail' => fake()->imageUrl(640, 480, 'cats', true),
            'status' => fake()->randomElement(['draft', 'published', 'archived']),
            'views' => fake()->numberBetween(0, 1000),
            'likes' => fake()->numberBetween(0, 500),
            'comments' => fake()->numberBetween(0, 10000),
            'read_time' => fake()->numberBetween(1, 20),
            'category_id' => Category::factory(),
            'author_id' => User::factory(),
            'published_at' => fake()->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s'),
            'created_at' => fake()->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s'),
            'updated_at' => fake()->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s'),
        ];
    }
}
