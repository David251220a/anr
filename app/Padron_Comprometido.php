<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Padron_Comprometido extends Model
{
    protected $table = 'padron_comprometido';    

    public $timestamps= false;

    protected $primarykey='Id_Comprometido';

    protected $guarded;

    public function getKeyName(){
        return "Id_Comprometido";
    }
}
