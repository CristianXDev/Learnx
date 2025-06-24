<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\VideosCompletado;

class VideosCompletados extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $estudiante_id, $videos_id;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.videosCompletados.view', [
            'videosCompletados' => VideosCompletado::latest()
						->orWhere('estudiante_id', 'LIKE', $keyWord)
						->orWhere('videos_id', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
    }
	
    private function resetInput()
    {		
		$this->estudiante_id = null;
		$this->videos_id = null;
    }

    public function store()
    {
        $this->validate([
		'estudiante_id' => 'required',
		'videos_id' => 'required',
        ]);

        VideosCompletado::create([ 
			'estudiante_id' => $this-> estudiante_id,
			'videos_id' => $this-> videos_id
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'VideosCompletado Successfully created.');
    }

    public function edit($id)
    {
        $record = VideosCompletado::findOrFail($id);
        $this->selected_id = $id; 
		$this->estudiante_id = $record-> estudiante_id;
		$this->videos_id = $record-> videos_id;
    }

    public function update()
    {
        $this->validate([
		'estudiante_id' => 'required',
		'videos_id' => 'required',
        ]);

        if ($this->selected_id) {
			$record = VideosCompletado::find($this->selected_id);
            $record->update([ 
			'estudiante_id' => $this-> estudiante_id,
			'videos_id' => $this-> videos_id
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'VideosCompletado Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            VideosCompletado::where('id', $id)->delete();
        }
    }
}