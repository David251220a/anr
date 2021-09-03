<?php

namespace App\Http\Controllers;

use App\Padron;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;


class PDFController extends Controller
{
    
    public function __construct(){

        $this->middleware('auth');

    }

    public function Resumen_General(){

        $sql_Call = 'CALL intendente_resumen()';

        $votacion_intendente = DB::select($sql_Call); 
        
        $PDF = PDF::loadView('pdf.intendente_resumen', compact('votacion_intendente'));
                
        return $PDF->stream();
    }

    public function Resumen_Local($id){

        $sql_Call = 'CALL intendente_local(?)';
        $votacion_intendente = DB::select($sql_Call, array($id)); 
        
        $local_votacion = DB::table('local_votacion')
        ->orderBy('Id_Local', 'ASC' )
        ->get();        
        
        $PDF = PDF::loadView('pdf.intendente_local_resumen', compact('votacion_intendente', 'local_votacion', 'id'));

        return $PDF->stream();
    }

    public function Resumen_Mesa($id){

        $intendentes = DB::table('intendente AS a')
        ->join('lista AS b', 'b.Id_Lista', '=', 'a.Id_Lista')
        ->select('a.Id_Intendente'
        , DB::raw('CONCAT(a.Nombre, " ", a.Apellido, " ", b.Desc_Lista, " - ", b.Alias) AS intendente'))
        ->orderBy('a.Id_Lista', 'ASC' )
        ->get();

        $sql_Call = 'CALL intendente_mesa(?)';

        $votacion_intendente = DB::select($sql_Call, array($id)); 
        
        $PDF = PDF::loadView('pdf.intendente_mesa_resumen', compact('id', 'votacion_intendente', 'intendentes'));

        return $PDF->stream();

    }

    public function Intendente($id){
        
        $sql_Call = 'CALL intendente(?)';

        $votacion_intendente = DB::select($sql_Call, array($id)); 

        $local_votacion = DB::table('local_votacion')
        ->orderBy('Id_Local', 'ASC' )
        ->get();
        
        $intendente = DB::table('intendente AS a')
        ->join('lista AS b', 'b.Id_Lista', '=', 'a.Id_Lista')
        ->select('a.Id_Intendente'
        , DB::raw('CONCAT(a.Nombre, " ", a.Apellido, " ", b.Desc_Lista, " - ", b.Alias) AS intendente'))
        ->where('a.Id_Intendente', $id)
        ->orderBy('a.Id_Intendente', 'ASC' )
        ->first();

        $PDF = PDF::loadView('pdf.intendente', compact('votacion_intendente', 'intendente', 'local_votacion'));

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
 
    public function Resumen_Mesa_Consejal($id){

        $consejales = DB::table('consejal AS a')
        ->join('lista AS b', 'b.Id_Lista', '=', 'a.Id_Lista')
        ->select('a.Id_Consejal'
        , DB::raw('CONCAT(a.Nombre, " ", a.Apellido, " ", b.Desc_Lista, " OPCION = ", a.Orden) AS consejal'))
        ->orderBy('a.Id_Consejal', 'ASC' )
        ->get();

        $sql_Call = 'CALL consejal_mesa(?)';

        $votacion_consejal = DB::select($sql_Call, array($id)); 
        
        $PDF = PDF::loadView('pdf.consejal_mesa_resumen', compact('id', 'votacion_consejal', 'consejales'));

        return $PDF->stream();

    }

    public function Consejal($id){
        
        $sql_Call = 'CALL consejal(?)';

        $votacion_consejal = DB::select($sql_Call, array($id)); 

        $local_votacion = DB::table('local_votacion')
        ->orderBy('Id_Local', 'ASC' )
        ->get();
        
        $consejal = DB::table('consejal AS a')
        ->join('lista AS b', 'b.Id_Lista', '=', 'a.Id_Lista')
        ->select('a.Id_Consejal'
        , DB::raw('CONCAT(a.Nombre, " ", a.Apellido, " ", b.Desc_Lista, " OPCION = ", a.Orden) AS consejal'))
        ->where('Id_Consejal', $id)
        ->orderBy('a.Id_Consejal', 'ASC' )
        ->first();

        $PDF = PDF::loadView('pdf.consejal', compact('votacion_consejal', 'consejal', 'local_votacion'));

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

    public function padron_persona($id){

        $persona = Padron::where('CodPadron', $id)
        ->join('local_votacion','local_votacion.Id_Local', '=', 'padron.local')
        ->first();

        $PDF = PDF::loadView('pdf.padron', compact('persona'));
                
        return $PDF->stream();        

    }


}

