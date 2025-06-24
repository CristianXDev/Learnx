<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\VideosCompletado; // Asegúrate de importar tu modelo

class CursoExtraFunction extends Component{

 public $completado = false;
 public $videoId ;
 public $name = 'cursoExtraFunction';


 public function updateVideoId($videoId){

    dd($videoId);

  $this->videoId = $videoId;
}

public function mount($videoId){

    $this->videoId = $videoId;
    $this->completado = VideosCompletado::where('estudiante_id', auth()->id())
    ->where('videos_id', $videoId)
    ->exists();
}

public function toggleCompleto($videoId, $completado)
{
    if ($completado) {
            // Guardar registro si el switch se activa
        VideosCompletado::create([
            'estudiante_id' => auth()->id(),
            'videos_id' => $videoId,
        ]);

    } else {
            // Borrar el registro si el switch se desactiva
        VideosCompletado::where('estudiante_id', auth()->id())
        ->where('videos_id', $videoId)
        ->delete();
    }

    session()->flash('message', 'Tu progreso ha sido actualizado.');
}

public function render()
{
    return view('livewire.curso-extra-function.view');
}
}
