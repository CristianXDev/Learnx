<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\CursoPresencial;
use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;
use Gemini\Laravel\Facades\Gemini;

use Livewire\WithFileUploads;

class CursoPresencials extends Component
{
    use WithPagination;
	use WithFileUploads; // Usa el trait

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nombre, $descripcion, $image, $estatus, $calificacion, $profesor_id, $categoria_id,$fecha_ini, $estudiantes_max, $fecha_fin, $categorias;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.curso-presencials.view', [
            'cursoPresencials' => CursoPresencial::latest()
            ->where('profesor_id', Auth::user()->id) 
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
    }
	
    private function resetInput()
    {		
		$this->nombre = null;
		$this->descripcion = null;
		$this->image = null;
		$this->estatus = null;
		$this->calificacion = null;
		$this->profesor_id = null;
		$this->categoria_id = null;
		$this->fecha_ini = null;
		$this->estudiantes_max = null;
		$this->fecha_fin = null;
    }

    public function store()
    {
        $this->validate([
    	'nombre' => 'required|string|max:255', 
    	'descripcion' => 'required|string',
    	'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
		'fecha_ini' => 'required',
		'fecha_fin' => 'required',
		'estudiantes_max' => 'required',
		'categoria_id' => 'required',
        ]);

        CursoPresencial::create([ 
			'nombre' => $this-> nombre,
			'descripcion' => $this-> descripcion,
			'image' => $this->image->store('public/cursos/presenciales'),
			'estatus' => 'activo',
			'calificacion' => 0,
			'profesor_id' => Auth::user()->id,
			'categoria_id' => $this-> categoria_id,
			'fecha_ini' => $this-> fecha_ini,
			'fecha_fin' => $this-> fecha_fin,
			'estudiantes_max' => $this-> estudiantes_max
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Proceso realizado.');
    }

    public function edit($id)
    {
        $record = CursoPresencial::findOrFail($id);
        $this->selected_id = $id; 
		$this->nombre = $record-> nombre;
		$this->descripcion = $record-> descripcion;
		$this->image = $record-> image;
		$this->estatus = $record-> estatus;
		$this->categoria_id = $record-> categoria_id;
		$this->fecha_ini = $record-> fecha_ini;
		$this->estudiantes_max = $record-> estudiantes_max;
		$this->fecha_fin = $record-> fecha_fin;
    }

    public function update()
    {
        $this->validate([
		'nombre' => 'required',
		'descripcion' => 'required',
		'estatus' => 'required',
		'categoria_id' => 'required',
		'fecha_ini' => 'required',
		'estudiantes_max' => 'required',
		'fecha_fin' => 'required',
        ]);

        if ($this->selected_id) {
			$record = CursoPresencial::find($this->selected_id);
            $record->update([ 
			'nombre' => $this-> nombre,
			'descripcion' => $this-> descripcion,
			'image' => $this-> image,
			'estatus' => $this-> estatus,
			'categoria_id' => $this-> categoria_id,
			'fecha_ini' => $this-> fecha_ini,
			'estudiantes_max' => $this-> estudiantes_max,
			'fecha_fin' => $this-> fecha_fin
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Proceso realizado.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            CursoPresencial::where('id', $id)->delete();
        }
    }

    public function mount() {
 		$this->categorias = Categoria::all();
 	}

 	public function geminiNombre(){

 		$this->validate([
 			'nombre' => 'required|string|max:255', 
 		]);

		// 1. Conecta con Gemini (ya tienes la lógica aquí)
 		$result = Gemini::geminiPro()->generateContent(
 			'Mejora la redacción de este titulo de mi curso y hazlo un poco más llamativo: '. $this->nombre .
 			'Necestio que la redacción sea limpia y sin dialogos adicionales.
 			Solamente una respuesta.'
 		);

	   $result = $result->text();

    	// 2. Guardar el nuevo nombre
	   $this->nombre = str_replace("*", "", $result);


 	}

 	public function geminiDescripcion(){

 		$this->validate([
 			'descripcion' => 'required|string|max:255', 
 		]);

		// 1. Conecta con Gemini (ya tienes la lógica aquí)
 		$result = Gemini::geminiPro()->generateContent(
 			'Mejora la redacción de esta descripcion de mi curso y hazlo un poco más llamativo: '. $this->descripcion .
 			'Necestio que la redacción sea limpia y sin dialogos adicionales.
 			Solamente una respuesta.'
 		);

 		$result = $result->text();

	    // 2. Guardar el nuevo nombre
 		$this->descripcion = str_replace("*", "", $result);

 	}
}