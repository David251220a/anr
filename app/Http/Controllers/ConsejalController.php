<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Votacion_Consejal;
use App\Auditoria;
use App\Http\Requests\ConsejalRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ConsejalController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
        $this->middleware('ad');

    }

    public function index(Request $request){        

        if($request){
            
            $id_user = auth()->id();

            $primero = DB::table('consejal AS a')
            ->join('lista AS b','b.Id_Lista','=','a.Id_Lista')
            ->select('a.*'
            , DB::raw('CONCAT(a.Nombre, space(1), a.Apellido, " - ", b.Alias, " - Orden: ", a.Orden) AS Consejal')
            ,'b.Desc_Lista')
            ->where('a.Id_Lista', 11)            
            ->orderBy('a.Orden', 'ASC')
            ->get();

            $segundo = DB::table('consejal AS a')
            ->join('lista AS b','b.Id_Lista','=','a.Id_Lista')
            ->select('a.*'
            , DB::raw('CONCAT(a.Nombre, space(1), a.Apellido, " - ", b.Alias, " - Orden: ", a.Orden) AS Consejal')
            ,'b.Desc_Lista')
            ->where('a.Id_Lista', 12)            
            ->orderBy('a.Orden', 'ASC')
            ->get();

            $tercero = DB::table('consejal AS a')
            ->join('lista AS b','b.Id_Lista','=','a.Id_Lista')
            ->select('a.*'
            , DB::raw('CONCAT(a.Nombre, space(1), a.Apellido, " - ", b.Alias, " - Orden: ", a.Orden) AS Consejal')
            ,'b.Desc_Lista')
            ->where('a.Id_Lista', 13)            
            ->orderBy('a.Orden', 'ASC')
            ->get();

            $cuarto = DB::table('consejal AS a')
            ->join('lista AS b','b.Id_Lista','=','a.Id_Lista')
            ->select('a.*'
            , DB::raw('CONCAT(a.Nombre, space(1), a.Apellido, " - ", b.Alias, " - Orden: ", a.Orden) AS Consejal')
            ,'b.Desc_Lista')
            ->where('a.Id_Lista', 14)            
            ->orderBy('a.Orden', 'ASC')
            ->get();

            $quinto = DB::table('consejal AS a')
            ->join('lista AS b','b.Id_Lista','=','a.Id_Lista')
            ->select('a.*'
            , DB::raw('CONCAT(a.Nombre, space(1), a.Apellido, " - ", b.Alias, " - Orden: ", a.Orden) AS Consejal')
            ,'b.Desc_Lista')
            ->where('a.Id_Lista', 15)
            ->orderBy('a.Orden', 'ASC')
            ->get();

            $local_votacion = DB::table('local_votacion')
            ->orderBy('Id_Local', 'ASC')
            ->get();

            $mesa = DB::table('mesa')
            ->orderBy('Id_Mesa', 'ASC')
            ->get();

            return view('votacion.consejal.index',["primero"=>$primero
            , "segundo"=>$segundo
            , "tercero"=>$tercero
            , "cuarto"=>$cuarto
            , "quinto"=>$quinto
            , "local_votacion"=>$local_votacion
            , "mesa"=>$mesa]);
        }

    }

    public function store(ConsejalRequest $request){        
        
        $id_user = auth()->id();

        $existe_registro = DB::table('votacion_consejal')
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

            return redirect()->route('consejal.index')->with('msj', 'Ya existe registro en este local: '.$aux_local->Desc_Local.' y en este mesa: '.$aux_mesa->Mesa);

        }

        $consejal = $request->get('consejal');
        $votos = $request->get('votos');

        $cont = 0;
        $url="";

        if ($request->file('acta')) {
            
            $imagen = $request->file('acta')->store('public/documentos');
            $url = Storage::url($imagen);

        }

        while ($cont < count($consejal)) {
            # code...
            $votacion_consejal = new Votacion_Consejal();
            $votacion_consejal->Id_Local = $request->id_local;
            $votacion_consejal->Id_Mesa = $request->id_mesa;
            $votacion_consejal->Id_Consejal = $consejal[$cont];
            $votacion_consejal->Votos = $votos[$cont];
            $votacion_consejal->Fecha_Alta =  Carbon::now();
            $votacion_consejal->Id_User = $id_user;
            $votacion_consejal->imagen = $url;
            
            $votacion_consejal->save();
            $cont = $cont + 1 ;  

        }
        
        return redirect()->route('consejal.index');

    }

}
