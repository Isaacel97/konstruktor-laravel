<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\SendMail;
use App\Models\RelAcabadosCondiciones;
use App\Models\Acabados;
use App\Models\User;

class SendEmailController extends Controller
{
    public function sendMail(Request $request)
    {
        $data = $request->all();
        $dataUser = User::findOrFail($data['id_user']);
        try {
            $acabadosId = RelAcabadosCondiciones::where('condicion_id', $data['condicionId'])->first();
            $acabado = Acabados::select('acabado')->where('id', $acabadosId->acabado_id)->first();
    
            $bodyKontruktor = 'Precio cotizado $' . $data['costo'] . ' pesos. La cual consta de ' . $data['area'] . ' m2 de construcción. Con ' . $data['recamaras'] . ' recámaras, ' . $data['banos'] . ' baños, ' . $data['cocheras'] . ' cocheras, con un acabado '. $acabado . ', en un terreno con area de '.$data['metros']. 'm2 COS ' .$data['COS']. ' CUS ' .$data['CUS']. ' de ' .$data['niveles']. ' niveles. Datos de contacto: ';
    
            $testMailData = [
                'title' => '¡' .$dataUser->name. ', ya tenemos tu cotización!',
                'body' => 'La contrucción de tu casa, tendría un costo de $' . $data['costo'] . ' pesos. La cual consta de ' . $data['area'] . ' m2 de construcción. Con ' . $data['recamaras'] . ' recámaras, ' . $data['banos'] . ' baños, ' . $data['cocheras'] . ' cocheras, de'. $data['niveles'] . ' nivele(s), con acabados' . $acabado. '. Para más información, favor de contactanos al 442 449 9749.'
            ];
    
            if(isset($dataUser->email)) {
                $bodyKontruktor .= 'Email: ' . $dataUser->email . '. ';
                Mail::to($dataUser->email)->send(new SendMail($testMailData));
            } 
            if(isset($dataUser->telefono)) {
                $bodyKontruktor .= 'Teléfono: ' . $dataUser->telefono. ', ';
            }
    
            $mailKonstruktor = [
                'title' => '¡Nueva cotización a nombre de ' .$dataUser->name. $dataUser->apellido.'!',
                'body' => $bodyKontruktor
            ];
    
            Mail::to('isacel97@gmail.com')->send(new SendMail($mailKonstruktor));
            return response()->json([
                'message' => 'Mail enviado correctamente'
            ], 200);
        } catch (\Throwable $th) {
            //error #4
            return response()->json([
                'message' => 'Error al enviar el mail',
                'error' => $th->getMessage(),
                'data' => $data,
            ], 404);
        }  
    }
}
