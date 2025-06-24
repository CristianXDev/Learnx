<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class logoutController extends Controller{

    public function logout(Request $request){

        if(isset($request['logout'])){

            //Hacer que fluya el ciclo de sesiones
            Session::flush();

            //Cerrar sesion activa
            Auth::logout();

            //Redirigir al inicio
            return redirect()->route('auth-login');

        } else{ 
        
            //Redirigir al inicio
            return redirect()->route('dashboard');

         }
    }
}
