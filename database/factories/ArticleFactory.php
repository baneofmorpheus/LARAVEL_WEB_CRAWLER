<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->name(),
            'link' => fake()->url(),
            'date' => Carbon::today()->subDays(rand(0, 179))->addSeconds(rand(0, 86400))->format('d/m/Y'),
            'excerpt' => fake()->paragraph(4),
            'image_url' => fake()->imageUrl(360, 360, 'houses', true),
        ];
    }
}
