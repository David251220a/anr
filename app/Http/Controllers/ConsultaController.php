<?php

namespace App\Http\Controllers;

use App\Http\Requests\IntendenteRequest;
use App\Local_Mesa_Votacion;
use Illuminate\Http\Request;
use App\Votacion_Intendente;
use App\Aporedados;
use App\Integrante_Mesa;
use App\Padron_Comprometido;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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
        
        if (($id_user == 1) || ($id_user == 2)) {
        
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

        }else{

            return redirect()->route('consulta.padron_celular');

        }
        

    }

    public function referente_consejal(Request $request){

        $id_user = auth()->id();

        if (($id_user == 1) || ($id_user == 2)) {
            
            $referente=trim($request->get('referente'));
        
            $url_consulta = User::where('id', $id_user)
            ->first();

            $url = $url_consulta->url;  

            $consejal_id = DB::table('equivalente_consejal') 
            ->where('equivalente_nombre', '=' ,  $url_consulta->url)
            ->first();
            
            $referentes = DB::table('padron_comprometido AS a')
            ->join('users AS b', 'b.id', '=', 'a.Id_User')
            ->join('equivalente_consejal AS c', 'c.equivalente_nombre', '=', 'b.url')
            ->join('consejal AS d', 'd.Id_Consejal', '=', 'c.Id_Consejal')
            ->select('a.Cod_Referente', 'a.apellido_nombre_Referente', 'a.Id_User')
            ->where('d.Id_Consejal', $consejal_id->Id_Consejal)
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
            ->where('d.Id_Consejal', $consejal_id->Id_Consejal)
            ->orderBy('d.Id_Consejal', 'ASC')
            ->get();

            if((empty($referente)) || ($referente == 99)){
                
                $sql_Call = 'CALL padron_comprometido_consejal(?)';

                $totales = DB::select($sql_Call, array($consejal_id->Id_Consejal));

                $referente = 99;

            }elseif ($referente == 98){

                $sql_Call = 'CALL consejal_comprometidos(?)';

                $totales = DB::select($sql_Call, array($consejal_id->Id_Consejal));
                $referente = 98;

            }else{
                
                $sql_Call = 'CALL padron_comprometido(?, ?)';

                $refe = Padron_Comprometido::where('Cod_Referente', $referente)
                ->first();

                $user = $refe->Id_User;

                $comprometidos = DB::select($sql_Call, array($user, $referente));             

            }
            
            return view('consulta.referente_consejal', compact('listas', 'referentes', 'referente', 'totales', 'comprometidos'));

        }else{

            return redirect()->route('consulta.padron_celular');

        }

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


    public function integrante_mesa(Request $request){

        $id_user = auth()->id();
        $searchtext=str_replace('.', '',trim($request->get('searchtext')));
        $id_rol = Auth::user()->id == 2;

        // if(($id_rol == 4) || ($id_rol == 1)){

            if(empty($searchtext)){
            
                $integrantes = DB::table('integrante_mesa AS a')
                ->join('padron AS b', 'b.cedula', '=', 'a.Cedula_Integrante')
                ->join('local_votacion AS c', 'c.Id_Local', '=', 'a.Id_Local')
                ->select('a.*', 'b.apellido_nombre', 'c.Desc_Local')
                ->orderBy('a.Id_Local', 'ASC')
                // ->orderBy('a.Id_Mesa', 'ASC')
                ->paginate(10);
    
                $sessiones = DB::table('integrante_mesa')
                ->first();
    
            }else{
    
                $integrantes = DB::table('integrante_mesa AS a')
                ->join('padron AS b', 'b.cedula', '=', 'a.Cedula_Integrante')
                ->join('local_votacion AS c', 'c.Id_Local', '=', 'a.Id_Local')
                ->select('a.*', 'b.apellido_nombre', 'c.Desc_Local')
                ->where('a.Cedula_Integrante', $searchtext)
                ->orWhere('b.apellido_nombre', 'LIKE', '%'. $searchtext . '%')
                ->orderBy('a.Id_Local', 'ASC')
                // ->orderBy('a.Id_Mesa', 'ASC')
                ->paginate(10);
    
                $sessiones = DB::table('integrante_mesa')
                ->first();
    
            }
    
            return view('consulta.integrante_mesa', compact('integrantes', 'sessiones', 'searchtext'));

        // }else{

        //     return redirect()->route('consulta.padron_celular');

        // }

    }
    
    public function integrante_store(Request $request){


        $cedula_integrante = $request->get('cedula');
        $p_1= $request->get('Primera_Session');
        $p_2= $request->get('Segunda_Session');
        $p_3= $request->get('Tercera_Session');
        $p_4= $request->get('Cuarta_Session');
        $p_5= $request->get('Quinta_Session');
        $p_6= $request->get('Sexta_Session');
        $p_7= $request->get('Septima_Session');
        $p_8= $request->get('Octava_Session');
        $p_9= $request->get('Novena_Session');
        $p_10= $request->get('Decima_Session');

        if($p_1 == 'on'){

            $p_1 = 1;

        }else{

            $p_1 = 0;

        }

        if($p_2 == 'on'){

            $p_2 = 1;

        }else{

            $p_2 = 0;

        }
        if($p_3 == 'on'){

            $p_3 = 1;

        }else{

            $p_3 = 0;

        }

        if($p_4 == 'on'){

            $p_4 = 1;

        }else{

            $p_4 = 0;

        }
        if($p_5 == 'on'){

            $p_5 = 1;

        }else{

            $p_5 = 0;

        }

        if($p_6 == 'on'){

            $p_6 = 1;

        }else{

            $p_6 = 0;

        }

        if($p_7 == 'on'){

            $p_7 = 1;

        }else{

            $p_7 = 0;

        }

        if($p_8 == 'on'){

            $p_8 = 1;

        }else{

            $p_8 = 0;

        }

        if($p_9 == 'on'){

            $p_9 = 1;

        }else{

            $p_9 = 0;

        }

        if($p_10 == 'on'){

            $p_10 = 1;

        }else{

            $p_10 = 0;

        }

        $integrante = Integrante_Mesa::where('Cedula_Integrante', $cedula_integrante)
        ->first();
        
        $integrante->Primera_Session = $p_1;
        $integrante->Segunda_Session = $p_2;
        $integrante->Tercera_Session = $p_3;
        $integrante->Cuarta_Session = $p_4;
        $integrante->Quinta_Session = $p_5;
        $integrante->Sexta_Session = $p_6;
        $integrante->Septima_Session = $p_7;
        $integrante->Octava_Session = $p_8;
        $integrante->Novena_Session = $p_9;
        $integrante->Decima_Session = $p_10; 

        $integrante->save();

        return redirect()->route('consulta.integrante_mesa');

    }

    public function capacitacion(){

        $sessiones = Integrante_Mesa::first();

        return view('consulta.capacitacion_act', compact('sessiones'));

    }

    public function capacitacion_actualizar(Request $request){

        $request->validate([
            'sessiones' => 'required'
        ]);

        $session = $request->get('sessiones');

        $sessiones = Integrante_Mesa::first();

        $sessiones->Sessiones_Habilitar =  $session;

        $sessiones->save();

        return redirect()->route('consulta.capacitacion')->with('msj', 'Actualizado con exito');

    }

}
