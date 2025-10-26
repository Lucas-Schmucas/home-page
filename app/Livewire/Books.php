<?php

namespace App\Livewire;

use App\Models\Book;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithPagination;

class Books extends Component
{
    use WithPagination;

    public function render()
    {
        $books = Cache::rememberForever('books',
            fn() => Book::query()->paginate(12)
        );

        return view('livewire.books', [
            'books' => $books,
        ])->title(config('app.name') . ' Books');
    }
}
