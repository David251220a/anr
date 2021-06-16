@extends('layouts.admin')

@section('contenido')

<div class="rows">

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        
        <LEGEND><b> <i> <u><h3>Votos Consejal</h3></u></i></b> </LEGEND>

    </div>
</div>

<div class="rows">

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        @if (session()->has('msj'))
        
        <div class="alert alert-danger" role="alert">{{session('msj')}}</div>
        
        @else
            
        @endif
    </div>
</div>

<br>

<div class="rows">

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="table table-responsive">

            <table id="detalles"  class="table table-striped table-bordered table-condensed table-hover">                
                
                <thead style="background-color:#f20a0ade">
                    
                    <th style="text-align: center">Lista</th>                                                
                    <th colspan="2" style="text-align: center">Consejal</th>
                    <th style="text-align: center">Local</th>
                    <th style="text-align: center">Mesa</th>
                    <th style="text-align: center">Votos</th>
                    <th style="text-align: center">Opcion</th>
                    <th style="text-align: center">Acta</th>

                </thead>                
                @foreach ($votos_consejal as $vot)

                    <tr style="vertical-align: middle ; text-align: center">
                                            
                        <td>{{$vot->Desc_Lista}}</td>                    
                        <td>{{$vot->Nombre}}</td>
                        <td>{{$vot->Apellido}}</td>
                        <td>{{$vot->Desc_Local}}</td>
                        <td>{{$vot->Mesa}}</td>
                        <td style="text-align: right">{{number_format($vot->Votos,0, ".", ".")}}</td>
                        <td>
                            <a href="" data-target="#modal-edit-{{$vot->Id_Votacion_Consejal}}" data-toggle="modal">
                                 <button class="btn btn-danger">Editar</button>
                            </a>
                           
                        </td>

                        <td>

                            @if(empty($vot->imagen))

                                <button class="btn btn-danger">NO</button>

                            @else

                                <button class="btn btn-info">SI</button>
                                <a href="{{URL::action('Consulta_ConsejalController@Acta', $vot->Id_Votacion_Consejal)}}" target="_blank">
                                    <button class="btn btn-info">Ver</button>
                               </a>

                            @endif                                                                                                                      

                        </td>
                    
                    </tr>
                    
                    @include('consulta.votos_consejal.modal')
                
                @endforeach

            </table>

        </div>        

    </div>

</div>

@push('scripts')

<script type="text/javascript">

        $(document).ready(function() {
            var dataTable = $('#detalles').dataTable({
                //$("#detalles_.dataTables_filter").hide();                
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",                    
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
                        
            });
        
        });
</script>

@endpush

@endsection