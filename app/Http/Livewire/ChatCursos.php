<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ChatCurso;

class ChatCursos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $curso_id, $usuario_id, $mensaje, $documento;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.chatCursos.view', [
            'chatCursos' => ChatCurso::latest()
						->orWhere('curso_id', 'LIKE', $keyWord)
						->orWhere('usuario_id', 'LIKE', $keyWord)
						->orWhere('mensaje', 'LIKE', $keyWord)
						->orWhere('documento', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
    }
	
    private function resetInput()
    {		
		$this->curso_id = null;
		$this->usuario_id = null;
		$this->mensaje = null;
		$this->documento = null;
    }

    public function store()
    {
        $this->validate([
		'curso_id' => 'required',
		'usuario_id' => 'required',
        ]);

        ChatCurso::create([ 
			'curso_id' => $this-> curso_id,
			'usuario_id' => $this-> usuario_id,
			'mensaje' => $this-> mensaje,
			'documento' => $this-> documento
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'ChatCurso Successfully created.');
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
			session()->flash('message', 'ChatCurso Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            ChatCurso::where('id', $id)->delete();
        }
    }
}