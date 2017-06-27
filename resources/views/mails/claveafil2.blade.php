<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Confirmar Cuenta</title>
        <meta name="viewport" content="width=device-width" />
       <style type="text/css">
            @media only screen and (max-width: 550px), screen and (max-device-width: 550px) {
                body[yahoo] .buttonwrapper { background-color: transparent !important; }
                body[yahoo] .button { padding: 0 !important; }
                body[yahoo] .button a { background-color: #6dcff6; padding: 15px 25px !important; }
            }

            @media only screen and (min-device-width: 601px) {
                .content { width: 600px !important; }
                .col387 { width: 387px !important; }
            }
        </style>
    </head>
    <body bgcolor="#3b3f40" style="margin: 0; padding: 0;" yahoo="fix">
 
        <table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 100%; max-width: 600px;" class="content">
            <tr>
                <td align="center" bgcolor="#6dcff6" style="padding: 20px 20px 20px 20px; color: #ffffff; font-family: Arial, sans-serif; font-size: 36px; font-weight: bold;">
                    <img src="http://35.164.247.216/images/logo.png" alt="Atiempo" width="100" style="display:block;" />
                    <!-- url('images/logo.png')-->
                </td>
            </tr>
            <tr>
                <td align="center" bgcolor="#ffffff" style="padding: 40px 20px 40px 20px; color: #555555; font-family: Arial, sans-serif; font-size: 20px; line-height: 30px; border-bottom: 1px solid #f6f6f6;">
                
                
                	
                	
                	<h2>Estimad@ <br><br> </h2>
                    <b>Su solicitud ha sido rechazada `por parte del proveedor de la orden de servicio con los siguientes detalles</b>
                    <br/>
                    Detalles
                     </br>
                    </br>
                    <table border="0">
                       
                        <tr>
                            <td>Fecha de la cita</td>
                            <td>{{ $data['fecha_cita'] }}</td>
                        </tr>
                       
                       
                        <tr>
                            <td>Motivo</td>
                            <td>{{ $data['motivo'] }}</td>
                        </tr>
                        <tr>
                            <td>Servicio</td>
                            <td>{{ $data['servicio'] }}</td>
                        </tr>
                        <tr>
                            <td>Especialidad</td>
                            <td>{{ $data['especialidad'] }}</td>
                        </tr>
                        <tr>
                            <td>Procedimiento</td>
                            <td>{{ $data['procedimiento'] }}</td>
                        </tr>
                    </table>
                 
                    
                </td>
            </tr>
            <tr>
                <td align="center" bgcolor="#f9f9f9" style="padding: 30px 20px 30px 20px; font-family: Arial, sans-serif;">
                    
                </td>
            </tr>
            <tr>
                <td align="center" bgcolor="#dddddd" style="padding: 15px 10px 15px 10px; color: #555555; font-family: Arial, sans-serif; font-size: 12px; line-height: 18px;">
                    <p><b>{{ date('Y') }} Corporacion Atiempo - Todos los derechos reservados</b> <br> 
                    Desarrollado por <a href="http://brizerconsulting.com/" target="_blank">BrizerConsulting.com</a></p>
                </td>
            </tr>
        </table>
    </body>
</html>