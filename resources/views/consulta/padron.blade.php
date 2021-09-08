@extends('layouts.admin')

@section('contenido')

    {!! Form::open(array('route' => 'consulta.padron', 'method'=>'GET', 'autocomplete'=>'off', 'role'=>'search')) !!}
    

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
                                <th style="vertical-align:middle; text-align:center"><img src="{{asset('manuel.jpg')}}"></th>
                            </tr>

                        </thead>
                    @endif

                    @if ($votante)
                        
                        <tbody>

                            <tr>
                                <td style="text-align: center">CEDULA DE IDENTIDAD</td>
                            </tr>
                            <tr>
                                <td style="text-align: center"><b>{{$votante->cedula}}</b></td>
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
                                <th style="vertical-align:middle; text-align:center"><img src="{{asset('manuel_pequeno.jpg')}}" ></th>
                            </tr>

                        </thead>

                    @endif

                    @if ($votante)
                        
                        <tbody>

                            <tr>
                                <td style="text-align: center">CEDULA DE IDENTIDAD</td>
                            </tr>
                            <tr>
                                <td style="text-align: center"><b>{{$votante->cedula}}</b></td>
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
                
            });

        </script>

    @endpush

@endsection