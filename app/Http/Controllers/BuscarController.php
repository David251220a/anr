<?php

namespace App\Http\Controllers;

use App\Padron;
use App\Padron_Comprometido;
use App\Auditoria;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BuscarController extends Controller
{
    //
    public function __construct(){

        $this->middleware('auth');
        $this->middleware('ad_4');  

    }

    public function index(Request $request){

        $searchtext=str_replace('.', '',trim($request->get('searchtext')));
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
        $cedula = str_replace('.', '',trim($request->get('referente')));
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

        $existe = Padron_Comprometido::where('Cod_Comprometido',  $request->codpadron)
        ->where('Id_User', $id_user)
        ->first();

        if($existe){

            if ($comprometido == 0) {

                // $padron_comprometido = Padron_Comprometido::where('Cod_Comprometido',  $request->codpadron)
                // ->where('Id_User', $id_user)
                // ->delete();

                $existe->Cod_Referente = 99999;
                $existe->apellido_nombre_Referente = "";
                $existe->comprometido = $comprometido;
                $existe->save();

                return redirect()->route('consulta.index');

            }

            if ($persona->CodPadron == 99999){
            
                return redirect()->route('consulta.index')->with('msj', 'No existe referente con este numero de C.I: '.$cedula);

            }

            $existe->Cod_Referente = $persona->CodPadron;
            $existe->apellido_nombre_Referente = $persona->cedula . " " .$persona->apellido_nombre;
            $existe->voto = $voto;
            $existe->comprometido = $comprometido;
            $existe->save();

            return redirect()->route('consulta.index');

        }

        if (($voto == 1) && ($comprometido == 0)){

            $padron_comprometido= new Padron_Comprometido();

            $padron_comprometido->Cod_Referente = 99999;
            $padron_comprometido->apellido_nombre_Referente = "";
            $padron_comprometido->Cod_Comprometido = $request->codpadron;
            $padron_comprometido->voto = $voto;
            $padron_comprometido->comprometido = $comprometido;
            $padron_comprometido->Id_User = $id_user;
            $padron_comprometido->Fecha_Comprometido = $fecha;
            $padron_comprometido->save();


            $padron = Padron::where('CodPadron', $request->codpadron)
            ->first();

            $padron->si_voto = $voto;
            $padron->Id_User = $voto;
            $padron->FechaHora = Carbon::now();
            $padron->save();

            return redirect()->route('consulta.index');

        }

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

    public function padron_celular(Request $request){

        $searchtext=str_replace('.', '', trim($request->get('searchtext')));
        $votante="";
        $id_user = auth()->id();        

        $votante = "";

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
            ->where('a.cedula', $searchtext)
            ->orderBy('a.local', 'ASC')
            ->orderBy('a.mesa', 'ASC')
            ->first();
            
        }

        return view('consulta.padron_celular', compact('searchtext', 'votante'));

    }

    public function padron_celular_store(Request $request){
        
        $comprometido = $request->comprometido;
        $voto = $request->voto;
        $id_user = auth()->id();
        $cedula = str_replace('.', '',trim($request->get('referente')));
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

            return redirect()->route('consulta.padron_celular')->with('msj', 'No existe referente con este numero de C.I: '.$cedula);

        }

        $existe = Padron_Comprometido::where('Cod_Comprometido',  $request->codpadron)
        ->where('Id_User', $id_user)
        ->first();

        if($existe){         
            
            if ($comprometido == 0) {

                // $padron_comprometido = Padron_Comprometido::where('Cod_Comprometido',  $request->codpadron)
                // ->where('Id_User', $id_user)
                // ->delete();

                $existe->Cod_Referente = 99999;
                $existe->apellido_nombre_Referente = "";
                $existe->comprometido = $comprometido;
                $existe->save();

                return redirect()->route('consulta.padron_celular');

            }

            if ($persona->CodPadron == 99999){
            
                return redirect()->route('consulta.padron_celular')->with('msj', 'No existe referente con este numero de C.I: '.$cedula);

            }

            $existe->Cod_Referente = $persona->CodPadron;
            $existe->apellido_nombre_Referente = $persona->cedula . " " .$persona->apellido_nombre;
            $existe->voto = $voto;
            $existe->comprometido = $comprometido;
            $existe->save();

            return redirect()->route('consulta.padron_celular');

        }

        if (($voto == 1) && ($comprometido == 0)){

            $padron_comprometido= new Padron_Comprometido();

            $padron_comprometido->Cod_Referente = 99999;
            $padron_comprometido->apellido_nombre_Referente = "";
            $padron_comprometido->Cod_Comprometido = $request->codpadron;
            $padron_comprometido->voto = $voto;
            $padron_comprometido->comprometido = $comprometido;
            $padron_comprometido->Id_User = $id_user;
            $padron_comprometido->Fecha_Comprometido = $fecha;
            $padron_comprometido->save();


            $padron = Padron::where('CodPadron', $request->codpadron)
            ->first();

            $padron->si_voto = $voto;
            $padron->Id_User = $voto;
            $padron->FechaHora = Carbon::now();
            $padron->save();

            return redirect()->route('consulta.padron_celular');

        }

        $padron_comprometido= new Padron_Comprometido();

        $padron_comprometido->Cod_Referente = $persona->CodPadron;
        $padron_comprometido->apellido_nombre_Referente = $persona->cedula . " " .$persona->apellido_nombre;
        $padron_comprometido->Cod_Comprometido = $request->codpadron;
        $padron_comprometido->voto = $voto;
        $padron_comprometido->comprometido = $comprometido;
        $padron_comprometido->Id_User = $id_user;
        $padron_comprometido->Fecha_Comprometido = $fecha;
        $padron_comprometido->save();

        return redirect()->route('consulta.padron_celular');

    }

    public function voto_padron(Request $request){
        
        $searchtext=str_replace('.', '', trim($request->get('searchtext')));
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
            ->where('a.cedula', $searchtext)
            ->orderBy('a.local', 'ASC')
            ->orderBy('a.mesa', 'ASC')
            ->first();

            // if($votante){

            //     $auditoria = new Auditoria();

            //     $auditoria->Cod_Padron = $votante->CodPadron;
            //     $auditoria->cedula = $votante->cedula;
            //     $auditoria->Id_User = $id_user;
            //     $auditoria->Fecha_Hora = Carbon::now();

            //     $auditoria->save();
            // }
            
        }

        return view('consulta.votos', compact('searchtext', 'votante'));

    }

    public function voto_padron_store(Request $request){
        
        $voto = 1;
        $cont= 0;
        $id_user = auth()->id();

        $padron = Padron::where('CodPadron', $request->codpadron)
        ->first();

        $padron->si_voto = $voto;
        $padron->Id_User = $id_user;
        $padron->FechaHora = Carbon::now();

        $padron->save();

        $padron_comprometido = Padron_Comprometido::where('Cod_Comprometido', $request->codpadron)
        ->get();

        while ($cont < count($padron_comprometido)) {
            
            $padron_comprometido[$cont]->voto = $voto;
            
            $padron_comprometido[$cont]->save();
            $cont = $cont + 1 ;

        }

        return redirect()->route('consulta.voto_padron');

    }

}
