<?php

namespace App\Services;

use App\Models\LogProcess;

class LogService
{
    public function createLog($message, $action)
    {
        return LogProcess::create([
            'message' => $message,
            'action' => $action,
        ]);
    }
}
