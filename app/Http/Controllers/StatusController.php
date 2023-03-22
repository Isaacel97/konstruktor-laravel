<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function show()
    {
        return response()->json(Status::all(), 200);
    }
}
