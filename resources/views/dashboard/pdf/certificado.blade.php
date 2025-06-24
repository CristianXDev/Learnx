<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificado de participación</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body{
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-family: Arial, sans-serif;
        }

        .certificate{
            width: 1000px;
            height: 600px;
            padding: 40px;
            position: relative;
            top:100px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        .content{
            text-align: center;
            padding: 20px;
            position: relative;
            z-index: 1;
        }

        h1{
            color: #03045e;
            font-size: 48px;
            margin-bottom: 10px;
            letter-spacing: 2px;
        }

        h2{
            color: #03045e;
            font-size: 24px;
            margin-bottom: 40px;
            font-weight: normal;
        }

        strong{
           color: #03045e;
        }

        .recipient{
            color: #03045e;
            font-size: 36px;
            font-weight: bold;
            margin: 20px 0 20px 0;
            padding-bottom: 10px;
        }

        .description{
            color: #666;
            margin: 20px auto;
            max-width: 600px;
            line-height: 1.6;
        }

        .footer{
            margin-top: 40px;
        }

        .footer-left {
            float: left;
            width: 48%;
        }

        .footer-left h1{
            margin-top:30px;
            color:#111;
            display:inline;
            font-size:23px;
        } 


        .footer-right {
            float: right;
            width: 48%;
        }

        .signature-line {
            width: 200px;
            border-top: 2px solid #03045e;
            margin-top: 10px;
            padding-top: 5px;
        }

        .date{
           position:absolute;
           bottom:150px;
           left:80px;
        }

        .teacher{
           position:absolute;
           bottom:150px;
           right:75px;
        }

        .seal {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            margin: 0 20px;
        }

        .qr{
            position:absolute;
            bottom:15px;
            left:430px;
        }

         .qr img{
            position:absolute;
            top:340px;
            left:0px;
         }

        .gray{
            color:#666;
            font-size:12px;
        }
        .blue{
            color:#696bff;
        }

    </style>
</head>
<body style="background-image: url({{ public_path() . '/static/assets/img/others/certificado.jpg' }}); background-repeat: no-repeat; background-size: cover; height: 100%; width: 100%; margin: 0; padding: 0;">
    <div class="certificate">
        <div class="content">
            <h1>CERTIFICADO</h1>
            <h2>DE PARTICIPACIÓN</h2>
            <p>Este certificado se presenta con orgullo a:</p>
            <div class="recipient">{{$nombre}} {{$apellido}}</div>
            <p class="description">En reconocimiento a su destacada participación y finalización exitosa del curso de  <strong>{{$nombreCurso}}</strong> ofrecido por LearnX. a lo largo del curso, el beneficiario ha demostrado un compromiso excepcional y ha adquirido habilidades y conocimientos necesarios ejercer esta área.</p>
            <div class="footer">

                <div class="footer-left">
                    <div>
                     <img src="{{public_path().'/static/assets/img/favicon/favicon.ico'}}" alt="" width="20" height="20">
                     <h1>Learn<span class="blue">X</span></h1>
                    </div>
                </div>

                <div class="footer-right">
                    <div>
                         <img src="{{public_path().'/static/assets/img/others/firma-digital.png'}}" alt="" width="80" height="50">
                    </div>
                </div>

            </div>

            <!--QR-->
            <div class="qr"><
                <img src='{{public_path()."$qr" }}' alt="qr" width="150" height="150">
                <p class="gray"><small>Para validar el certificado</small></p>
            </div>

        </div>
    </div>
</body>
</html>