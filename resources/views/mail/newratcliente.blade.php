<!doctype html>
<html lang="en">

<head>
    <title>Sistema de Reporte en Atención Técnica - MadeIn</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-sm-12 m-auto">
                <p>Estimado {{ $Contacto->name }},</p>
                <br />
                <p>Se adjunta el reporte realizado en dependencias de {{ $Cliente->name }}, {{ $Cliente->ciudad }},
                    {{ $Cliente->direccion }}.</p>
                <br />
            </div>
        </div>
    </div>
</body>

</html>
