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

    public function consejal_local(Request $request){

        $local=trim($request->get('local'));

        $local_votacion = DB::table('local_votacion')
        ->orderBy('Id_Local', 'ASC' )
        ->get();

        $sql_Call = 'CALL consejal_local(?)';

        if((empty($local)) || ($local == 99)){

            $local = 99;
            $votacion_consejal = DB::select($sql_Call, array($local)); 

        }else{

            $votacion_consejal = DB::select($sql_Call, array($local)); 

        }

        return view('reportes.consejal.local_consejal', compact('local', 'local_votacion', 'votacion_consejal'));

    }

}
