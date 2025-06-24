@extends('sources-home')

@section('title')

<title>LearnX | ¡Unete a una de nuestras aulas!</title>

@endsection

@section('content')
<!-- hero section -->
<section id="home" class="min-h-100vh flex justify-between items-center relative mt-10 md:mt-20">
    <div class="flex flex-col justify-center w-full md:w-2/3 mx-5 md:mx-15">
        <div>
            <h1 class="white fs-l3 lh-2 md:fs-xl1 md:lh-1 fw-900">¡Espacio virtual<br> con un 
                <span class="border-b bc-indigo bw-4">ambiente<br> dinamico </span> para aprender!</h1>

                <div class="br-8 mt-10 inline-flex">
                    <a href="{{ route('register') }}" 
                    class="button-lg bg-indigo-lightest-20 indigo-lightest focus-white fw-300 fs-s3 mr-0 br-l-0 ft-big" >¡Comenzar!</a></h5>
                </div>
            </div>
        </div>

        <div class="relative flex justify-end items-center w-full md:w-1/3 px-10 md:px-20 md:ml-20"> 
            <span class="hidden md:block"></span> 
            <img src="{{ asset('static/assets/img/classroom-join/bg-8.png') }}" alt="girl_vr" class="max-h-60vh object-cover md:max-h-full" width="600" height="300"> 
        </div>
    </section>

<!-- classrooms -->
<section class="p-0 md-p-5">

    <!--title testimonials-->
    <div class="flex justify-center items-center mb-5" id="classroom">
        <h1 class="white fs-l3 fw-900"><span class="border-b bc-indigo bw-4">Aulas publicas</span></h1>
    </div>

    @if ($classroom->isEmpty())
        <div class="flex justify-center items-center mt-5">
            <h2 class="white">No hay aulas disponibles.</h2>
        </div>
    @else
        <div class="flex flex-wrap">
            @foreach ($classroom as $row)
                <div class="w-100pc md-w-33pc p-10">
                    <a href="#" class="block no-underline p-5 br-8 hover-bg-indigo-lightest-10 hover-scale-up-1 ease-300"> 
                        <img class="w-100pc" src="{{ Storage::url( $row->foto) }}" alt="{{ $row->nombre }}">
                        <h3 class="fw-600 white fs-m3 mt-3">{{ $row->nombre }}</h3>
                        <p>{{ Str::limit($row->descripcion, 150, '...') }}</p>

                        <div class="flex justify-center items-center mt-5">
                            <button class="button-lg bg-indigo indigo-lightest fw-300 fs-s3 br-l-0">¡Unirme!</button>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @endif

</section>




    <!-- subscribe -->
    <section class="p-10 md-p-l5">
        <div class="br-8 bg-indigo-lightest-10 p-5 md-p-l5 flex flex-wrap md-justify-between md-items-center">
            <div class="w-100pc md-w-33pc">
                <h2 class="white fs-m4 fw-800">¡Suscribete!</h2>
                <p class="fw-600 indigo-lightest opacity-40">¡Descubre nuevo contenido y disfruta de ofertas unicas! </p>
            </div>
            <div class="w-100pc md-w-50pc">
                <div class="flex my-5">
                    <input type="text"
                    class="input-lg flex-grow-1 bw-0 fw-200 bg-indigo-lightest-10 white ph-indigo-lightest focus-white opacity-80 fs-s3 py-5 br-r-0"
                    placeholder="Correo electronico...">
                    <button class="button-lg bg-indigo indigo-lightest fw-300 fs-s3 br-l-0">Comenzar</button>
                </div>
            </div>
        </div>
    </section>

    <!-- footer -->
    <footer class="p-5 md-p-l5 bg-indigo-lightest-10">
        <div class="flex flex-wrap">
            <div class="md-w-25pc mb-10">
                <img src="{{asset('static/assets/img/favicon/favicon.ico')}}" class="w-l0" alt="">
                <div class="white opacity-70 fs-s2 mt-4 md-pr-10">
                    <p>LearnX es tu espacio de aprendizaje online personalizado, donde podrás acceder a tus cursos, materiales de estudio, comunicarte con tus compañeros y profesores a través de foros y mensajería, participar en clases en vivo, acceder a recursos digitales interactivos.</p>
                </div>
            </div>
            <div class="w-100pc md-w-50pc">
                <div class="flex justify-around">
                    <div class="w-33pc md-px-10 mb-10">
                        <h5 class="white">Company</h5>
                        <ul class="list-none mt-5 fs-s2">
                            <li class="my-3"><a href="#" class="white opacity-70 no-underline hover-underline">About
                            Us</a></li>
                            <li class="my-3"><a href="#" class="white opacity-70 no-underline hover-underline">Jobs</a>
                            </li>
                            <li class="my-3"><a href="#"
                                class="white opacity-70 no-underline hover-underline">Contact</a></li>
                                <li class="my-3"><a href="#" class="white opacity-70 no-underline hover-underline">Media</a>
                                </li>
                            </ul>
                        </div>
                        <div class="w-33pc md-px-10 mb-10">
                            <h5 class="white">Product</h5>
                            <ul class="list-none mt-5 fs-s2">
                                <li class="my-3"><a href="#" class="white opacity-70 no-underline hover-underline">About
                                Us</a></li>
                                <li class="my-3"><a href="#" class="white opacity-70 no-underline hover-underline">Jobs</a>
                                </li>
                                <li class="my-3"><a href="#"
                                    class="white opacity-70 no-underline hover-underline">Contact</a></li>
                                    <li class="my-3"><a href="#" class="white opacity-70 no-underline hover-underline">Media</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="w-33pc md-px-10 mb-10">
                                <h5 class="white">Support</h5>
                                <ul class="list-none mt-5 fs-s2">
                                    <li class="my-3"><a href="#" class="white opacity-70 no-underline hover-underline">About
                                    Us</a></li>
                                    <li class="my-3"><a href="#" class="white opacity-70 no-underline hover-underline">Jobs</a>
                                    </li>
                                    <li class="my-3"><a href="#"
                                        class="white opacity-70 no-underline hover-underline">Contact</a></li>
                                        <li class="my-3"><a href="#" class="white opacity-70 no-underline hover-underline">Media</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="w-100pc md-w-25pc">
                            <div class="flex w-75pc md-w-100pc mx-auto">
                                <input type="text"
                                class="input flex-grow-1 bw-0 fw-200 bg-indigo-lightest-10 white ph-indigo-lightest focus-white opacity-80 fs-s3 py-5 br-r-0"
                                placeholder="Correo electronico...">
                                <button class="button bg-indigo indigo-lightest fw-300 fs-s3 br-l-0">¡Comenzar!</button>
                            </div>
                            <div class="flex justify-around my-8">
                                <a href="#" class="relative p-5 bg-indigo br-round white hover-scale-up-1 ease-400"><i
                                    data-feather="twitter" class="absolute-center h-4"></i></a>
                                    <a href="#" class="relative p-5 bg-indigo br-round white hover-scale-up-1 ease-400"><i
                                        data-feather="facebook" class="absolute-center h-4"></i></a>
                                        <a href="#" class="relative p-5 bg-indigo br-round white hover-scale-up-1 ease-400"><i
                                            data-feather="instagram" class="absolute-center h-4"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </footer>

                        </div>
                        @endsection