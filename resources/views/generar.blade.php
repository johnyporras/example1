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
            <h4>Tarjetas Producto A-MEMBER</h4>
            @foreach ($result as $value)
               {{ $value }}<br>
            @endforeach 
            <h4>Tarjetas Producto A-MEMBER Encriptadas</h4>
            @foreach ($encript as $value)
               {{ $value }}<br>
            @endforeach 
        </div>
    </div>  
</div>

</body>
</html>