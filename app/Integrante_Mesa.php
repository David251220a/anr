<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Integrante_Mesa extends Model
{
    protected $table = 'integrante_mesa';    

    public $timestamps= false;

    protected $primarykey='Id_Integrante';

    protected $guarded;

    public function getKeyName(){
        return "Id_Integrante";
    }
}
