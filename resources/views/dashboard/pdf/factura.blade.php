    <style>
        body {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
        }

        .header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 30px;
        }

        .header h1{
            position:absolute;
            top:43px;
            left:160px;
        } 

        .logo {
            background-color: #7c3aed;
            color: white;
            width: 32px;
            height: 32px;
            text-align: center;
            border-radius: 6px;
            font-weight: bold;
            font-size: 20px;
        }

        .logo span{
           position:relative;
           top:4px;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            margin: 0;
        }

        .invoice-details {
            background-color: #f3f4f6;
            padding: 15px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            margin-bottom: 20px;
        }

        .invoice-details div:last-child {
          margin-right: 50px; 
        }

        .label {
            color: #6b7280;
            font-size: 14px;
        }

        .billed-to {
            margin-bottom: 30px;
        }

        .billed-to h2 {
            font-size: 14px;
            margin-bottom: 5px;
        }

        .billed-to p {
            color: #6b7280;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
        }

        thead {
            background-color: #f3f4f6;
        }

        th {
            text-align: left;
            padding: 12px 16px;
            font-weight: 600;
            font-size: 14px;
        }

        th:nth-child(2) {
            text-align: center;
        }

        th:nth-child(3),
        th:nth-child(4) {
            text-align: right;
        }

        td {
            padding: 12px 16px;
            border-top: 1px solid #e5e7eb;
        }

        td:nth-child(2) {
            text-align: center;
        }

        td:nth-child(3),
        td:nth-child(4) {
            text-align: right;
        }

        .course-description {
            color: #6b7280;
            font-size: 14px;
            margin-top: 4px;
        }

        .div-right{
            position:absolute;
            right:225px;
            top:0;
        }

        .div-right img{
            position:absolute;
            top:41px;
        }

        .div-right h1{
            position:absolute;
            top:14px;
            left:35px;
        }

        .div-right span{
            position:absolute;
            left:84px;
        }

        .blue{
            color:#696bff;
        }

        .qr{
            position:absolute;
            top:200px;
            left:80%;
        }

    </style>
</head>
<body>
    <div class="header">
        <div class="logo"><span>$</span></div>
        <h1 class="title">RECIBO</h1>

        <div class="div-right">
            <img src="{{public_path().'/static/assets/img/favicon/favicon.ico'}}" alt="" width="30" height="30">
            <h1>Learn<span class="blue">X</span></h1>
        </div>
    </div>

    <div class="invoice-details">
        <div>
            <span class="label">Nro.: </span>
            <span>#{{$factura->codigo_ref}}</span>
        </div>
        <div>
            <span class="label">Fecha del pago: </span>
            <span>{{$fechaFormateada}}</span>
        </div>
        <div>
            <span class="label">Total Adeudado: </span>
            <span>${{$factura->curso->precio}}</span>
        </div>
    </div>

    <div class="billed-to">
        <h2>ADEUDADO A:</h2>
        <p>{{$nombre}} {{$apellido}} - CI: {{$cedula}}</p>
        <p><small>({{$email}})</small></p>

        <!--QR-->
        <div class="qr">
            <img src='{{public_path()."$qr" }}' alt="qr" width="80" height="80">
        </div>

    </div>

    <table>
        <thead>
            <tr>
                <th>Curso</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div>{{$factura->curso->nombre}}</div>
                    <div class="course-description">{{$descripcion}}</div>
                </td>
                <td>1</td>
                <td>${{$factura->curso->precio}}</td>
                <td>${{$factura->curso->precio}}</td>
            </tr>
        </tbody>
    </table>