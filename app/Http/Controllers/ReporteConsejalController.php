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

    public function consejal_mesa(Request $request){
        
        $id_consejal=trim($request->get('id_consejal'));

        $consejales = DB::table('consejal AS a')
        ->join('lista AS b', 'b.Id_Lista', '=', 'a.Id_Lista')
        ->select('a.Id_Consejal'
        , DB::raw('CONCAT(a.Nombre, " ", a.Apellido, " ", b.Desc_Lista, " OPCION = ", a.Orden) AS consejal'))
        ->orderBy('a.Id_Consejal', 'ASC' )
        ->get();

        $sql_Call = 'CALL consejal_mesa(?)';

        if((empty($id_consejal)) || ($id_consejal == 9999)){

            $id_consejal = 9999;
            $votacion_consejal = DB::select($sql_Call, array($id_consejal)); 

        }else{

            $votacion_consejal = DB::select($sql_Call, array($id_consejal)); 

        }

        return view('reportes.consejal.mesa_consejal', compact('id_consejal', 'votacion_consejal', 'consejales'));

    }

}
