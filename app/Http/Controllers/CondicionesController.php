<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Condiciones;

class CondicionesController extends Controller
{
    public function selectCondicion($condicionId)
    {
        return response(Condiciones::find($condicionId), 200);
    }

    public function show()
    {
        return response()->json(Condiciones::all(), 200);
    }
}
