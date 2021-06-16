@extends('layouts.admin')

@section('contenido')

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

    <img src="{{asset('imagenes/acta/'.$votos_intendente->imagen)}}" alt="{{$votos_intendente->imagen}}" 
    height="500 px" width="500 px" class="img-thumbnail">
    
</div>

@endsection