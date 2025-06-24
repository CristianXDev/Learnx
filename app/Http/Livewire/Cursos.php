<?php

namespace App\Http\Livewire;

//Componentes Livewire
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

//Modelos
use App\Models\Curso;
use App\Models\Materia;
use App\Models\Submateria;
use App\Models\Categoria;
use App\Models\Auditoria;

//Componente de autenificación
use Illuminate\Support\Facades\Auth;

//Componente de Gemini
use Gemini\Laravel\Facades\Gemini;

//Clase principal
class Cursos extends Component{

    //Componente - Paginación
    use WithPagination;

    //Componente - Carga / Subida de videos u archivos
    use WithFileUploads;

    //Integración con Bootstrap
    protected $paginationTheme = 'bootstrap';

    //Variables
    public $selected_id, $keyWord, $nombre, $descripcion, $image, $estatus, $calificacion, $profesor_id, $categoria_id, $tipo, $categorias, $precio = 0;

    //Render
    public function render(){

    //Buscar e filtrar la información
       $cursos = Curso::query()
       ->where('profesor_id', Auth::user()->id)
       ->when($this->keyWord, function ($query, $keyWord) {
        $query->where(function ($query) use ($keyWord) {
            $query->where('nombre', 'LIKE', '%' . $keyWord . '%')
            ->orWhere('estatus', 'LIKE', '%' . $keyWord . '%')
            ->orWhere('tipo', 'LIKE', '%' . $keyWord . '%')
            ->orWhereHas('categoria', function ($query) use ($keyWord) {
                $query->where('nombre', 'LIKE', '%' . $keyWord . '%');
            });
        });
    })
       ->with(['calificacionCurso' => function ($query) {
          $query->select('curso_id', \DB::raw('AVG(calificacion) as promedio_calificacion'))
          ->groupBy('curso_id');
      }])
       ->paginate(10);

        //Retornamos la vista
        return view('livewire.cursos.view', [
            'cursos' => $cursos,
        ]);
    }

    //Cerrar modal
    public function cancel(){

        $this->resetInput();
    }

    //Resetear Campos
    private function resetInput(){		
        $this->nombre = null;
        $this->descripcion = null;
        $this->image = null;
        $this->tipo = null;
        $this->precio = null;
        $this->estatus = null;
        $this->calificacion = null;
        $this->profesor_id = null;
        $this->categoria_id = null;
    }

    //Agregar datos
    public function store(){

        //Validar campos
        $this->validate([
            'nombre' => 'required|string|max:255', 
            'descripcion' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'tipo' => 'required|in:gratis,premium', 
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        //Crear un curso
        Curso::create([ 
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'image' => $this->image->store('public/cursos'),
            'tipo' => $this->tipo,
            'precio' => $this->precio,
            'estatus' => 'activo',
            'calificacion' => 0,
            'profesor_id' => auth()->user()->id,
            'categoria_id' => $this->categoria_id
        ]);

        //Auditoria
        Auditoria::create([ 
            'usuario_id' => Auth::user()->id,
            'descripcion' => 'El usuario ha agregado el curso: ' . $this->nombre,
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

        $record = Curso::findOrFail($id);
        $this->selected_id = $id; 
        $this->nombre = $record-> nombre;
        $this->descripcion = $record-> descripcion;
        $this->image = $record-> image;
        $this->tipo = $record-> tipo;
        $this->precio = $record-> precio;
        $this->estatus = $record-> estatus;
        $this->calificacion = $record-> calificacion;
        $this->categoria_id = $record-> categoria_id;
    }

    //Actualizar datos
    public function update(){

        //Validar campos
        $this->validate([
            'nombre' => 'required|string|max:255', 
            'descripcion' => 'required|string',
            'tipo' => 'required|in:gratis,premium',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        //Verificar el ID del aula online
        if($this->selected_id){

             //Actualizar el curso
            $record = Curso::find($this->selected_id);
            $record->update([ 
                'nombre' => $this-> nombre,
                'descripcion' => $this-> descripcion,
                'tipo' => $this-> tipo,
                'precio' => $this-> precio,
                'estatus' => $this-> estatus,
                'calificacion' => $this-> calificacion,
                'categoria_id' => $this-> categoria_id
            ]);

            //Auditoria
            Auditoria::create([ 
                'usuario_id' => Auth::user()->id,
                'descripcion' => 'El usuario ha actualizado el curso: ' . $this->nombre,
            ]);

            //Resetar inputs
            $this->resetInput();

             //Cerrar modal
            $this->dispatchBrowserEvent('closeModal');

            //Mensaje guardado en la sesión
            session()->flash('message', 'Actualizado correctamente');
        }
    }

    //Eliminar curso
    public function destroy($id){

        //Verificar si existe el ID
        if($id){

            //Auditoria
            Auditoria::create([ 
                'usuario_id' => Auth::user()->id,
                'descripcion' => 'El usuario ha eliminado un curso',
            ]);

            //Borrar el curso
            Curso::where('id', $id)->delete();
        }
    }

    //Buscamos datos adicionales
    public function mount(){

        //Traer el listado de materias
        $this->materias = Materia::all();

        //Traer el listado de temas
        $this->submaterias = Submateria::all();

        //Traer el listado de categorias
        $this->categorias = Categoria::all();
    }

    //Vericar el tipo de curso y establecer su valor
    public function updatedTipo($tipo){

        // Establece el precio a 0 si el curso es gratis
        if($tipo === 'gratis'){
            $this->precio = 0; 
        }
    }

//Función de gemini (Mejorar el nombre del curso)
public function geminiNombre(){

    //Validar campos
    $this->validate([
        'nombre' => 'required|string|max:255', 
    ]);

    //Establcemos los datos de la consulta
    $result = Gemini::geminiPro()->generateContent(
        'Mejora la redacción de este titulo de mi curso y hazlo un poco más llamativo: '. $this->nombre .
        'Necestio que la redacción sea limpia y sin dialogos adicionales.
         Solamente una respuesta.'
    );

    //solicitamos la respuesta a gemini
    $result = $result->text();

    //Guardar el nuevo nombre (formateando el texto)
    $this->nombre = str_replace("*", "", $result);
}

//Función de gemini (Mejorar la descripción del curso)
public function geminiDescripcion(){

    //Validar campos
    $this->validate([
        'descripcion' => 'required|string|max:255', 
    ]);

    //Establcemos los datos de la consulta
    $result = Gemini::geminiPro()->generateContent(
        'Mejora la redacción de esta descripcion de mi curso y hazlo un poco más llamativo: '. $this->descripcion .
        'Necestio que la redacción sea limpia y sin dialogos adicionales.
         Solamente una respuesta.'
    );

   //solicitamos la respuesta a gemini
    $result = $result->text();

    //Guardar la nueva descripción (formateando el texto)
    $this->descripcion = str_replace("*", "", $result);
    
    }
}