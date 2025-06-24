<?php

namespace App\Http\Livewire;

//Componentes
use Livewire\Component;
use Livewire\WithPagination;

//Modelos
use App\Models\Auditoria;

//Clase principal
class Auditorias extends Component{

    //Componente - Paginación
    use WithPagination;

    //Integración con Bootstrap
	protected $paginationTheme = 'bootstrap';

    //Variables
    public $selected_id, $keyWord, $usuario_id, $descripcion, $created_at;

    //Render
    public function render(){

		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.auditorias.view', [
            'auditorias' => Auditoria::latest()
						->orWhere('usuario_id', 'LIKE', $keyWord)
						->orWhere('descripcion', 'LIKE', $keyWord)
						->orWhere('created_at', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
}