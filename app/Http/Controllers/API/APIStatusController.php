<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\APIStatus;

class APIStatusController extends Controller
{
    public function index()
    {
        $apiStatus = APIStatus::all();

        return $apiStatus;
    }
}
