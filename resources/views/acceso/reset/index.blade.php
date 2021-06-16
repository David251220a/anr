@extends('layouts.admin')

@section('contenido')

    <div class="rows">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">

            <h3>Usuario: {{$user->name}}</h3>
            
        </div>

    </div>

    <div class="rows">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
    
            @if (session()->has('msj'))
            <div class="alert alert-info" role="alert">{{session('msj')}}</div>
            @else
            <div class="alert alert-info"  role="alert" style="display:none;">{{session('msj')}}</div>
            @endif                
        </div>
    
    </div>

    {!! Form::model($user, ['method'=>'PUT','route'=>['reset.update', $user->id]] ) !!}
    {{Form::token()}}

    <div class="row">
        
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

            <div class="form-group">

                <label for="contraseña" >Nueva Contraseña</label>
                <input type="password" id="contraseña" required name="contraseña" required value="{{old('contraseña')}}" class="form-control" placeholder="contraseña..">

            </div>
        
        </div>

    </div>        

    <div class="row">
        
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

            <div class="form-group">
    
                <label for="contraseña1" >Repetir Contraseña</label>
                <input type="password" required name="contraseña1" id="contraseña1" required value="{{old('contraseña')}}" class="form-control" placeholder="contraseña..">
    
            </div>
        </div>

    </div>

    <div class="row">
    
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div id="msg"></div>
    
                <!-- Mensajes de Verificación -->
                <div id="error" class="alert alert-danger ocultar"  type="hidden" role="alert">
                Las Contraseñas no coinciden, vuelve a intentar !
                </div>
                <div id="ok" class="alert alert-success ocultar"  type="hidden" role="alert">
                Las Contraseñas coinciden !                 
    
            </div>
        
        </div>

    </div>
    
    <div class="row">

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">

            <div class="form-group">
            <input name="_token" value="{{ csrf_token() }}"  type="hidden"> 

                <button id="pguardar" class="btn btn-primary" type="submit">Guardar</button>
                <button class="btn btn-danger" type="reset">Cancelar</button>  
    
            </div>
    
        </div>    
        
    </div>

    {!! Form::close() !!}    

    @push('scripts')

        <script type="text/javascript">

            $(document).ready(function(){
                $("#error").hide();
                $("#ok").hide();
                $( "#contraseña1" ).keyup(function() {
                   verificarPasswords();
                });
                $("#pguardar").hide();
                
            });

            function verificarPasswords() {
 
                // Ontenemos los valores de los campos de contraseñas 
                pass1 = document.getElementById('contraseña');
                pass2 = document.getElementById('contraseña1');

                // Verificamos si las constraseñas no coinciden 
                if (pass1.value != pass2.value) {

                    $("#error").show();
                    $("#ok").hide();
                    $("#pguardar").hide();
                    

                } else {

                    $("#error").hide();
                    $("#ok").show();
                    $("#pguardar").show();
                    

                }

            }

        </script>

    @endpush

@endsection
