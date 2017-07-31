<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tarjetas de Prueba</title>
    <link rel="stylesheet" href="{{ url('plugins/bootstrap/css/bootstrap.min.css') }}">
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <h4>Tarjetas por 9</h4>
            <pre>{{ print_r($result) }}</pre>
            <h4>Tarjetas por 9 Encriptadas</h4>
            <pre>{{ print_r($encript) }}</pre>
        </div>
        <div class="col-xs-12">
            <h4>Tarjetas por 4</h4>
            <pre>{{ print_r($result1) }}</pre>
            <h4>Tarjetas por 4 Encriptadas</h4>
            <pre>{{ print_r($encript1) }}</pre>
        </div>
    </div>  
</div>

</body>
</html>