<?php

namespace App\Livewire;

use Livewire\Component;

class About extends Component
{
    public function render()
    {
        $workExperience = null;
        $education = null;

        return view('livewire.about', [
            'workExperience' => $workExperience,
            'education' => $education,
        ])->title(config('app.name').'About');
    }
}
