<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
    protected $table = 'auditoria';    

    public $timestamps= false;

    protected $primarykey='Id_Auditoria';

    public function getKeyName(){
        return "Id_Auditoria";
    }
}
