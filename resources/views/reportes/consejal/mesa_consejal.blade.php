@extends('layouts.admin')

@section('contenido')

    <div class="row">

        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
            
            {!! Form::open(array('route' => 'reportes.consejal_mesa', 'method'=>'GET', 'autocomplete'=>'off', 'role'=>'search')) !!}

            <div class="form-group">

                <div class="input-group">
                    
                    <select name="id_consejal" id="id_consejal" class="form-control selectpicker"  data-live-search="true">
                                
                        <option value="99" @if(9999 == $id_consejal) selected="selected" @endif>TODOS LOS LOCALES</option>
                    
                        @foreach ($consejales as $consejal)
                            
                            <option value="{{$consejal->Id_Consejal}}" @if($consejal->Id_Consejal == $id_consejal) selected="selected" @endif>{{$consejal->consejal}} </option>
                    
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
        
            <a href=" {{ route('consejal_mesa', $id_consejal) }} " target="_blank">
                <button class="btn btn-info float-right"><li  class="fa fa-file-pdf-o"></li> PDF</button>
            </a>
        
        </div>

    </div>

    <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            @if((empty($id_consejal)) || ($id_consejal == 9999))

                @foreach ($consejales as $consejal)

                    <div class="table-responsive">

                        <table id="detalles" class="table table-striped table-condensed table-bordered table-hover table-responsive">

                            <thead style="background-color:#f71808a8">

                                <tr style="text-align: center">
                                    
                                    <th colspan="2" style="text-align: center">{{$consejal->consejal}}</th>
                                    
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

                                @foreach ($votacion_consejal as $vot)
                            
                                    @if($vot->Id_Consejal == $consejal->Id_Consejal)
                                        
                                        <tr style="text-align: center">
                                            
                                            <td>{{$vot->Mesa}}</td>
                                            <td style="text-align: right">{{number_format($vot->votos,0, ".", ".")}}</td>
                                            @php
                                                $total = $vot->consejal_votos;
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
                    $consejal_1= "";
                @endphp

                @foreach ($consejales as $conse)
                    
                    @if ($conse->Id_Consejal == $id_consejal)

                        @php
                            $consejal_1= $conse->consejal;
                        @endphp
                        
                    @endif

                @endforeach

                <div class="table-responsive">

                    <table id="detalles" class="table table-striped table-condensed table-bordered table-hover table-responsive">

                        <thead style="background-color:#f71808a8">

                            <tr style="text-align: center">
                                
                                <th colspan="2" style="text-align: center">{{$consejal_1}}</th>
                                
                            </tr>

                            <tr style="text-align: center">
    
                                <th style="text-align: center">Mesa</th>
                                <th style="text-align: center">Votos</th>
    
                            </tr>
    
                        </thead>

                        <tbody>

                            @foreach ($votacion_consejal as $vot)
                                    
                                <tr style="text-align: center">
                                    
                                    <td>{{$vot->Mesa}}</td>
                                    <td style="text-align: right">{{number_format($vot->votos,0, ".", ".")}}</td>
                                    @php
                                        $total = $vot->consejal_votos;
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


        </div>

    </div>

@endsection