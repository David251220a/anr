@extends('layouts.admin')

@section('contenido')

<div class="rows">

    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">

        <h3>Listado de Usuario  
        <a href="usuario/create"> <a href="" data-target="#modal-edit" data-toggle="modal">
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
                        <th>Nivel</th>
                        <th>URL</th>
                        <th>Opciones</th>

                    </thead>
                                        
                    @foreach ($usuario as $usu)
                    <tr>

                        <td>{{$usu->name}}</td>
                        <td>{{$usu->email}}</td>
                        <td>{{$usu->url}}</td>
                        <td style="text-align: center">{{$usu->id_rol}}</td>
                        <td>
                            
                            <a href="" data-target="#modal-delete-{{$usu->id}}" data-toggle="modal">
                                <button class="btn btn-danger">Cambiar Contraseña</button>
                            </a>

                            <a href="" data-target="#modal-new-{{$usu->id}}" data-toggle="modal">
                                <button class="btn btn-primary">Editar</button>
                            </a>
                           
                        </td>
                    </tr>                    

                    @include('acceso.usuario.modal_contrasena')
                    @include('acceso.usuario.modal_edit')

                    @endforeach
                    
                </table>

            </div>

            {{$usuario -> render()}}

        </div>

    </div>


@endsection