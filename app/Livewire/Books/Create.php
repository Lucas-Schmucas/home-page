<?php

namespace App\Livewire\Books;

use App\Models\Book;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

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

    public function save(): void
    {
        $this->validate();

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('books', 'public');
        }

        Book::create([
            'title' => $this->title,
            'author' => $this->author,
            'image' => $imagePath,
            'personal_summary' => $this->personal_summary,
            'url' => $this->url,
            'started_on' => $this->started_on,
            'finished_on' => $this->finished_on,
        ]);

        Cache::forget('books');

        session()->flash('success', 'Book added successfully!');

        $this->redirect(route('books'), navigate: true);
    }

    public function render()
    {
        return view('livewire.books.create')
            ->title(config('app.name').' - Add Book');
    }
}
