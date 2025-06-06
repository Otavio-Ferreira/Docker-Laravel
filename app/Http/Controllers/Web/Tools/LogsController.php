<?php

namespace App\Http\Controllers\Web\Tools;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class LogsController extends Controller
{
    private $data = [];

    public function index(){
        $this->data['logs'] = Activity::latest()->orderBy('created_at', 'desc')->get();

        return view('pages.logs.index', $this->data);
    }

    public function getUserLogs(){
        $user = Auth::user();

        $this->data['logs'] = Activity::where('causer_type', get_class($user))
                        ->where('causer_id', $user->id)
                        ->latest()
                        ->get();

        return view('pages.logs.user', $this->data);

    }
}

