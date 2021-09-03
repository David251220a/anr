<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Votacion_Consejal;
use App\Http\Requests\ConsejalRequest;
use App\Local_Mesa_Votacion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ConsejalController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
        $this->middleware('ad');
        $this->middleware('ad_3');

    }

    public function index(Request $request){        

        if($request){
            
            $id_user = auth()->id();

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

            $local_votacion = DB::table('local_votacion')
            ->orderBy('Id_Local', 'ASC')
            ->get();

            $mesa = DB::table('mesa')
            ->orderBy('Id_Mesa', 'ASC')
            ->get();

            return view('votacion.consejal.index',["listas"=>$listas
            , "ordenes"=>$ordenes
            , "local_votacion"=>$local_votacion
            , "mesa"=>$mesa]);
        }

    }

    public function store(ConsejalRequest $request){
        
        $id_user = auth()->id();

        $existe_registro = DB::table('votacion_consejal')
        ->where('Id_Local', $request->id_local_consejal)
        ->where('Id_Mesa', $request->id_mesa_consejal)
        ->first();
        
        if ($existe_registro) {
            
            $aux_mesa = DB::table('mesa')
            ->where('Id_Mesa', $request->id_mesa_consejal)
            ->first();

            $aux_local = DB::table('local_votacion')
            ->where('Id_Local', $request->id_local_consejal)
            ->first();

            return redirect()->route('consejal.index')->with('msj', 'Ya existe registro en este local: '.$aux_local->Desc_Local.' y en este mesa: '.$aux_mesa->Mesa);

        }

        $consejal = $request->get('consejal');
        $votos = $request->get('votos');

        $lista = $request->get('lista');
        $orden = $request->get('orden');

        $id_consejal = $request->get('id_lista');
        $votos_varios = $request->get('votos_varios');

        $cont = 0;
        $cont_votos = 0;
        $url="";

        if ($request->file('acta')) {
            
            $imagen = $request->file('acta')->store('public/documentos');
            $url = Storage::url($imagen);

        }

        while($cont < count($orden)){

            $cont_lista = 0;

            while($cont_lista < count($lista)){

                $consejal = DB::table('consejal')
                ->where('Id_Lista', $lista[$cont_lista])
                ->where('Orden', $orden[$cont])
                ->latest('Id_Consejal')
                ->first();

                $votacion_consejal = new Votacion_Consejal();
                $votacion_consejal->Id_Local = $request->id_local_consejal;
                $votacion_consejal->Id_Mesa = $request->id_mesa_consejal;
                $votacion_consejal->Id_Consejal = $consejal->Id_Consejal;
                $votacion_consejal->Votos = $votos[$cont_votos];
                $votacion_consejal->Fecha_Alta =  Carbon::now();
                $votacion_consejal->Id_User = $id_user;
                $votacion_consejal->imagen = $url;
                
                $votacion_consejal->save();
                $cont_lista = $cont_lista + 1 ;
                $cont_votos = $cont_votos + 1 ;
                
            }
            
            $cont = $cont + 1 ;
        }

        $cont_varios = 0;

        while($cont_varios < count($id_consejal)){

            $votacion_consejal = new Votacion_Consejal();
            $votacion_consejal->Id_Local = $request->id_local_consejal;
            $votacion_consejal->Id_Mesa = $request->id_mesa_consejal;
            $votacion_consejal->Id_Consejal = $id_consejal[$cont_varios];
            $votacion_consejal->Votos = $votos_varios[$cont_varios];
            $votacion_consejal->Fecha_Alta =  Carbon::now();
            $votacion_consejal->Id_User = $id_user;
            $votacion_consejal->imagen = $url;
            
            $votacion_consejal->save();
            $cont_varios = $cont_varios + 1 ;

        }
        
        $id = Local_Mesa_Votacion::where('Id_Local', $request->id_local_consejal)
        ->where('Id_mesa', $request->id_mesa_consejal)
        ->where('Tipo_Carga', 2)
        ->first();

        $id->Activo = 0;
        $id->save();

        return redirect()->route('consejal.index')->with('msj', 'Se guardo con exito!.');

    }

    public function getmesas_consejal($id){

        $mesas = DB::table('local_mesa_votacion AS a')
        ->join('mesa AS b','b.Id_Mesa','=','a.Id_Mesa')
        ->select('a.*', 'b.Mesa')
        ->where('Id_Local', $id)
        ->where('Activo', 1)
        ->where('Tipo_Carga', 2)
        ->get();

        return $mesas;

    }

}
