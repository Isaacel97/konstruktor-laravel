<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactosController;
use App\Http\Controllers\AcabadosController;
use App\Http\Controllers\CondicionesController;
use App\Http\Controllers\CotizacionesController;
use App\Http\Controllers\SendEmailController;
use App\Http\Controllers\UserController;
use App\HttP\Controllers\StatusController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//rutas data contactos
Route::post('contacto', function(Request $request) {
    $resp = Contacto::create($request->all());
    return $resp;
});

Route::get('admin/contactos/{contacto}', [ContactosController::class, 'show']);

Route::get('admin/contactos/{contacto}', function ($contactoId) {
    return response(Contacto::find($contactoId), 200);
});

Route::put('admin/contactos/{contacto}', function(Request $request, $contactoId) {
    $product = Product::findOrFail($contactoId);
    $product->update($request->all());
    return $product;
});

//rutas data acabados
Route::get('cotizacion/acabados/', [AcabadosController::class, 'show']);
Route::get('cotizacion/acabados/{acabado}', [AcabadosController::class, 'selectAcabado']);
Route::get('cotizacion/acabados/condicion/{condicion}', [AcabadosController::class, 'showByCondicion']);

//rutas data condiciones
Route::get('cotizacion/condicion/', [CondicionesController::class, 'show']);
Route::get('cotizacion/condicion/{condicion}', [CondicionesController::class, 'selectCondicion']);

//rutas data cotizaciones
Route::post('cotizacion/calculoArea/', function(Request $request) {
    $controller = new CotizacionesController;
    $resp = $controller->calculoArea($request);
    return $resp;
});

Route::post('cotizacion/enviaCotizacion/', function(Request $request){
    $controller = new SendEmailController;
    $resp = $controller->sendMail($request);
    return $resp;
});

Route::get('cotizacion/listaCotizaciones/', [CotizacionesController::class, 'show']);

//rutas data status
Route::get('cotizacion/status/', [StatusController::class, 'show']);

Route::post('cotizacion/setStatus/', function(Request $request) {
    $controller = new CotizacionesController;
    $resp = $controller->setStatus($request);
    return $resp;
});
//rutas usuarios clientes
Route::post('user/create/', function(Request $request) {
    $controller = new UserController;
    $resp = $controller->create($request);
    return $resp;
});
