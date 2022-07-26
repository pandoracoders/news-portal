<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableSetCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'table_set_id',
    ];
}
