<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use DB;
use Carbon\Carbon;
use App\Votacion_Intendente;

class IntendenteController extends Controller
{
    
    public function __construct(){

        $this->middleware('auth');

    }

    public function index(Request $request){        

        if($request){
            
            $id_user = auth()->id();

            $intendente = DB::table('intendente AS a')
            ->join('lista AS b','b.Id_Lista','=','a.Id_Lista')
            ->select('a.*'
            ,'b.Desc_Lista')
            ->orderBy('Id_Lista', 'ASC')
            ->get();

            $user = DB::table('user_config AS a')
            ->join('local_votacion AS b','b.Id_Local','=','a.Id_Local')
            ->select('a.*'
            ,'b.Desc_Local')
            ->where('a.Id_User','=',$id_user)
            ->first();

            $local_votacion = DB::table('local_votacion')
            ->orderBy('Id_Local', 'ASC')
            ->get();

            $mesa = DB::table('mesa')
            ->orderBy('Id_Mesa', 'ASC')
            ->get();

            $votos_intendente = DB::table('votacion_intendente AS a')
            ->join('intendente AS b','b.Id_Intendente','=','a.Id_Intendente')
            ->join('lista AS c','c.Id_Lista','=','b.Id_Lista')
            ->select('a.Id_Intendente'            
            , DB::raw('SUM(a.`Votos`) AS Votos')
            , 'b.Apellido'
            , 'b.Nombre'
            , 'c.Desc_Lista')            
            ->groupBy('a.Id_Intendente'                    
            , 'b.Apellido'
            , 'b.Nombre'
            , 'c.Desc_Lista')            
            ->get();

            return view('votacion\intendente.index',["intendente"=>$intendente
            , "user"=>$user
            , "mesa"=>$mesa
            , "local_votacion"=>$local_votacion
            , "votos_intendente"=>$votos_intendente]);

           

        }

    }

    public function store(Request $request){        
        
        $id_user = auth()->id();

        $hubo_error = 0;

        try {
            
            DB::beginTransaction();                        

            $intendente = $request->get('intendente');
            $votos = $request->get('votos');
            $local = $request->get('local');
            $mesa = $request->get('mesa');

            $date = Carbon :: now ();

            $cont = 0;

            while ($cont < count($intendente)) {

                $id_intendente = $intendente[$cont];
                $local_votacion = $local[$cont];
                $id_mesa = $mesa[$cont];

                $verificacion_votacion = DB::table('votacion_intendente')
                ->where('Id_Intendente','=',$id_intendente)
                ->where('Id_Local','=',$local_votacion)
                ->where('Id_Mesa','=',$id_mesa)
                ->first();

                if (empty($verificacion_votacion->Id_Intendente)){

                    $votacion = new Votacion_Intendente();

                    $votacion->Id_Intendente = $intendente[$cont];
                    $votacion->Votos = $votos[$cont];
                    $votacion->Id_Mesa = $mesa[$cont];
                    $votacion->Fecha_Alta = $date;
                    $votacion->Id_Local = $local[$cont];
                    $votacion->Id_User = $id_user;
                    
                    $votacion->save();

                }else{

                    $hubo_error = 1;
                    break;

                }
                
                $cont = $cont + 1 ;
            }

            if ($hubo_error == 1){

                return back()->with('msj', 'Ya se ha cargado los votos del Intendente en este local de Votacion y Mesa!!!');

            }
            
            DB::commit();

        } catch (\Excepcion $e) {
            //throw $th;
            DB::rollback();
        }

        return redirect('votacion/intendente');

    }
}
