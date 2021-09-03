@extends('layouts.admin')

@section('contenido')

    <div class="row">

        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
            
            {!! Form::open(array('route' => 'reportes.intendente_local', 'method'=>'GET', 'autocomplete'=>'off', 'role'=>'search')) !!}

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

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
        
            <a href=" {{ route('intendente_local', $local) }} " target="_blank">
                <button class="btn btn-info float-right"><li  class="fa fa-file-pdf-o"></li> PDF</button>
            </a>
        
        </div>

        

    </div>

    <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        
            <u><h4 align="center" ><strong>Resumen de Votos por Local</strong></h4></u>
        
        </div>

    </div>

    <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            
            @if((empty($local)) || ($local == 99))
            
                @foreach ($local_votacion as $loca)

                    <div class="table-responsive">

                        <table id="detalles" class="table table-striped table-condensed table-bordered table-hover table-responsive">

                            <thead style="background-color:#f71808a8">

                                <tr style="text-align: center">
                                    
                                    <th colspan="3" style="text-align: center">{{$loca->Id_Local}}-{{$loca->Desc_Local}}</th>
                                    
                                </tr>
                                <tr style="text-align: center">
        
                                    <th style="text-align: center">Lista</th>
                                    <th style="text-align: center">Intendente</th>
                                    <th style="text-align: center">Votos</th>
        
                                </tr>
        
                            </thead>

                            @php
                                $total_local=0;
                            @endphp
                            @php
                                $total_general = 0;
                            @endphp
                            
                            <tbody>

                                @foreach ($votacion_intendente as $vot)
                            
                                    @if($vot->Id_Local == $loca->Id_Local)
                                        
                                        <tr style="text-align: center">
                                            
                                            <td>{{$vot->Desc_Lista}} - {{$vot->Alias}}</td>
                                            <td>{{$vot->intendente}}</td>
                                            <td style="text-align: right">{{number_format($vot->votos,0, ".", ".")}}</td>
                                            @php
                                                $total_local = $vot->total_general_local;
                                            @endphp                                                                                        
                                            
                                        </tr>

                                    @endif

                                    @php
                                        $total_general = $vot->total_general;
                                    @endphp

                                @endforeach

                            </tbody>

                            <tfoot>

                                <tr style="background-color:#f71808a8">

                                    <td  colspan="2"> <b>Total de Votos</b></td>
                                    <td style="text-align: right"><b>{{number_format($total_local,0, ".", ".")}} </b></td>

                                </tr>

                            </tfoot>

                        </table>

                    </div>

                @endforeach
                
                <div class="table-responsive">

                    <table id="detalles" class="table table-striped table-condensed table-bordered table-hover table-responsive">

                        <thead style="background-color:#f71808a8">
                            <tr>

                                <th style="text-align: center"><b>TOTAL GENERAL DE VOTOS</b></th>
                                <th style="text-align: center"><b>{{$total_general}}</b></th>

                            </tr>
                            
                        </thead>

                    </table>

                </div>
                
            @else
                
                @php
                    $local1= "";
                @endphp

                @foreach ($local_votacion as $loca1)
                    
                    @if ($loca1->Id_Local == $local)

                        @php
                            $local1=$loca1->Id_Local. "-".$loca1->Desc_Local;
                        @endphp
                        
                    @endif

                @endforeach
                                    

                <div class="table-responsive">

                    <table id="detalles" class="table table-striped table-condensed table-bordered table-hover table-responsive">

                        <thead style="background-color:#f71808a8">

                            <tr style="text-align: center">
                                
                                <th colspan="3" style="text-align: center">{{$local1}}</th>
                                
                            </tr>
                            <tr style="text-align: center">

                                <th style="text-align: center">Lista</th>
                                <th style="text-align: center">Intendente</th>
                                <th style="text-align: center">Votos</th>

                            </tr>

                        </thead>

                        @php
                            $total_local=0;
                        @endphp
                        @php
                            $total_general = 0;
                        @endphp
                        
                        <tbody>

                            @foreach ($votacion_intendente as $vot)                                
                                    
                                <tr style="text-align: center">
                                    
                                    <td>{{$vot->Desc_Lista}} - {{$vot->Desc_Lista}}</td>
                                    <td>{{$vot->intendente}}</td>
                                    <td style="text-align: right">{{number_format($vot->votos,0, ".", ".")}}</td>
                                    @php
                                        $total_local = $vot->total_general_local;
                                    @endphp
                                    @php
                                        $total_general = $vot->total_general;
                                    @endphp
                                </tr>

                            @endforeach

                        </tbody>

                        <tfoot>

                            <tr style="background-color:#f71808a8">

                                <td  colspan="2"> <b>Total de Votos</b></td>
                                <td style="text-align: right"><b>{{number_format($total_local,0, ".", ".")}} </b></td>

                            </tr>

                        </tfoot>

                    </table>

                    <div class="table-responsive">

                        <table id="detalles" class="table table-striped table-condensed table-bordered table-hover table-responsive">

                            <thead style="background-color:#f71808a8">
                                <tr>

                                    <th style="text-align: center"><b>TOTAL GENERAL DE VOTOS</b></th>
                                    <th style="text-align: center"><b>{{$total_local}}</b></th>

                                </tr>
                                
                            </thead>

                        </table>

                    </div>

                </div>
                
            @endif

            
        
        </div>

    </div>


@endsection