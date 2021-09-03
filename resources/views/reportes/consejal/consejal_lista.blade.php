@extends('layouts.admin')

@section('contenido')

    <div class="row">

        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
            
            {!! Form::open(array('route' => 'reportes.consejal_lista', 'method'=>'GET', 'autocomplete'=>'off', 'role'=>'search')) !!}

            <div class="form-group">

                <div class="input-group">
                    
                    <select name="id_lista" id="id_lista" class="form-control selectpicker"  data-live-search="true">
                    
                        <option value="999" @if(999 == $id_lista) selected="selected" @endif>TODOAS LAS LISTAS</option>

                        @foreach ($listas as $lista)
                            
                            <option value="{{$lista->Id_Lista}}" @if($lista->Id_Lista == $id_lista) selected="selected" @endif>{{$lista->Desc_Lista}} </option>
                    
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
        
            <a href=" {{ route('consejal_lista', $id_lista) }} " target="_blank">
                <button class="btn btn-info float-right"><li  class="fa fa-file-pdf-o"></li> PDF</button>
            </a>
        
        </div>

    </div>

    <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            @if((empty($id_lista)) || ($id_lista == 999))

                @foreach ($listas as $lista)
                
                    <div class="table-responsive">

                        <table id="detalles" class="table table-striped table-condensed table-bordered table-hover table-responsive">

                            <thead style="background-color:#f71808a8">

                                <tr style="text-align: center">
                                    
                                    <th colspan="2" style="text-align: center">{{$lista->Desc_Lista}}</th>
                                    
                                </tr>
                                <tr style="text-align: center">

                                    <th style="text-align: center">Consejal</th>
                                    <th style="text-align: center">Votos</th>

                                </tr>

                            </thead>

                            @php
                                $votos_lista= 0;
                            @endphp

                            @php
                                $total_general = 0;
                            @endphp

                            <tbody>

                                @foreach ($votacion_consejal as $vot)
                            
                                    @if($vot->Id_Lista == $lista->Id_Lista)
                                        
                                        <tr style="text-align: center">
                                            
                                            <td>{{$vot->consejal}}</td>
                                            <td style="text-align: right">{{number_format($vot->votos_consejal,0, ".", ".")}}</td>
                                             
                                        </tr>
                                        @php
                                            $votos_lista = $vot->votos_lista;
                                        @endphp
                                        @php
                                            $total_general = $vot->Total;
                                        @endphp

                                    @endif

                                @endforeach

                            </tbody>

                            <tfoot>

                                <tr style="background-color:rgb(145, 143, 143)">

                                    <td style="text-align: center"> <b>Total de Votos</b></td>
                                    <td style="text-align: right"><b>{{number_format($votos_lista,0, ".", ".")}} </b></td>

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
                    $lista_nombre = "";
                @endphp

                @foreach ($listas as $lis)

                    @if ($lis->Id_Lista == $id_lista)

                        @php
                            $lista_nombre = $lis->Desc_Lista;
                        @endphp
                        
                    @endif
                    
                @endforeach

                <div class="table-responsive">

                    <table id="detalles" class="table table-striped table-condensed table-bordered table-hover table-responsive">

                        <thead style="background-color:#f71808a8">

                            <tr style="text-align: center">
                                
                                <th colspan="2" style="text-align: center">{{$lista_nombre}}</th>
                                
                            </tr>
                            <tr style="text-align: center">

                                <th style="text-align: center">Consejal</th>
                                <th style="text-align: center">Votos</th>

                            </tr>

                        </thead>

                        @php
                            $votos_lista= 0;
                        @endphp

                        @php
                            $total_general = 0;
                        @endphp

                        <tbody>

                            @foreach ($votacion_consejal as $vot)
    
                                <tr style="text-align: center">
                                    
                                    <td>{{$vot->consejal}}</td>
                                    <td style="text-align: right">{{number_format($vot->votos_consejal,0, ".", ".")}}</td>
                                        
                                </tr>
                                @php
                                    $votos_lista = $vot->votos_lista;
                                @endphp
                                @php
                                    $total_general = $vot->Total;
                                @endphp

                            @endforeach

                        </tbody>

                        <tfoot>

                            <tr style="background-color:rgb(145, 143, 143)">

                                <td style="text-align: center"> <b>Total de Votos</b></td>
                                <td style="text-align: right"><b>{{number_format($votos_lista,0, ".", ".")}} </b></td>

                            </tr>

                        </tfoot>

                    </table>

                </div>

                <div class="table-responsive">

                    <table id="detalles" class="table table-striped table-condensed table-bordered table-hover table-responsive">

                        <thead style="background-color:#f71808a8">
                            <tr>

                                <th style="text-align: center"><b>TOTAL GENERAL DE VOTOS</b></th>
                                <th style="text-align: center"><b>{{$votos_lista}}</b></th>

                            </tr>
                            
                        </thead>

                    </table>

                </div>
                
            @endif
            
        </div>
        
    </div>

@endsection