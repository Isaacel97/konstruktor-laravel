<?php

namespace App\Http\Controllers;

use App\Models\Areas;
use Illuminate\Http\Request;

class ContizacionesController extends Controller
{
    public function calculoArea(Request $request)
    {
        $data = $request->all();
        $Recamara = Areas::select('m2')->where('condicion_id', $data['condicion_id'])->where('nombre', 'Recamara')->first();
        $Banos = Areas::select('m2')->where('condicion_id', $data['condicion_id'])->where('nombre', 'Baño')->first();
        $Cochera = Areas::select('m2')->where('condicion_id', $data['condicion_id'])->where('nombre', 'Cochera')->first();
        $Sala = Areas::select('m2')->where('condicion_id', $data['condicion_id'])->where('nombre', 'Sala')->first();
        $Comedor = Areas::select('m2')->where('condicion_id', $data['condicion_id'])->where('nombre', 'Comedor')->first();
        $Cocina = Areas::select('m2')->where('condicion_id', $data['condicion_id'])->where('nombre', 'Cocina')->first();
        $Desayunador = Areas::select('m2')->where('condicion_id', $data['condicion_id'])->where('nombre', 'Desayunador')->first();
        $Vestidor = Areas::select('m2')->where('condicion_id', $data['condicion_id'])->where('nombre', 'Vestidor')->first();

        if ($data['condicion_id'] > 0) {
            $areaRecamara = $data['recamaras'] * $Recamara->m2;
            $areaBanos = $data['banos'] * $Banos->m2;
            $areaCochera = $data['cocheras'] * $Cochera->m2;
            $areaSala = 1 * $Sala->m2;
            $areaComedor = 1 * $Comedor->m2;
            $areaCocina = 1 * $Cocina->m2;
        }

        $areaTotal = $areaRecamara + $areaBanos + $areaCochera + $areaSala + $areaComedor + $areaCocina;

        if ($data['condicion_id'] == 2) {
            $areaDesayunador = 1 * $Desayunador->m2;
            $areaVestidor = 1 * $Vestidor->m2;

            $areaTotal= $areaTotal + $areaDesayunador + $areaVestidor;
        }
        
        $valores = [];
        $valores['COS'] = $data['area'] * 0.7;
        $valores['CUS'] = $data['area'] * 2.1;
        
        if($areaTotal <= $valores['COS']) {
            $valores['primerNivel'] = true;
        } else {
            $valores['primerNivel'] = false;
        }

        if($areaTotal <= $valores['CUS']) {
            $valores['areaConstruccion'] = $areaTotal;
            $valores['res'] = true;
            return response($valores, 200);
        } else {
            $valores['res'] = false;
            return response($valores, 200);
        }
        return response($valores, 200);
    }
}
