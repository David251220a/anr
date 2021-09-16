@extends('layouts.admin')

@section('contenido')

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <h2 style="text-align: center">{{date('d-m-Y H:i', strtotime(Carbon\Carbon::now()))}}</h2>

        </div>
    </div>

    <div class="row">

        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-8">

            {!! Form::open(array('route' => 'consulta.referente_intendente', 'method'=>'GET', 'autocomplete'=>'off', 'role'=>'search')) !!}
                            
                <div class="form-group">

                    <div class="input-group">
                        
                        <select name="referente" id="referente" class="form-control selectpicker"  data-live-search="true">
                                    
                            <option value="99" @if(99 == $referente) selected="selected" @endif>TOTAL COMPROMETIDOS POR REFERENTES</option>
                        
                            @foreach ($referentes as $refe)
                                
                                <option value="{{$refe->Cod_Referente}}" @if($refe->Cod_Referente == $referente) selected="selected" @endif>{{$refe->apellido_nombre_Referente}}</option>
                        
                            @endforeach
                        
                        </select>
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-primary">Buscar </button>                            
                            
                        </span>

                    </div>

                </div>

            {{Form::close() }}

        </div>

    </div>

    <div class="row" style="text-align: center">

        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-8">

            @if (99 == $referente)
                            
                <a class="btn btn-secondary btn-sm float-right" href=" {{ route('referente_intendente') }} " target="_blank">
                    <button class="btn btn-info"><li  class="fa fa-file-pdf-o"></li> PDF</button>
                </a>

            @else

                <a class="btn btn-secondary btn-sm float-right" href="#" target="_blank">
                    <button class="btn btn-info"><li  class="fa fa-file-pdf-o"></li> PDF</button>
                </a>

            @endif

        </div>

    </div>
    <br>

    @if ($referente == 99)

        @if ($totales)

            @foreach ($listas as $lista)
            
                <div class="row">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            
                        <div class="table-responsive">
            
                            <table class="table table-striped table-condensed table-bordered table-hover table-responsive">
                                

                                <thead style="background-color:#f71808a8">
            
                                    <tr>
                                        <td colspan="4" style="text-align: center">LISTA 1 - OPCION: {{$lista->Id_Consejal}} / {{$lista->Nombre}} {{$lista->Apellido}}</td>
                                    </tr>
                                    <td style="text-align: center">Referente Cedula</td>
                                    <td style="text-align: center">Apellido y Nombre</td>
                                    <td style="text-align: center">Usuario Encargado</td>
                                    <td style="text-align: center">Total Comprometido</td>
            
                                </thead>

                                @php
                                    $total_lista = 0;
                                @endphp
                                @php
                                    $total_general = 0;
                                @endphp

                                <tbody>
                                    
                                    @foreach ($totales as $total)

                                        @if ($total->Id_Consejal == $lista->Id_Consejal)

                                            <tr>
                                                <td style="text-align: right">{{number_format($total->Cedula_Referente, 0, ".", ".")}}</td>
                                                <td style="text-align: center">{{$total->Nombre_Referente}}</td>
                                                <td style="text-align: center">{{$total->Usuario}}</td>
                                                <td style="text-align: right">{{number_format($total->Total_Referente, 0, ".", ".")}}</td>
                                                @php
                                                    $total_lista = $total_lista + $total->Total_Referente;
                                                @endphp
                                            </tr>

                                        @endif

                                        @php
                                            $total_general = $total_general + $total->Total_Referente;
                                        @endphp
                                        
                                    @endforeach
                                    
                                </tbody>

                                <tfoot>
                                    
                                    <tr>
                                        <th colspan="3" style="text-align: center"><b> Total por Lista/Opcion </b></th>
                                        <th style="text-align: right"> <b> {{number_format($total_lista, 0, ".", ".")}} </b></th>
                                    </tr>
                                
                                </tfoot>
            
                            </table>
                            
                        </div>
            
                    </div>
            
                </div>
                
            @endforeach

            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="table-responsive">
            
                        <table class="table table-striped table-condensed table-bordered table-hover table-responsive">

                            <thead style="background-color:#f71808a8">
                                <th style="text-align: center"><b>TOTAL GENERAL DE COMPROMETIDOS</b> </th>
                                <th style="text-align: right"> <b> {{number_format($total_general, 0, ".", ".")}} </b></th>
                            </thead>

                        </table>

                    </div>

                </div>

            </div>
            
        @endif
                
    @else
        
        @php
            $total_comprometido=0;
        @endphp
        @php
            $total_voto = 0;
        @endphp
        @foreach ($comprometidos as $compre)

            @php
                $total_comprometido = $total_comprometido + $compre->comprometido;
            @endphp

            @if ($compre->voto  == 1)

                @php
                    $total_voto = $total_voto + $compre->voto;
                @endphp
                
            @endif
            
        @endforeach

        <div class="row">
        
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <div class="table-responsive">

                    <table id="example" class="table table-striped table-condensed table-bordered table-hover table-responsive">

                        <thead style="background-color:#f71808a8">

                            <th style="text-align: center">Cedula</th>
                            <th style="text-align: center">Apellido y Nombre</th>
                            <th style="text-align: center">Local</th>
                            <th style="text-align: center">Mesa</th>
                            <th style="text-align: center">Orden</th>
                            <th style="text-align: center">Com.</th>
                            <th style="text-align: center">Voto</th>
                            {{-- <th style="text-align: center">Referente</th>
                            <th style="text-align: center">PDF</th> --}}

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
                                        <td style="text-align: center; font-size: 1.2rem" width="70px">{!! Form::checkbox('comprometido', null, $comprometido->comprometido) !!} </td>
                                        <td style="text-align: center; font-size: 1.2rem" width="70px"> {!! Form::checkbox('voto', null, $comprometido->voto) !!} </td>
                                        {{-- <td style="text-align: center; font-size: 1.2rem">{{$comprometido->apellido_nombre_Referente}}</td>
                                        <td style="text-align: center" width="50px">
                                            <a href="#">
                                                <button class="btn btn-info btn-sm">PDF</button>
                                            </a>

                                        </td> --}}

                                    </tr>
                                    
                                @endforeach

                            </tbody>
                            
                        @endif

                    </table>
                    
                </div>

            </div>

        </div>
    
        <br>

        <div class="row">
        
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <div class="table-responsive">

                    <table class="table table-striped table-condensed table-bordered table-hover table-responsive">

                        <thead>

                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>

                        </thead >

                        <tbody>
                            
                            <tr>
                                
                                <td colspan="5" style="text-align: center"> <b>Total Comprometido :</b></td>
                                <td width="100px" style="text-align: center" > <b>{{number_format($total_comprometido, 0, ".", ".")}} </b></td>
                                <td width="70px"></td>

                            </tr>

                            <tr>
                                <td colspan="5" style="text-align: center"><b> Total Voto : </b></td>
                                <td></td>
                                <td style="text-align: center"> <b> {{number_format($total_voto, 0, ".", ".")}} </b></td>
                            </tr>

                        </tbody>

                    </table>
                    
                </div>

            </div>

        </div>
    
    @endif
    
    @push('scripts')

        <script type="text/javascript">

            $(document).ready(function() {
                $('#example').DataTable({
                    responsive: true,
                    autoWidth: false,
                    "pageLength": 10,                                       
                    "language": {
                        "lengthMenu": "Mostrar _MENU_ registros por paginas",
                        "zeroRecords": "No hay coicidencia",
                        "info": "Mostrando la pagina _PAGE_ de _PAGES_",
                        "infoEmpty": "No records available",
                        "infoFiltered": "(Filtrado de _MAX_ registros totales)", 
                        'search': 'Buscar', 
                        'paginate': {
                            'next': 'Siguiente',
                            'previous': 'Anterior'
                        }
                    }
                });
            });

        </script>
        
    @endpush


@endsection