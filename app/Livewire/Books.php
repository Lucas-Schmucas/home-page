<?php

namespace App\Livewire;

use Livewire\Component;

class Books extends Component
{
    public function render()
    {
        $books = null;

        return view('livewire.books', [
            'books' => $books,
        ])->title(config('app.name').'Books');
    }
}
