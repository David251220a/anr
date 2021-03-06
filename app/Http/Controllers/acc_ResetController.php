<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\User;

class acc_ResetController extends Controller
{
    public function __construct(){

        $this->middleware('auth');

    }

    public function index(Request $request){

        $id_user = auth()->id();        

        $user = DB::table('users')   
        ->where('id','=',$id_user)
        ->first();

        if($request){

            return view('acceso.reset.index',["user"=>$user]);

        }

    }

    
    public function update(Request $request, $id){        

        $user = User::findOrFail($id);        
        $user->password = bcrypt($request->get('contraseña'));
        $user->api_token=Str::random(60);
        $user->update();
                
        return redirect('acceso/reset')->with('msj', 'Se cambio correctamente la constraseña.!!');;
        

    }
    
}
