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

    public function consejal(Request $request){

        $id_consejal=trim($request->get('id_consejal'));

        if(empty($id_consejal)){

            $id_consejal = 1;

        }

        $sql_Call = 'CALL consejal(?)';

        $votacion_consejal = DB::select($sql_Call, array($id_consejal)); 

        $local_votacion = DB::table('local_votacion')
        ->orderBy('Id_Local', 'ASC' )
        ->get();

        $consejales = DB::table('consejal AS a')
        ->join('lista AS b', 'b.Id_Lista', '=', 'a.Id_Lista')
        ->select('a.Id_Consejal'
        , DB::raw('CONCAT(a.Nombre, " ", a.Apellido, " ", b.Desc_Lista, " OPCION = ", a.Orden) AS consejal'))
        ->orderBy('a.Id_Consejal', 'ASC' )
        ->get();

        return view('reportes.consejal.consejal', compact('votacion_consejal', 'local_votacion', 'id_consejal', 'consejales'));

    }

    public function general_intendente(){

        $sql_Call = 'CALL intendente_resumen()';

        $votacion_intendente = DB::select($sql_Call); 

        return view('reportes.intendente.general_intendente', compact('votacion_intendente'));

    }

    public function intendente_local(Request $request){

        $local=trim($request->get('local'));

        $local_votacion = DB::table('local_votacion')
        ->orderBy('Id_Local', 'ASC' )
        ->get();

        $sql_Call = 'CALL intendente_local(?)';

        if((empty($local)) || ($local == 99)){

            $local = 99;
            $votacion_intendente = DB::select($sql_Call, array($local)); 

        }else{

            $votacion_intendente = DB::select($sql_Call, array($local)); 

        }

        return view('reportes.intendente.local_intendente', compact('local', 'local_votacion', 'votacion_intendente'));

    }

    public function intendente_mesa(Request $request){
        
        $id_intendente=trim($request->get('id_intendente'));

        $intendentes = DB::table('intendente AS a')
        ->join('lista AS b', 'b.Id_Lista', '=', 'a.Id_Lista')
        ->select('a.Id_Intendente'
        , DB::raw('CONCAT(a.Nombre, " ", a.Apellido, " ", b.Desc_Lista, " - ", b.Alias) AS intendente'))
        ->orderBy('a.Id_Lista', 'ASC' )
        ->get();

        $sql_Call = 'CALL intendente_mesa(?)';

        if((empty($id_intendente)) || ($id_intendente == 9999)){

            $id_intendente = 9999;
            $votacion_intendente = DB::select($sql_Call, array($id_intendente)); 

        }else{

            $votacion_intendente = DB::select($sql_Call, array($id_intendente)); 

        }

        return view('reportes.intendente.mesa_intendente', compact('id_intendente', 'votacion_intendente', 'intendentes'));

    }

    public function intendente(Request $request){

        $id_intendente=trim($request->get('id_intendente'));

        if(empty($id_intendente)){

            $id_intendente = 1;

        }

        $sql_Call = 'CALL intendente(?)';

        $votacion_intendente = DB::select($sql_Call, array($id_intendente)); 

        $local_votacion = DB::table('local_votacion')
        ->orderBy('Id_Local', 'ASC' )
        ->get();

        $intendentes = DB::table('intendente AS a')
        ->join('lista AS b', 'b.Id_Lista', '=', 'a.Id_Lista')
        ->select('a.Id_Intendente'
        , DB::raw('CONCAT(a.Nombre, " ", a.Apellido, " ", b.Desc_Lista, " - ", b.Alias) AS intendente'))
        ->orderBy('a.Id_Lista', 'ASC' )
        ->get();

        return view('reportes.intendente.intendente', compact('votacion_intendente', 'local_votacion', 'id_intendente', 'intendentes'));

    }

}
