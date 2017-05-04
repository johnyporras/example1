$(document).ready(function() {
	// Funcion del reloj
	var $dOut = $('.clock-date'),
    	$hOut = $('.clock-hours'),
    	$mOut = $('.clock-minutes'),
    	$sOut = $('.clock-seconds'),
    	$ampmOut = $('.clock-ampm');

	var months = [
		'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
	];

	var days = [
	  'Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'
	];

	function update(){

		$.ajax({
	        url: '/api/clock',
	        success: function(data) {
	          dia = data;
	        },
	    });

		 var date = new Date(dia);
		  
		 var ampm = date.getHours() < 12
		            ? 'AM'
		            : 'PM';
		  
		 var hours = date.getHours() == 0
		            ? 12
		            : date.getHours() > 12
		            ? date.getHours() - 12
		            : date.getHours();
		  
		 var minutes = date.getMinutes() < 10 
		            ? '0' + date.getMinutes() 
		            : date.getMinutes();
		  
		 var seconds = date.getSeconds() < 10 
		            ? '0' + date.getSeconds() 
		            : date.getSeconds();
		  
		 var dayOfWeek = days[date.getDay()];
		 var month = months[date.getMonth()];
		 var day = date.getDate();
		 var year = date.getFullYear();
		  
		 var dateString = dayOfWeek + ', ' + day + ' ' + month + ', ' + year;
		  
		 $dOut.text(dateString);
		 $hOut.text(hours);
		 $mOut.text(minutes);
		 $sOut.text(seconds);
		 $ampmOut.text(ampm);
	}
	window.setInterval(update, 1000);

});