<?php

namespace App\Models\Backend;

use App\Models\Traits\SeoTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory , SeoTrait;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'status',
        'order'
    ];

}
