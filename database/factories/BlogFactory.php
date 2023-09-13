<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Blog;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \Blog::class;

    public function definition(): array
    {
        return [            
            'title' => $this->faker->text,
            'description' => $this->faker->paragraph,
            'code'  =>  $this->faker->uuid,
        ]; 

    }
}