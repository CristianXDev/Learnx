<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gemini\Laravel\Facades\Gemini;
use Gemini\Data\Blob;
use Gemini\Enums\MimeType;
use Livewire\WithFileUploads;

class FotoTranscripcionIA extends Component{

    use WithFileUploads;

    public $photo, $interpretacion, $showModal = true;

    public function render(){

        return view('livewire.foto-transcripcion-ia.view');
    }

    public function cancel(){

        $this->resetInput();
    }
    
    private function resetInput(){

        $this->photo = null;
        $this->interpretacion = null;
    }


    public function gemini_photo(){

       // Validación mejorada
        $this->validate([
            'photo' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,gif', // Formatos específicos
                'max:5120', // Tamaño máximo en KB (5MB)
            ],
        ], [
            'photo.required' => 'Debe seleccionar una imagen para analizar.',
            'photo.image' => 'El archivo debe ser una imagen válida.',
            'photo.mimes' => 'Solo se permiten imágenes en formato JPEG, PNG, JPG o GIF.',
            'photo.max' => 'La imagen no debe superar los 5MB de tamaño.',
        ]);

        $result = Gemini::geminiProVision()->generateContent([
            'Describe lo mejor posible en español el contenido de la imagen con lujo de detalles. la respuesta debe ser concisa y debe ser solamente una respuesta.',
            new Blob(
                mimeType: MimeType::IMAGE_JPEG,
                data: base64_encode(file_get_contents($this->photo->getRealPath()))
            )
        ]);

        $this->interpretacion =   str_replace(['*'], '', $result->text());
    }

    public function closeModal(){

        $this->showModal = false;
        $this->dispatchBrowserEvent('closeModal');
    }

}
