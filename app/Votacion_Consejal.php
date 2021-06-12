<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Votacion_Consejal extends Model
{
    protected $table = 'votacion_consejal';    

    public $timestamps= false;

    protected $primarykey='Id_Votacion_Consejal';

    public function getKeyName(){
        return "Id_Votacion_Consejal";
    }
}
