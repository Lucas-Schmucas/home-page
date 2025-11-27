<?php

use App\Livewire\Auth\Login;
use App\Livewire\Books;
use App\Livewire\Home;
use App\Livewire\Projects;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/books', Books::class)->name('books');
Route::get('/mcp', Projects::class)->name('mcp');
Route::get('/projects', Projects::class)->name('projects');
Route::get('/login', Login::class)->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/books/create', \App\Livewire\Books\Create::class)->name('books.create');
    Route::get('/books/{book}/edit', \App\Livewire\Books\Edit::class)->name('books.edit');
    Route::get('/projects/create', \App\Livewire\Projects\Create::class)->name('projects.create');
});
