<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Votacion_Consejal;
use App\Auditoria;
use App\Local_Mesa_Votacion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Consulta_ConsejalController extends Controller
{
    public function __construct(){

        $this->middleware('auth');

    }

    public function index(Request $request){

        if($request){
            
            $id_user = auth()->id();
            $local=trim($request->get('id_local'));

            if((empty($local)) || ($local == 99)){

                $votos = DB::table('votacion_consejal AS a')
                ->join('mesa AS b','b.Id_Mesa','=','a.Id_Mesa')
                ->join('local_votacion AS c','c.Id_Local','=','a.Id_Local')
                ->select('a.Id_Local'
                , 'c.Desc_Local'
                , 'a.Id_Mesa'
                , 'b.Mesa'
                , DB::raw("SUM(a.`Votos`) AS cont"))
                ->groupBy('a.Id_Local'
                , 'c.Desc_Local'
                , 'b.Mesa'
                , 'a.Id_Mesa')
                ->paginate(10);

            }else{

                $votos = DB::table('votacion_consejal AS a')
                ->join('mesa AS b','b.Id_Mesa','=','a.Id_Mesa')
                ->join('local_votacion AS c','c.Id_Local','=','a.Id_Local')
                ->select('a.Id_Local'
                , 'c.Desc_Local'
                , 'a.Id_Mesa'
                , 'b.Mesa'
                , DB::raw("SUM(a.`Votos`) AS cont"))
                ->where('a.Id_Local', $local)
                ->groupBy('a.Id_Local'
                , 'c.Desc_Local'
                , 'b.Mesa'
                , 'a.Id_Mesa')
                ->paginate(10);

            }

            $local_votacion = DB::table('local_votacion')
            ->orderBy('Id_Local', 'ASC')
            ->get();

            return view('consulta.votos_consejal.index', compact('votos', 'local_votacion', 'local'));

        }

    }

    public function editar($id1, $id2){

        $local_votacion = DB::table('local_votacion')
        ->where('Id_Local', $id1)
        ->first();

        $mesas = DB::table('mesa')
        ->where('Id_Mesa', $id2)
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
        ->orderBy('a.Id_Votacion_Consejal', 'ASC')
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

        return view('consulta.votos_consejal.edit', compact('local_votacion', 'mesas', 'votaciones', 'ordenes', 'listas', 'totales'));

    }

    public function eliminar($id1, $id2){
        
        $votacion = DB::table('votacion_consejal')
        ->where('Id_Local', $id1)
        ->where('Id_Mesa', $id2)
        ->delete();

        $id = Local_Mesa_Votacion::where('Id_Local', $id1)
        ->where('Id_mesa', $id2)
        ->where('Tipo_Carga', 2)
        ->first();

        $id->Activo = 1;
        $id->save();

        return redirect()->route('consulta_consejal.index')->with('msj', 'Se elimino registro con exito');

    }

    public function update(Request $request, $id){

        $id_mesa = $request->id_mesa_consejal;
        $id_local = $id;
        $id_user = auth()->id();

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

            $request->validate([
                'acta' => 'image',
            ]);
            
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
                
                $votacion_consejal = Votacion_Consejal::where('Id_Consejal', $consejal->Id_Consejal)
                ->where('Id_Local', $id_local)
                ->where('Id_Mesa', $id_mesa)
                ->first();
                
                $votacion_consejal->Votos = $votos[$cont_votos];
                $votacion_consejal->Fecha_Actualizacion =  Carbon::now();
                $votacion_consejal->Id_User = $id_user;
                if ($request->file('acta')) {
            
                    $votacion_consejal->imagen = $url;
        
                }                
                
                $votacion_consejal->save();

                $cont_lista = $cont_lista + 1 ;
                $cont_votos = $cont_votos + 1 ;
                
            }
            
            $cont = $cont + 1 ;
            
        }

        $cont_varios = 0;

        while($cont_varios < count($id_consejal)){
            
            $votacion_consejal = Votacion_Consejal::where('Id_Consejal', $id_consejal[$cont_varios])
            ->where('Id_Local', $id_local)
            ->where('Id_Mesa', $id_mesa)
            ->first();

            $votacion_consejal->Votos = $votos_varios[$cont_varios];
            $votacion_consejal->Fecha_Actualizacion =  Carbon::now();
            $votacion_consejal->Id_User = $id_user;
            if ($request->file('acta')) {
            
                $votacion_consejal->imagen = $url;
    
            }

            $votacion_consejal->save();
            $cont_varios = $cont_varios + 1 ;

        }

        return redirect()->route('consulta_consejal.index')->with('msj', 'Se Actualizo con exito.');

    }

    public function Acta($id1, $id2){

        $votos_consejal = Votacion_Consejal::where('Id_Local', $id1)
        ->where('Id_Mesa', $id2)
        ->first();

        return view('consulta.votos_consejal.acta', compact('votos_consejal'));

    }

}
