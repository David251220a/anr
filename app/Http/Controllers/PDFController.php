<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Requests\PersonaFormRequest;
use illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class PDFController extends Controller
{
    
    public function __construct(){

        $this->middleware('auth');

    }

    public function Resumen_General(){

        $sql_Call = 'CALL pdf_resumen_general()';

        $votacion_intendente = DB::select($sql_Call);
        
        $aux = DB::table('votacion_intendente')        
        ->select('Id_Intendente'            
        , DB::raw('COUNT(`Votos`) AS cont'))        
        ->groupBy('Id_Intendente')            
        ->first();
        
        
        $PDF = PDF::loadView('pdf\intendente_resumen',["votacion_intendente"=>$votacion_intendente
        , "aux"=>$aux]);      
                
        return $PDF->stream();
    }

    public function Resumen_Local(){

        $local1 = DB::table('votacion_intendente AS a')
        ->join('intendente AS b','b.Id_Intendente','=','a.Id_Intendente')
        ->join('lista AS c','c.Id_Lista','=','b.Id_Lista')
        ->join('local_votacion AS d','d.Id_Local','=','a.Id_Local')
        ->select('a.Id_Intendente'            
        , DB::raw('SUM(a.`Votos`) AS Votos')
        , 'b.Apellido'
        , 'b.Nombre'
        , 'a.Id_Local'
        , 'd.Desc_Local'
        , 'b.Id_Lista'
        , 'c.Desc_Lista')
        ->where('a.Id_Local', '=' , 1)
        ->groupBy('a.Id_Intendente'
        , 'b.Apellido'
        , 'b.Nombre'
        , 'a.Id_Local'
        , 'd.Desc_Local'
        , 'b.Id_Lista'
        , 'c.Desc_Lista')
        ->orderBy('a.Id_Intendente'
        , 'ASC' )
        ->get();

        $local1_desc = DB::table('local_votacion')
        ->where('Id_Local', '=' , 1)
        ->first();

        $local2 = DB::table('votacion_intendente AS a')
        ->join('intendente AS b','b.Id_Intendente','=','a.Id_Intendente')
        ->join('lista AS c','c.Id_Lista','=','b.Id_Lista')
        ->join('local_votacion AS d','d.Id_Local','=','a.Id_Local')
        ->select('a.Id_Intendente'            
        , DB::raw('SUM(a.`Votos`) AS Votos')
        , 'b.Apellido'
        , 'b.Nombre'
        , 'a.Id_Local'
        , 'd.Desc_Local'
        , 'b.Id_Lista'
        , 'c.Desc_Lista')
        ->where('a.Id_Local', '=' , 2)
        ->groupBy('a.Id_Intendente'
        , 'b.Apellido'
        , 'b.Nombre'
        , 'a.Id_Local'
        , 'd.Desc_Local'
        , 'b.Id_Lista'
        , 'c.Desc_Lista')
        ->orderBy('a.Id_Intendente'
        , 'ASC' )
        ->get();

        $local2_desc = DB::table('local_votacion')
        ->where('Id_Local', '=' , 2)
        ->first();

        $local3 = DB::table('votacion_intendente AS a')
        ->join('intendente AS b','b.Id_Intendente','=','a.Id_Intendente')
        ->join('lista AS c','c.Id_Lista','=','b.Id_Lista')
        ->join('local_votacion AS d','d.Id_Local','=','a.Id_Local')
        ->select('a.Id_Intendente'            
        , DB::raw('SUM(a.`Votos`) AS Votos')
        , 'b.Apellido'
        , 'b.Nombre'
        , 'a.Id_Local'
        , 'd.Desc_Local'
        , 'b.Id_Lista'
        , 'c.Desc_Lista')
        ->where('a.Id_Local', '=' , 3)
        ->groupBy('a.Id_Intendente'
        , 'b.Apellido'
        , 'b.Nombre'
        , 'a.Id_Local'
        , 'd.Desc_Local'
        , 'b.Id_Lista'
        , 'c.Desc_Lista')
        ->orderBy('a.Id_Intendente'
        , 'ASC' )
        ->get();

        $local3_desc = DB::table('local_votacion')
        ->where('Id_Local', '=' , 3)
        ->first();
        
        $local4 = DB::table('votacion_intendente AS a')
        ->join('intendente AS b','b.Id_Intendente','=','a.Id_Intendente')
        ->join('lista AS c','c.Id_Lista','=','b.Id_Lista')
        ->join('local_votacion AS d','d.Id_Local','=','a.Id_Local')
        ->select('a.Id_Intendente'            
        , DB::raw('SUM(a.`Votos`) AS Votos')
        , 'b.Apellido'
        , 'b.Nombre'
        , 'a.Id_Local'
        , 'd.Desc_Local'
        , 'b.Id_Lista'
        , 'c.Desc_Lista')
        ->where('a.Id_Local', '=' , 4)
        ->groupBy('a.Id_Intendente'
        , 'b.Apellido'
        , 'b.Nombre'
        , 'a.Id_Local'
        , 'd.Desc_Local'
        , 'b.Id_Lista'
        , 'c.Desc_Lista')
        ->orderBy('a.Id_Intendente'
        , 'ASC' )
        ->get();

        $local4_desc = DB::table('local_votacion')
        ->where('Id_Local', '=' , 4)
        ->first();
        
        $local5 = DB::table('votacion_intendente AS a')
        ->join('intendente AS b','b.Id_Intendente','=','a.Id_Intendente')
        ->join('lista AS c','c.Id_Lista','=','b.Id_Lista')
        ->join('local_votacion AS d','d.Id_Local','=','a.Id_Local')
        ->select('a.Id_Intendente'            
        , DB::raw('SUM(a.`Votos`) AS Votos')
        , 'b.Apellido'
        , 'b.Nombre'
        , 'a.Id_Local'
        , 'd.Desc_Local'
        , 'b.Id_Lista'
        , 'c.Desc_Lista')
        ->where('a.Id_Local', '=' , 5)
        ->groupBy('a.Id_Intendente'
        , 'b.Apellido'
        , 'b.Nombre'
        , 'a.Id_Local'
        , 'd.Desc_Local'
        , 'b.Id_Lista'
        , 'c.Desc_Lista')
        ->orderBy('a.Id_Intendente'
        , 'ASC' )
        ->get();

        $local5_desc = DB::table('local_votacion')
        ->where('Id_Local', '=' , 5)
        ->first();
        
        $PDF = PDF::loadView('pdf\intendente_local_resumen',["local1"=>$local1
        , "local1_desc"=>$local1_desc
        , "local2"=>$local2
        , "local3_desc"=>$local3_desc
        , "local3"=>$local3
        , "local4_desc"=>$local4_desc
        , "local4"=>$local4
        , "local5_desc"=>$local5_desc
        , "local5"=>$local5
        , "local2_desc"=>$local2_desc ]);
                
        return $PDF->stream();
    }

    
}
