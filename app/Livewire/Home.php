<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $profileImagePath = 'profile_image.jpg';
        $profileImageUrl = Storage::disk('public')->url($profileImagePath);

        return view('livewire.home', [
            'profileImageUrl' => $profileImageUrl,
        ])->title(config('app.name').' - Home');
    }
}
