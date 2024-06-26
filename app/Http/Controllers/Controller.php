<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Services\LogService;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected $logService;

    public function __construct()
    {
        $this->logService = new LogService();
    }
}
