@extends('layouts.admin')

@section('contenido')

    <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            @if (session()->has('msj'))
            
                <div class="alert alert-danger" role="alert">{{session('msj')}}</div>
                
            @endif        

        </div>

    </div>
    {!! Form::open(array('route' => 'consulta.padron_celular', 'method'=>'GET', 'autocomplete'=>'off', 'role'=>'search')) !!}

        <div class="form-group">

            <div class="input-group">

                <input type="search" class="form-control" name="searchtext"  placeholder="Buscar.." value="{{$searchtext}}">        
                <span class="input-group-btn">
                <button type="submit" class="btn btn-primary">Buscar</button>

            </span>

            </div>

        </div>

    {{Form::close() }}

    <div class="row" id="pantalla_grande" style="display: none">

        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

            <div class="table-responsive">

                <table id="detalles" class="table table-striped table-condensed table-bordered table-hover table-responsive">

                    @if ($votante)
                    
                        <thead>

                            <tr style="text-align: center">
                                <th style="vertical-align:middle; text-align:center"><img src="{{asset(Auth::user()->url)}}"></th>
                            </tr>

                        </thead>
                    @endif

                    @if ($votante)
                        
                        <tbody>

                            <tr>
                                <td style="text-align: center">CEDULA DE IDENTIDAD</td>
                            </tr>
                            <tr>
                                <td style="text-align: center"><b>{{number_format($votante->cedula, 0, ".", ".")}}</b></td>
                            </tr>
                            <tr>
                                <td style="text-align: center">APELLIDO Y NOMBRE</td>
                            </tr>
                            <tr>
                                <td style="text-align: center"><b>{{$votante->apellido_nombre}}</b></td>
                            </tr>
                            <tr>
                                <td style="text-align: center">LOCAL</td>
                            </tr>
                            <tr>
                                <td style="text-align: center"><b>{{$votante->Desc_Local}}</b></td>
                            </tr>                           
                            <tr>
                                <td style="text-align: center"> MESA : <b>{{$votante->mesa}} </b></td>
                            </tr>
                            <tr>
                                <td style="text-align: center">ORDEN : <b>{{$votante->orden}} </b></td>
                            </tr>
                            <tr>

                                <td style="text-align: center" width="30px">
                                    <a href=" {{ route('persona_padron', $votante->CodPadron) }}" target="_blank">
                                        <button class="btn btn-info btn-sm"><li  class="fa fa-file-pdf-o"></li> PDF</button>
                                    </a>
                                </td>

                            </tr>
                            
                            <tr style="text-align: center">
                                <td><button id="btn_ver" class="btn btn-primary btn-sm">Ver Mas</button></td>
                            </tr>
                            
                            {!! Form::open(['route' => 'consulta.padron_celular_store', 'method'=>'POST', 'autocomplete' => 'off', 'files' => true]) !!}
                                <tr>
                                    <td style="display: none" class="ver centro">Comprometido:  {!! Form::checkbox('comprometido', null, $votante->comprometido) !!}</td>
                                    <input type="hidden" name="codpadron" value="{{$votante->CodPadron}}">
                                </tr>

                                <tr>
                                    <td style="display: none" class="ver centro">Voto :  {!! Form::checkbox('voto', null, $votante->voto) !!} </td>
                                </tr>

                                <tr>
                                    <td style="display: none" class="ver centro"><b>Referente</b></td>
                                </tr>

                                <tr>
                                    <td style="display: none" class="ver centro"><input type="text" style="width: 300px; text-align: center" name="referente" value="{{$votante->apellido_nombre_Referente}}"></td>
                                </tr>

                                <tr>
                                    <td style="display: none" class="ver centro"><button style="font-size: 1.2rem" class="btn btn-success btn-sm float-right" type="submit">OK</button> </td>
                                </tr>

                            {!! Form::close() !!}
                            
                            
                        </tbody>
                        

                        
                    @else

                        <tfoot>

                            <tr style="background-color:#ede7e6a8">

                                <td colspan="8" style="text-align: center"><h3><b> "No figura en la Ciudad de Limpio" </b></h3></td>
                            </tr>
                        </tfoot>

                    @endif


                </table>

            </div>
            

        </div>

    </div>

    <div class="row" id="pantalla_pequeno" style="display: none">

        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

            <div class="table-responsive">

                <table id="detalles" class="table table-striped table-condensed table-bordered table-hover table-responsive">

                    @if ($votante)
                    
                        <thead>

                            <tr style="text-align: center">
                                <th style="vertical-align:middle; text-align:center"><img src="{{asset(Auth::user()->url_1)}}" ></th>
                            </tr>

                        </thead>

                    @endif

                    @if ($votante)
                        
                        <tbody>

                            <tr>
                                <td style="text-align: center">CEDULA DE IDENTIDAD</td>
                            </tr>
                            <tr>
                                <td style="text-align: center"><b>{{number_format($votante->cedula, 0, ".", ".")}}</b></td>
                            </tr>
                            <tr>
                                <td style="text-align: center">APELLIDO Y NOMBRE</td>
                            </tr>
                            <tr>
                                <td style="text-align: center"><b>{{$votante->apellido_nombre}}</b></td>
                            </tr>
                            <tr>
                                <td style="text-align: center">LOCAL</td>
                            </tr>
                            <tr>
                                <td style="text-align: center"><b>{{$votante->Desc_Local}}</b></td>
                            </tr>
                            <tr>
                                <td style="text-align: center"> MESA : <b>{{$votante->mesa}} </b></td>
                            </tr>
                            <tr>
                                <td style="text-align: center">ORDEN : <b>{{$votante->orden}} </b></td>
                            </tr>
                            <tr>

                                <td style="text-align: center" width="30px">
                                    <a href=" {{ route('persona_padron', $votante->CodPadron) }}" target="_blank">
                                        <button class="btn btn-info btn-sm"><li  class="fa fa-file-pdf-o"></li> PDF</button>
                                    </a>
                                </td>

                            </tr>
                            
                            <tr style="text-align: center">
                                <td><button id="btn_ver1" class="btn btn-primary btn-sm">Ver Mas</button></td>
                            </tr>
                            
                            {!! Form::open(['route' => 'consulta.padron_celular_store', 'method'=>'POST', 'autocomplete' => 'off', 'files' => true]) !!}
                                <tr>
                                    <td style="display: none" class="ver1 centro1">Comprometido:  {!! Form::checkbox('comprometido', null, $votante->comprometido) !!}</td>
                                    <input type="hidden" name="codpadron" value="{{$votante->CodPadron}}">
                                </tr>

                                <tr>
                                    <td style="display: none" class="ver1 centro1">Voto :  {!! Form::checkbox('voto', null, $votante->voto) !!} </td>
                                </tr>

                                <tr>
                                    <td style="display: none" class="ver1 centro1"><b>Referente</b></td>
                                </tr>

                                <tr>
                                    <td style="display: none" class="ver1 centro1"><input type="text" style="width: 300px; text-align: center" name="referente" value="{{$votante->apellido_nombre_Referente}}"></td>
                                </tr>

                                <tr>
                                    <td style="display: none" class="ver1 centro1"><button style="font-size: 1.2rem" class="btn btn-success btn-sm float-right" type="submit">OK</button> </td>
                                </tr>

                            {!! Form::close() !!}
                            
                            
                        </tbody>
                        

                        
                    @else

                        <tfoot>

                            <tr style="background-color:#ede7e6a8">

                                <td colspan="8" style="text-align: center"><h3><b> "No figura en la Ciudad de Limpio" </b></h3></td>
                            </tr>
                        </tfoot>

                    @endif


                </table>

            </div>
            

        </div>

    </div>

    @push('scripts')

        <script type="text/javascript">

            $(document).ready(function(){  

                var ventana_alto =$(window).height();
                var ventana_ancho =$(window).width();

                if(ventana_alto >= 600  && ventana_ancho >= 600){

                    $("#pantalla_grande").css("display", "block");
                    $("#pantalla_pequeno").css("display", "none");

                }else{

                    $("#pantalla_grande").css("display", "none");
                    $("#pantalla_pequeno").css("display", "block");

                }

                $(window).resize(function() {
                    var ventana_alto1 =$(window).height();
                    var ventana_ancho1 =$(window).width();

                    if((ventana_alto1 > 600 ) && (ventana_ancho1 > 600)){

                        $("#pantalla_grande").css("display", "block");
                        $("#pantalla_pequeno").css("display", "none");

                    }else{

                        $("#pantalla_grande").css("display", "none");
                        $("#pantalla_pequeno").css("display", "block");

                    }
                    
                });

                $("#btn_ver").on('click',function(event){
                    
                    var isVisible = $('.ver').is(":visible");

                    if(isVisible == true){

                        $('.ver').css("display", "none");
                        $('.centro').css("text-align", "center");

                    }else{
                        
                        $('.ver').css("display", "block");
                        $('.centro').css("text-align", "center");

                    }
                    
                });

                $("#btn_ver1").on('click',function(event){
                    
                    var isVisible = $('.ver1').is(":visible");

                    if(isVisible == true){

                        $('.ver1').css("display", "none");
                        $('.centro1').css("text-align", "center");

                    }else{
                        
                        $('.ver1').css("display", "block");
                        $('.centro1').css("text-align", "center");

                    }
                    
                });
                
            });

        </script>

    @endpush

@endsection