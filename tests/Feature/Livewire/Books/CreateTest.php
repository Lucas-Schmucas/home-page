<?php

use App\Livewire\Books\Create;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;

beforeEach(function () {
    Storage::fake('public');
    Cache::flush();
});

it('redirects guests to login when trying to access create book page', function () {
    $this->get(route('books.create'))
        ->assertRedirect(route('login'));
});

it('allows authenticated users to access create book page', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->get(route('books.create'))
        ->assertSuccessful();
});

it('can render the create book component', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Create::class)
        ->assertSuccessful();
});

it('validates required fields', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Create::class)
        ->call('save')
        ->assertHasErrors([
            'title' => 'required',
            'author' => 'required',
            'personal_summary' => 'required',
            'url' => 'required',
        ]);
});

it('validates title max length', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Create::class)
        ->set('title', str_repeat('a', 256))
        ->call('save')
        ->assertHasErrors(['title' => 'max']);
});

it('validates author max length', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Create::class)
        ->set('author', str_repeat('a', 256))
        ->call('save')
        ->assertHasErrors(['author' => 'max']);
});

it('validates url format', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Create::class)
        ->set('url', 'not-a-valid-url')
        ->call('save')
        ->assertHasErrors(['url' => 'url']);
});

it('validates started_on date format', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Create::class)
        ->set('started_on', 'not-a-date')
        ->call('save')
        ->assertHasErrors(['started_on' => 'date']);
});

it('validates finished_on date format', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Create::class)
        ->set('finished_on', 'not-a-date')
        ->call('save')
        ->assertHasErrors(['finished_on' => 'date']);
});

it('can create a book with minimum required fields', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Create::class)
        ->set('title', 'The Great Book')
        ->set('author', 'John Doe')
        ->set('personal_summary', 'This is a great book about testing.')
        ->set('url', 'https://amazon.com/great-book')
        ->call('save')
        ->assertHasNoErrors()
        ->assertRedirect(route('books'));

    assertDatabaseHas('books', [
        'title' => 'The Great Book',
        'author' => 'John Doe',
        'personal_summary' => 'This is a great book about testing.',
        'url' => 'https://amazon.com/great-book',
        'image' => null,
        'started_on' => null,
        'finished_on' => null,
    ]);
});

it('can create a book with all fields', function () {
    $user = User::factory()->create();
    $image = UploadedFile::fake()->image('book-cover.jpg');

    Livewire::actingAs($user)
        ->test(Create::class)
        ->set('title', 'Complete Book')
        ->set('author', 'Jane Smith')
        ->set('personal_summary', 'A comprehensive book with all details.')
        ->set('url', 'https://amazon.com/complete-book')
        ->set('image', $image)
        ->set('started_on', '2024-01-01')
        ->set('finished_on', '2024-02-01')
        ->call('save')
        ->assertHasNoErrors()
        ->assertRedirect(route('books'));

    $book = Book::where('title', 'Complete Book')->first();

    expect($book)->not->toBeNull();
    expect($book->title)->toBe('Complete Book');
    expect($book->author)->toBe('Jane Smith');
    expect($book->personal_summary)->toBe('A comprehensive book with all details.');
    expect($book->url)->toBe('https://amazon.com/complete-book');
    expect($book->image)->not->toBeNull();
    expect($book->started_on->format('Y-m-d'))->toBe('2024-01-01');
    expect($book->finished_on->format('Y-m-d'))->toBe('2024-02-01');

    Storage::disk('public')->assertExists($book->image);
});

it('stores image in correct directory', function () {
    $user = User::factory()->create();
    $image = UploadedFile::fake()->image('cover.jpg');

    Livewire::actingAs($user)
        ->test(Create::class)
        ->set('title', 'Test Book')
        ->set('author', 'Test Author')
        ->set('personal_summary', 'Test summary')
        ->set('url', 'https://amazon.com/test')
        ->set('image', $image)
        ->call('save');

    $book = Book::where('title', 'Test Book')->first();

    expect($book->image)->toStartWith('books/');
    Storage::disk('public')->assertExists($book->image);
});

it('clears books cache after creation', function () {
    $user = User::factory()->create();

    Cache::shouldReceive('forget')
        ->once()
        ->with('books');

    Livewire::actingAs($user)
        ->test(Create::class)
        ->set('title', 'Cache Test Book')
        ->set('author', 'Cache Author')
        ->set('personal_summary', 'Testing cache clearing')
        ->set('url', 'https://amazon.com/cache-test')
        ->call('save');
});

it('sets success flash message after creation', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Create::class)
        ->set('title', 'Flash Test')
        ->set('author', 'Flash Author')
        ->set('personal_summary', 'Testing flash message')
        ->set('url', 'https://amazon.com/flash-test')
        ->call('save')
        ->assertSessionHas('success', 'Book added successfully!');
});

it('prevents unauthenticated users from creating books via direct component access', function () {
    $this->get(route('books.create'))
        ->assertRedirect(route('login'));

    expect(Book::count())->toBe(0);
});
