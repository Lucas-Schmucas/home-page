<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'started_on' => 'date',
            'finished_on' => 'date',
        ];
    }
}
