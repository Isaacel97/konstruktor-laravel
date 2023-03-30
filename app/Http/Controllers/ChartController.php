<?php

namespace App\Http\Controllers;

use App\Models\Cotizacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ChartController extends Controller
{
    public function status(){
        //bring all status count from cotizaciones table
        try {
            $status = Cotizacion::select(DB::raw('count(*) as count,status.id, status.status'))->groupBy('status_id')->join('status', 'cotizaciones.status_id', '=', 'status.id')->get();
            return response()->json($status);
        } catch (\Throwable $th) {
            return response($th, 404);
        }
}

public function totalCotizaciones(){
    //traer todas las cotizaciones del ano actual
    $cotizaciones = Cotizacion::select(DB::raw('count(*) as count, MONTH(fecha_cotizacion) as month'))->whereYear('fecha_cotizacion', date('Y'))->groupBy('month')->get();
       return response()->json($cotizaciones);
}
}
