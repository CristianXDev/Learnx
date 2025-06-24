<?php

namespace App\Http\Livewire;

//Componentes Livewire
use Livewire\Component;
use Livewire\WithPagination;

//Componente de autenificación
use Illuminate\Support\Facades\Auth;

//Modelos
use App\Models\Categoria;
use App\Models\Auditoria;

//Clase principal
class Categorias extends Component{

    //Componente - Paginación
    use WithPagination;

    //Integración con Bootstrap
	protected $paginationTheme = 'bootstrap';

    //Variables
    public $selected_id, $keyWord, $nombre;

    //Render
    public function render(){

		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.categorias.view', [
            'categorias' => Categoria::latest()
						->orWhere('nombre', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    //Cerrar modal
    public function cancel(){

        $this->resetInput();
    }
	
    //Resetear Campos
    private function resetInput(){

		$this->nombre = null;
    }

    //Agregar datos
    public function store(){

        //Validar campos
        $this->validate([
		'nombre' => 'required',
        ]);

        //Crear Categoria
        Categoria::create([ 
			'nombre' => $this-> nombre
        ]);

        //Registro de auditoria
        Auditoria::create([ 
            'usuario_id' => Auth::user()->id,
            'descripcion' => 'El usuario ha agregado la categoria: ' . $this->nombre,
        ]);
        
        //Resetar inputs
        $this->resetInput();

        //Cerrar modal
		$this->dispatchBrowserEvent('closeModal');

        //Mensaje guardado en la sesión
		session()->flash('message', 'Creado correctamente');
    }

    //Inicializar variables
    public function edit($id){

        $record = Categoria::findOrFail($id);
        $this->selected_id = $id; 
		$this->nombre = $record-> nombre;
    }

    //Actualizar datos
    public function update(){

        //Validar campos
        $this->validate([
		'nombre' => 'required',
        ]);

        //Verificar el ID de la categoria
        if ($this->selected_id) {

            //Actualizar categoria
			$record = Categoria::find($this->selected_id);
            $record->update([ 
			'nombre' => $this-> nombre
            ]);

            //Registro de auditoria
            Auditoria::create([ 
                'usuario_id' => Auth::user()->id,
                'descripcion' => 'El usuario ha actualizado la categoria: ' . $this->nombre,
            ]);

            //Resetar inputs
            $this->resetInput();

            //Cerrar modal
            $this->dispatchBrowserEvent('closeModal');

             //Mensaje guardado en la sesión
            session()->flash('message', 'Actualizado correctamente');
        }
    }

    //Eliminar materia
    public function destroy($id){

        //Verificar si existe el ID
        if ($id){

             //Registro de auditoria
            Auditoria::create([ 
                'usuario_id' => Auth::user()->id,
                'descripcion' => 'El usuario eliminado una categoria ',
            ]);

            //Borrar categoria
            Categoria::where('id', $id)->delete();
        }
    }
}