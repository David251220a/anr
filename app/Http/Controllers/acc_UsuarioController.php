<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
    
                return view('acceso.usuario.index',["usuario"=>$usuario, "searchtext"=>$query]);
    
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
            $user->id_rol = $request->get('id_rol');
            $user->url = $request->get('url').".jpg";
            $user->password =  bcrypt($request->get('contraseña'));            
            $user->api_token=Str::random(60);

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

            $random = Str::random(40);

            $user = User::findOrFail($id);
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->password = bcrypt($request->get('contraseña'));     
            $user->api_token=$random;       
            $user->update();

            return redirect('acceso/usuario');

        }else{

            return redirect('votacion/intendente');

        }

    }

    public function update(Request $request, $id){

        $usuario = User::find($id);
        
        $usuario->url = $request->get('url');
        $usuario->name = $request->get('name');
        $usuario->email = $request->get('email');
        $usuario->id_rol = $request->get('id_rol');

        $usuario->update();

        return redirect('acceso/usuario')->with('msj', 'Se actualizo usuario con exito.');

    }
}
