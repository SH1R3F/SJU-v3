<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'image', 'link', 'target', 'status', 'group'];

    protected $casts = [
        'status' => 'boolean',
        'group' => 'integer',
    ];
}
