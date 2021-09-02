<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteConsejalController extends Controller{
    
    public function general_consejal(){

        $sql_Call = 'CALL consejal_resumen()';

        $votacion_consejal = DB::select($sql_Call); 

        return view('reportes.consejal.general_consejal', compact('votacion_consejal'));

    }

}
