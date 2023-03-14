<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function createUser(Request $request)
    {
        $data = $request->all();
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = md5($data['password']);
        $user->role_id = $data['role_id'];
        $user->telefono = $data['telefono'];
        $user->save();
        if ($user->save()) {
            return response($user, 200);
        } else {
            return response('Error al crear usuario', 500);
        }
        
    }
}
