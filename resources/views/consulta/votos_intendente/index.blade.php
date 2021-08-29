@extends('layouts.admin')

@section('contenido')

    <div class="rows">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            
            <LEGEND><b> <i> <u><h3>Ultimos votos cargados - Intendente</h3></u></i></b> </LEGEND>

        </div>
        
    </div>

    {!! Form::open(['route' => 'consulta_intendente.index','method'=>'GET', 'autocomplete' => 'off', 'role'=>'search']) !!}

        <div class="row">

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            
                <div class="form-group">

                    <select name="id_local" id="id_local" class="form-control selectpicker"  data-live-search="true">
                                
                        <option value="99" @if(99 == $local) selected="selected" @endif>TODOS LOS LOCALES</option>

                        @foreach ($local_votacion as $vot)
                            
                            <option value="{{$vot->Id_Local}}" @if($vot->Id_Local == $local) selected="selected" @endif>{{$vot->Desc_Local}} </option>
    
                        @endforeach
    
                    </select>
                    

                </div>
            
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            
                <div class="form-group">

                    <div class="input-group">
                        
                        <select name="id_mesa" id="id_mesa" class="form-control selectpicker"  data-live-search="true">
                        
                            <option value="99" @if(99 == $mesa) selected="selected" @endif>TODAS LAS MESAS</option>

                            @foreach ($mesas as $me)
                                
                                <option value="{{$me->Id_Mesa}}"  @if($me->Id_Mesa == $mesa) selected="selected" @endif>{{$me->Mesa}} </option>
        
                            @endforeach
        
                        </select>
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-primary">Buscar </button>
                        </span>

                    </div>

                </div>
            
            </div>

        </div>

    {{Form::close() }}


<script type="text/javascript">

</script>

@endsection