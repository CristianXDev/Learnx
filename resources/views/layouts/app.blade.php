<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@hasSection('title') @yield('title') | @endif {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
    @livewireStyles
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
					@auth()
                    <ul class="navbar-nav mr-auto">
						<!--Nav Bar Hooks - Do not delete!!-->
						<li class="nav-item">
                            <a href="{{ url('/quiz_curso_entregado') }}" class="nav-link"><i class="fab fa-laravel text-info"></i> Quiz_curso_entregado</a> 
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/quiz_curso') }}" class="nav-link"><i class="fab fa-laravel text-info"></i> Quiz_curso</a> 
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/calificacion_curso') }}" class="nav-link"><i class="fab fa-laravel text-info"></i> Calificacion_curso</a> 
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/likes') }}" class="nav-link"><i class="fab fa-laravel text-info"></i> Likes</a> 
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/comentarios_cursos') }}" class="nav-link"><i class="fab fa-laravel text-info"></i> Comentarios_cursos</a> 
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/notas') }}" class="nav-link"><i class="bi-house text-info"></i> Notas</a> 
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/auditorias') }}" class="nav-link"><i class="bi-house text-info"></i> Auditorias</a> 
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/profesores') }}" class="nav-link"><i class="bi-house text-info"></i> Profesores</a> 
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/gemini_chat') }}" class="nav-link"><i class="bi-house text-info"></i> Gemini_chat</a> 
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/estados') }}" class="nav-link"><i class="bi-house text-info"></i> Estados</a> 
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/estudiantes') }}" class="nav-link"><i class="bi-house text-info"></i> Estudiantes</a> 
                        </li>
                    </ul>
					@endauth()

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @livewireScripts
    <script type="module">
        const addModal = new bootstrap.Modal('#createDataModal');
        const editModal = new bootstrap.Modal('#updateDataModal');
        window.addEventListener('closeModal', () => {
           addModal.hide();
           editModal.hide();
        })
    </script>
</body>
</html>