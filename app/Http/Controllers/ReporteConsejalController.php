<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteConsejalController extends Controller{
    
    public function general_consejal(){

        $votacion_consejal = DB::table('votacion_consejal AS a')
        ->join('consejal AS b','b.Id_Consejal','=','a.Id_Consejal')        
        ->join('lista AS c','c.Id_Lista','=','b.Id_Lista')
        ->select('a.Id_Consejal'            
        , DB::raw('SUM(a.`Votos`) AS Votos')
        , 'b.Apellido'
        , 'b.Nombre'
        , 'c.Desc_Lista')            
        ->groupBy('a.Id_Consejal'
        , 'b.Apellido'
        , 'b.Nombre'
        , 'c.Desc_Lista')
        // ->where(DB::raw('SUM(a.`Votos`) AS Votos'), '>=', 1)
        ->orderBy('a.Id_Consejal', 'ASC')
        ->get();

        return view('reportes.consejal.general_consejal', compact('votacion_consejal'));

    }

}
