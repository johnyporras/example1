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
<p>Pagos pendientes de su cuenta</p>
    <table class="table" id="table">
        <thead>
            <tr>
                <th class="text-center">Id</th>
                <th class="text-center">Fecha de Corte</th>
                <th class="text-center">Estatus</th>
                <th class="text-center">Monto</th>
                <th class="text-center">Seleccione</th>
            </tr>
        </thead>
        <tbody>
   @if(is_object($rsPagos))
     @foreach($rsPagos as $item)
    <tr id="{{$item->id}}" class="row1"  data-montimp="" data-idprov="">
        <td>{{$item->id}}</td>
        <td id="numfact{{$item->id}}">{{$item->fechacorte}}</td>
        <td id="numcon{{$item->id}}">{{$item->estatus}}</td>
        <td id="cant{{$item->id}}">{{$item->monto}}</td>
        <td>
        	<input type="checkbox" name="{{$item->id}}" id="{{$item->id}}" data-monto="{{$item->monto}}" class="checkpago">    
        </td>
    </tr>
    @endforeach
    @endif
        </tbody>
    </table>
    
      <p> Total a Pagar <span id="montopago"></span></p>
     <br>
     <br> 
 </div>
 
 <div class="col-sm-2">
 </div>
 </div>
 