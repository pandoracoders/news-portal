<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Article;
use App\Models\Backend\User;
use BaconQrCode\Writer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $writers = User::writer()->get();
        // return ($writers);
        return view('backend.pages.dashboard.index', [
            'tables' => [
                'writers' => $writers,
                'editors' => User::editor()->get(),
            ],
            'todays_posts' => Article::where('created_at', '=', Carbon::today())->count(),
            'yesterday_posts' => Article::where('created_at', '=', Carbon::yesterday())->count(),
            'total_posts' => Article::count(),
            'total_writers' => User::writer()->count(),
            'total_editors' => User::editor()->count(),
        ]);
    }
}
