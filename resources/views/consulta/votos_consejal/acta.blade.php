@extends('layouts.admin')

@section('contenido')

<div class="container">

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="text-center">

            <img src="{{asset('imagenes/acta/'.$votos_consejal->imagen)}}" alt="{{$votos_consejal->imagen}}" 
            height="500 px" width="500 px" class="img-thumbnail">

        </div>
        
    </div>

</div>
@endsection