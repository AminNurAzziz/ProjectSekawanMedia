<?php

namespace App\Http\Controllers;

use App\Models\LogProcess;
use Illuminate\Support\Facades\Log;

class LogProcessController extends Controller
{
    public function index()
    {
        $logProcesses = LogProcess::orderBy('recorded_at', 'desc')->get();
        return view('log_process', compact('logProcesses'));
    }

    public function destroyAll()
    {
        LogProcess::truncate();
        Log::info('All logs deleted successfully');
        return redirect('/logs')->with('success', 'All logs deleted successfully');
    }
}
