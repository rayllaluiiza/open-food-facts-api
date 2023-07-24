<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\APIStatus;

class APIStatusController extends Controller
{
    /**
     * @OA\Get(
     *      tags={"/status"},
     *      summary="Display a listing of the resource",
     *      description="Get all status on database",
     *      path="/status",
     *      security={{"bearerAuth": {}}},
     *      @OA\Response(
     *          response="200", description="List of status"
     *      )
     * )
     */
    public function index()
    {
        $apiStatus = APIStatus::all();

        return $apiStatus;
    }
}
