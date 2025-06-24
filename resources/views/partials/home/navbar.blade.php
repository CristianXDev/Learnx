<nav class="w-100pc flex flex-column md-flex-row md-px-10 py-5 bg-black navbar-fixed navbar fixed-top">
    <div class="flex justify-between">
        <a href="{{ route('index') }}" class="flex items-center p-2 mr-4 no-underline">
            <img class="max-h-l2 w-auto" src="{{asset('static/assets/img/favicon/favicon.ico')}}" />
            <h1 class="mx-2 ft-white">Learn<span class="ft-blue">X</span></h1>
        </a>
        <a data-toggle="toggle-nav" data-target="#nav-items" href="#"
        class="flex items-center ml-auto md-hidden indigo-lighter opacity-50 hover-opacity-100 ease-300 p-1 m-3">
        <i data-feather="menu"></i>
    </a>
</div>
<div id="nav-items" class="hidden flex sm-w-100pc flex-column md-flex md-flex-row md-justify-end items-center ft-white">
    <a href="{{ route('index') }}" class="fs-s1 mx-3 py-3 indigo no-underline ft-white">Inicio</a>
    <a href="{{ route('index-curso') }}" class="fs-s1 mx-3 py-3 indigo no-underline ft-white">Cursos</a>
    <a href="{{ route('index-classroom') }}" class="fs-s1 mx-3 py-3 indigo no-underline ft-white">Aulas</a>
    <a href="{{ route('register') }}" class="button bg-white black fw-600 no-underline mx-5">Registro</a>
</div>
</nav>