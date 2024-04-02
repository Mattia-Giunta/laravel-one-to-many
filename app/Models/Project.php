<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'slug',
        'cover_image'
    ];

    // protected $table = "projects";

    public static function generateSlug($title)
    {
        return Str::slug($title, '-');
    }
}