<?php

namespace App\Http\Controllers;

use App\Padron;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class BuscarController extends Controller
{
    //

    public function index(Request $request){

        $searchtext=trim($request->get('searchtext'));
        $votante="";

        if($searchtext){
        
            $votante = DB::table('padron AS a')
            ->join('local_votacion AS b','b.Id_Local','=','a.local')
            ->select('a.*', 'b.Desc_Local')
            ->where('a.cedula', 'LIKE', '%'.$searchtext.'%')
            ->orwhere('a.apellido_nombre', 'LIKE', '%'.$searchtext.'%') 
            ->paginate(50);
            
            return view('consulta.buscar', compact('searchtext', 'votante'));

        }

        $votante = DB::table('padron AS a')
        ->join('local_votacion AS b','b.Id_Local','=','a.local')
        ->select('a.*', 'b.Desc_Local')
        ->paginate(50);

        return view('consulta.buscar', compact('searchtext', 'votante'));
        

    }

    public function store(Request $request){

        $voto = $request->voto;

        if($voto == 'on'){

            $voto = 1;

        }else{

            $voto = 0;

        }        
        

        $padron= Padron::find($request->codpadron);

        $padron->referente = $request->referente;
        $padron->voto = $voto;
        $padron->save();

        return redirect()->route('consulta.index');

    }
}
