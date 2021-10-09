<?php

namespace App\Http\Controllers;

use App\Padron;
use App\Padron_Comprometido;
use App\User;
use App\Votacion_Consejal;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;


class PDFController extends Controller
{

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

    public function Lista($id){
        
        $sql_Call = 'CALL consejal_lista(?)';
        $votacion_consejal = DB::select($sql_Call, array($id));

        $listas = DB::table('lista')
        ->whereBetween('Id_Lista', [11,99])
        ->orderBy('numero_lista', 'ASC')
        ->get();
    
        $PDF = PDF::loadView('pdf.consejal_lista',compact('votacion_consejal', 'listas', 'id'));

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

    public function intendente_acta($id1, $id2){

        $votacion_intendente = DB::table('votacion_intendente AS a')
        ->join('intendente AS b', 'b.Id_Intendente', '=', 'a.Id_Intendente')
        ->join('lista AS c', 'c.Id_Lista', '=', 'b.Id_Lista')
        ->select('a.*', 'c.Desc_Lista', 'c.Alias', 'b.Nombre', 'b.Apellido')
        ->where('a.Id_Local', $id1)
        ->where('a.Id_Mesa', $id2)
        ->whereBetween('a.Id_Intendente', [1,90])
        ->orderBy('a.Id_Intendente', 'ASC')
        ->get();

        $local = DB::table('local_votacion')
        ->where('Id_Local', $id1)
        ->first();
        
        $votacion_nulos  = DB::table('votacion_intendente AS a')
        ->join('intendente AS b', 'b.Id_Intendente', '=', 'a.Id_Intendente')
        ->join('lista AS c', 'c.Id_Lista', '=', 'b.Id_Lista')
        ->select('a.*', 'c.Desc_Lista', 'c.Alias', 'b.Nombre', 'b.Apellido')
        ->whereBetween('a.Id_Intendente', [90,99])
        ->where('a.Id_Local', $id1)
        ->where('a.Id_Mesa', $id2)
        ->orderBy('a.Id_Intendente', 'ASC')
        ->get();

        $total = DB::table('votacion_intendente AS a')
        ->select(DB::raw(' SUM(a.Votos) AS votos'))
        ->where('a.Id_Local', $id1)
        ->where('a.Id_Mesa', $id2)
        ->first();

        $PDF = PDF::loadView('pdf.intendente_acta', compact('votacion_intendente', 'local', 'votacion_nulos', 'total', 'id2'));
                
        return $PDF->stream();


    }

    public function consejal_acta($id1, $id2){

        $local_votacion = DB::table('local_votacion')
        ->where('Id_Local', $id1)
        ->first();

        $listas = DB::table('consejal AS a')
        ->join('lista AS b','b.Id_Lista','=','a.Id_Lista')
        ->select('a.Id_Lista', 'b.numero_lista')
        ->whereBetween('a.Id_Lista', [11, 90])
        ->groupBy('a.Id_Lista', 'b.numero_lista')
        ->orderBy('b.numero_lista')
        ->get();

        $ordenes = DB::table('consejal')
        ->select('Orden')
        ->whereBetween('Id_Lista', [11, 90])
        ->groupBy('Orden')
        ->orderBy('Orden')
        ->get();        

        $votaciones = DB::table('votacion_consejal AS a')
        ->join('consejal AS b', 'b.Id_Consejal', '=', 'a.Id_Consejal')
        ->where('a.Id_Local', $id1)
        ->where('a.Id_Mesa', $id2)
        // ->orderBy('b.Orden', 'ASC')
        // ->orderBy('b.Id_Lista', 'ASC')
        ->get();

        $totales = DB::table('votacion_consejal AS a')
        ->join('consejal AS b', 'b.Id_Consejal', '=', 'a.Id_Consejal')
        ->join('lista AS c', 'c.Id_Lista', '=', 'b.Id_Lista')
        ->select('b.Id_Lista'
        , 'c.numero_lista'
        , DB::raw('SUM(a.Votos) AS total'))
        ->where('a.Id_Local', $id1)
        ->where('a.Id_Mesa', $id2)
        ->groupBy('b.Id_Lista', 'c.numero_lista')
        ->orderBy('c.numero_lista')
        ->get();

        $total = Votacion_Consejal::where('Id_Local', $id1)
        ->where('Id_Mesa', $id2)
        ->select(DB::raw('SUM(Votos) AS total'))
        ->first();

        $PDF = PDF::loadView('pdf.consejal_acta', compact('local_votacion', 'listas', 'ordenes', 'votaciones', 'totales', 'total', 'id2'));

        return $PDF->stream();
        
    }

    public function referente_intendente(){
        
        $id_user = auth()->id();

        if (($id_user == 1) || ($id_user == 2)) {

            $referentes = Padron_Comprometido::select('Cod_Referente', 'apellido_nombre_Referente', 'Id_User')
            ->groupBy('Cod_Referente')
            ->groupBy('apellido_nombre_Referente')
            ->groupBy('Id_User')
            ->get();
    
            $listas  = DB::table('padron_comprometido AS a')
            ->join('users AS b', 'b.id', '=', 'a.Id_User')
            ->join('equivalente_consejal AS c', 'c.equivalente_nombre', '=', 'b.url')
            ->join('consejal AS d', 'd.Id_Consejal', '=', 'c.Id_Consejal')
            ->select('d.Id_Consejal'
            , 'd.Nombre'
            , 'd.Apellido')
            ->distinct()
            ->orderBy('d.Id_Consejal', 'ASC')
            ->get();
                
            $sql_Call = 'CALL totales_por_referente()';
            $totales = DB::select($sql_Call);
            
            $PDF = PDF::loadView('pdf.referente_intendente', compact('totales', 'listas', 'referentes'));
    
            return $PDF->stream();            

        }else{

            return "No puede ver este reporte. No cuenta con los permisos necesarios!";

        }



    }

    public function referente_consejal(){
        
        $id_user = auth()->id();

        if (($id_user == 1) || ($id_user == 2)) {

            $url_consulta = User::where('id', $id_user)
            ->first();

            $url = $url_consulta->url;  

            $consejal_id = DB::table('equivalente_consejal') 
            ->where('equivalente_nombre', '=' ,  $url_consulta->url)
            ->first();

            $referentes = DB::table('padron_comprometido AS a')
            ->join('users AS b', 'b.id', '=', 'a.Id_User')
            ->join('equivalente_consejal AS c', 'c.equivalente_nombre', '=', 'b.url')
            ->join('consejal AS d', 'd.Id_Consejal', '=', 'c.Id_Consejal')
            ->select('a.Cod_Referente', 'a.apellido_nombre_Referente', 'a.Id_User')
            ->where('d.Id_Consejal', $consejal_id->Id_Consejal)
            ->groupBy('Cod_Referente')
            ->groupBy('apellido_nombre_Referente')
            ->groupBy('Id_User')
            ->get();

            $listas  = DB::table('padron_comprometido AS a')
            ->join('users AS b', 'b.id', '=', 'a.Id_User')
            ->join('equivalente_consejal AS c', 'c.equivalente_nombre', '=', 'b.url')
            ->join('consejal AS d', 'd.Id_Consejal', '=', 'c.Id_Consejal')
            ->select('d.Id_Consejal'
            , 'd.Nombre'
            , 'd.Apellido')
            ->distinct()
            ->where('d.Id_Consejal', $consejal_id->Id_Consejal)
            ->orderBy('d.Id_Consejal', 'ASC')
            ->get();
                
            $sql_Call = 'CALL padron_comprometido_consejal(?)';
            $totales = DB::select($sql_Call, array($consejal_id->Id_Consejal));
            
            $PDF = PDF::loadView('pdf.referente_intendente', compact('totales', 'listas', 'referentes'));

            return $PDF->stream();

        }else{
            
            return "No puede ver este reporte. No cuenta con los permisos necesarios!";
        }

    }

    public function referente_lista_consejal(){

        $id_user = auth()->id();

        if (($id_user == 1) || ($id_user == 2)) {

            $url_consulta = User::where('id', $id_user)
            ->first();
    
            $consejal_id = DB::table('equivalente_consejal') 
            ->where('equivalente_nombre', '=' ,  $url_consulta->url)
            ->first();
    
            $consejal = DB::table('consejal')
            ->where('Id_Consejal', $consejal_id->Id_Consejal)
            ->first();
    
            $sql_Call = 'CALL consejal_comprometidos(?)';
    
            $comprometidos = DB::select($sql_Call, array($consejal_id->Id_Consejal));
            
            $locales = DB::table('local_votacion')
            ->get();

            $PDF = PDF::loadView('pdf.consejal_listado', compact('comprometidos', 'consejal', 'locales'));
                
            return $PDF->stream();


        }else{

            return "No puede ver este reporte. No cuenta con los permisos necesarios!";

        }



    }

    public function referentes_inte($id){
        
        $sql_Call = 'CALL padron_comprometido_rep(?)';

        $comprometidos = DB::select($sql_Call, array($id)); 

        $PDF = PDF::loadView('pdf.referentes', compact('comprometidos', 'id'));
                
        return $PDF->stream();

    }

    public function integrante_todos(){

        $integrantes = DB::table('integrante_mesa AS a')
        ->join('padron AS b', 'b.cedula', '=', 'a.Cedula_Integrante')
        ->join('local_votacion AS c', 'c.Id_Local', '=', 'a.Id_Local')
        ->select('a.*', 'b.apellido_nombre', 'c.Desc_Local')
        ->orderBy('a.Id_Local', 'ASC')
        ->get();

        $PDF = PDF::loadView('pdf.integrante_general', compact('integrantes'));
                
        return $PDF->stream();

    }

    public function integrante_local(){

        $integrantes = DB::table('integrante_mesa AS a')
        ->join('padron AS b', 'b.cedula', '=', 'a.Cedula_Integrante')
        ->join('local_votacion AS c', 'c.Id_Local', '=', 'a.Id_Local')
        ->select('a.*', 'b.apellido_nombre', 'c.Desc_Local')
        ->orderBy('a.Id_Local', 'ASC')
        ->get();

        $locales = DB::table('local_votacion')
        ->orderBy('Id_Local', 'ASC' )
        ->get();  

        $PDF = PDF::loadView('pdf.integrante_local', compact('integrantes', 'locales'));
                
        // return $PDF->setPaper('a4', 'landscape')->stream("Integrante Local");
        return $PDF->stream("Integrante Local.pdf");


    }

    public function lista_integrante_local(){

        $integrantes = DB::table('integrante_mesa AS a')
        ->join('padron AS b', 'b.cedula', '=', 'a.Cedula_Integrante')
        ->join('local_votacion AS c', 'c.Id_Local', '=', 'a.Id_Local')
        ->leftJoin('consejal AS d', 'd.Id_Consejal', '=', 'a.Id_Consejal')
        ->select('a.*', 'b.apellido_nombre', 'c.Desc_Local', 'd.Nombre', 'd.Apellido')
        ->orderBy('a.Id_Local', 'ASC')
        ->get();

        $locales = DB::table('local_votacion')
        ->orderBy('Id_Local', 'ASC' )
        ->get();  

        $PDF = PDF::loadView('pdf.lista_integrante_local', compact('integrantes', 'locales'));


    }

    public function lista_integrante_consejal(){


    }

}

