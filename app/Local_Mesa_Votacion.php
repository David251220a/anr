<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Local_Mesa_Votacion extends Model
{
    protected $table = 'local_mesa_votacion';    


    // public static function mesas($id){

    //     $mesas = DB::table('local_mesa_votacion')
    //     ->where('Id_Local', $id)
    //     ->where('Activo', 1)
    //     ->get();

    //     return $mesas;
    // }
}
