<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\User;
use BaconQrCode\Writer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $writers = User::writer()->get();
        // return ($writers);
        return view('backend.pages.dashboard.index', [
            'writers' => $writers,
        ]);
    }
}
