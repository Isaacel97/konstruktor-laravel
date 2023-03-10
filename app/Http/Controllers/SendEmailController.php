<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\SendMail;
use App\Models\RelAcabadosCondiciones;
use App\Models\Acabados;

class SendEmailController extends Controller
{
    public function sendMail(Request $request)
    {

        $data = $request->all();

        $acabadosId = RelAcabadosCondiciones::where('condicion_id', $data['condicionId'])->first();
        $acabado = Acabados::select('acabado')->where('id', $acabadosId->acabado_id)->first();

        $bodyKontruktor = 'Precio cotizado $' . $data['costo'] . ' pesos. La cual consta de ' . $data['area'] . ' m2 de construcción. Con ' . $data['recamaras'] . ' recámaras, ' . $data['banos'] . ' baños, ' . $data['cocheras'] . ' cocheras, con un acabado '. $acabado . ', en un terreno con area de '.$data['metros']. 'm2 COS ' .$data['COS']. ' CUS ' .$data['CUS']. ' de ' .$data['niveles']. ' niveles. Datos de contacto: ';

        $testMailData = [
            'title' => '¡' .$data['nombre']. ', ya tenemos tu cotización!',
            'body' => 'La contrucción de tu casa, tendría un costo de $' . $data['costo'] . ' pesos. La cual consta de ' . $data['area'] . ' m2 de construcción. Con ' . $data['recamaras'] . ' recámaras, ' . $data['banos'] . ' baños, ' . $data['cocheras'] . ' cocheras, de'. $data['niveles'] . ' nivele(s), con acabados' . $acabado. '. Para más información, favor de contactanos al 442 449 9749.'
        ];

        if(isset($data['email'])) {
            $bodyKontruktor .= 'Email: ' . $data['email'] . '. ';
            Mail::to($data['email'])->send(new SendMail($testMailData));
        } 
        if(isset($data['telefono'])) {
            $bodyKontruktor .= 'Teléfono: ' . $data['telefono'] . ', ';
        }

        $mailKonstruktor = [
            'title' => '¡Nueva cotización a nombre de ' .$data['nombre']. '!',
            'body' => $bodyKontruktor
        ];

        Mail::to('contacto@konstruktor.com.mx')->send(new SendMail($mailKonstruktor));
        Mail::to('henoch@konstruktor.com.mx')->send(new SendMail($mailKonstruktor));

        return back()->with('success', 'Thanks for contacting us!');
    }
}
