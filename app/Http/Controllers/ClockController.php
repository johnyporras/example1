<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Carbon\Carbon;

class ClockController extends Controller
{   
    public function clock()
    {
        setlocale(LC_TIME, 'es_VE', 'es_VE.utf-8', 'es_VE.utf8'); 
        # Asi es mucho mas seguro que funciones, ya que no todos los sistemas llaman igual al locale ;)
		date_default_timezone_set('America/Caracas');
       	// Guardo y muestro facha con local obligado....
       	$mytime = Carbon::now();
        return $mytime;
    }
}