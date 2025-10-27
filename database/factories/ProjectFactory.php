<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $technologies = [
            ['Laravel', 'PHP', 'MySQL'],
            ['React', 'TypeScript', 'Tailwind CSS'],
            ['Vue.js', 'JavaScript', 'Node.js'],
            ['Laravel', 'Livewire', 'Alpine.js'],
            ['Next.js', 'React', 'PostgreSQL'],
        ];

        $startDate = fake()->dateTimeBetween('-2 years', '-6 months');
        $isCompleted = fake()->boolean(70);

        return [
            'name' => fake()->words(3, true),
            'description' => fake()->sentences(3, true),
            'url' => fake()->boolean(60) ? fake()->url() : null,
            'github_url' => fake()->boolean(80) ? 'https://github.com/'.fake()->userName().'/'.fake()->slug(2) : null,
            'technologies' => fake()->randomElement($technologies),
        ];
    }
}
