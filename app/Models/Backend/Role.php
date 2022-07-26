<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "permissions",
    ];

    protected $casts = [
        "permissions" => "json",
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, Permission::class);
    }
}
