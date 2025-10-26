<?php

namespace App\Livewire;

use App\Http\Resources\WorkExperienceResource;
use App\Models\WorkExperience;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class About extends Component
{
    public function render()
    {
        $workExperience = Cache::rememberForever('work_experience',
            fn() => WorkExperience::query()->orderBy('start_date', 'desc')->get()
        );

        return view('livewire.about', [
            'workExperience' => $workExperience,
        ])->title(config('app.name') . ' - About');
    }
}
