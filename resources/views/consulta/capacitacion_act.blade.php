@extends('layouts.admin')

@section('contenido')

    <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            @if (session()->has('msj'))
            
                <div class="alert alert-danger" role="alert">{{session('msj')}}</div>
                
            @endif        

        </div>

    </div>

    {!! Form::open(array('route' => 'consulta.capacitacion_actualizar', 'method'=>'POST', 'autocomplete'=>'off', 'role'=>'search')) !!}
        
        <div class="row">

            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">

                <div class="form-group">

                    <div class="input-group">
                        
                        <label for="">Habiltacion de Capacitación</label>
                        <input type="text" class="form-control" name="sessiones" value="{{$sessiones->Sessiones_Habilitar}}">
                        @error('sessiones')

                            <span class="text-danger">{{$message}}</span>

                        @enderror
        
                    </div>
        
                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">

                <div class="input-group">
                            
                    <button type="submit" class="btn btn-primary">Grabar</button>

                </div>

            </div>
        </div>

    {{Form::close() }}

@endsection