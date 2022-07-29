<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        "role_id",
        "user_id",
        "permissions",
    ];

    protected $casts = [
        'permissions' => 'json',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
