<?php

namespace App\Http\Controllers;

use App\Padron_Comprometido;
use Illuminate\Http\Request;
use App\Auditoria;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InicioController extends Controller
{    

    public function index(){

        $id_rol = auth()->user()->id_rol;

        if($id_rol == 1){
                
            return redirect()->route('intendente.index');

        }

        if($id_rol == 2){
                
            return redirect()->route('intendente.index');

        }

    }

    public function padron_ver(Request $request){

        $searchtext=str_replace('.', '', trim($request->get('searchtext')));
        $votante="";
        $id_user = auth()->id();        

        $votante = "";

        if($searchtext){
        
            $votante = DB::table('padron AS a')
            ->join('local_votacion AS b','b.Id_Local','=','a.local')            
            ->select('a.*', 'b.Desc_Local')
            ->addSelect(['voto' => Padron_Comprometido::select('voto')
                ->whereColumn('Cod_Comprometido', 'a.CodPadron')
                ->where('Id_User', $id_user)
                ->limit(1)
            ])
            ->addSelect(['comprometido' => Padron_Comprometido::select('comprometido')
                ->whereColumn('Cod_Comprometido', 'a.CodPadron')
                ->where('Id_User', $id_user)
                ->limit(1)
            ])
            ->addSelect(['apellido_nombre_Referente' => Padron_Comprometido::select('apellido_nombre_Referente')
                ->whereColumn('Cod_Comprometido', 'a.CodPadron')
                ->where('Id_User', $id_user)
                ->limit(1)
            ])
            ->where('a.cedula', $searchtext)
            ->orderBy('a.local', 'ASC')
            ->orderBy('a.mesa', 'ASC')
            ->first();

            if($votante){

                $auditoria = new Auditoria();

                $auditoria->Cod_Padron = $votante->CodPadron;
                $auditoria->cedula = $votante->cedula;
                $auditoria->Id_User = 54;
                $auditoria->Fecha_Hora = Carbon::now();

                $auditoria->save();
            }
            
        }

        return view('consulta.padron', compact('searchtext', 'votante'));
        

    }

}
