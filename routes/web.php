<?php

/*======================
    1. DEPENDENCIAS
=======================*/
use Illuminate\Support\Facades\Route; //Manejador de rutas
use Illuminate\Support\Facades\Auth; //Controlador de autentificación y protección de rutas

/*======================
    2. CONTROLADORES 
=======================*/
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ForgotController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ExamenJoinController;
use App\Http\Controllers\CursoPayController;
use App\Http\Controllers\CursoRegistrationController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\ClassroomJoinController;
use App\Http\Controllers\EstadisticaController;
use App\Http\Controllers\PdfDownloadController;
use App\Http\Controllers\QuizCursoController;
use App\Http\Controllers\ApiController;

/*======================
3. RUTAS SIN PROTECCIÓN
=======================*/

//HOME INDEX [GET]
Route::get('/', [HomeController::class, 'home'])->name('index');

//HOME AULAS [GET]
Route::get('/classrooms', [HomeController::class, 'classroom'])->name('index-classroom');

//HOME CURSOS [GET]
Route::get('/cursos', [HomeController::class, 'curso'])->name('index-curso');

/*======================
3.1 RUTAS CON CONTROLADOR
=======================*/

//REGISTER - [POST]
Route::post('/register', [registerController::class, 'register'])->name('auth-register');

//LOGIN - [POST]
Route::post('/login', [loginController::class, 'login'])->name('auth-login');

//LOGOUT - [POST]
Route::post('/logout', [logoutController::class, 'logout'])->name('auth-logout');



/*======================
4. RUTAS DESAUTENTIFICADAS
 =======================*/
 Route::middleware('guest')->group(function(){

    //LOGIN [GET]
    Route::get('/login', function () {
        return view('auth.auth-login');
    })->name('login');

    //REGISTER [GET]
    Route::get('/register', function () {
        return view('auth.auth-register');
    })->name('register');

    //FORGOT [GET]
    Route::get('/forgot', function () {
        return view('auth.auth-forgot');
    })->name('forgot');

});


/*======================
 5. RUTAS AUTENTIFICADAS
 =======================*/
 Route::middleware('auth')->group(function(){


    /*======================
    5.1 - RUTAS SIMPLES
    =======================*/

    //DASHBOARD [GET]
    Route::get('/dashboard', function () {
        return view('dashboard.home.index');
    })->name('dashboard');

    //PROFILE [GET]
    Route::get('dashboard/profile', function () {
        return view('dashboard.profile.index');
    })->name('profile');

    //FAQ [GET]
    Route::get('dashboard/faq', function () {
        return view('dashboard.faq.index');
    })->name('faq');

    /*======================
    5.2 - RUTAS CON CONTROLADOR
    =======================*/



    //PROFILE UPDATE [POST]
    Route::post('dashboard/profile/update', [profileController::class, 'update'])->name('profile_update');

    //PROFILE UPDATE PHOTO [POST]
    Route::post('dashboard/profile/update/photo', [profileController::class, 'update_photo'])->name('profile_photo');

    //PROFILE UPDATE PASSWORD [POST]
    Route::post('dashboard/profile/update/password', [profileController::class, 'update_password'])->name('profile_update_password');

    //PROFILE DELETE [POST]
    Route::post('dashboard/profile/delete', [profileController::class, 'delete'])->name('profile_delete');

    //CLASSROOM JOIN [GET]
    Route::get('/dashboard/classroom/join/{codigo}', [ClassroomJoinController::class, 'join'])->name('classroom-join');

    //CLASSROOM ACCEPT [GET]
    Route::get('/dashboard/classroom/accept/{codigo}', [ClassroomJoinController::class, 'accept'])->name('classroom-accept');

    //EXAMEN JOIN [GET]
    Route::get('/dashboard/examenes/join/{id?}', [examenJoinController::class, 'join'])->name('examen-join');

    //EXAMEN  SUBMIT [GET]
    Route::post('/dashboard/examenes/submit/{id?}', [examenJoinController::class, 'submit'])->name('examen-submit');

    //EXAMEN RETROALIMENTACIÓN [GET]
    Route::get('dashboard/examen/gemini/{id}', [PdfDownloadController::class, 'retroalimentacion'])->name('examen-gemini');

    //EXAMEN  DESCARGAR [GET]
    Route::get('dashboard/examen/download/{id}', [PdfDownloadController::class, 'examen'])->name('examen-download');

   //CURSO PAY [GET]
    Route::get('dashboard/curso/pay/{id}', [CursoPayController::class, 'confirm'])->name('confirm-pay');

    //CURSO PAYPAL [GET]
    Route::get('dashboard/curso/paypal/{id}', [CursoPayController::class, 'pay'])->name('curso-paypal');

    //CURSO APPROVED [GET]
    Route::get('dashboard/curso/approved/{id}', [CursoPayController::class, 'approved'])->name('curso-approved');

    //CURSO REGISTRATION [GET]
    Route::get('dashboard/curso/registration/{id}', [cursoRegistrationController::class, 'registration'])->name('curso-registration');

    //CURSO PRESENCIAL REGISTRATION [GET]
    Route::get('dashboard/curso/presencial/registration/{id}', [cursoRegistrationController::class, 'registrationPresencial'])->name('curso-presencial-registration');

    //CERTIFICADOS DOWNLOAD [POST]
    Route::post('dashboard/certificado/download/', [PdfDownloadController::class, 'certificado'])->name('certificado_pdf');

    //FACTURA DOWNLOAD [POST]
    Route::post('dashboard/factura/download/', [PdfDownloadController::class, 'factura'])->name('factura_pdf');

    //BACKUP - [GET]
    Route::get('/backup', [BackupController::class, 'createBackup'])->name('backup-create');

    //BACKUP - [GET]
    Route::get('/backup/update', [BackupController::class, 'updateBackup'])->name('backup-update');

    //ESTADISTICAS USUARIOS [GET]
    Route::get('dashboard/estadisticas/usuario', [EstadisticaController::class, 'usuarios'])->name('estadistica-usuario');

    //ESTADISTICAS CURSOS [GET]
    Route::get('dashboard/estadisticas/cursos', [EstadisticaController::class, 'cursos'])->name('estadistica-cursos');

    //ESTADISTICAS AULAS [GET]
    Route::get('dashboard/estadisticas/classrooms', [EstadisticaController::class, 'classrooms'])->name('estadistica-classrooms');

    /*======================
    5.3 - RUTAS LIVEWIRE
    =======================*/

    //MATERIAS
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('materias', function () {
            return view('livewire.materias.index');
        })
        ->name('materias');
    });

    //SUBMTERIAS - TEMAS
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('submaterias', function () {
            return view('livewire.submaterias.index');
        })
        ->name('submaterias');
    });

    //AULAS
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('aulas', function () {
            return view('livewire.aulas.index');
        })
        ->name('aulas');
    });

    //CATEGORIAS 
    Route::group(['prefix' => 'dashboard/categorias'], function () {
        Route::get('/', function () {
            return view('livewire.categorias.index');
        })
        ->name('categorias');
    });

    //AULAS
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('classrooms', function () {
            return view('livewire.classrooms.index');
        })
        ->name('classrooms');
    });

    //CLASSROOM PUBLIC
    Route::group(['prefix' => 'dashboard/classrooms/public'], function () {
        Route::get('/', function () {
            return view('livewire.classroom-public.index');
        })
        ->name('classroom_public');
    });

    //CLASSROOM UNITED
    Route::group(['prefix' => 'dashboard/classrooms/united'], function () {
        Route::get('/', function () {
            return view('livewire.classroom-users.index');
        })
        ->name('classroom_united');
    });

    //CLASSROOM HOME
        Route::group(['prefix' => 'dashboard/classrooms/home'], function () {
        Route::get('/{code?}', function ($code = null) { // El ? hace que 'code' sea opcional
            // ... tu lógica aquí
            return view('livewire.chats-classrooms.index'); 
        })
        ->name('classroom_home');
    });

    //CLASSROOM PRIVATE
    Route::get('dashboard/classroom/private', function () {
        return view('dashboard.classroom.classroom_private');
    })->name('classroom_private');

    //EXAMEN 
    Route::group(['prefix' => 'dashboard/examenes'], function () {
        Route::get('/', function () {
            return view('livewire.examenes.index');
        })
        ->name('examenes');
    });

    //EXAMEN - QUEST
    Route::group(['prefix' => 'dashboard/examenes/quest/{id?}'], function () {
        Route::get('/', function () {
            return view('livewire.examenes-quest.index');
        })
        ->name('examen-quest');
    });

    //EXAMEN - QUEST
    Route::group(['prefix' => 'dashboard/examenes/quest/multi/{id?}'], function () {
        Route::get('/', function () {
            return view('livewire.examenes-multiples.index');
        })
        ->name('examen-quest-multi');
    });

    //EXAMEN - COMPLETE
    Route::group(['prefix' => 'dashboard/examenes/complete'], function () {
        Route::get('/', function () {
            return view('livewire.examenes-entregados.index');
        })
        ->name('examenes-entregados');
    });

    //EXAMEN - CORRECTION 
    Route::group(['prefix' => 'dashboard/examenes/correction/{id}'], function () {
        Route::get('/', function () {
            return view('livewire.examenes-clasicos-entregados.index');
        })
        ->name('examenes-correction');
    });

    //EXAMEN - CORRECTION MULTIPLE
    Route::group(['prefix' => 'dashboard/examenes/correction/multi/{id}'], function () {
        Route::get('/', function () {
            return view('livewire.examenes-multiples-entregados.index');
        })
        ->name('examenes-correction-multiple');
    });

    //EXAMEN - ENTREGADOS ESTUDIANTE
    Route::group(['prefix' => 'dashboard/examenes/complete/estudiantes'], function () {
        Route::get('/', function () {
              return view('livewire.examenes-entregados-estudiantes.index');
        })
        ->name('examenes-entregados-estudiantes');
    });

    //CURSO 
    Route::group(['prefix' => 'dashboard/cursos'], function () {
        Route::get('/', function () {
            return view('livewire.cursos.index');
        })
        ->name('cursos');
    });

    //CURSO PRESENCIAL
    Route::group(['prefix' => 'dashboard/cursos/presenciales'], function () {
        Route::get('/', function () {
            return view('livewire.curso-presencials.index');
        })
        ->name('cursos-presencial');
    });

    //CURSO MIEMBROS
    Route::group(['prefix' => 'dashboard/curso/online/miembros/{id}'], function () {
        Route::get('/', function () {
            return view('livewire.curso-online-miembros.index');
        })
        ->name('curso-online-miembros');
    });

    //CURSO MIEMBROS
    Route::group(['prefix' => 'dashboard/curso/presencial/miembros/{id}'], function () {
        Route::get('/', function () {
            return view('livewire.curso-presencial-miembros.index');
        })
        ->name('curso-presencial-miembros');
    });

    //CURSO - VIDEOS
    Route::group(['prefix' => 'dashboard/cursos/videos/{id}'], function () {
        Route::get('/', function () {
            return view('livewire.videos-cursos.index');
        })
        ->name('cursos-videos');
    });

    //CURSO PRESNCIAL - ACTIVIDADES
    Route::group(['prefix' => 'dashboard/cursos/presencial/actividades/{id}'], function () {
        Route::get('/', function () {
            return view('livewire.actividades-curso-presencials.index');
        })
        ->name('cursos-actividades');
    });

    //CURSO - PUBLIC 
    Route::group(['prefix' => 'dashboard/cursos/publicos'], function () {
        Route::get('/', function () {
            return view('livewire.cursos-public.index');
        })
        ->name('cursos-public');
    });

    //CURSO - PUBLIC 
    Route::group(['prefix' => 'dashboard/cursos/presenciales/publicos'], function () {
        Route::get('/', function () {
            return view('livewire.cursos-presenciales-public.index');
        })
        ->name('cursos-presenciales-public');
    });

    //CURSO - VIEW 
    Route::group(['prefix' => 'dashboard/cursos/view/{id}'], function () {
        Route::get('/', function () {
            return view('livewire.cursos-view.index');
        })
        ->name('cursos-view');
    });

    //CURSO PRESENCIAL - VIEW 
    Route::group(['prefix' => 'dashboard/curso/presencial/view/{id}'], function () {
        Route::get('/', function () {
            return view('livewire.curso-presencial-view.index');
        })
        ->name('cursos-presencial-view');
    });

    //CURSO -FACTURA 
    Route::group(['prefix' => 'dashboard/facturas'], function () {
        Route::get('/', function () {
            return view('livewire.facturas.index');
        })
        ->name('facturas');
    });

    //CURSO - PREGUNTAS [QUIZZ] 
    Route::group(['prefix' => 'dashboard/curso/pregunta/quiz/{id}'], function () {
        Route::get('/', function () {
            return view('livewire.quiz-cursos.index');
        })
        ->name('quiz-curso');
    });

    //CURSO QUIZ JOIN [GET]
    Route::get('/dashboard/curso/quiz/{id}', [QuizCursoController::class, 'join'])->name('quiz-join');

    //CURSO QUIZ SUbMIT [GET]
    Route::post('/dashboard/curso/quiz/submit/{id}', [QuizCursoController::class, 'submit'])->name('quiz-submit');

    //CERTIFICADOS - VIEW 
    Route::group(['prefix' => 'dashboard/certificados'], function () {
        Route::get('/', function () {
            return view('livewire.inscripciones-cursos.index');
        })
        ->name('certificados');
    });

    //AUDITORIA
    Route::group(['prefix' => 'dashboard/auditoria'], function () {
        Route::get('/', function () {
            return view('livewire.auditorias.index');
        })
        ->name('auditorias');
    });

    //BACKUP
    Route::get('/dashboard/backup', function () {
        return view('dashboard.backup.index');
    })->name('backup');

  
    //MODULOS CURSOS
    Route::group(['prefix' => 'dashboard/modulos/cursos/{id}'], function () {
        Route::get('/', function () {
            return view('livewire.modulos-cursos.index');
        })
        ->name('modulos_cursos');
    });

    //MODULOS USUARIOS 
    Route::group(['prefix' => 'dashboard/gestion/usuarios'], function () {
        Route::get('/', function () {
            return view('livewire.users.index');
        })
        ->name('usuarios');
    });

    //TAREAS 
    Route::group(['prefix' => 'dashboard/tareas'], function () {
        Route::get('/', function () {
            return view('livewire.tareas.index');
        })
        ->name('tareas');
    });

    //AULAS Y TAREAS [DOCENTE] PAG-1
    Route::group(['prefix' => 'dashboard/aulas/tareas/pendiente/docente'], function () {
        Route::get('/', function () {
            return view('livewire.aulas-online-tareas-pendientes-docente.index');
        })
        ->name('aulas-online-tareas-docente');
    });

    //TAREAS ENTREGADAS [DOCENTE] PAG-2
    Route::group(['prefix' => 'dashboard/tareas/pendiente/docentes/{id}'], function () {
        Route::get('/', function () {
            return view('livewire.tareas-pendientes-docente.index');
        })
        ->name('tareas-docente');
    });

    //TAREAS ENTREGADAS [DOCENTE] PAG-3
    Route::group(['prefix' => 'dashboard/tareas/pendientes/listado/docente/{id}'], function () {
        Route::get('/', function () {
            return view('livewire.tareas-entregadas-pendientes-docente.index');
        })
        ->name('tareas-entregadas-docente');
    });

    //AULAS Y TAREAS CORREGIDOS [DOCENTE] PAG-1
    Route::group(['prefix' => 'dashboard/aulas/tareas/corregido/docente'], function () {
        Route::get('/', function () {
            return view('livewire.aulas-online-tareas-corregido-docente.index');
        })
        ->name('aulas-online-tareas-corregido-docente');
    });

    //TAREAS ENTREGADAS [DOCENTE] PAG-2
    Route::group(['prefix' => 'dashboard/tareas/corregido/docentes/{id}'], function () {
        Route::get('/', function () {
            return view('livewire.tareas-corregido-docente.index');
        })
        ->name('tareas-docente-corregido');
    });

   //TAREAS ENTREGADAS [DOCENTE] PAG-3
    Route::group(['prefix' => 'dashboard/tareas/corregido/listado/docente/{id}'], function () {
        Route::get('/', function () {
            return view('livewire.tareas-entregadas-corregido-docente.index');
        })
        ->name('tareas-corregido-docente');
    });

    //AULAS Y TAREAS [ESTUDIANTES] PAG-1
    Route::group(['prefix' => 'dashboard/aulas/tareas/pendiente/estudiante'], function () {
        Route::get('/', function () {
            return view('livewire.aulas-online-tareas-pendientes-estudiante.index');
        })
        ->name('aulas-online-tareas-estudiante');
    });

    //TAREAS ENTREGADAS [ESTUDIANTES] PAG-2
    Route::group(['prefix' => 'dashboard/tareas/pendiente/estudiante/{id}'], function () {
        Route::get('/', function () {
            return view('livewire.tareas-pendientes-estudiante.index');
        })
        ->name('tareas-estudiante');
    });

    //TAREAS ENTREGADAS [ESTUDIANTE]
    Route::group(['prefix' => 'dashboard/tareas/entregadas/estudiante'], function () {
        Route::get('/', function () {
            return view('livewire.tareas-entregadas-estudiante.index');
        })
        ->name('tareas-entregadas-estudiante');
    });


    //TAREAS ENTREGADAS 
    Route::group(['prefix' => 'dashboard/gemini'], function () {
        Route::get('/', function () {
            return view('livewire.gemini.index');
        })
        ->name('gemini-dashboard');
    });

});


/*======================
       API BETA
=======================*/

//API
Route::get('/dashboard/api/', [ApiController::class, 'index'])->name('api');

//API - REST
Route::get('/dashboard/api/rest', [ApiController::class, 'rest'])->name('api-rest');



/*======================
    RUTA DE ERRORES
=======================*/

//ERROR 404
Route::fallback(function () {
    return view('errors.pageNoFound');
});