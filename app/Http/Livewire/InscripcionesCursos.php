<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\InscripcionesCurso;
use App\Models\VideosCompletado;
use App\Models\VideosCurso;
use App\Models\ModulosCurso;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class InscripcionesCursos extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $estudiante_id, $curso_id, $videos_terminados;

    public function render()
    {
        $keyWord = '%'.$this->keyWord .'%';
        $inscripcionesCursos = InscripcionesCurso::latest()
        ->where('estudiante_id', Auth::user()->id) 
        ->paginate(10);

        //Agregar un conteo de videos completados
        foreach ($inscripcionesCursos as $row){

            //Videos totales del curso
            $row->videos_total_count = DB::table('modulos_cursos')
            ->join('videos_cursos', 'modulos_cursos.id', '=', 'videos_cursos.modulo_id') // Une las tablas
            ->where('modulos_cursos.curso_id', $row->curso_id) // Filtra por curso
            ->count();

            // Obtener los IDs de videos del curso
            $videoIds = DB::table('modulos_cursos')
            ->join('videos_cursos', 'modulos_cursos.id', '=', 'videos_cursos.modulo_id')
            ->where('modulos_cursos.curso_id', $row->curso_id)
            ->pluck('videos_cursos.id'); // Obtener solo los IDs de videos

            // Obtener los IDs de videos completados
            $completedVideoIds = DB::table('videos_completados')
            ->pluck('videos_id');

            // Calcular la intersección y contar los elementos
            $videosVistos = $videoIds->intersect($completedVideoIds)->count();
        }

        return view('livewire.inscripciones-cursos.view', [
            'inscripcionesCursos' => $inscripcionesCursos,
            'videosVistos' => $videosVistos,
        ]);
    }

    public function cancel()
    {
        $this->resetInput();
    }

    private function resetInput()
    {       
      $this->estudiante_id = null;
      $this->curso_id = null;
  }

  public function store()
  {
    $this->validate([
      'estudiante_id' => 'required',
      'curso_id' => 'required',
  ]);

    InscripcionesCurso::create([ 
     'estudiante_id' => $this-> estudiante_id,
     'curso_id' => $this-> curso_id
 ]);

    $this->resetInput();
    $this->dispatchBrowserEvent('closeModal');
    session()->flash('message', 'InscripcionesCurso Successfully created.');
}

public function edit($id)
{
    $record = InscripcionesCurso::findOrFail($id);
    $this->selected_id = $id; 
    $this->estudiante_id = $record-> estudiante_id;
    $this->curso_id = $record-> curso_id;
}

public function update()
{
    $this->validate([
      'estudiante_id' => 'required',
      'curso_id' => 'required',
  ]);

    if ($this->selected_id) {
     $record = InscripcionesCurso::find($this->selected_id);
     $record->update([ 
         'estudiante_id' => $this-> estudiante_id,
         'curso_id' => $this-> curso_id
     ]);

     $this->resetInput();
     $this->dispatchBrowserEvent('closeModal');
     session()->flash('message', 'InscripcionesCurso Successfully updated.');
 }
}

public function destroy($id)
{
    if ($id) {
        InscripcionesCurso::where('id', $id)->delete();
    }
}

}