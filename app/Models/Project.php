<?php

namespace App\Models;

use App\Technology;
use Illuminate\Database\Eloquent\Casts\AsEnumCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'technologies' => AsEnumCollection::of(Technology::class),
        ];
    }
}
