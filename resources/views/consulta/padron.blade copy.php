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

    <div class="row">

        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

            <div class="table-responsive">

                <table id="detalles" class="table table-striped table-condensed table-bordered table-hover table-responsive">

                    <thead style="background-color:#f71808a8">

                        <th style="text-align: center; font-size: 1.2rem">Cedula</th>
                        <th style="text-align: center; font-size: 1.2rem">Apellido y Nombre</th>
                        <th style="text-align: center; font-size: 1.2rem">Local</th>
                        <th style="text-align: center; font-size: 1.2rem">M</th>
                        <th style="text-align: center; font-size: 1.2rem">O</th>
                        <th style="text-align: center; font-size: 1.2rem">Celular</th>
                        <th style="text-align: center; font-size: 1.2rem">Enviar</th>
                        <th style="text-align: center; font-size: 1.2rem">PDF</th>
                        
                    </thead>

                    @if (count($votante))

                        <tbody>
                            @php
                                $indice = 0;
                            @endphp
                            @foreach ($votante as $vota)
                            
                                <tr>
                                    
                                    <td style="text-align: right; font-size: 1.2rem">
                                        {{number_format($vota->cedula, 0, ".", ".")}}
                                        <input type="hidden" id="codpadron_{{$indice}}" value="{{$vota->CodPadron}}">
                                        @php
                                            $indice = $indice + 1;
                                        @endphp
                                    </td>
                                    <td style="text-align: center; font-size: 1.2rem">{{$vota->apellido_nombre}}</td>
                                    <td style="text-align: center; font-size: 1.2rem">{{$vota->Desc_Local}}</td>
                                    <td style="text-align: right; font-size: 1.2rem">{{$vota->mesa}}</td>
                                    <td style="text-align: right; font-size: 1.2rem">{{$vota->orden}}</td>
                                    <td style="text-align: right; font-size: 1.2rem"><input type="text" id="sms" class=" form-control Contacto" placeholder="ejemplo: 76820842"></td>
                                    <td style="text-align: center" width="30px">

                                        <button id="#btnCompartir" class="btn btn-success btn-sm compartir"><li  class="fa fa-file-pdf-o"></li>whatsapp</button>
                                        
                                    </td>
                                    <td style="text-align: center" width="30px">
                                        <a href=" {{ route('persona_padron', $vota->CodPadron) }}" target="_blank">
                                            <button class="btn btn-info btn-sm"><li  class="fa fa-file-pdf-o"></li> PDF</button>
                                        </a>
                                    </td>
                                                            
                                </tr>

                            @endforeach

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

            {{-- {{$votante-> links()}} --}}
            {{$votante->appends(['searchtext' => $searchtext])->links()}}

        </div>

    </div>

    @push('scripts')

        <script type="text/javascript">

            $(document).ready(function(){                  

                $('.compartir').on('click',function(event){
                    
                    let mensaje = "Descargue el local y lugar de votacion de usted: ";
                    let celular_aux = 0;
                    let codpadron = 0;
                    let sms_url = "http://web.cjppm.gov.py.confettiarteyfiesta.com.py/pdf/padron/";                    
                    let indice = 0;

                    $(".Contacto").each(

                        function(index, value) {

                            if ( $.isNumeric($(this).val()) ){
                                celular_aux = $(this).val();
                                indice = index;
                            }

                            $(this).val('');
                        }

                        
                    );

                    codpadron = $("#codpadron_"+indice).val();

                    sms_url = sms_url+codpadron;
                    if (!mensaje) return alert("Escribe algo");
                    //  window.open("https://api.whatsapp.com/send?phone=+5959"+celular_aux+"&text=" + encodeURIComponent(mensaje)+ sms_url);
                    window.open("https://wa.me/5959"+celular_aux+"?text=" + encodeURIComponent(mensaje)+ sms_url);
                    
                });       
                
            });

        </script>

    @endpush

@endsection