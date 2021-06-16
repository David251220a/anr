<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use DB;

class AuditoriaController extends Controller
{
    public function __construct(){

        $this->middleware('auth');

    }

    public function index(Request $request){

        if($request){
                    
            $auditoria = DB::table('auditoria AS a')
            ->join('users AS b','b.id','=','a.Id_User')
            ->join('intendente AS c','c.Id_Intendente','=','a.Id_Intendente')
            ->join('local_votacion AS d','d.Id_Local','=','a.Id_Local')
            ->join('mesa AS e','e.Id_Mesa','=','a.Id_Mesa')
            ->join('lista AS f','f.Id_Lista','=','c.Id_Lista')
            ->select('a.*'
            ,'b.name'
            ,'c.Apellido'
            ,'c.Nombre'
            ,'d.Desc_Local'
            ,'f.Desc_Lista'
            ,'e.Mesa')
            ->orderby('Id_Auditoria','DESC')
            ->get();

            $auditoria_consejal = DB::table('auditoria AS a')
            ->join('users AS b','b.id','=','a.Id_User')
            ->join('consejal AS c','c.Id_Consejal','=','a.Id_Consejal')
            ->join('local_votacion AS d','d.Id_Local','=','a.Id_Local')
            ->join('mesa AS e','e.Id_Mesa','=','a.Id_Mesa')
            ->join('lista AS f','f.Id_Lista','=','c.Id_Lista')
            ->select('a.*'
            ,'b.name'
            ,'c.Apellido'
            ,'c.Nombre'
            ,'d.Desc_Local'
            ,'f.Desc_Lista'
            ,'e.Mesa')
            ->orderby('Id_Auditoria','DESC')
            ->get();

            return view('acceso\auditoria.index',["auditoria"=>$auditoria, "auditoria_consejal"=>$auditoria_consejal]);    
            
        }

    }
}
