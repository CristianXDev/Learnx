<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\InscripcionesCurso;

class CursoOnlineMiembros extends Component{

    use WithPagination;

    public $miembros;

    public function render(){

        return view('livewire.curso-online-miembros.view',[
            'miembros'=> $this->miembros,
        ]);
    }

    public function mount($id){

        $this->miembros = InscripcionesCurso::where('curso_id',$id)->get();
    }

    public function destroy($id){

        if ($id) {
            InscripcionesCurso::where('estudiante_id', $id)->delete();
        }
    }
}
