<?php

namespace App\Http\Livewire;

//Componentes 
use Livewire\Component;
use Livewire\WithPagination;

//Modelos
use App\Models\User;

//Clase principal
class Users extends Component{

	//Componente - Paginación
	use WithPagination;

	//Integración con Bootstrap
	protected $paginationTheme = 'bootstrap';

	//Variables
	public $selected_id, $keyWord, $name, $image, $lastName, $cedula, $email, $estatus_email, $estatus, $rol;

	//Render
	public function render(){

		$keyWord = '%'.$this->keyWord .'%';
		return view('livewire.users.view', [
			'users' => User::latest()
			->orWhere('name', 'LIKE', $keyWord)
			->orWhere('lastName', 'LIKE', $keyWord)
			->orWhere('cedula', 'LIKE', $keyWord)
			->orWhere('email', 'LIKE', $keyWord)
			->orWhere('estatus', 'LIKE', $keyWord)
			->orWhere('rol', 'LIKE', $keyWord)
			->paginate(10),
		]);
	}
	
	//Cerrar modal
	public function cancel(){

		$this->resetInput();
	}
	
	//Resetear Campos
	private function resetInput(){

		$this->name = null;
		$this->image = null;
		$this->lastName = null;
		$this->cedula = null;
		$this->email = null;
		$this->estatus_email = null;
		$this->estatus = null;
		$this->rol = null;
	}

	//Inicializar variables
	public function edit($id){

		$record = User::findOrFail($id);
		$this->selected_id = $id; 
		$this->name = $record-> name;
		$this->lastName = $record-> lastName;
		$this->cedula = $record-> cedula;
		$this->estatus = $record-> estatus;
		$this->rol = $record-> rol;
	}

	//Actualizar datos
	public function update(){

		//Validar datos
		$this->validate([
			'name' => 'required',
			'lastName' => 'required',
			'cedula' => 'required|min:7|max:8',
			'estatus' => 'required',
			'rol' => 'required',
		]);

		//Realizar la actualización
		if ($this->selected_id) {
			$record = User::find($this->selected_id);
			$record->update([ 
				'name' => $this-> name,
				'lastName' => $this-> lastName,
				'cedula' => str_replace(".", "", $this->cedula),
				'estatus' => $this-> estatus,
				'rol' => $this-> rol
			]);

			//Resetar inputs
			$this->resetInput();

			//Cerrar modal
			$this->dispatchBrowserEvent('closeModal');

			//Mensaje guardado en la sesión
			session()->flash('message', 'Proceso realizado correctamente.');
		}
	}
}