@extends('layouts.admin')

@section('contenido')

<div class="rows">

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        
        <LEGEND><b> <i> <u><h3>Auditoria</h3></u></i></b> </LEGEND>

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
                    
                    <tr style="text-align: center">
                        <th  style="text-align: center" colspan="5">Auditoria</th>
                    </tr>
                    <tr style="text-align: center">
                        
                        <th style="text-align: center">Cedula</th>
                        <th style="text-align: center">Apellido Nombre</th>
                        <th style="text-align: center">Local</th>
                        <th style="text-align: center">Mesa</th>
                        <th style="text-align: center">Orden</th>
                        {{-- <th style="text-align: center">Fecha</th> --}}
                    
                    </tr>

                </thead>  
                @php
                    $cont = 0;
                @endphp

                <tbody>

                    @foreach ($auditoria as $audi)

                        <tr style="vertical-align: middle ; text-align: center">
                            
                            <td>{{number_format($audi->Cedula, 0, ".", ".")}}</td>
                            <td>{{$audi->apellido_nombre}}</td>
                            <td>{{$audi->Desc_Local}}</td>
                            <td>{{$audi->mesa}}</td>
                            <td>{{$audi->orden}}</td>
                            {{-- <td>{{date('H:i', strtotime($audi->Fecha_Hora))}}</td> --}}
                        
                        </tr>                                        

                        @php
                            $cont = $cont + 1;
                        @endphp
                    
                    @endforeach

                </tbody>

            </table>

        </div>        

    </div>

</div>

<div class="rows">

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="table table-responsive">

            <table id="detalles"  class="table table-striped table-bordered table-condensed table-hover">                
                
                <thead style="background-color:#f20a0ade">
                    
                    <tr style="text-align: center">
                        <th  colspan="4" style="text-align: center">Total: {{number_format($cont, 0, ".", ".")}}</th>
                    </tr>

                </thead>

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

            var dataTable = $('#detalles1').dataTable({
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