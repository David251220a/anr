<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\IntendenteRequest;
use App\Local_Mesa_Votacion;
use App\Votacion_Intendente;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class IntendenteController extends Controller
{
    
    public function __construct(){

        $this->middleware('auth');
        $this->middleware('ad');
        $this->middleware('ad_3');
        $this->middleware('ad_4');

    }

    public function index(Request $request){        

        if($request){            

            $intendentes = DB::table('intendente AS a')
            ->join('lista AS b','b.Id_Lista','=','a.Id_Lista')
            ->select('a.*'
            , DB::raw('CONCAT(a.Nombre, space(1), a.Apellido, " - ", b.Alias) AS Intendente')
            ,'b.Desc_Lista')
            ->orderBy('Id_Lista', 'ASC')
            ->get();

            $local_votacion = DB::table('local_votacion')
            ->orderBy('Id_Local', 'ASC')
            ->get();

            // $local_votacion = DB::table('local_votacion')
            // ->pluck('Desc_Local', 'Id_Local');

            $mesa = DB::table('mesa')
            ->orderBy('Id_Mesa', 'ASC')
            ->get();

            return view('votacion.intendente.index',["intendentes"=>$intendentes            
            , "mesa"=>$mesa
            , "local_votacion"=>$local_votacion]);

           

        }

    }

    public function store(IntendenteRequest $request){

        $id_user = auth()->id();

        $request->validate([
            'total_votos' => 'required|numeric|min:0|not_in:0',
        ]);

        $existe_registro = DB::table('votacion_intendente')
        ->where('Id_Local', $request->id_local)
        ->where('Id_Mesa', $request->id_mesa)
        ->first();

        if ($existe_registro) {
            
            $aux_mesa = DB::table('mesa')
            ->where('Id_Mesa', $request->id_mesa)
            ->first();

            $aux_local = DB::table('local_votacion')
            ->where('Id_Local', $request->id_local)
            ->first();

            return redirect()->route('intendente.index')->with('msj', 'Ya existe registro en este local: '.$aux_local->Desc_Local.' y en este mesa: '.$aux_mesa->Mesa);

        }

        $intendente = $request->get('intendente');
        $votos = $request->get('votos');

        $cont = 0;
        $url="";

        if ($request->file('acta')) {
            
            $imagen = $request->file('acta')->store('public/documentos');
            $url = Storage::url($imagen);

        }

        while ($cont < count($intendente)) {
            # code...
            $votacion_intendente = new Votacion_Intendente();
            $votacion_intendente->Id_Local = $request->id_local;
            $votacion_intendente->Id_Mesa = $request->id_mesa;
            $votacion_intendente->Id_Intendente = $intendente[$cont];
            $votacion_intendente->Votos = $votos[$cont];
            $votacion_intendente->Fecha_Alta =  Carbon::now();
            $votacion_intendente->Id_User = $id_user;
            $votacion_intendente->imagen = $url;
            
            $votacion_intendente->save();
            $cont = $cont + 1 ;  

        }

        $id = Local_Mesa_Votacion::where('Id_Local', $request->id_local)
        ->where('Id_mesa', $request->id_mesa)
        ->where('Tipo_Carga', 1)
        ->first();

        $id->Activo = 0;
        $id->save();

        return redirect()->route('intendente.index')->with('msj', 'Se guardo con exito!.');;
        
    }

    public function getmesas($id){

        $mesas = DB::table('local_mesa_votacion AS a')
        ->join('mesa AS b','b.Id_Mesa','=','a.Id_Mesa')
        ->select('a.*', 'b.Mesa')
        ->where('Id_Local', $id)
        ->where('Activo', 1)
        ->where('Tipo_Carga', 1)
        ->get();

        // return Local_Mesa_Votacion::where('Id_Local', $id)
        // ->where('Activo', 1)
        // ->get();
        return $mesas;

    }

}
