<?php

namespace App\Http\Controllers;

//modals
use App\Models\Areas;
use App\Models\Condiciones;
use App\Models\Cotizacion;
use App\Models\User;
use App\Models\Acabados;
//request
use Illuminate\Http\Request;
//facade
use Illuminate\Support\Facades\DB;

class CotizacionesController extends Controller
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

    public function show()
    {
        $cotizaciones = Cotizacion::with('status', 'condicion', 'acabado', 'user')->get();
        try {
            return response()->json($cotizaciones, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error al obtener cotizaciones',
                'error' => $th->getMessage()
            ], 500);
        }
        
    }

    public function selectCotizacion($cotizacionId)
    {
        return response()->json(Cotizacion::find($cotizacionId), 200);
    }

    public function setStatus(Request $request)
    {
        $data = $request->all();
        $cotizacion = Cotizacion::findOrFail($data['id']);
        $cotizacion->status_id = $data['status_id'];
        $cotizacion->save();
        try {
            return response()->json([
                'message' => 'Status de cliente actualizado correctamente',
                'estado' => true,
                'res' => $cotizacion
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error al actualizar status de cliente',
                'estado' => false,
                'res' => $th->getMessage()
            ], 500);
        }
    }

    public function createCotizacion(Request $request) {
        //declaramos la data que recibimos
        $data = $request->all();

        //validamos que el usuario exista
        try {
            $dataUser = User::findOrFail($data['id_user']);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error al obtener datos del usuario',
                'error' => $th->getMessage()
            ], 404);
        }
        
        try {
            //validamos que el usuario sea un cliente
            if ($dataUser->role_id == 2) {
                //definimos datos de la cotizacion
                $cotizacion = new Cotizacion();
                $cotizacion->id_user = $data['id_user'];
                $cotizacion->fecha_cotizacion = DB::raw('now()');
                $cotizacion->m2 = $data['metros'];
                $cotizacion->recamaras = $data['recamaras'];
                $cotizacion->baños = $data['banos'];
                $cotizacion->cocheras = $data['cocheras'];
                $cotizacion->cuartos_servicio = 0;
                $cotizacion->cuarto_lavado = 0;
                $cotizacion->estudio = 0;
                $cotizacion->sala_tv = 0;
                $cotizacion->portico = 0;
                $cotizacion->otro = 'NA';
                //si es casa residencial se agrega el vestidor
                if ($data['condicionId'] == 2) {
                    $cotizacion->vestidor = 1;
                } else {
                    $cotizacion->vestidor = 0;
                }
                // $cotizacion->cuartos_servicio = $data['cuartos_servicio'];
                // $cotizacion->cuartos_lavado = $data['cuartos_lavado'];
                // $cotizacion->estudio = $data['estudio'];
                // $cotizacion->sala_tv = $data['sala_tv'];
                // $cotizacion->portico = $data['portico'];
                // $cotizacion->otro = $data['otro'];
                //quita la coma del precio para insertarlo en la base de datos
                $cotizacion->total = str_replace(',', '', $data['costo']);
                $cotizacion->status_id = 1;
                $cotizacion->id_condicion = $data['condicionId'];
                //en bace al precio del acabado se define el id del acabado
                $acabado = Acabados::select('id')->where('precio', $data['acabado'])->first();
                $cotizacion->id_acabados = $acabado->id;
                $cotizacion->save();
    
                try {
                    //si todo sale bien
                    return response()->json([
                        'message' => 'Cotización creada correctamente',
                        'estado' => true,
                        //yo se que es inseguro mandar datos del usuario como respuesta
                        //pero es para fines de aprobar la materia
                        //juro que no lo haré en un proyecto real
                        //lo peor es que copilot autocompleto el comentario
                        'nombre' => $dataUser->name,
                        'res' => $cotizacion
                    ], 200);
                } catch (\Throwable $th) {
                    // conteo de intentos #13
                    return response()->json([
                        'message' => 'Error al crear cotización',
                        'estado' => false,
                        'res' => $th->getMessage()
                    ], 500);
                }
            } else {
                //si eres admin ni de chiste puedes hacer cotización
                return response()->json([
                    'message' => 'No tienes permisos para crear cotizaciones',
                    'estado' => false,
                    'res' => $dataUser
                ], 404);
            }
        } catch (\Throwable $th) {
            //capturamos cualquier excepción que pueda ocurrir
            return response()->json([
                'message' => 'Error al crear cotización',
                'estado' => false,
                'res' => $th->getMessage()
            ], 500);
        }
    }
}
