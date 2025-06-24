<?php

namespace App\Http\Livewire;

//Componentes Livewire
use Livewire\Component;

//Modelos
use App\Models\Curso;
use App\Models\Categoria;

//Clase principal
class CursosPublic extends Component{

    //Variables
    public $search, $cursos, $categorias;

    //Render
    public function render(){

        // Buscar y filtrar la información
       $this->cursos = Curso::query()
       ->when($this->search, function ($query) {
        $query->where(function ($query) {
            $query->where('nombre', 'like', '%' . $this->search . '%')
            ->orWhere('descripcion', 'like', '%' . $this->search . '%');
        })
        ->orWhereHas('categoria', function ($query) {
            $query->where('nombre', 'like', '%' . $this->search . '%');
        });
    })
       ->with(['calificacionCurso' => function ($query) {
          $query->select('curso_id', \DB::raw('AVG(calificacion) as promedio_calificacion'))
          ->groupBy('curso_id');
      }])
       ->get();

        // Retornamos la vista
        return view('livewire.cursos-public.view');
    }

    public function mount(){

        $this->categorias = Categoria::all();
    }
}
