<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aporedados extends Model
{
    //
    protected $table = 'aporedado_local';    

    public $timestamps= false;

    protected $primarykey='Id_Aporedado';

    protected $guarded;

    public function getKeyName(){
        return "Id_Aporedado";
    }
}
