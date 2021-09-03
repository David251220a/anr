@extends('layouts.admin')

@section('contenido')

    <div class="row">

        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
            
            {!! Form::open(array('route' => 'reportes.intendente', 'method'=>'GET', 'autocomplete'=>'off', 'role'=>'search')) !!}

            <div class="form-group">

                <div class="input-group">
                    
                    <select name="id_intendente" id="id_intendente" class="form-control selectpicker"  data-live-search="true">
                    
                        @foreach ($intendentes as $intendente)
                            
                            <option value="{{$intendente->Id_Intendente}}" @if($intendente->Id_Intendente == $id_intendente) selected="selected" @endif>{{$intendente->intendente}} </option>
                    
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
        
            <a href=" {{ route('intendente', $id_intendente) }} " target="_blank">
                <button class="btn btn-info float-right"><li  class="fa fa-file-pdf-o"></li> PDF</button>
            </a>
        
        </div>

    </div>

    <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            @php
                $cont = 0;
            @endphp

            @foreach ($local_votacion as $local)
                            
                <div class="table-responsive">

                    <table id="detalles" class="table table-striped table-condensed table-bordered table-hover table-responsive">

                        <thead style="background-color:#f71808a8">

                            <tr style="text-align: center">
                                
                                <th colspan="2" style="text-align: center">{{$local->Desc_Local}}</th>
                                
                            </tr>
                            <tr style="text-align: center">
    
                                <th style="text-align: center">Mesa</th>
                                <th style="text-align: center">Votos</th>
    
                            </tr>
    
                        </thead>

                        @php
                            $total_local= 0;
                        @endphp

                        @php
                            $total_general= 0;
                        @endphp

                        <tbody>

                            @foreach ($votacion_intendente as $vot)
                        
                                @if($vot->Id_Local == $local->Id_Local)
                                    
                                    <tr style="text-align: center">
                                        
                                        <td>{{$vot->Mesa}}</td>
                                        <td style="text-align: right">{{number_format($vot->Votos,0, ".", ".")}}</td>
                                        @php
                                            $total_local = $vot->total_local;
                                        @endphp
                                        
                                    </tr>

                                @endif

                                @php
                                    $total_general = $vot->total_general;
                                @endphp

                            @endforeach

                        </tbody>

                        <tfoot>

                            <tr style="background-color:rgb(145, 143, 143)">

                                <td style="text-align: center"> <b>Total de Votos</b></td>
                                <td style="text-align: right"><b>{{number_format($total_local,0, ".", ".")}} </b></td>

                            </tr>

                        </tfoot>

                    </table>

                </div>
                
            @endforeach

        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

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
            
        </div>
        
        

    </div>


@endsection