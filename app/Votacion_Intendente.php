<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Votacion_Intendente extends Model
{
    protected $table = 'votacion_intendente';    

    public $timestamps= false;

    protected $primarykey='Id_Votacion';


    public function getKeyName(){
        return "Id_Votacion";
    }
}
