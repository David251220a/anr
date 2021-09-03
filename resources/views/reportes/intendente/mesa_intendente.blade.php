@extends('layouts.admin')

@section('contenido')

    <div class="row">

        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
            
            {!! Form::open(array('route' => 'reportes.intendente_mesa', 'method'=>'GET', 'autocomplete'=>'off', 'role'=>'search')) !!}

            <div class="form-group">

                <div class="input-group">
                    
                    <select name="id_intendente" id="id_intendente" class="form-control selectpicker"  data-live-search="true">
                                
                        <option value="9999" @if(9999 == $id_intendente) selected="selected" @endif>TODOS LOS INTENDENTES</option>
                    
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
        
            <a href=" {{ route('intendente_mesa', $id_intendente) }} " target="_blank">
                <button class="btn btn-info float-right"><li  class="fa fa-file-pdf-o"></li> PDF</button>
            </a>
        
        </div>

    </div>

    <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            @if((empty($id_intendente)) || ($id_intendente == 9999))

                @foreach ($intendentes as $intendente)

                    <div class="table-responsive">

                        <table id="detalles" class="table table-striped table-condensed table-bordered table-hover table-responsive">

                            <thead style="background-color:#f71808a8">

                                <tr style="text-align: center">
                                    
                                    <th colspan="2" style="text-align: center">{{$intendente->intendente}}</th>
                                    
                                </tr>
                                <tr style="text-align: center">
        
                                    <th style="text-align: center">Mesa</th>
                                    <th style="text-align: center">Votos</th>
        
                                </tr>
        
                            </thead>

                            @php
                                $total= 0;
                            @endphp

                            <tbody>

                                @foreach ($votacion_intendente as $vot)
                            
                                    @if($vot->Id_Intendente == $intendente->Id_Intendente)
                                        
                                        <tr style="text-align: center">
                                            
                                            <td>{{$vot->Mesa}}</td>
                                            <td style="text-align: right">{{number_format($vot->votos,0, ".", ".")}}</td>
                                            @php
                                                $total = $vot->intendentes_votos;
                                            @endphp                                                                                        
                                            
                                        </tr>

                                    @endif

                                @endforeach

                            </tbody>

                            <tfoot>

                                <tr style="background-color:#f71808a8">

                                    <td style="text-align: center"> <b>Total de Votos</b></td>
                                    <td style="text-align: right"><b>{{number_format($total,0, ".", ".")}} </b></td>

                                </tr>

                            </tfoot>

                        </table>

                    </div>
                    
                @endforeach
                
            @else

                @php
                    $inte_1= "";
                @endphp

                @foreach ($intendentes as $inte)
                    
                    @if ($inte->Id_Intendente == $id_intendente)

                        @php
                            $inte_1= $inte->intendente;
                        @endphp
                        
                    @endif

                @endforeach

                @if ($votacion_intendente)

                    <div class="table-responsive">

                        <table id="detalles" class="table table-striped table-condensed table-bordered table-hover table-responsive">

                            <thead style="background-color:#f71808a8">

                                <tr style="text-align: center">
                                    
                                    <th colspan="2" style="text-align: center">{{$inte_1}}</th>
                                    
                                </tr>

                                <tr style="text-align: center">
        
                                    <th style="text-align: center">Mesa</th>
                                    <th style="text-align: center">Votos</th>
        
                                </tr>
        
                            </thead>

                            <tbody>

                                @foreach ($votacion_intendente as $vot)
                                        
                                    <tr style="text-align: center">
                                        
                                        <td>{{$vot->Mesa}}</td>
                                        <td style="text-align: right">{{number_format($vot->votos,0, ".", ".")}}</td>
                                        @php
                                            $total = $vot->intendentes_votos;
                                        @endphp                                                                                        
                                        
                                    </tr>

                                @endforeach

                            </tbody>

                            <tfoot>

                                <tr style="background-color:#f71808a8">

                                    <td style="text-align: center"> <b>Total de Votos</b></td>
                                    <td style="text-align: right"><b>{{number_format($total,0, ".", ".")}} </b></td>

                                </tr>

                            </tfoot>

                        </table>

                    </div>
                
                @endif


                
            @endif


        </div>

    </div>

@endsection