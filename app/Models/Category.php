<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $tables = 'categories';

    public $dates = [
        'created_at',
        'updated_at',
    ];

    public $fillable = [
        'uuid',
        'title',
        'created_at',
        'updated_at',
    ];
}
