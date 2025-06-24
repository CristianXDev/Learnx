<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class registerController extends Controller{


    public function register(Request $request){

        // 1. Validar los datos del formulario
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:20',
            'lastName' => 'required|max:20',
            'cedula' => 'required|min:7|max:8',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        // 2. Si la validación falla, redirigir con los errores
        if ($validator->fails()) {
             return redirect()->back()->withErrors($validator)->withInput(); // Devuelve todos los valores anteriores
        }

        // 3. Crear un nuevo usuario
        $user = new User();
        $user->name = $request->input('name');
        $user->lastName = $request->input('lastName');
        $user->cedula = str_replace(".", "", $request->input('cedula'));
        $user->email = $request->input('email');

        // 3.1 Cifrar la contraseña usando bcrypt
        $user->password = bcrypt($request->input('password')); 

        //4. Verificar el rol del usuario
        if(!isset($request['master'])){

            $user->rol = 2; //Rol del estudiante = 2
            $user->estatus = 'activo';

        } else{

            $user->rol = 3; //Rol de maestro = 3
            $user->estatus = 'pendiente';
        }

        // 5. Guardar el usuario en la base de datos
        $user->save();

        // 6. Redirigir a una vista de éxito o realizar otra acción
        return redirect()->route('login')->with('success', 'Usuario creado correctamente.');
    }



}
