<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ExamenesClasico;
use App\Models\Examene;
use Gemini\Laravel\Facades\Gemini;
use Gemini\Data\Blob;
use Gemini\Enums\MimeType;

use Illuminate\Support\Str;

use Livewire\WithFileUploads;

class ExamenesQuest extends Component{

    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $examen_id, $pregunta, $respuesta, $numeroPreguntas, $prompt, $photo;

    public function render(){

      $keyWord = '%'.$this->keyWord .'%';
      return view('livewire.examenes-quest.view', [
        'examenesClasicos' => ExamenesClasico::
        where('examen_id', $this->examen_id)->get(),
    ]);
  }

  public function cancel()
  {
    $this->resetInput();
}

private function resetInput()
{		
  $this->pregunta = null;
  $this->respuesta = null;
  $this->numeroPreguntas = null;
  $this->prompt = null;
  $this->photo = null;
}

public function store(){

    $this->validate([
        'examen_id' => 'required|exists:examenes,id',
        'pregunta' => 'required',
        'respuesta' => 'required',
    ]);

    ExamenesClasico::create([ 
     'examen_id' => $this-> examen_id,
     'pregunta' => $this-> pregunta,
     'respuesta' => $this-> respuesta
 ]);

    $this->resetInput();
    $this->dispatchBrowserEvent('closeModal');
    session()->flash('message', 'ExamenesClasico Successfully created.');
}

public function edit($id)
{
    $record = ExamenesClasico::findOrFail($id);
    $this->selected_id = $id; 
    $this->pregunta = $record-> pregunta;
    $this->respuesta = $record-> respuesta;
}

public function update(){

    $this->validate([
      'pregunta' => 'required',
      'respuesta' => 'required',
  ]);

    if ($this->selected_id) {
     $record = ExamenesClasico::find($this->selected_id);
     $record->update([ 
         'pregunta' => $this-> pregunta,
         'respuesta' => $this-> respuesta
     ]);

     $this->resetInput();
     $this->dispatchBrowserEvent('closeModal');
     session()->flash('message', 'ExamenesClasico Successfully updated.');
 }
}

public function destroy($id)
{
    if ($id) {
        ExamenesClasico::where('id', $id)->delete();
    }
}

public function mount($id)
{
    $this->examen_id = $id;
}

public function gemini(){


    $examen = Examene::where('id',$this->examen_id)->first();

    // 1. Conecta con GEMINI
    $result = Gemini::geminiPro()->generateContent(

        "Genera una pregunta y una respuesta para un examen llamado" . $examen->nombre . ". 
        La respuesta debe ser concisa y precisa, sin diálogos adicionales.
        Formatea la salida como un array de Laravel con dos elementos: 
        - El primer elemento debe ser la pregunta.
        - El segundo elemento debe ser la respuesta.
        - En caso de que el examen tenga un nombre incohorente el campo de pregunta dirá: Defina un nombre  más descriptivo para el examen. Y el campo de respuesta dirá: Corrija he intente de nuevo.

        Ejemplo de la estructura:

        array = [
        'pregunta' => '',
        'respuesta' => '',
        ];
        "

    );

    $data = $result->text();

    // 1. Extraer el contenido entre corchetes []
    $contenidoArray = Str::between($data, '[', ']');

   // 2. Eliminar espacios en blanco, saltos de línea y caracteres especiales
    $contenidoArray = str_replace(['"',"\n"], '', $contenidoArray);

    $string = trim($contenidoArray);
    $string = str_replace([' => ', ', '], ' => ', $string);

    // Divide el string en un array usando '=>' como delimitador
    $array = collect(explode(' => ', $string))
    ->map(function ($value) {
            return trim($value); // Elimina espacios adicionales
        })
    ->toArray();

    // Usa la función Str::replace() para reemplazar los caracteres
    $array = array_map(function ($value) {
        return Str::replace(["'", ','], '', $value);
    }, $array);

    if (count($array) < 4) {  

        $this->pregunta = '¡Oh, Estamos teniendo problemas!';
        $this->respuesta = 'Intente de nuevo';

    } else {

        //Guardar valores
        $this->pregunta = $array[1];
        $this->respuesta = $array[3];
    }
} 

public function gemini_multiple(){


    // 1. Conecta con GEMINI
    $result = Gemini::geminiPro()->generateContent(

        "Genera ".$this->numeroPreguntas." preguntas con su respectiva respuesta para un examen, las preguntas deben tratar sobre el siguiente tema:".$this->prompt.". 
        La respuesta debe ser concisa y precisa, sin diálogos adicionales.
        Formatea la salida estricatemnete como un array de Laravel con dos elementos: 
        - El primer elemento debe ser la pregunta.
        - El segundo elemento debe ser la respuesta.
        - Las preguntas solo pueden tener una respuesta.

        Ejemplo de la estructura que debes seguir:

        array = [
        'pregunta' => '',
        'respuesta' => '',
        'pregunta' => '',
        'respuesta' => '',
        ];

        Y así con todas las demas preguntas solicitadas.

        "

    );

    $data = $result->text();

    // 1. Extraer el contenido entre corchetes [] (Ya lo tenías bien)
    $contenidoArray = Str::between($data, '[', ']');

    // 2. Mejor limpieza del string. Evitar varias llamadas a str_replace.
    $contenidoArray = preg_replace('/\s*=>\s*/', '=>', trim(str_replace(["\n", '"'], '', $contenidoArray)));


    // 3. Divide el string en un array usando '=>' como delimitador
    $array = explode('=>', $contenidoArray);


    // 4. Procesamiento iterativo más limpio y eficiente
    $preguntasRespuestas = [];
    for ($i = 1; $i < count($array); $i += 2) {
        // Validar que existan la pregunta y respuesta
        if (isset($array[$i+1])){
            $preguntasRespuestas[] = [
                'pregunta' => trim($array[$i]),
                'respuesta' => trim($array[$i + 1]),
            ];
        } else {

            $this->pregunta = '¡Oh, Estamos teniendo problemas!';
            break; // Salir del bucle si hay un error en la estructura de los datos
        }

    }

    $cleanedArray = collect($preguntasRespuestas)->map(function ($item) {
        $pregunta = trim(str_replace([" 'respuesta'", "'pregunta'"],"", $item['pregunta']));
        $respuesta = trim(str_replace([" 'respuesta'", "'pregunta'"],"", $item['respuesta']));

        return [
            "pregunta" => $pregunta,
            "respuesta" => $respuesta,
        ];
    })->toArray();



    $collection = collect($cleanedArray);

    $cleanedArray2 = $collection->map(function ($item) {
      return [
        'pregunta' => str_replace(["'", ",","[","]"], "", $item['pregunta']),
        'respuesta' => str_replace(["'", ",","[","]"], "", $item['respuesta']),
    ];
})->toArray();

// 5. Guardar en la base de datos
    foreach ($cleanedArray2 as $preguntaRespuesta) {
        ExamenesClasico::create([
            'examen_id' => $this->examen_id,
            'pregunta' => $preguntaRespuesta['pregunta'],
            'respuesta' => $preguntaRespuesta['respuesta'],
        ]);
    }

    $this->resetInput();
    $this->dispatchBrowserEvent('closeModal');
    session()->flash('message', 'Preguntas creadas');
}


public function gemini_photo(){

    $this->validate([
        'photo' => 'required|image',
    ]);

    $result = Gemini::geminiProVision()->generateContent([
        'Transcribe esta imagen a texto',
        new Blob(
            mimeType: MimeType::IMAGE_JPEG,
            data: base64_encode(file_get_contents($this->photo->getRealPath()))
        )
    ]);

    $interpretacion = $result->text();

    $this->pregunta = $interpretacion;

    $this->photo = null;

}
}