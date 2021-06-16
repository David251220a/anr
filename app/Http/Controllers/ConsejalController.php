<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use DB;
use Carbon\Carbon;
use App\Votacion_Consejal;
use App\Auditoria;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Storage;

class ConsejalController extends Controller
{
    public function __construct(){

        $this->middleware('auth');

    }

    public function index(Request $request){        

        if($request){
            
            $id_user = auth()->id();

            $consejal = DB::table('consejal AS a')
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

            $aux_consejal = DB::table('consejal')            
            ->orderBy('Id_Consejal', 'ASC')
            ->get();

            $local_votacion = DB::table('local_votacion')
            ->orderBy('Id_Local', 'ASC')
            ->get();

            $mesa = DB::table('mesa')
            ->orderBy('Id_Mesa', 'ASC')
            ->get();

            $votos_consejal = DB::table('votacion_consejal AS a')
            ->join('consejal AS b','b.Id_Consejal','=','a.Id_Consejal')
            ->join('lista AS c','c.Id_Lista','=','b.Id_Lista')
            ->select('a.Id_Consejal'            
            , DB::raw('SUM(a.`Votos`) AS Votos')
            , 'b.Apellido'
            , 'b.Nombre'
            , 'c.Desc_Lista')            
            ->groupBy('a.Id_Consejal'                    
            , 'b.Apellido'
            , 'b.Nombre'
            , 'c.Desc_Lista')            
            ->get();

            return view('votacion\consejal.index',["consejal"=>$consejal
            , "user"=>$user
            , "mesa"=>$mesa
            , "aux_consejal"=>$aux_consejal
            , "local_votacion"=>$local_votacion
            , "votos_consejal"=>$votos_consejal]);

           

        }

    }

    public function store(Request $request){        
        
        $id_user = auth()->id();

        $hubo_error = 0;

        try {
            
            DB::beginTransaction();                        

            $consejal = $request->get('consejal');
            $votos = $request->get('votos');
            $local = $request->get('local');
            $mesa = $request->get('mesa');

            $date = Carbon :: now ();

            $cont = 0;

            while ($cont < count($consejal)) {

                $id_consejal = $consejal[$cont];
                $local_votacion = $local[$cont];
                $id_mesa = $mesa[$cont];

                $verificacion_votacion = DB::table('votacion_consejal')
                ->where('Id_Consejal','=',$id_consejal)
                ->where('Id_Local','=',$local_votacion)
                ->where('Id_Mesa','=',$id_mesa)
                ->first();

                if (empty($verificacion_votacion->Id_Consejal)){

                    $votacion = new Votacion_Consejal();

                    $votacion->Id_Consejal = $consejal[$cont];
                    $votacion->Votos = $votos[$cont];
                    $votacion->Id_Mesa = $mesa[$cont];
                    $votacion->Fecha_Alta = $date;
                    $votacion->Id_Local = $local[$cont];
                    $votacion->Id_User = $id_user;
                    if ($request->hasFile('pacta')){

                        $file = $request->file('pacta');
                        $file->move(public_path().'./imagenes/acta/', $file->getClientOriginalName());
                        $votacion->imagen = $file->getClientOriginalName();

                    }
                    
                    $votacion->save();

                    $auditoria = new Auditoria();

                    $auditoria->Id_Consejal = $consejal[$cont];                    
                    $auditoria->Id_Local = $local[$cont];
                    $auditoria->Id_Mesa = $mesa[$cont];
                    $auditoria->Votos_Valor_Anterior = 0;
                    $auditoria->Votos_Valor_Nuevo = $votos[$cont];
                    $auditoria->Descripcion_Cambio = "Primera carga de Consejal en el Local: ".$local[$cont]. " mesa: " .$mesa[$cont];
                    $auditoria->Fecha = $date;
                    $auditoria->Id_User = $id_user;
                    
                    $auditoria->save();

                }else{

                    $hubo_error = 1;
                    break;

                }
                
                $cont = $cont + 1 ;
            }

            if ($hubo_error == 1){

                return back()->with('msj', 'Ya se ha cargado los votos del Consejal en este local de Votacion y Mesa!!!');

            }
            
            DB::commit();

        } catch (\Excepcion $e) {
            //throw $th;
            DB::rollback();
        }

        return redirect('votacion/consejal');

    }

}
