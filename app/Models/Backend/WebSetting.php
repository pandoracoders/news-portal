<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        "key",
        "value",
        "type",
    ];


    // boot function
    protected static function boot()
    {
        parent::boot();
        static::created(function ($model) {
            clearSettingCache();
        });

        static::updated(function ($model) {
            clearSettingCache();
        });
    }
}
