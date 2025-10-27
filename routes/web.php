<?php

use App\Livewire\About;
use App\Livewire\Books;
use App\Livewire\Home;
use App\Livewire\Projects;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/about', About::class)->name('about');
Route::get('/books', Books::class)->name('books');
Route::get('/mcp', Projects::class)->name('mcp');
Route::get('/projects', Projects::class)->name('projects');
