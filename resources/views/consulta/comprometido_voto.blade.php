@extends('layouts.admin')

@section('contenido')

    <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <h2 style="text-align: center">{{date('d-m-Y H:i', strtotime(Carbon\Carbon::now()))}}</h2>

        </div>
    </div>

    <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            
            {!! Form::open(array('route' => 'consulta.comprometido_voto', 'method'=>'GET', 'autocomplete'=>'off', 'role'=>'search')) !!}

                <div class="form-group">

                    <div class="input-group">
                        
                        <select name="local" id="local" class="form-control selectpicker"  data-live-search="true">
                                    
                            <option value="99" @if(99 == $local) selected="selected" @endif>TODOS LOS LOCALES</option>
                        
                            @foreach ($local_votacion as $locales)
                                
                                <option value="{{$locales->Id_Local}}" @if($locales->Id_Local == $local) selected="selected" @endif>{{$locales->Id_Local}}-{{$locales->Desc_Local}} </option>
                        
                            @endforeach
                        
                        </select>
                    
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-primary">Buscar </button>
                        </span>
                            

                    </div>

                </div>
        
            {{Form::close() }}

        </div>

    </div>

    <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            
            @if ($votaciones)

                @if ($local == 99)

                    <div class="table-responsive">

                        <table id="detalles" class="table table-striped table-condensed table-bordered table-hover table-responsive">

                            <thead style="background-color:#f71808a8">

                                <tr style="text-align: center">
                                    
                                    <th colspan="6" style="text-align: center">Votos</th>
                                    
                                </tr>
                                <tr style="text-align: center">

                                    <th style="text-align: center">Cedula</th>
                                    <th style="text-align: center">Apellido Nombre</th>
                                    <th style="text-align: center">Local</th>
                                    <th style="text-align: center">M</th>
                                    <th style="text-align: center">Usuario</th>
                                    <th style="text-align: center">Hora</th>


                                </tr>

                            </thead>
                            @php
                                $total_local = 0;
                            @endphp
                            <tbody>

                                @foreach ($votaciones as $vot)
                                        
                                    <tr style="text-align: center">
                                        
                                        <td style="text-align: right">{{number_format($vot->cedula,0, ".", ".")}}</td>
                                        <td>{{$vot->apellido_nombre}}</td>
                                        <td>{{$vot->Desc_Local}}</td>
                                        <td style="text-align: right">{{number_format($vot->mesa,0, ".", ".")}}</td>
                                        <td>{{$vot->usuario}}</td>
                                        <td>{{date('H:i', strtotime($vot->FechaHora))}}</td>

                                        @php
                                            $total_local = $total_local + 1;
                                        @endphp                                                                                        
                                        
                                    </tr>

                                @endforeach

                            </tbody>

                            <tfoot>

                                <tr style="background-color:#f71808a8">

                                    <td  colspan="5"> <b>Total de Votos</b></td>
                                    <td style="text-align: right"><b>{{number_format($total_local,0, ".", ".")}} </b></td>

                                </tr>

                            </tfoot>

                        </table>

                    </div>
                
                @else
            

                    <div class="table-responsive">

                        <table id="detalles" class="table table-striped table-condensed table-bordered table-hover table-responsive">

                            <thead style="background-color:#f71808a8">

                                <tr style="text-align: center">
                                    
                                    <th colspan="6" style="text-align: center">Votos / Local  de {{$dale->Desc_Local}}</th>
                                    
                                </tr>
                                <tr style="text-align: center">

                                    <th style="text-align: center">Cedula</th>
                                    <th style="text-align: center">Apellido Nombre</th>
                                    <th style="text-align: center">Local</th>
                                    <th style="text-align: center">M</th>
                                    <th style="text-align: center">Usuario</th>
                                    <th style="text-align: center">Hora</th>


                                </tr>

                            </thead>
                            @php
                                $total_local = 0;
                            @endphp
                            <tbody>

                                @foreach ($votaciones as $vot)
                                        
                                    @if ($vot->Id_Local == $local)
                                    
                                        <tr style="text-align: center">
                                            
                                            <td style="text-align: right">{{number_format($vot->cedula,0, ".", ".")}}</td>
                                            <td>{{$vot->apellido_nombre}}</td>
                                            <td>{{$vot->Desc_Local}}</td>
                                            <td style="text-align: right">{{number_format($vot->mesa,0, ".", ".")}}</td>
                                            <td>{{$vot->usuario}}</td>
                                            <td>{{date('H:i', strtotime($vot->FechaHora))}}</td>

                                            @php
                                                $total_local = $total_local + 1;
                                            @endphp                                                                                        
                                            
                                        </tr>

                                    @endif

                                @endforeach

                            </tbody>

                            <tfoot>

                                <tr style="background-color:#f71808a8">

                                    <td  colspan="5"> <b>Total de Votos</b></td>
                                    <td style="text-align: right"><b>{{number_format($total_local,0, ".", ".")}} </b></td>

                                </tr>

                            </tfoot>

                        </table>

                    </div>

                @endif
        
            @endif

        </div>

    </div>

@endsection
