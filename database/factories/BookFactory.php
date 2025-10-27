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

        $uuid = fake()->uuid();
        $imagePath = null;

        try {
            $imageContents = @file_get_contents("https://picsum.photos/seed/{$uuid}/200/200");
            if ($imageContents !== false) {
                $imagePath = "books/{$uuid}.jpg";
                \Illuminate\Support\Facades\Storage::disk('public')->put($imagePath, $imageContents);
            }
        } catch (\Exception $e) {
            // If image fetching fails, just continue without an image
        }

        return [
            'title' => fake()->words(3, true),
            'author' => fake()->name(),
            'image' => $imagePath,
            'personal_summary' => fake()->paragraphs(3, true),
            'url' => 'https://www.amazon.com',
            'started_on' => $startedOn,
            'finished_on' => $finishedOn,
        ];
    }
}
