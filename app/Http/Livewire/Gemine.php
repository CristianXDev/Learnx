<?php

namespace App\Http\Livewire;

//Componentes Livewire
use Livewire\Component;

//Componente de autenificación
use Illuminate\Support\Facades\Auth;

//Componente de Gemini
use Gemini\Laravel\Facades\Gemini;

//Modelos
use App\Models\GeminiChat;

//Clase principal
class Gemine extends Component{

  //Variables
  public $pregunta, $respuesta, $showChat = false;

  //Resetear Campos
  private function resetInput(){

    $this->pregunta = null;
    $this->respuesta = null;
  }

  //Procesar el mensaje
  public function procesarMensaje(){

    //Validar campos
    $this->validate([
      'pregunta' => 'required|string|min:5',
    ]);

    //Establcemos los datos de la consulta
    $result = Gemini::geminiPro()->generateContent($this->pregunta);

    //Guardar el nuevo nombre (formateando el texto)
    $this->respuesta = str_replace("*", "", $result->text());

    //
    GeminiChat::create([ 
      'usuario_id' => Auth::user()->id,
      'pregunta' => $this-> pregunta,
      'respuesta' => $this-> respuesta
    ]);

    //Resetar inputs
    $this->resetInput();
    #$this->emitSelf('refreshChat');
  }

  //Controlar si el chat está desplegado o no
  public function toggleChat(){


    $this->showChat = !$this->showChat;
  }

  //Inicializar el chat
  public function init(){

     $this->chat = GeminiChat::latest()
      ->where('usuario_id', Auth::user()->id)
      ->orderBy('created_at', 'desc')
      ->take(10)
      ->get();
  }

  //Render
  public function render(){

    //Llamar la a función de inicialización
    $this->init();

    //Retornar la vista
    return view('livewire.gemine.view');
  }

}