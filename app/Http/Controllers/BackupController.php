<?php

namespace App\Http\Controllers;

//Componentes
use Illuminate\Http\Request;

//Clase principal
class BackupController extends Controller{

    //Crear Backup
    public function createBackup(){

        //Ruta del script que ejecuta el respaldo
        $backupScript = public_path('static/assets/backup/backup.bat');

        //Ejecuta el script del respaldo
        $result = exec($backupScript, $output, $return_var);

        //Validar el resultado
        if($return_var === 0){

            //Operación satisfactoria
            return redirect()->back()->with('success', 'Respaldo realizado correctamente!');

        } else {

            //Algo salió mal al ejecutar el script
            return redirect()->back()->withErrors('Hubo un error al realizar el respaldo.');
        }
    }

    //Cargar Backup
    public function updateBackup(){

        //Ruta del script que ejecuta el respaldo
        $backupScript = public_path('static/assets/backup/updateBackup.bat');

        //Ejecuta el script del respaldo
        $result = exec($backupScript, $output, $return_var);

        //Validar el resultado
        if($return_var === 0){

            //Operación satisfactoria
            return redirect()->back()->with('success', 'Base de datos restaurado correctamente!');

        } else {

            //Algo salió mal al ejecutar el script
            return redirect()->back()->withErrors('Hubo un error al cargar la información en la base de datos.');
        }
    }
}
