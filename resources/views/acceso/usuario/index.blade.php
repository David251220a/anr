@extends('layouts.admin')

@section('contenido')

<div class="rows">

    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">

        <h3>Listado de Usuario  <a href="usuario/create"> <a href="" data-target="#modal-edit" data-toggle="modal">
            <button class="btn btn-success">Nuevo</button>
       </a></h3>
        @include('acceso.usuario.search')
        @include('acceso.usuario.modal')
        
    </div>

</div>

<div class="rows">

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        @if (session()->has('msj'))
        
        <div class="alert alert-danger" role="alert">{{session('msj')}}</div>
        
        @else
            
        @endif
    </div>
</div>

    <div class="rows">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <div class="table-responsive">

                <table class="table table-striped table-bordered table-condensed table-hover">

                    {{-- Cabecera de la tabla --}}
                    
                    <thead>

                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Opciones</th>

                    </thead>
                                        
                    @foreach ($usuario as $usu)
                    <tr>

                        <td>{{$usu->name}}</td>
                        <td>{{$usu->email}}</td>
                        <td>
                            
                            <a href="" data-target="#modal-delete-{{$usu->id}}" data-toggle="modal">
                            <button class="btn btn-danger">Cambiar Contraseña</button>
                            </a>
                           
                        </td>
                    </tr>                    

                    @include('acceso.usuario.modal_contraseña')

                    @endforeach
                    
                </table>

            </div>

            {{$usuario -> render()}}

        </div>

    </div>


@endsection