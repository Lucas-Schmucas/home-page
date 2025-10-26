<?php

namespace App\Livewire;

use App\Models\Book;
use Livewire\Component;
use Livewire\WithPagination;

class Books extends Component
{
    use WithPagination;

    public function render()
    {
        $books = Book::query()->paginate(12);

        return view('livewire.books', [
            'books' => $books,
        ])->title(config('app.name').' Books');
    }
}
