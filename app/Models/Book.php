<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'image',
        'personal_summary',
        'url',
        'started_on',
        'finished_on',
    ];

    protected function casts(): array
    {
        return [
            'started_on' => 'date',
            'finished_on' => 'date',
        ];
    }

    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->image ? Storage::disk('public')->url($this->image) : null
        );
    }
}
