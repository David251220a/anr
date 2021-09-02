<?php

namespace App\Http\Controllers;

use App\Padron;
use App\Padron_Comprometido;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class BuscarController extends Controller
{
    //
    public function __construct(){

        $this->middleware('auth');        

    }

    public function index(Request $request){

        $searchtext=trim($request->get('searchtext'));
        $cCodTab=trim($request->get('cCodTab'));
        $votante="";
        $id_user = auth()->id();

        if($searchtext){
        
            $votante = DB::table('padron AS a')
            ->join('local_votacion AS b','b.Id_Local','=','a.local')            
            ->select('a.*', 'b.Desc_Local')
            ->addSelect(['voto' => Padron_Comprometido::select('voto')
                ->whereColumn('Cod_Comprometido', 'a.CodPadron')
                ->where('Id_User', $id_user)
                ->limit(1)
            ])
            ->addSelect(['comprometido' => Padron_Comprometido::select('comprometido')
                ->whereColumn('Cod_Comprometido', 'a.CodPadron')
                ->where('Id_User', $id_user)
                ->limit(1)
            ])
            ->addSelect(['apellido_nombre_Referente' => Padron_Comprometido::select('apellido_nombre_Referente')
                ->whereColumn('Cod_Comprometido', 'a.CodPadron')
                ->where('Id_User', $id_user)
                ->limit(1)
            ])
            ->where('a.cedula', 'LIKE', '%'.$searchtext.'%')
            ->orwhere('a.apellido_nombre', 'LIKE', '%'.$searchtext.'%') 
            ->orderBy('a.local', 'ASC')
            ->orderBy('a.mesa', 'ASC')
            ->paginate(50);            
            
            return view('consulta.buscar', compact('searchtext', 'votante'));

        }

        $votante = DB::table('padron AS a')
        ->join('local_votacion AS b','b.Id_Local','=','a.local')        
        ->select('a.*', 'b.Desc_Local')
        ->addSelect(['voto' => Padron_Comprometido::select('voto')
                ->whereColumn('Cod_Comprometido', 'a.CodPadron')
                ->where('Id_User', $id_user)
                ->limit(1)
            ])
            ->addSelect(['comprometido' => Padron_Comprometido::select('comprometido')
                ->whereColumn('Cod_Comprometido', 'a.CodPadron')
                ->where('Id_User', $id_user)
                ->limit(1)
            ])
            ->addSelect(['apellido_nombre_Referente' => Padron_Comprometido::select('apellido_nombre_Referente')
                ->whereColumn('Cod_Comprometido', 'a.CodPadron')
                ->where('Id_User', $id_user)
                ->limit(1)
            ])
        ->where('a.cedula', 'LIKE', '%'.$searchtext.'%')
        ->orwhere('a.apellido_nombre', 'LIKE', '%'.$searchtext.'%') 
        ->orderBy('a.local', 'ASC')
        ->orderBy('a.mesa', 'ASC')
        ->paginate(50);

        return view('consulta.buscar', compact('searchtext', 'votante'));
        

    }

    public function store(Request $request){

        $comprometido = $request->comprometido;
        $voto = $request->voto;
        $id_user = auth()->id();
        $cedula = trim($request->get('referente'));
        $fecha = Carbon::now();

        if($voto == 'on'){

            $voto = 1;

        }else{

            $voto = 0;

        }

        if($comprometido == 'on'){

            $comprometido = 1;

        }else{

            $comprometido = 0;

        }
        
        $persona = Padron::where('cedula', $cedula)
        ->first();

        if (empty($persona)){

            return redirect()->route('consulta.index')->with('msj', 'No existe referente con este numero de C.I: '.$cedula);

        }

        // $padron= Padron::find($request->codpadron);

        $padron_comprometido= new Padron_Comprometido();

        $padron_comprometido->Cod_Referente = $persona->CodPadron;
        $padron_comprometido->apellido_nombre_Referente = $persona->cedula . " " .$persona->apellido_nombre;
        $padron_comprometido->Cod_Comprometido = $request->codpadron;
        $padron_comprometido->voto = $voto;
        $padron_comprometido->comprometido = $comprometido;
        $padron_comprometido->Id_User = $id_user;
        $padron_comprometido->Fecha_Comprometido = $fecha;
        $padron_comprometido->save();

        return redirect()->route('consulta.index');

    }


}
