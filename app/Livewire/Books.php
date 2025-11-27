<?php

namespace App\Livewire;

use App\Models\Book;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class Books extends Component
{
    use WithPagination;

    public function delete(Book $book): void
    {
        if ($book->image) {
            Storage::disk('public')->delete($book->image);
        }

        $book->delete();

        Cache::forget('books');

        session()->flash('success', 'Book deleted successfully!');
    }

    public function render()
    {
        $books = Cache::rememberForever('books',
            fn () => Book::query()
                ->orderByDesc('started_on')
                ->get()
        );

        $booksByYear = $books->groupBy(fn ($book) => $book->started_on?->format('Y') ?? 'Unknown');

        return view('livewire.books', [
            'booksByYear' => $booksByYear,
        ])->title(config('app.name').' Books');
    }
}
