<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Component;

class Projects extends Component
{
    public function render()
    {
        $projects = Project::query()
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.projects', [
            'projects' => $projects,
        ])->title(config('app.name').' - Projects');
    }
}
