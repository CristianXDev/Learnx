<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\InscripcionesCursoPresencial;

class CursoPresencialMiembros extends Component{

    use WithPagination;

    public $miembros;

    public function render(){

        return view('livewire.curso-presencial-miembros.view',[
            'miembros'=> $this->miembros,
        ]);
    }

    public function mount($id){

        $this->miembros = InscripcionesCursoPresencial::where('curso_id',$id)->get();
    }

    public function destroy($id){

        if ($id) {
            InscripcionesCursoPresencial::where('estudiante_id', $id)->delete();
        }
    }
}
