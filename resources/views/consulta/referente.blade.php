@extends('layouts.admin')

@section('contenido')

    {!! Form::open(array('route' => 'consulta.referente', 'method'=>'GET', 'autocomplete'=>'off', 'role'=>'search')) !!}
            
        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            
                <div class="form-group">

                    <div class="input-group">
                        
                        <select name="referente" id="referente" class="form-control selectpicker"  data-live-search="true">
                                    
                            <option value="99" @if(99 == $referente) selected="selected" @endif>SELECCIONE UN REFERENTE</option>
                        
                            @foreach ($referentes as $refe)
                                
                                <option value="{{$refe->referente}}" @if($refe->referente == $referente) selected="selected" @endif>{{$refe->referente}} </option>
                        
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
    
            @if (99 != $referente)
                            
                <a class="btn btn-secondary btn-sm float-right" href=" {{ route('referente_pdf', $referente) }}" target="_blank">
                    <button class="btn btn-info float-right"><li  class="fa fa-file-pdf-o"></li> PDF</button>
                </a>

            @endif

        </div>
        
    </div>
    

    <div class="row">
    
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <div class="table-responsive">

                <table id="detalles" class="table table-striped table-condensed table-bordered table-hover table-responsive">

                    <thead style="background-color:#f71808a8">

                        <th style="text-align: center">Cedula</th>
                        <th style="text-align: center">Apellido y Nombre</th>
                        <th style="text-align: center">Local</th>
                        <th style="text-align: center">Mesa</th>
                        <th style="text-align: center">Orden</th>
                        <th style="text-align: center">Com.</th>
                        <th style="text-align: center">Referente</th>
                        <th style="text-align: center">PDF</th>

                    </thead>

                    @if ($comprometidos)

                        <tbody>

                            @foreach ($comprometidos as $comprometido)

                                <tr>

                                    <td style="text-align: right; font-size: 1.2rem">{{number_format($comprometido->cedula, 0, ".", ".")}}</td>
                                    <td style="text-align: center; font-size: 1.2rem">{{$comprometido->apellido_nombre}}</td>
                                    <td style="text-align: center; font-size: 1.2rem">{{$comprometido->Desc_Local}}</td>
                                    <td style="text-align: right; font-size: 1.2rem">{{$comprometido->mesa}}</td>
                                    <td style="text-align: right; font-size: 1.2rem">{{$comprometido->orden}}</td>
                                    <td style="text-align: center; font-size: 1.2rem" width="70px"> {!! Form::checkbox('voto', null, $comprometido->voto) !!} </td>
                                    <td style="text-align: center; font-size: 1.2rem">{{$comprometido->referente}}</td>
                                    <td style="text-align: center" width="50px">
                                        <a href="#">
                                            <button class="btn btn-info btn-sm">PDF</button>
                                        </a>

                                    </td>

                                </tr>
                                
                            @endforeach

                        </tbody>
                        
                    @endif

                </table>
                
            </div>

            {{-- {{$comprometidos-> links()}} --}}
            {{$comprometidos->appends(['referente' => $referente])->links()}}

        </div>

    </div>

@endsection

