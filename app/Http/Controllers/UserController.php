<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = $request->all();

        $validated = $request->validate([
            'name' => 'required',
            'apellido' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'role_id' => 'required|numeric',
            'telefono' => 'required|numeric|digits:10',
        ]);
        
        try {
            $user = new User();
            $user->name = $data['name'];
            $user->apellidos = $data['apellido'];
            $user->email = $data['email'];
            $user->password = md5($data['password']);
            $user->role_id = $data['role_id'];
            $user->telefono = $data['telefono'];
            $user->save();

            return response()->json([
                'message' => 'Usuario creado correctamente',
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error al crear el usuario',
                'error' => $th->getMessage()
            ], 500);
        }

        // if ($user->save()) {
        //     return response()->json([
        //         'message' => 'Usuario creado correctamente',
        //     ], 201);
        // } else {
        //     return response()->json([
        //         'message' => 'Error al crear el usuario',
        //     ], 500);
        // }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
