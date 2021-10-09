<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use DB;

class AuditoriaController extends Controller
{
    public function __construct(){

        $this->middleware('auth');

    }

    public function index(Request $request){

        if($request){
                    
            $sql_Call = 'CALL auditoria';

            $auditoria = DB::select($sql_Call);

            return view('acceso.auditoria.index',["auditoria"=>$auditoria]);    
            
        }

    }
}
