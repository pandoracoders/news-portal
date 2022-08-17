<?php

namespace App\Models\Backend;

use App\Jobs\OrgSchema;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebSetting extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        "key",
        "value",
        "type",
    ];





}
