<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class loginController extends Controller{

    public function login(Request $request){

    // 1. Validar los datos del formulario
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

    // 2. Si la validación falla, redirigir con los errores
        if ($validator->fails()) {

        return redirect()->back()->withErrors($validator)->withInput(); // Devuelve todos los valores anteriores
    }

    // Busca al usuario por correo electrónico
    $user = User::where('email', $request->email)->first();

    if ($user){

        //Validar si el correo electronico esta verificado
        if($user['estatus_email']=='2'){


            if($user['estatus'] == 'inactivo'){

                // Mostrar un mensaje de error si las credenciales son incorrectas
                return back()->withErrors(['email' => 'Su cuenta se encuentra suspendida.']);


            } else {


                if($user['estatus'] == 'pendiente'){

                    // Mostrar un mensaje de error si las credenciales son incorrectas
                    return back()->withErrors(['email' => 'Su cuenta no ha sido verificada aún. Intente más tarde.']);

                } else{

                    // Verifica si el usuario existe y si la contraseña es correcta
                    if ($user && Hash::check($request->password, $user->password)){

                         // Iniciar sesión al usuario
                        Auth::login($user);

                        // Redireccionar al usuario a la página de inicio o a la ruta deseada
                        return redirect()->route('dashboard');

                    } else {

                        // Mostrar un mensaje de error si las credenciales son incorrectas
                        return back()->withErrors(['email' => 'Credenciales inválidas.']);
                    }

                }

            }


        } else{

            // Mostrar un mensaje de error si las credenciales son incorrectas
            return back()->withErrors(['email' => 'Su correo electronico no ha sido verificado.']);

        }

    } else {

        return back()->withErrors(['email' => 'Su usuario no esta registrado']);
        }
    }
}