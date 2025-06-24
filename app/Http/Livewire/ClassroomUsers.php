<?php

namespace App\Http\Livewire;

//Componentes Livewire
use Livewire\Component;
use Livewire\WithPagination;

//Componente de autenificación
use Illuminate\Support\Facades\Auth;

//Modelos
use App\Models\ClassroomUser;
use App\Models\Auditoria;

//Clase principal
class ClassroomUsers extends Component{

    //Componente - Paginación
    use WithPagination;

    //Integración con Bootstrap
    protected $paginationTheme = 'bootstrap';

    //Variables
    public $selected_id, $keyWord, $usuario_id, $classroom_id;

    //Render
    public function render(){

        //Buscar e filtrar la información
        $classrooms = ClassroomUser::query()
        ->where('usuario_id', Auth::user()->id) 
        ->when($this->keyWord, function ($query, $keyWord) {
            $query->where(function ($query) use ($keyWord) {
                $query->orWhereHas('classroom', function ($query) use ($keyWord) {
                    $query->where('nombre', 'LIKE', '%' . $keyWord . '%');
                });
            });
        })->paginate(10);

        //Retornar la vista
        return view('livewire.classroom-users.view', [
            'classroomUsers' => $classrooms,
        ]);
    }

    //Desincribir al usuario del curso
    public function destroy($id){

        //Verificar si existe el ID
        if($id){

            //Auditoria
            Auditoria::create([ 
                'usuario_id' => Auth::user()->id,
                'descripcion' => 'El usuario se ha desinscrito de un aula',
            ]);

            //Eliminar suscripción del usuario
            ClassroomUser::where('id', $id)->delete();
        }
    }
}