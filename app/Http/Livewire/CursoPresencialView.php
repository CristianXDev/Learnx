<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ActividadesCursoPresencial;
use App\Models\CursoPresencial;
use App\Models\ChatCurso;
use App\Models\InscripcionesCursoPresencial;
use Illuminate\Support\Facades\Auth;

class CursoPresencialView extends Component{

   public $selected_id, $keyWord, $curso, $actividades, $inscrito, $curso_id, $mensaje, $usuario_id, $documento;

    public function render(){ 

        $chat = ChatCurso::where('curso_id', $this->curso_id)
            ->get(); // Obtiene los resultados de la consulta

        return view('livewire.curso-presencial-view.view', [
            'actividades' => $this->actividades,
            'cursos' => $this->CursoPresencial,
            'inscrito' => $this->inscrito,
            'chat'=>  $chat,
        ]);
    }

    public function cancel(){

        $this->resetInput();
    }
    
    private function resetInput(){

        $this->usuario_id = null;
        $this->mensaje = null;
        $this->documento = null;
    }

    public function store(){

        $this->validate([
        'mensaje' => 'required',
        ]);

        ChatCurso::create([ 
            'curso_id' => $this-> curso_id,
            'usuario_id' => Auth::user()->id,
            'mensaje' => $this-> mensaje,
            'documento' => $this-> documento,
        ]);
        
        $this->resetInput();
        $this->dispatchBrowserEvent('closeModal');
        session()->flash('message', 'ChatsClassroom Successfully created.');
    }

    public function edit($id)
    {
        $record = ChatCurso::findOrFail($id);
        $this->selected_id = $id; 
        $this->curso_id = $record-> curso_id;
        $this->usuario_id = $record-> usuario_id;
        $this->mensaje = $record-> mensaje;
        $this->documento = $record-> documento;
    }

    public function update()
    {
        $this->validate([
        'curso_id' => 'required',
        'usuario_id' => 'required',
        ]);

        if ($this->selected_id) {
            $record = ChatCurso::find($this->selected_id);
            $record->update([ 
            'curso_id' => $this-> curso_id,
            'usuario_id' => $this-> usuario_id,
            'mensaje' => $this-> mensaje,
            'documento' => $this-> documento
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
            session()->flash('message', 'ChatsClassroom Successfully updated.');
        }
    }

    public function destroy($id){

        if ($id) {
            ChatCurso::where('id', $id)->delete();
        }
    }

    public function mount($id){

        //ID del curso
        $this->curso_id = $id;

        //Actividades
        $this->actividades = ActividadesCursoPresencial::where('curso_presencial_id',$id)->get();

        //Curso
        $this->CursoPresencial = CursoPresencial::where('id',$id)->get();

        $this->inscrito =  Auth::user()->InscripcionesCursoPresencial()->where('curso_id', $id)->exists();
    }
}
