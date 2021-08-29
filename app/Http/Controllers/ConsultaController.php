<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Votacion_Intendente;
use Illuminate\Support\Facades\DB;

class ConsultaController extends Controller
{
    
    public function __construct(){

        $this->middleware('auth');

    }
    
    public function index(Request $request){        

        if($request){
            
            $id_user = auth()->id();
            $searchtext=trim($request->get('searchtext'));
            $local=trim($request->get('id_local'));
            $mesa=trim($request->get('id_mesa'));

            $local_votacion = DB::table('local_votacion')
            ->orderBy('Id_Local', 'ASC')
            ->get();            

            $mesas = DB::table('mesa')
            ->orderBy('Id_Mesa', 'ASC')
            ->get();

            return view('consulta.votos_intendente.index', compact('searchtext', 'local_votacion', 'mesas', 'local', 'mesa'));

        }

    }

    public function destroy(Request $request, $id){

        return redirect('consulta/votos_intendente');        

    }

    public function Acta($id){

        $votos_intendente = Votacion_Intendente::findOrFail($id);
        return view('consulta.votos_intendente.acta',["votos_intendente"=>$votos_intendente]);

    }

}
