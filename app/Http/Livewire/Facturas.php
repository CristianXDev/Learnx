<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Factura;
use Illuminate\Support\Facades\Auth;

class Facturas extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $usuario_id, $curso_id, $codigo_ref, $estatus, $fecha_pago;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.facturas.view', [
            'facturas' => Factura::latest()
						->where('usuario_id', Auth::user()->id) 
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
    }
	
    private function resetInput()
    {		
		$this->usuario_id = null;
		$this->curso_id = null;
		$this->codigo_ref = null;
		$this->estatus = null;
		$this->fecha_pago = null;
    }

    public function store()
    {
        $this->validate([
		'usuario_id' => 'required',
		'curso_id' => 'required',
		'codigo_ref' => 'required',
		'estatus' => 'required',
		'fecha_pago' => 'required',
        ]);

        Factura::create([ 
			'usuario_id' => $this-> usuario_id,
			'curso_id' => $this-> curso_id,
			'codigo_ref' => $this-> codigo_ref,
			'estatus' => $this-> estatus,
			'fecha_pago' => $this-> fecha_pago
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Factura Successfully created.');
    }

    public function edit($id)
    {
        $record = Factura::findOrFail($id);
        $this->selected_id = $id; 
		$this->usuario_id = $record-> usuario_id;
		$this->curso_id = $record-> curso_id;
		$this->codigo_ref = $record-> codigo_ref;
		$this->estatus = $record-> estatus;
		$this->fecha_pago = $record-> fecha_pago;
    }

    public function update()
    {
        $this->validate([
		'usuario_id' => 'required',
		'curso_id' => 'required',
		'codigo_ref' => 'required',
		'estatus' => 'required',
		'fecha_pago' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Factura::find($this->selected_id);
            $record->update([ 
			'usuario_id' => $this-> usuario_id,
			'curso_id' => $this-> curso_id,
			'codigo_ref' => $this-> codigo_ref,
			'estatus' => $this-> estatus,
			'fecha_pago' => $this-> fecha_pago
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Factura Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Factura::where('id', $id)->delete();
        }
    }
}