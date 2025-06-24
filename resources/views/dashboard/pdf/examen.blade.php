<html>
<head>

<style>

    body{
        margin: 3cm 2cm 2cm;
    }

    header {|
        position: fixed;
        top: 0cm;
        left: 0cm;
        right: 0cm;
        height: 2cm;
        background-color: white;
        color: black;
        text-align: left;
        line-height: 30px;
    }

    header img{
        position:absolute;
        top:0;
    }

    header h1{
        position:absolute;
        left:50px;
    }


    main{
        margin-top:50px;
        text-align: left;
    }

    footer {
        position: fixed;
        bottom: 0cm;
        left: 0cm;
        right: 0cm;
        height: 2cm;
        background-color: white;
        color: black;
        text-align: center;
        line-height: 35px;
    }

    .div-left,
    .div-right{
        position:absolute;   
    }

    .div-left{
        left:50px;
    }

    .div-right{
        width:300px;
        left:875px;
    }

    .div-right img{
        left:80px;
    }

    .div-right h3{
        position: absolute;

    }

    .d-inline{
        display:inline;
    }

    .mx-1{
        margin:0 15px 0 15px;
    }

    .mt-1{
        position:relative;
        top:10px;
    }

    .center{
        position:absolute;
        left:250px;
        line-height:0;
        text-align:center;
        width:575px;
    }

    .text-center{
        text-align:center;
    }

    .main-center{
        text-align:center;
        margin-bottom:50px;
    }

    .check{
        color:green;
    }

    .x{
        color:red;  
    }

    .check-border{
        border-color:green;
    }

    .x-border{
        border-color:red;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .quiz-content {
        margin-top:40px;
        padding: 20px 40px 40px;
    }

    h1 {
        color: #333;
        font-size: 24px;
        margin-bottom: 10px;
        text-align: center;
    }

    .subtitle {
        text-align: center;
        margin-bottom: 40px;
        font-size: 14px;
    }

    .question {
        margin-bottom: 20px;
    }

    .question-title {
        color: #444;
        font-size: 16px;
        margin-bottom: 10px;
        font-weight: 500;
    }

    .question-input {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
        color: #333;
    }

    .question-input:focus {
        outline: none;
        border-color: #4f46e5;
        box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.1);
    }
  
    .info{
        margin:30px 0 70px 0;
        width: 100%;
    }

    .info p{
        color:#333;
    }

    .inline {
        width: 50%;
    }

    .left {
        float: left;
        text-align: left;
    }

    .right {
        float: right;
        text-align: right;
    }

    .gray{
        color:#333;
    }

</style>  

</head>
<body>
    <div class="body">
        <header>

            <div class="div-right">
                <img src="{{public_path().'/static/assets/img/favicon/favicon.ico'}}" alt="" width="50" height="50">
                <h2 class="gray">LearnX</h2>
            </div>

            <div class="center">
               <p>PLATAFORMA DE E-LEARNING PARA CREAR, VENDER E IMPARTIR CURSOS</p>
               <p>ONLINE TOTALEMENTE PERSONALIZABLES. CON INTEGRACIÓN DE AULAS</p>
               <p>VIRTUALES Y EXAMENES EN LINEA</p>
            </div>
            

            <div class="div-left">
                <img src="{{public_path().'/static/assets/img/others/upta.png'}}" alt="" width="90" height="80">
            </div>
            
        </header>


        <!--CONTAINER-->
        <div class="container">
    
            <div class="quiz-content">

                <h1>{{ $exam->nombre }}</h1>
                <p class="center">{{ $exam->materia->nombre }} / {{ $exam->submateria->nombre }}</p>

                <div class="info">
                    <div class="inline left">
                        <p>Corregido por: {{ $exam->user->name }} {{ $exam->user->lastName }}</p>
                    </div>

                    <div class="inline right">
                        <p>Generado al estudiante: {{ $estudiante }}</p>
                    </div>
                </div>

                <!--Cargar preguntas clasicas-->
                @foreach($preguntasRespuestas as $preguntaRespuesta)

                <div class="question">
                    <p class="question-title"><strong>Pregunta N°{{ $loop->iteration }}:</strong> {{ $preguntaRespuesta['pregunta'] }}</p>
                    <input type="text" class="question-input {{ $preguntaRespuesta['estatus'] == 'correcto' ? 'check-border' : 'x-border'   }}" value="{{ $preguntaRespuesta['respuesta'] }}">


                    @if($preguntaRespuesta['estatus'] == 'correcto')

                        <div class="text-center">
                            <span class="check">Correcto</span>
                            <img src="{{public_path().'/static/assets/img/others/check.png'}}" alt="" width="30" height="30" class="mt-1">
                        </div>

                        @else

                        <div class="text-center">
                            <span class="x">Incorrecto</span>
                            <img src="{{public_path().'/static/assets/img/others/x.png'}}" alt="" width="30" height="30" class="mt-1">
                        </div>

                    @endif

                </div>

                @endforeach


            </div>
        </div>

        <footer class="text-center">
            <p class="gray">Av. Universidad (al lado comando FAN-Peaje) y Av. Ricaurte, Urb Industrial SOCO (frente Maviplanca) Teléfonos (0244)3 214878-3214723 Fax (0244) 3217054 - Apartado 109 – Código Postal 2121 – UPTA-FBF.</p>
        </footer>

    </body>
    </html>