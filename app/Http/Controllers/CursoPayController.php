<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Curso;
use App\Models\Factura;
use App\Models\InscripcionesCurso;

use Carbon\Carbon;

class CursoPayController extends Controller{


    public function confirm(Request $request){

        //Guardar id del usuario
        $id = $request['id'];

        // Find the user to update
        $curso = Curso::findOrFail($id); 

        return view('dashboard.curso-pay.confirm-pay',compact('curso'));

    }


    public function pay($id){

        $curso_id = $id;

        $curso = Curso::find($curso_id);

        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                config('services.paypal.client_id'), // ClientID
                config('services.paypal.client_secret'), // ClientSecret
            )
        );

        // After Step 2
        $payer = new \PayPal\Api\Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new \PayPal\Api\Amount();
        $amount->setTotal($curso->precio);
        $amount->setCurrency('USD');

        $transaction = new \PayPal\Api\Transaction();
        $transaction->setAmount($amount);

        $redirectUrls = new \PayPal\Api\RedirectUrls();

        $redirectUrls->setReturnUrl(route('curso-approved', ['id' => $curso->id]))
        ->setCancelUrl(route('confirm-pay',[$curso->id]));

        $payment = new \PayPal\Api\Payment();
        $payment->setIntent('sale')
        ->setPayer($payer)
        ->setTransactions(array($transaction))
        ->setRedirectUrls($redirectUrls);

        // After Step 3
        try{

            $payment->create($apiContext);

            return redirect()->away($payment->getApprovalLink());
        }

        catch (\PayPal\Exception\PayPalConnectionException $ex) {
        // This will print the detailed information on the exception.
        //REALLY HELPFUL FOR DEBUGGING
            echo $ex->getData();
        }

        return 'Ha ocurrido un problema con la conexión';

    }


    public function approved(Request $request){

        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                config('services.paypal.client_id'), // ClientID
                config('services.paypal.client_secret'),      // ClientSecret
            )
        );

        $paymentId = $_GET['paymentId'];
        $payment = \PayPal\Api\Payment::get($paymentId, $apiContext);

        $execution = new \PayPal\Api\PaymentExecution();
        $execution->setPayerId($_GET['PayerID']);

        $result = $payment->execute($execution, $apiContext);

        //Crear la factura
        $id_curso = $request->id; //ID CURSO
        $id_usuario = Auth()->user()->id; //ID USUARIO
        $codigo_ref = uniqid();
        $estatus = "pagado";
        $fecha_pago = Carbon::now();

        //Asignar datos a la factura
        $compra = new Factura();
        $compra->usuario_id = $id_usuario;
        $compra->curso_id = $id_curso;
        $compra->codigo_ref = $codigo_ref;
        $compra->estatus = $estatus;
        $compra->fecha_pago = $fecha_pago;

        //Guardar los datos en la factura
        $compra->save();

        //Guardar datos de la inscripción
        $inscripcion = new InscripcionesCurso();
        $inscripcion->estudiante_id = Auth()->user()->id; 
        $inscripcion->curso_id = $id_curso;

        //Guardar los datos en la base de datos
        $inscripcion->save();

        return redirect('/dashboard/facturas')->with('success','Curso comprado');
    }


}
