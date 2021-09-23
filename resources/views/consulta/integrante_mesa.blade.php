
@php
    $session = $sessiones->Sessiones_Habilitar;
@endphp

@extends('layouts.admin')

@section('contenido')

    <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            @if (session()->has('msj'))
            
                <div class="alert alert-danger" role="alert">{{session('msj')}}</div>
                
            @endif        

        </div>

    </div>

    {!! Form::open(array('route' => 'consulta.integrante_mesa', 'method'=>'GET', 'autocomplete'=>'off', 'role'=>'search')) !!}
        
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

            <a class="btn btn-secondary btn-sm float-right" href=" {{ route('integrante_todos') }} " target="_blank">
                <button class="btn btn-info"><li  class="fa fa-file-pdf-o"></li> General</button>
            </a>
            <a class="btn btn-secondary btn-sm float-right" href="#" target="_blank">
                <button class="btn btn-info"><li  class="fa fa-file-pdf-o"></li> Local</button>
            </a>
            
        </div>

    </div>
    
    <br>

    <div class="row">

        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

            <div class="table-responsive">

                <table id="detalles" class="table table-striped table-condensed table-bordered table-hover table-responsive">

                    <thead style="background-color:#f71808a8">

                        <tr>

                            <th style="text-align: center; font-size: 1.2rem">Cedula</th>
                            <th style="text-align: center; font-size: 1.2rem">Apellido y Nombre</th>
                            <th style="text-align: center; font-size: 1.2rem">Cargo</th>
                            <th style="text-align: center; font-size: 1.2rem">Local</th>
                            <th style="text-align: center; font-size: 1.2rem">M</th> 
                            <th style="text-align: center; font-size: 1.2rem">1/C</th> 
                            <th style="text-align: center; font-size: 1.2rem">2/C</th> 
                            <th style="text-align: center; font-size: 1.2rem">3/C</th> 
                            @if ($session >= 4)
                                <th style="text-align: center; font-size: 1.2rem">4/C</th> 
                            @endif
                            @if ($session >= 5)
                                <th style="text-align: center; font-size: 1.2rem">5/C</th> 
                            @endif
                            @if ($session >= 6)
                                <th style="text-align: center; font-size: 1.2rem">6/C</th> 
                            @endif
                            @if ($session >= 7)
                                <th style="text-align: center; font-size: 1.2rem">7/C</th> 
                            @endif
                            @if ($session >= 8)
                                <th style="text-align: center; font-size: 1.2rem">8/C</th> 
                            @endif
                            @if ($session >= 9)
                                <th style="text-align: center; font-size: 1.2rem">9/C</th> 
                            @endif
                            @if ($session >= 10)
                                <th style="text-align: center; font-size: 1.2rem">10/C</th> 
                            @endif

                            <th style="text-align: center; font-size: 1.2rem">OK</th>

                        </tr>

                    </thead>

                    @if (count($integrantes))

                        <tbody>

                            @foreach ($integrantes as $integrante)
                            
                                <tr>
                                    {!! Form::open(['route' => 'consulta.integrante_store', 'autocomplete' => 'off']) !!}
                                    
                                        <td style="text-align: right; font-size: 1.2rem">{{number_format($integrante->Cedula_Integrante, 0, ".", ".")}}<input type="hidden" name="cedula" value="{{$integrante->Cedula_Integrante}}"></td>
                                        <td style="text-align: center; font-size: 1.2rem">{{$integrante->apellido_nombre}}</td>
                                        <td style="text-align: center; font-size: 1.2rem">{{$integrante->Cargo}}</td>
                                        <td style="text-align: center; font-size: 1.2rem">{{$integrante->Desc_Local}}</td>
                                        <td style="text-align: right; font-size: 1.2rem">{{$integrante->Id_Mesa}}</td>
                                        <td style="text-align: center; font-size: 1.2rem"> {!! Form::checkbox('Primera_Session', null, $integrante->Primera_Session) !!} </td>
                                        <td style="text-align: center; font-size: 1.2rem"> {!! Form::checkbox('Segunda_Session', null, $integrante->Segunda_Session) !!} </td>
                                        <td style="text-align: center; font-size: 1.2rem"> {!! Form::checkbox('Tercera_Session', null, $integrante->Tercera_Session) !!} </td>
                                        @if ($session >= 4)
                                            <td style="text-align: center; font-size: 1.2rem"> {!! Form::checkbox('Cuarta_Session', null, $integrante->Cuarta_Session) !!} </td>
                                        @endif
                                        @if ($session >= 5)
                                            <td style="text-align: center; font-size: 1.2rem"> {!! Form::checkbox('Quinta_Session', null, $integrante->Quinta_Session) !!} </td>
                                        @endif
                                        @if ($session >= 6)
                                            <td style="text-align: center; font-size: 1.2rem"> {!! Form::checkbox('Sexta_Session', null, $integrante->Sexta_Session) !!} </td>
                                        @endif
                                        @if ($session >= 7)
                                            <td style="text-align: center; font-size: 1.2rem"> {!! Form::checkbox('Septima_Session', null, $integrante->Septima_Session) !!} </td>
                                        @endif
                                        @if ($session >= 8)
                                            <td style="text-align: center; font-size: 1.2rem"> {!! Form::checkbox('Octava_Session', null, $integrante->Octava_Session) !!} </td>
                                        @endif
                                        @if ($session >= 9)
                                            <td style="text-align: center; font-size: 1.2rem"> {!! Form::checkbox('Novena_Session', null, $integrante->Novena_Session) !!} </td>
                                        @endif
                                        @if ($session >= 10)
                                            <td style="text-align: center; font-size: 1.2rem"> {!! Form::checkbox('Decima_Session', null, $integrante->Decima_Session) !!} </td>
                                        @endif
                                        <td style="text-align: center"> 
                                            
                                            <button style="font-size: 1.2rem" class="btn btn-success btn-sm float-right" type="submit">OK</button> 
                                        </td>
                                        
                                    {!! Form::close() !!}

                                </tr>

                            @endforeach

                        </tbody>                    
                        
                    @else

                        <tfoot>

                            <tr style="background-color:#ede7e6a8">

                                <td colspan="8" style="text-align: center"><h3><b> "No figura" </b></h3></td>
                            </tr>
                        </tfoot>
                    
                    @endif

                </table>

            </div>

            {{-- {{$votante-> links()}} --}}
            {{$integrantes->appends(['searchtext' => $searchtext])->links()}}

        </div>
    </div>

@endsection