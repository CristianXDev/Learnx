<html>
<head>


    <style>

        body{
            margin: 3cm 2cm 2cm;
        }

        header {
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
            top:7px;
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

</style>
</head>
<body>
    <div class="body">
        <header>

            <div class="div-right">
                <img src="{{public_path().'/static/assets/img/favicon/favicon.ico'}}" alt="" width="50" height="50">
                <h2>LearnX</h2>
            </div>

            <div class="center">
                <p>REPÚBLICA BOLIVARIANA DE VENEZUELA</p>
                <p>MINISTERIO DEL PODER POPULAR PARA LA EDUCACION UNIVERSITARIA</p>
                <p>UNIVERSIDAD POLITÉCNICA TERRITORIAL DEL ESTADO ARAGUA</p>
                <p>“FEDERICO BRITO FIGUEROA”</p>
                <p>DEPARTAMENTO DE  INFORMÁTICA</p>
                <p>LA VICTORIA- ESTADO ARAGUA</p>
            </div>
            

            <div class="div-left">
                <img src="{{public_path().'/static/assets/img/others/upta.png'}}" alt="" width="90" height="80">
            </div>

        </header>

        <main>
            
            <div class="main-center">
                <h2>RETROALIMENTACIÓN</h2>
            </div>

            @foreach ($secciones as $seccion)
             {!! $seccion !!}
            @endforeach

        </main>

    </body>
    </html>