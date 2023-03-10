<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contacto;

class ContactosController extends Controller
{
    public function index()
    {
        return response(Contacto::all(),200);
    }

    public function show($contactoId)
    {
        return response(Contacto::find($contactoId), 200);
    }

    public function store(Request $request)
    {
        $resp = Contacto::create($request->all());
        return $resp;
    }

    public function update(Request $request, $contactoId)
    {
        $product = Product::findOrFail($contactoId);
        $product->update($request->all());
        return $product;
    }
}
