<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
         Livewire::component('gemine', 'App\Http\Livewire\Gemine');
         Livewire::component('foto-transcripcion-ia', 'App\Http\Livewire\FotoTranscripcionIA');
         Livewire::component('comentarios-curso', 'App\Http\Livewire\ComentariosCursos');
    }
}
