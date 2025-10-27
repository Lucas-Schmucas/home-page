<?php

namespace App\Livewire\WorkExperience;

use App\Models\WorkExperience;
use App\Technology;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    #[Validate('required|string|max:255')]
    public string $job_title = '';

    #[Validate('required|string|max:255')]
    public string $company_name = '';

    #[Validate('required|string')]
    public string $description = '';

    #[Validate('nullable|image|max:2048')]
    public $image;

    #[Validate('nullable|string|max:255')]
    public ?string $color = null;

    #[Validate('required|date')]
    public string $start_date = '';

    #[Validate('nullable|date')]
    public ?string $end_date = null;

    public array $technologies = [];

    public function save(): void
    {
        $this->validate();

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('work-experience', 'public');
        }

        $selectedTechnologies = collect($this->technologies)
            ->map(fn ($value) => Technology::from($value))
            ->toArray();

        WorkExperience::create([
            'job_title' => $this->job_title,
            'company_name' => $this->company_name,
            'description' => $this->description,
            'image' => $imagePath,
            'color' => $this->color,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'technologies' => $selectedTechnologies,
        ]);

        Cache::forget('work_experience');

        session()->flash('success', 'Work experience added successfully!');

        $this->redirect(route('about'), navigate: true);
    }

    public function render()
    {
        return view('livewire.work-experience.create', [
            'availableTechnologies' => Technology::cases(),
        ])->title(config('app.name').' - Add Work Experience');
    }
}
