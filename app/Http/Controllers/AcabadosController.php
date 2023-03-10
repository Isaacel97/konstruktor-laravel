<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Acabados;
use App\Models\RelAcabadosCondiciones;

class AcabadosController extends Controller
{
    public function selectAcabado($acabadoId)
    {
        return response(Acabados::find($acabadoId), 200);
    }

    public function show()
    {
        return response(Acabados::all(), 200);
    }

    public function showByCondicion($condicionId)
    {
        $acabados = RelAcabadosCondiciones::where('condicion_id', $condicionId)->get();
        $acabadosId = [];
        foreach ($acabados as $acabado) {
            $acabadosId[] = $acabado->acadado_id;
        }
        return response(Acabados::whereIn('id', $acabadosId)->get(), 200);
    }
}
