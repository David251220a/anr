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
                        <th  style="text-align: center" colspan="8">Intendente</th>
                    </tr>
                    <tr style="text-align: center">
                        
                        <th style="text-align: center">Lista</th>
                        <th style="text-align: center">Intendente</th>
                        <th style="text-align: center">Local</th>
                        <th style="text-align: center">Mesa</th>
                        <th style="text-align: center">Descripcion Cambio</th>
                        <th style="text-align: center">Fecha</th>
                        <th style="text-align: center">Usuario</th>                    
                    </tr>

                </thead>                
                @foreach ($auditoria as $audi)

                    <tr style="vertical-align: middle ; text-align: center">
                        
                        <td>{{$audi->Desc_Lista}}</td>
                        <td>{{$audi->Nombre}} {{$audi->Apellido}} </td>
                        <td>{{$audi->Desc_Local}}</td>
                        <td>{{$audi->Mesa}}</td>
                        <td>{{$audi->Descripcion_Cambio}}</td>
                        <td>{{date('d-m-Y H:i', strtotime($audi->Fecha))}}</td>
                        <td>{{$audi->name}}</td>
                    
                    </tr>                                        
                
                @endforeach

            </table>

        </div>        

    </div>

</div>

<br>
<br>
<hr width="100%" style="color: #ed1212;" />
<br>
<br>

<div class="rows">

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="table table-responsive">

            <table id="detalles1"  class="table table-striped table-bordered table-condensed table-hover">                
                
                <thead style="background-color:#f20a0ade">
                    
                    <tr style="text-align: center">
                        <th  style="text-align: center" colspan="8">Consejal</th>
                    </tr>
                    <tr style="text-align: center">
                        
                        <th style="text-align: center">Lista</th>
                        <th style="text-align: center">Consejal</th>
                        <th style="text-align: center">Local</th>
                        <th style="text-align: center">Mesa</th>
                        <th style="text-align: center">Descripcion Cambio</th>
                        <th style="text-align: center">Fecha</th>
                        <th style="text-align: center">Usuario</th>                    
                    </tr>

                </thead>                
                @foreach ($auditoria_consejal as $audi1)

                    <tr style="vertical-align: middle ; text-align: center">
                                            
                        <td>{{$audi1->Desc_Lista}}</td>
                        <td>{{$audi1->Desc_Lista}} - {{$audi1->Nombre}} {{$audi1->Apellido}} </td>
                        <td>{{$audi1->Desc_Local}}</td>
                        <td>{{$audi1->Mesa}}</td>
                        <td>{{$audi1->Descripcion_Cambio}}</td>
                        <td>{{date('d-m-Y H:i', strtotime($audi1->Fecha))}}</td>
                        <td>{{$audi1->name}}</td>
                    
                    </tr>                                        
                
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