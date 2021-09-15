<?php

namespace App\Http\Controllers;

use App\Http\Requests\IntendenteRequest;
use App\Local_Mesa_Votacion;
use Illuminate\Http\Request;
use App\Votacion_Intendente;
use App\Aporedados;
use App\Padron_Comprometido;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ConsultaController extends Controller
{
    
    public function __construct(){

        $this->middleware('auth');        

    }
    
    public function index(Request $request){        

        if($request){
            
            $id_user = auth()->id();
            $local=trim($request->get('id_local'));

            if((empty($local)) || ($local == 99)){

                $votos = DB::table('votacion_intendente AS a')
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

                $votos = DB::table('votacion_intendente AS a')
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

            return view('consulta.votos_intendente.index', compact('local_votacion', 'local', 'votos'));

        }

    }

    public function destroy(Request $request, $id){

        return redirect('consulta/votos_intendente');        

    }

    public function editar($id1, $id2){

        $local_votacion = DB::table('local_votacion')
        ->where('Id_Local', $id1)
        ->first();

        $mesas = DB::table('mesa')
        ->where('Id_Mesa', $id2)
        ->first();

        $intendentes = DB::table('intendente AS a')
        ->join('lista AS b','b.Id_Lista','=','a.Id_Lista')
        ->select('a.*'
        , DB::raw('CONCAT(a.Nombre, space(1), a.Apellido, " - ", b.Alias) AS Intendente')
        ,'b.Desc_Lista')
        ->orderBy('Id_Lista', 'ASC')
        ->get();

        $votaciones = DB::table('votacion_intendente')
        ->where('Id_Local', $id1)
        ->where('Id_Mesa', $id2)
        ->get();

        return view('consulta.votos_intendente.edit', compact('local_votacion', 'mesas', 'votaciones', 'intendentes'));

    }

    public function eliminar($id1, $id2){
        
        $votacion = DB::table('votacion_intendente')
        ->where('Id_Local', $id1)
        ->where('Id_Mesa', $id2)
        ->delete();

        $id = Local_Mesa_Votacion::where('Id_Local', $id1)
        ->where('Id_mesa', $id2)
        ->where('Tipo_Carga', 1)
        ->first();

        $id->Activo = 1;
        $id->save();

        return redirect()->route('consulta_intendente.index')->with('msj', 'Se elimino registro con exito');

    }

    public function update(Request $request, $votos_intendente){

        $id_mesa = $request->id_mesa;
        $id_local = $votos_intendente;
        $id_user = auth()->id();

        $intendente = $request->get('intendente');
        $votos = $request->get('Votos');

        $cont = 0;
        $url="";

        if ($request->file('acta')) {
            
            $request->validate([
                'acta' => 'image',
            ]);
            
            $imagen = $request->file('acta')->store('public/documentos');
            $url = Storage::url($imagen);

        }

        while ($cont < count($intendente)) {
            # code...
            $votacion_intendente = Votacion_Intendente::where('Id_Local', $id_local)
            ->where('Id_Mesa', $id_mesa)
            ->where('Id_Intendente', $intendente[$cont])
            ->first();
            
            $votacion_intendente->Votos = $votos[$cont];
            $votacion_intendente->Fecha_Actualizacion =  Carbon::now();
            $votacion_intendente->Id_User = $id_user;
            if ($request->file('acta')) {
            
                $votacion_intendente->imagen = $url;    
    
            }
            
            $votacion_intendente->save();
            $cont = $cont + 1 ;  

        }

        return redirect()->route('consulta_intendente.index')->with('msj', 'Se actualizo con exito.');

    }

    public function Acta($id1, $id2){

        $votos_intendente = Votacion_Intendente::where('Id_Local', $id1)
        ->where('Id_Mesa', $id2)
        ->first();

        return view('consulta.votos_intendente.acta',["votos_intendente"=>$votos_intendente]);

    }

    public function referente(Request $request){

        $id_user = auth()->id();
        $referente=trim($request->get('referente'));
        
        
        $referentes = Padron_Comprometido::where('Id_User', $id_user)
        ->select('Cod_Referente', 'apellido_nombre_Referente')
        ->groupBy('Cod_Referente')
        ->groupBy('apellido_nombre_Referente')
        ->get();


        if((empty($referente)) || ($referente == 99)){
            
            $sql_Call = 'CALL padron_comprometido(?, ?)';

            $comprometidos = DB::select($sql_Call, array($id_user, 99999));            

            $referente = 99;

        }else{
            
            $sql_Call = 'CALL padron_comprometido(?, ?)';

            $comprometidos = DB::select($sql_Call, array($id_user, $referente)); 

        }

        return view('consulta.referente', compact('comprometidos', 'referentes', 'referente'));

    }

    public function referente_intendente(Request $request){

        $id_user = auth()->id();
        $referente=trim($request->get('referente'));
        
        $referentes = Padron_Comprometido::select('Cod_Referente', 'apellido_nombre_Referente', 'Id_User')
        ->groupBy('Cod_Referente')
        ->groupBy('apellido_nombre_Referente')
        ->groupBy('Id_User')
        ->get();

        $comprometidos = "";
        $totales = "";

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

        if((empty($referente)) || ($referente == 99)){
            
            $sql_Call = 'CALL totales_por_referente()';

            $totales = DB::select($sql_Call);

            $referente = 99;

        }else{
            
            $sql_Call = 'CALL padron_comprometido(?, ?)';

            $refe = Padron_Comprometido::where('Cod_Referente', $referente)
            ->first();

            $user = $refe->Id_User;

            $comprometidos = DB::select($sql_Call, array($user, $referente));             

        }
        
        return view('consulta.referente_intendente', compact('listas', 'referentes', 'referente', 'totales', 'comprometidos'));

    }

    public function aporedado(Request $request){

        $aporedados = DB::table('aporedado_local')
        ->orderBy('Id_Aporedado', 'ASC')
        ->get();

        return view('consulta.aporedado', compact('aporedados'));
    
    }

    public function store_aporedado(Request $request, $id){
        
        $aporedados  = Aporedados::where('Id_Aporedado', $id)
        ->first();

        $aporedados->Apoderado1 = $request->get('aporedado_1');
        $aporedados->Apo1_Telefono = $request->get('telefono_1');
        $aporedados->Apoderado2 = $request->get('aporedado_2');
        $aporedados->Apo2_Telefono = $request->get('telefono_2');
        $aporedados->Apoderado3 = $request->get('aporedado_3');
        $aporedados->Apo3_Telefono = $request->get('telefono_3');
        $aporedados->Apoderado4 = $request->get('aporedado_4');
        $aporedados->Apo4_Telefono = $request->get('telefono_4');

        $aporedados->save();

        return redirect()->route('consulta.aporedado');

    }
    

}
