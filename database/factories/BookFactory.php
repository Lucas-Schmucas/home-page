<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startedOn = fake()->dateTimeBetween('-2 years', 'now');
        $finishedOn = fake()->optional(0.7)->dateTimeBetween($startedOn, 'now');

        return [
            'title' => fake()->words(3, true),
            'author' => fake()->name(),
            'image_url' => 'https://picsum.photos/seed/'.fake()->uuid().'/400/600',
            'personal_summary' => fake()->paragraphs(3, true),
            'url' => 'https://www.amazon.com',
            'started_on' => $startedOn,
            'finished_on' => $finishedOn,
        ];
    }
}
