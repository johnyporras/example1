@extends('layouts.app')
@section('title','Pagos')
@section('content') 

   <script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script
    src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet"
    href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet"
    href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
<div class="row">
<div class="col-sm-2">
</div>
<div class="col-sm-8">
<p>Listado de Citas</p>
    <table class="table" id="table">
        <thead>
            <tr>
                <th class="text-center">Id</th>
                <th class="text-center">Fecha</th>
                <th class="text-center">Hora</th>
                <th class="text-center">Afiliado</th>
                
            </tr>
        </thead>
        <tbody>
     @foreach($result as $item)
    <tr id="$item['id']" class="row1">
        <td >{{ $item['id'] }}</td>
        <td>{{ $item['fecha'] }}</td>
        <td>{{ $item['hora']}}</td>
        <td>{{ $item['afiliado'] }}</td>
       
    </tr>
    @endforeach
        </tbody>
    </table>
    
   
     <br>
     <br> 
 </div>
 
 <div class="col-sm-2">
 </div>
 </div>
 

@endsection
@section('script')
<script>
 $('#table').DataTable({

	"columnDefs": [
        {"className": "dt-center", "targets": "_all"}
      ],
	"searching":true,
	"paging":true,
	"info":true
});
  	
 </script>
@endsection
