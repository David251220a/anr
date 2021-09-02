<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;


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
        
        
        $PDF = PDF::loadView('pdf.intendente_resumen',["votacion_intendente"=>$votacion_intendente
        , "aux"=>$aux]);      
                
        return $PDF->stream();
    }

    public function Resumen_Local(){

        $votacion_intendente = DB::table('votacion_intendente AS a')
        ->join('intendente AS b','b.Id_Intendente','=','a.Id_Intendente')        
        ->join('lista AS c','c.Id_Lista','=','b.Id_Lista')
        ->select('a.Id_Intendente'            
        , DB::raw('SUM(a.`Votos`) AS Votos')
        , 'b.Apellido'
        , 'b.Nombre'
        , 'c.Desc_Lista'
        , 'a.Id_Local')
        ->groupBy('a.Id_Intendente'
        , 'b.Apellido'
        , 'b.Nombre'
        , 'c.Desc_Lista'
        , 'a.Id_Local')
        ->orderBy('a.Id_Intendente', 'ASC')        
        ->get();
        
        $local_votacion = DB::table('local_votacion')
        ->orderBy('Id_Local', 'ASC' )
        ->get();        
                
        $PDF = PDF::loadView('pdf.intendente_local_resumen',["votacion_intendente"=>$votacion_intendente
        , "local_votacion"=>$local_votacion]);

        return $PDF->stream();
    }

    public function Resumen_Mesa(){

        $resumen_mesa = DB::table('votacion_intendente AS a')
        ->join('intendente AS b','b.Id_Intendente','=','a.Id_Intendente')
        ->join('mesa AS c','c.Id_Mesa','=','a.Id_Mesa')
        ->select('a.Id_Intendente'            
        , DB::raw('SUM(a.`Votos`) AS Votos')
        , 'b.Apellido'
        , 'b.Nombre'
        , 'a.Id_Mesa'
        , 'c.Mesa')        
        ->groupBy('a.Id_Intendente'
        , 'b.Apellido'
        , 'b.Nombre'
        , 'a.Id_Mesa'
        , 'c.Mesa')
        ->orderBy('a.Id_Intendente', 'ASC' )
        ->get();

        $intendente = DB::table('intendente')
        ->orderBy('Id_Intendente', 'ASC' )
        ->get();

        $PDF = PDF::loadView('pdf.intendente_mesa_resumen',["resumen_mesa"=>$resumen_mesa
        , "intendente"=>$intendente]);

        return $PDF->stream();

    }

    public function Intendente($id){
        
        $intendente = DB::table('votacion_intendente AS a')
        ->join('intendente AS b','b.Id_Intendente','=','a.Id_Intendente')        
        ->join('mesa AS e','e.Id_Mesa','=','a.Id_Mesa')
        ->where('a.Id_Intendente', '=', $id)
        ->orderBy('a.Id_Intendente', 'ASC')
        ->orderBy('a.Id_Local', 'ASC')
        ->orderBy('a.Id_Mesa', 'ASC')
        ->get();

        $aux_intendente = DB::table('intendente')
        ->where('Id_Intendente', '=', $id)
        ->first();

        $local_votacion = DB::table('local_votacion')
        ->orderBy('Id_Local', 'ASC' )
        ->get();

        $PDF = PDF::loadView('pdf.intendente',["local_votacion"=>$local_votacion
        , "aux_intendente"=>$aux_intendente
        , "intendente"=>$intendente]);

        return $PDF->stream();

    }

    public function Resumen_General_Consejal(){        

        $sql_Call = 'CALL consejal_resumen()';

        $votacion_consejal = DB::select($sql_Call);

        $PDF = PDF::loadView('pdf.consejal_resumen',compact('votacion_consejal'));      
                
        return $PDF->stream();
    }

    public function Resumen_Local_Consejal($id){        

        $sql_Call = 'CALL consejal_local(?)';
        $votacion_consejal = DB::select($sql_Call, array($id)); 
        
        $local_votacion = DB::table('local_votacion')
        ->orderBy('Id_Local', 'ASC' )
        ->get();        
        
        $PDF = PDF::loadView('pdf.consejal_local_resumen', compact('votacion_consejal', 'local_votacion', 'id'));
                
        return $PDF->stream();
    }
 
    public function Resumen_Mesa_Consejal(){

        $resumen_mesa = DB::table('votacion_consejal AS a')
        ->join('consejal AS b','b.Id_Consejal','=','a.Id_Consejal')
        ->join('mesa AS c','c.Id_Mesa','=','a.Id_Mesa')
        ->select('a.Id_Consejal'            
        , DB::raw('SUM(a.`Votos`) AS Votos')
        , 'b.Apellido'
        , 'b.Nombre'
        , 'a.Id_Mesa'
        , 'c.Mesa')        
        ->groupBy('a.Id_Consejal'
        , 'b.Apellido'
        , 'b.Nombre'
        , 'a.Id_Mesa'
        , 'c.Mesa')
        ->orderBy('a.Id_Consejal', 'ASC' )
        ->get();

        $consejal = DB::table('consejal')
        ->orderBy('Id_Consejal', 'ASC' )
        ->get();

        $total = DB::table('votacion_consejal')
        ->select('Id_Consejal'            
        , DB::raw('SUM(`Votos`) AS Votos')        
        , 'Id_Mesa')               
        ->groupBy('Id_Consejal'        
        , 'Id_Mesa')
        ->orderBy('Id_Consejal', 'ASC' )
        ->get();

        $PDF = PDF::loadView('pdf.consejal_mesa_resumen',["resumen_mesa"=>$resumen_mesa
        , "consejal"=>$consejal
        , "total"=>$total]);

        return $PDF->stream();

    }

    public function Consejal($id){
        
        $consejal = DB::table('votacion_consejal AS a')
        ->join('consejal AS b','b.Id_Consejal','=','a.Id_Consejal')        
        ->join('mesa AS e','e.Id_Mesa','=','a.Id_Mesa')
        ->where('a.Id_Consejal', '=', $id)
        ->orderBy('a.Id_Consejal', 'ASC')
        ->orderBy('a.Id_Local', 'ASC')
        ->orderBy('a.Id_Mesa', 'ASC')
        ->get();

        $aux_consejal = DB::table('consejal')
        ->where('Id_Consejal', '=', $id)
        ->first();

        $local_votacion = DB::table('local_votacion')
        ->orderBy('Id_Local', 'ASC' )
        ->get();

        $PDF = PDF::loadView('pdf.consejal',["local_votacion"=>$local_votacion
        , "aux_consejal"=>$aux_consejal
        , "consejal"=>$consejal]);

        return $PDF->stream();

    }

    public function Lista(){
        
        $consejal = DB::table('votacion_consejal AS a')
        ->join('consejal AS b','b.Id_Consejal','=','a.Id_Consejal')        
        ->join('lista AS c','c.Id_Lista','=','b.Id_Lista')
        ->select('b.Id_Lista'
        , 'a.Id_Consejal'
        , 'b.Nombre'
        , 'b.Apellido'
        , DB::raw('SUM(a.`Votos`) AS Votos')
        , 'c.Desc_Lista')
        ->where('b.Id_Lista','=', 8)
        ->groupBy('b.Id_Lista'
        , 'a.Id_Consejal'
        , 'b.Nombre'
        , 'b.Apellido'
        , 'c.Desc_Lista')                
        ->orderBy('b.Id_Lista', 'Asc')
        ->orderBy('a.Id_Consejal', 'Asc')
        ->get();

        $lista = DB::table('lista_consejal')
        ->where('Id_Lista','=', 8)
        ->orderBy('Id_Lista', 'ASC' )
        ->get();

        $consejal_monto = DB::table('votacion_consejal AS a')
        ->join('consejal AS b','b.Id_Consejal','=','a.Id_Consejal')        
        ->join('lista AS c','c.Id_Lista','=','b.Id_Lista')
        ->where('b.Id_Lista','=', 8)
        ->select('b.Id_Lista'            
        , DB::raw('SUM(a.`Votos`) AS Votos')
        , 'c.Desc_Lista')
        ->groupBy('b.Id_Lista'
        , 'c.Desc_Lista')                
        ->orderBy(DB::raw('SUM(a.`Votos`)'), 'DESC')
        ->get();
    
        $PDF = PDF::loadView('pdf.consejal_lista',["consejal"=>$consejal
        , "lista"=>$lista
        , "consejal_monto"=>$consejal_monto]);

        return $PDF->stream();

    }

    public function Lista_resumen(){
        
        $consejal = DB::table('votacion_consejal AS a')
        ->join('consejal AS b','b.Id_Consejal','=','a.Id_Consejal')        
        ->join('lista AS c','c.Id_Lista','=','b.Id_Lista')
        ->select('b.Id_Lista'            
        , DB::raw('SUM(a.`Votos`) AS Votos')
        , 'c.Desc_Lista')
        ->groupBy('b.Id_Lista'
        , 'c.Desc_Lista')                
        ->orderBy(DB::raw('SUM(a.`Votos`)'), 'DESC')
        ->get();
        

        $PDF = PDF::loadView('pdf.consejal_lista',["consejal"=>$consejal]);

        return $PDF->stream();

    }

    public function electores(){

        $electores = DB::table('electores')
        ->orderBy('Orden', 'ASC')
        ->get();

        return view('pdf.electores', compact('electores'));

    }

    public function electores_pdf(){

        $electores = DB::table('electores')
        ->orderBy('Orden', 'ASC')
        ->get();

        $PDF = PDF::loadView('pdf.electores_pdf',["electores"=>$electores]);      
                
        return $PDF->stream();

    }

    public function electores_pdf_descargar(){

        $electores = DB::table('electores')
        ->orderBy('Orden', 'ASC')
        ->get();

        $PDF = PDF::loadView('pdf.electores_pdf',["electores"=>$electores]);      
                
        return $PDF->download();

    }

    public function referentes($id){
        
        $id_user = auth()->id();

        $sql_Call = 'CALL padron_comprometido(?, ?)';

        $comprometidos = DB::select($sql_Call, array($id_user, $id)); 

        $PDF = PDF::loadView('pdf.referentes', compact('comprometidos', 'id'));
                
        return $PDF->stream();

    }


}

