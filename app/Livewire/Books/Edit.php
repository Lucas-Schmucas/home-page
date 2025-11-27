<?php

namespace App\Livewire\Books;

use App\Models\Book;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public Book $book;

    #[Validate('required|string|max:255')]
    public string $title = '';

    #[Validate('required|string|max:255')]
    public string $author = '';

    #[Validate('nullable|image|max:2048')]
    public $image;

    #[Validate('required|string')]
    public string $personal_summary = '';

    #[Validate('required|url')]
    public string $url = '';

    #[Validate('nullable|date')]
    public ?string $started_on = null;

    #[Validate('nullable|date')]
    public ?string $finished_on = null;

    public function mount(Book $book): void
    {
        $this->book = $book;
        $this->title = $book->title;
        $this->author = $book->author;
        $this->personal_summary = $book->personal_summary;
        $this->url = $book->url;
        $this->started_on = $book->started_on?->format('Y-m-d');
        $this->finished_on = $book->finished_on?->format('Y-m-d');
    }

    public function save(): void
    {
        $this->validate();

        $imagePath = $this->book->image;

        if ($this->image) {
            // Delete old image if exists
            if ($this->book->image) {
                Storage::disk('public')->delete($this->book->image);
            }
            $imagePath = $this->image->store('books', 'public');
        }

        $this->book->update([
            'title' => $this->title,
            'author' => $this->author,
            'image' => $imagePath,
            'personal_summary' => $this->personal_summary,
            'url' => $this->url,
            'started_on' => $this->started_on,
            'finished_on' => $this->finished_on,
        ]);

        Cache::forget('books');

        session()->flash('success', 'Book updated successfully!');

        $this->redirect(route('books'), navigate: true);
    }

    public function render()
    {
        return view('livewire.books.edit')
            ->title(config('app.name').' - Edit Book');
    }
}
