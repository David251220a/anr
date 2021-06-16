<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use DB;
use Carbon\Carbon;
use App\Votacion_Intendente;
use App\Auditoria;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Storage;

class ConsultaController extends Controller
{
    
    public function __construct(){

        $this->middleware('auth');

    }
    
    public function index(Request $request){        

        if($request){
            
            $id_user = auth()->id();

            $votos_intendente = DB::table('votacion_intendente AS a')
            ->join('intendente AS b','b.Id_Intendente','=','a.Id_Intendente')
            ->join('lista AS c','c.Id_Lista','=','b.Id_Lista')
            ->join('local_votacion AS d','d.Id_Local','=','a.Id_Local')
            ->join('mesa AS e','e.Id_Mesa','=','a.Id_Mesa')
            ->select('a.*'
            , 'b.Apellido'
            , 'b.Nombre'
            , 'c.Desc_Lista'
            , 'd.Desc_Local'
            , 'e.Mesa')
            ->orderBy('a.Id_Intendente', 'ASC')
            ->orderBy('a.Id_Local', 'ASC')
            ->orderBy('a.Id_Mesa', 'ASC')
            ->get();

            return view('consulta\votos_intendente.index',["votos_intendente"=>$votos_intendente]);

        }

    }

    public function destroy(Request $request, $id){        

        $id_user = auth()->id();
        $date = Carbon :: now ();

        $votos_intendente = Votacion_Intendente::findOrFail($id);        
        $votos_intendente->Votos=$request->get('votos');
        $votos_intendente->Fecha_Actualizacion=$date;
        if ($request->hasFile('pacta')){

            $file = $request->file('pacta');
            $file->move(public_path().'./imagenes/acta/', $file->getClientOriginalName());
            $votos_intendente->imagen = $file->getClientOriginalName();

        }
        $votos_intendente->update();

        $auditoria = new Auditoria();
        $auditoria->Id_Intendente = $request->get('id_intendente');
        $auditoria->Id_Local = $request->get('id_local');
        $auditoria->Id_Mesa = $request->get('id_mesa');
        $auditoria->Votos_Valor_Anterior = $request->get('votos_anterior');
        $auditoria->Votos_Valor_Nuevo = $request->get('votos');
        $auditoria->Descripcion_Cambio = "Actualizacion de Votos: ".$request->get('votos')." local: " .$request->get('id_local'). " mesa: " .$request->get('id_mesa');
        $auditoria->Fecha = $date;
        $auditoria->Id_User = $id_user;

        $auditoria->save();

        return redirect('consulta/votos_intendente');        

    }

    public function Acta($id){

        $votos_intendente = Votacion_Intendente::findOrFail($id);
        return view('consulta\votos_intendente.acta',["votos_intendente"=>$votos_intendente]);

    }

}
