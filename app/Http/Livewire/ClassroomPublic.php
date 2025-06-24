<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Classroom;
use App\Models\ClassroomUser;
use Illuminate\Support\Facades\Auth; // Importar Auth

class ClassroomPublic extends Component
{
    public $search = '';

    public function render()
    {
        $userId = Auth::id(); // Obtener el ID del usuario actual

        // Obtener los IDs de las clases a las que el usuario está inscrito
        $userClassrooms = ClassroomUser::where('usuario_id', $userId)->pluck('classroom_id')->toArray();

        $classrooms = Classroom::query()
            ->when($this->search, function ($query) {
                $query->where('nombre', 'like', '%' . $this->search . '%')
                    ->orWhere('descripcion', 'like', '%' . $this->search . '%');
            })
            // Excluir las clases a las que el usuario está inscrito
            ->whereNotIn('id', $userClassrooms)
            ->get();

        return view('livewire.classroom-public.view', [
            'classrooms' => $classrooms,
        ]);
    }
}