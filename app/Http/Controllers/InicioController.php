<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function __construct(){

        $this->middleware('auth');

    }

    public function index(){

        $id_rol = auth()->user()->id_rol;

        if($id_rol == 1){
                
            return redirect()->route('intendente.index');

        }

        if($id_rol == 2){
                
            return redirect()->route('intendente.index');

        }

    }

}
