<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use DB;
use App\User;

class acc_UsuarioController extends Controller
{
    public function __construct(){

        $this->middleware('auth');

    }

    public function index(Request $request){

        $id_user = auth()->id();
        $rol = DB::table('users')   
        ->where('id','=',$id_user)
        ->first();

        $id_rol = $rol->id_rol;        
        
        if($request){

            if ($id_rol == 1) {

                $query=trim($request->get('searchtext'));
                $usuario = DB::table('users AS a')                
                ->where('name','LIKE','%'.$query.'%')
                ->orderby('id','asc')
                ->paginate(10);
    
                return view('acceso\usuario.index',["usuario"=>$usuario, "searchtext"=>$query]);
    
            }else{
    
                return redirect('votacion/intendente');
    
            }

        }
        
    
    }

    public function store(Request $request){

        $id_user = auth()->id();
        $rol = DB::table('users')   
        ->where('id','=',$id_user)
        ->first();

        $id_rol = $rol->id_rol;    

        if ($id_rol == 1) {

            $cant_cadena = strlen($request->get('contraseña'));
                
            if ($cant_cadena <= 5){

                return back()->with('msj', 'La contraseña minima debe de contener maximo 6 caracteres.!!!');

            }

            $user = new User();

            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->password =  bcrypt($request->get('contraseña'));
            $user->id_rol = 2;

            $user->save();

            return redirect('acceso/usuario');

        }else{

            return redirect('votacion/intendente');

        }

        
    }

    public function destroy(Request $request, $id){

        $id_user = auth()->id();
        $rol = DB::table('users')   
        ->where('id','=',$id_user)
        ->first();

        $id_rol = $rol->id_rol;    

        if ($id_rol == 1) {

            $cant_cadena = strlen($request->get('contraseña'));
                
            if ($cant_cadena <= 5){

                return back()->with('msj', 'La contraseña minima debe de contener maximo 6 caracteres.!!!');

            }

            $user = User::findOrFail($id);
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->password = bcrypt($request->get('contraseña'));            
            $user->update();

            return redirect('acceso/usuario');

        }else{

            return redirect('votacion/intendente');

        }

    }
}
