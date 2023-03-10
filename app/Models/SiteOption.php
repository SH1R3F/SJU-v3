<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteOption extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'type', 'name', 'value', 'category'];
}
