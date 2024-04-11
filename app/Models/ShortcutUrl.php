<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortcutUrl extends Model
{
    use HasFactory;

    protected $fillable = ['original_url', 'slug', 'shorten_url'];
}
