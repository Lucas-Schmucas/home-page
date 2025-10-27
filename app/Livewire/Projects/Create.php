<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{
    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('required|string')]
    public string $description = '';

    #[Validate('nullable|url')]
    public ?string $url = null;

    #[Validate('nullable|url')]
    public ?string $github_url = null;

    public array $technologies = [''];

    public function addTechnology(): void
    {
        $this->technologies[] = '';
    }

    public function removeTechnology(int $index): void
    {
        unset($this->technologies[$index]);
        $this->technologies = array_values($this->technologies);
    }

    public function save(): void
    {
        $this->validate();

        $technologies = array_filter($this->technologies, fn ($tech) => ! empty(trim($tech)));

        Project::create([
            'name' => $this->name,
            'description' => $this->description,
            'url' => $this->url,
            'github_url' => $this->github_url,
            'technologies' => $technologies,
        ]);

        session()->flash('success', 'Project added successfully!');

        $this->redirect(route('projects'), navigate: true);
    }

    public function render()
    {
        return view('livewire.projects.create')
            ->title(config('app.name').' - Add Project');
    }
}
