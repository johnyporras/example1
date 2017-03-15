@extends('layouts.app')
@section('title','Permisos a Perfiles')
@section('content')

<h2>Módulos del sistema</h2>
<div class="row">
  <div class="col-sm-6">
    
    <div id="treeview5" class=""></div>
  </div>

<div class="col-sm-4">
<div class="row">
  <select multiple="" class="form-control" id="perfil" style="height:130px;">
          
  </select>
</div>

<div class="row" style="margin-top:60px;">

<p>Módulo: <span id="txtmodulo"></span></p>

<p>Usuario: <span id="txtusuario"></span></p>

  

</div>

<div class="row">
  <input type="checkbox" id="datapermiso" class="form-control">
  Tiene Permiso
  <input type="button" id="btnactpermiso" value="actualizar" class="form-control">
</div>
</div>

</div>

 
 @endsection



 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>


<script src="{{url('/')}}/js/bootstrap-treeview.js"></script>




<script>



$(document).ready(function(){
    
  var url = 'leerModulos';
  var moduloActual=null;
  var usuarioActual=null;
  var params = {
  }

  $.get(url,params,function(data){
    $('#treeview5').treeview({
          color: "#428bca",
          expandIcon: 'glyphicon glyphicon-chevron-right',
          collapseIcon: 'glyphicon glyphicon-chevron-down',
          nodeIcon: 'glyphicon glyphicon-bookmark',
          data:data,
          state: {
            expanded: false
          },

        onNodeSelected: function(event, data) {
          moduloActual=data.id;
          $('#txtmodulo').html(data.text);
        }

        });
    $('#treeview5').treeview('collapseAll', { silent: true });
  });

  

  var url2 = 'leerTipoUsuarios';
  $.get(url2,params,function(data1)
  {
      var h = eval('(' + data1 + ')');
      var des = '';
      var id = '';
      $("#perfil").empty();
      for(i=0;i<h.length;i++)
      {
        des = h[i].name;
        id = h[i].id;
        $("#perfil").append("<option value=\""+id+"\">"+des+"</option>");
      }
    })

  $("#perfil").on('click',function(data)
  {    
    url2="leerPermisos";
    usuarioActual=$("#perfil option:selected").val();
    $('#txtusuario').html($("#perfil option:selected").text());

    var params =
    {
      'perfil1':usuarioActual,
      'modulo':moduloActual
    }
    $.getJSON(url2,params,function(data)
    {
      
      if(data.permiso==false)
      {
        $('#datapermiso').prop('checked', false);
      }
      else
      {
        $('#datapermiso').prop('checked', true);
      }
    })
  })



  $("#btnactpermiso").on('click',function(data)
  {    
    url2="incPermiso";
    usuarioActual=$("#perfil option:selected").val();
    $('#txtusuario').html($("#perfil option:selected").text());
    permiso= $('#datapermiso').is(':checked');
    var params =
    {
      'perfil':usuarioActual,
      'modulo':moduloActual,
      'permiso':permiso
    }

    $.getJSON(url2,params,function(data)
    {
      if(data)
      {
        $("#result").addClass("alert alert-danger");
        $("#result").html("Los permisos fueron actualizados con éxito.");
        //location.href='permisos';
      }
    })
  })

  })


</script>
