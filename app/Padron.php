<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Padron extends Model
{
    protected $table = 'padron';    

    public $timestamps= false;

    protected $primarykey='CodPadron';

    protected $guarded;

    public function getKeyName(){
        return "CodPadron";
    }
}
