<?php

namespace App\Http\Livewire;

//Componentes Livewire
use Livewire\Component;
use Livewire\WithPagination;

//Modelos
use App\Models\ModulosCurso;

//Clase principal
class ModulosCursos extends Component{

//Componente - Paginación
use WithPagination;

//Integración con Bootstrap
protected $paginationTheme = 'bootstrap';

//Variables
public $selected_id, $keyWord, $titulo, $curso_id;

//Render
public function render(){

    //Buscar e filtrar la información
    $modulosCursos = ModulosCurso::query()
    ->where('curso_id', $this->curso_id) 
    ->when($this->keyWord, function ($query, $keyWord) {
        $query->where(function ($query) use ($keyWord) {
            $query->where('titulo', 'LIKE', $keyWord)
            ->orWhereHas('curso', function ($query) use ($keyWord) {
                $query->where('nombre', 'LIKE', '%' . $keyWord . '%');
            });
        });
    })->paginate(10);

    //Retornar vista
    return view('livewire.modulos-cursos.view', [
        'modulosCursos' => $modulosCursos]);
}

//Cerrar modal
public function cancel(){

    $this->resetInput();
}
 
//Resetear Campos   
private function resetInput(){	

    $this->titulo = null;
}

//Agregar datos
public function store(){

    //Validar campos
    $this->validate([
        'titulo' => 'required',
        'curso_id' => 'required',
    ]);

    //Crear un modulo
    ModulosCurso::create([ 
        'titulo' => $this-> titulo,
        'curso_id' => $this-> curso_id
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

    $record = ModulosCurso::findOrFail($id);
    $this->selected_id = $id; 
    $this->titulo = $record-> titulo;
    $this->curso_id = $record-> curso_id;
}

//Actualizar datos
public function update(){

    //Validar campos
    $this->validate([
        'titulo' => 'required',
        'curso_id' => 'required',
    ]);

    //Verificar el ID del aula online
    if($this->selected_id){

        //Actualizar el modulo
        $record = ModulosCurso::find($this->selected_id);
        $record->update([ 
            'titulo' => $this-> titulo,
            'curso_id' => $this-> curso_id
        ]);

        //Resetar inputs
        $this->resetInput();

        //Cerrar modal
        $this->dispatchBrowserEvent('closeModal');

        //Mensaje guardado en la sesión
        session()->flash('message', 'Actualizado correctamente');
    }
}

//Eliminar modulo
public function destroy($id){

    //Verificar si existe el ID
    if($id){

        //Borrar modulo
        ModulosCurso::where('id', $id)->delete();
    }
}

//Buscamos datos adicionales
public function mount($id){

    //Guardar el id del curso
    $this->curso_id = $id;
    }
}