<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableSet extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status'
    ];

    public function categories()
    {
        return $this->hasMany(Category::class, TableSetCategory::class);
    }

    public function tableSetCategories()
    {
        return $this->hasMany(TableSetCategory::class);
    }


    public function tableFields()
    {
        return $this->hasMany(TableField::class);
    }
}
