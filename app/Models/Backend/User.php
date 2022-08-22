<?php

namespace App\Models\Backend;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'email', 'password', 'google2fa_secret', 'alias_name', 'slug', 'gender', 'avatar', 'status'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token', 'google2fa_secret'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function permission()
    {
        return $this->hasOne(Permission::class);
    }

    public function role()
    {
        return $this->belongsToMany(Role::class, Permission::class);
    }

    public function getRoleAttribute()
    {
        return $this->role()->first();
    }

    public function getPermissionsAttribute()
    {
        return $this->permission->permissions;
    }

    public function articles()
    {
        return $this->hasMany(Article::class, 'writer_id');
    }

    // scope

    public function scopeWriter($query)
    {
        return $query->whereHas('permission.role', function ($q) {
            $q->where('slug', 'writer');
        });
    }

    // stat

    public function getTodayStat($task_status)
    {
        return Article::where('writer_id', $this->id)
            ->where('task_status', $task_status)
            ->where('created_at', carbon())
            ->count() ?? 0;
    }

    public function getYesterdayStat($task_status)
    {
        return Article::where('writer_id', $this->id)
            ->where('task_status', $task_status)
            ->where('created_at', carbon()->subDay())
            ->count() ?? 0;
    }

    public function getThisWeekStat($task_status)
    {
        return Article::where('writer_id', $this->id)
            ->whereBetween('created_at', [weekendStart(), weekendEnd()])
            ->where('task_status', $task_status)
            ->count() ?? 0;
    }

    public function getLastWeekStat($task_status)
    {
        return Article::where('writer_id', $this->id)
            ->whereBetween('created_at', [weekendStart()->subWeek(), weekendEnd()->subWeek()])
            ->where('task_status', $task_status)
            ->count() ?? 0;
    }

    public function getThisMonthStat($task_status)
    {
        return Article::where('writer_id', $this->id)
            ->whereBetween('created_at', [carbon()->startOfMonth(), carbon()->endOfMonth()])
            ->where('task_status', $task_status)
            ->count() ?? 0;
    }

    public function getLastMonthStat($task_status)
    {
        return Article::where('writer_id', $this->id)
            ->whereBetween('created_at', [weekendStart()->subMonth(), weekendEnd()->subMonth()])
            ->where('task_status', $task_status)
            ->count() ?? 0;
    }
}
