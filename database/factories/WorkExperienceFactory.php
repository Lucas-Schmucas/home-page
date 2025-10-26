<?php

namespace Database\Factories;

use App\Technology;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WorkExperience>
 */
class WorkExperienceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = fake()->dateTimeBetween('-5 years', '-1 year');
        $endDate = fake()->optional(0.6)->dateTimeBetween($startDate, 'now');

        $technologies = fake()->randomElements(
            Technology::cases(),
            fake()->numberBetween(2, 5)
        );

        $uuid = fake()->uuid();
        $imageContents = file_get_contents("https://picsum.photos/seed/{$uuid}/200/200");
        $imagePath = "work-experiences/{$uuid}.jpg";
        \Illuminate\Support\Facades\Storage::disk('public')->put($imagePath, $imageContents);

        return [
            'job_title' => fake()->jobTitle(),
            'description' => fake()->paragraphs(2, true),
            'image' => $imagePath,
            'company_name' => fake()->company(),
            'color' => fake()->randomElement(['blue', 'purple', 'green', 'red', 'orange', 'pink']),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'technologies' => $technologies,
        ];
    }
}
