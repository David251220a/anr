<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InicioController extends Controller
{    

    public function index(){

        $id_rol = auth()->user()->id_rol;

        if($id_rol == 1){
                
            return redirect()->route('intendente.index');

        }

        if($id_rol == 2){
                
            return redirect()->route('intendente.index');

        }

    }

    public function padron_ver(Request $request){

        $searchtext=trim($request->get('searchtext'));
        $cCodTab=trim($request->get('cCodTab'));
        $votante="";        

        if($searchtext){
        
            $votante = DB::table('padron AS a')
            ->join('local_votacion AS b','b.Id_Local','=','a.local')
            ->select('a.*', 'b.Desc_Local')
            ->where('a.cedula', 'LIKE', '%'.$searchtext.'%')
            ->orwhere('a.apellido_nombre', 'LIKE', '%'.$searchtext.'%') 
            ->orderBy('a.local', 'ASC')
            ->orderBy('a.mesa', 'ASC')
            ->paginate(50);
            
            return view('consulta.padron', compact('searchtext', 'votante'));

        }

        $votante = DB::table('padron AS a')
        ->join('local_votacion AS b','b.Id_Local','=','a.local')
        ->select('a.*', 'b.Desc_Local')
        ->orderBy('a.local', 'ASC')
        ->orderBy('a.mesa', 'ASC')
        ->paginate(50);

        return view('consulta.padron', compact('searchtext', 'votante'));
        

    }

}
