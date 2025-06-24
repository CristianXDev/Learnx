<?php

namespace App\Http\Livewire;

//Componentes Livewire
use Livewire\Component;

//Modelos
use App\Models\CursoPresencial;
use App\Models\Categoria;

//Clase principal
class CursosPresencialesPublic extends Component{

    //Variables
    public $search = '', $cursos, $cursosPresenciales;

    //Render
    public function render(){

        // Buscar y filtrar la información
       $this->cursosPresenciales = CursoPresencial::query()
        ->when($this->search, function ($query) {
            $query->where(function ($query) {
                $query->where('nombre', 'like', '%' . $this->search . '%')
                ->orWhere('descripcion', 'like', '%' . $this->search . '%');
            })
            ->orWhereHas('categoria', function ($query) {
                $query->where('nombre', 'like', '%' . $this->search . '%');
            });
        })
        ->get();

        //Retornamos la vista
        return view('livewire.cursos-presenciales-public.view');
    }

    public function mount(){

        $this->categorias = Categoria::all();
    }
}
