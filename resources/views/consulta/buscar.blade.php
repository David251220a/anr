@extends('layouts.admin')

@section('contenido')

    {!! Form::open(array('route' => 'consulta.index', 'method'=>'GET', 'autocomplete'=>'off', 'role'=>'search')) !!}
        
    <div class="form-group">

        <div class="input-group">

            <input type="search" class="form-control" name="searchtext"  placeholder="Buscar.." value="{{$searchtext}}">        
            <span class="input-group-btn">
            <button type="submit" class="btn btn-primary">Buscar</button>

        </span>

        </div>

    </div>

    {{Form::close() }}

    <div class="row">

        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

            <div class="table-responsive">

                <table id="detalles" class="table table-striped table-condensed table-bordered table-hover table-responsive">

                    <thead style="background-color:#f71808a8">

                        <th style="text-align: center; font-size: 1.2rem">Cedula</th>
                        <th style="text-align: center; font-size: 1.2rem">Apellido y Nombre</th>
                        <th style="text-align: center; font-size: 1.2rem">Local</th>
                        <th style="text-align: center; font-size: 1.2rem">M</th>
                        <th style="text-align: center; font-size: 1.2rem">O</th>
                        <th style="text-align: center; font-size: 1.2rem">C</th>
                        <th style="text-align: center; font-size: 1.2rem">Referentes</th>
                        <th style="text-align: center; font-size: 1.2rem">OK</th>
                        
                    </thead>

                    @if ($votante)

                        <tbody>

                            @foreach ($votante as $vota)
                            
                                <tr>
                                    {!! Form::open(['route' => 'consulta.store', 'autocomplete' => 'off', 'files' => true]) !!}
                                    <td style="text-align: right; font-size: 1.2rem">{{number_format($vota->cedula, 0, ".", ".")}} <input type="hidden" name="codpadron" value="{{$vota->CodPadron}}"></td>
                                    <td style="text-align: center; font-size: 1.2rem">{{$vota->apellido_nombre}}</td>
                                    <td style="text-align: center; font-size: 1.2rem">{{$vota->Desc_Local}}</td>
                                    <td style="text-align: right; font-size: 1.2rem">{{$vota->mesa}}</td>
                                    <td style="text-align: right; font-size: 1.2rem">{{$vota->orden}}</td>
                                    <td style="text-align: center; font-size: 1.2rem"> {!! Form::checkbox('voto', null, $vota->voto) !!} </td>
                                    <td style="text-align: center; font-size: 1.2rem"><input type="text" class="form-control" name="referente" value="{{$vota->referente}}"></td>
                                    <td style="text-align: center"> <button style="font-size: 1.2rem" class="btn btn-success btn-sm float-right" type="submit">OK</button> </td>
                                    {!! Form::close() !!}
                                </tr>

                            @endforeach

                        </tbody>
                        
                    @endif

                </table>

            </div>

            {{$votante-> render()}}

        </div>
    </div>

@endsection