@extends('layouts.admin')

@section('contenido')

    <div class="rows">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            @if (session()->has('msj'))
            
                <div class="alert alert-danger" role="alert">{{session('msj')}}</div>
                
            @endif        

        </div>

    </div>

    <div class="rows">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            
            <LEGEND><b> <i> <u><h3>Ultimos votos cargados - Consejal</h3></u></i></b> </LEGEND>

        </div>
        
    </div>

    {!! Form::open(['route' => 'consulta_consejal.index','method'=>'GET', 'autocomplete' => 'off', 'role'=>'search']) !!}

        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            
                <div class="form-group">

                    <div class="input-group">
                        
                        <select name="id_local" id="id_local" class="form-control selectpicker"  data-live-search="true">
                                
                            <option value="99" @if(99 == $local) selected="selected" @endif>TODOS LOS LOCALES</option>
    
                            @foreach ($local_votacion as $vot)
                                
                                <option value="{{$vot->Id_Local}}" @if($vot->Id_Local == $local) selected="selected" @endif>{{$vot->Desc_Local}} </option>
        
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

    <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <div class="table-responsive">

                <table id="detalles" class="table table-striped table-condensed table-bordered table-hover table-responsive">

                    <thead style="background-color:#f71808a8">

                        <th style="text-align: center">Local</th>
                        <th style="text-align: center">Mesa</th>
                        <th style="text-align: center">Votos Total</th>
                        <th style="text-align: center">Opciones</th>

                    </thead>

                    @if ($votos)

                        <tbody>

                            @foreach ($votos as $voto)

                                <tr>

                                    <td style="text-align: center">{{$voto->Desc_Local}}</td>
                                    <td style="text-align: center">{{$voto->Mesa}}</td>
                                    <td style="text-align: right">{{number_format($voto->cont, 0, ".", ".")}}</td>
                                    <td style="text-align: center" width="300px">
                                        <a href="{{ route('consulta_consejal.editar', [$voto->Id_Local, $voto->Id_Mesa]) }}">
                                            <button class="btn btn-info btn-sm">Editar</button>
                                        </a>
                                        <a href="#">
                                            <button class="btn btn-primary btn-sm">Acta</button>
                                        </a>
                                        <a href="#" target="_blank">
                                            <button class="btn btn-primary btn-sm">PDF</button>
                                        </a>
                                        @if ((Auth::user()->id == 1) || (Auth::user()->id == 2))

                                            <a href="{{ route('consulta_consejal.eliminar',[$voto->Id_Local, $voto->Id_Mesa]) }}">
                                                <button class="btn btn-danger btn-sm">Eliminar</button>
                                            </a>
                                            
                                        @endif

                                    </td>


                                </tr>
                                
                            @endforeach

                        </tbody>
                        
                    @endif

                </table>

            </div>

            {{-- {{$votos-> links()}} --}}
            {{$votos->appends(['votos' => $votos])->links()}}

        </div>

    </div>


<script type="text/javascript">

</script>

@endsection