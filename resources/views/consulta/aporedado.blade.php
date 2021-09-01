@extends('layouts.admin')

@section('contenido')

    <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <h4 style="text-align: center"><b><i><strong>Aporedados</strong></i></b></h4>
        
        </div>

    </div>

    <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <div class="table-responsive">

                <table id="example" class="table table-striped table-condensed table-bordered table-hover table-responsive">

                    <thead style="background-color:#f71808a8">

                        <th style="text-align: center">Local</th>
                        <th style="text-align: center">Cant. Mesa</th>
                        <th style="text-align: center">Aporedado</th>
                        <th style="text-align: center">Telefono</th>
                        <th style="text-align: center">Aporedado</th>
                        <th style="text-align: center">Telefono</th>
                        <th style="text-align: center">Aporedado</th>
                        <th style="text-align: center">Telefono</th>
                        <th style="text-align: center">Aporedado</th>
                        <th style="text-align: center">Telefono</th>
                        <th style="text-align: center">OK</th>

                    </thead>


                    <tbody>

                        @foreach ($aporedados as $aporedado)

                            <tr>
                                {!! Form::model($aporedado, ['route' => ['consulta.store_aporedado', $aporedado->Id_Aporedado], 'method' => 'put']) !!}
                                <td style="text-align: right; font-size: 1.2rem"><input type="hidden" class="form-control" name="id" value="{{$aporedado->Id_Aporedado}}">{{$aporedado->Local}}</td>
                                <td style="text-align: center; font-size: 1.2rem">{{$aporedado->Cant_Mesas}}</td>
                                <td style="text-align: center; font-size: 1.2rem"><input type="text" class="form-control" name="aporedado_1" value="{{$aporedado->Apoderado1}}"></td>
                                <td style="text-align: right; font-size: 1.2rem" width="100px"><input type="text" class="form-control" name="telefono_1" value="{{$aporedado->Apo1_Telefono}}"></td>
                                <td style="text-align: center; font-size: 1.2rem"><input type="text" class="form-control" name="aporedado_2" value="{{$aporedado->Apoderado2}}"></td>
                                <td style="text-align: right; font-size: 1.2rem" width="100px"><input type="text" class="form-control" name="telefono_2" value="{{$aporedado->Apo2_Telefono}}"></td>
                                <td style="text-align: center; font-size: 1.2rem"><input type="text" class="form-control" name="aporedado_3" value="{{$aporedado->Apoderado3}}"></td>
                                <td style="text-align: right; font-size: 1.2rem" width="100px"><input type="text" class="form-control" name="telefono_3" value="{{$aporedado->Apo3_Telefono}}"></td>
                                <td style="text-align: center; font-size: 1.2rem"><input type="text" class="form-control" name="aporedado_4" value="{{$aporedado->Apoderado4}}"></td>
                                <td style="text-align: right; font-size: 1.2rem" width="100px"><input type="text" class="form-control" name="telefono_4" value="{{$aporedado->Apo4_Telefono}}"></td>
                                <td style="text-align: center"> <button style="font-size: 1.2rem" class="btn btn-success btn-sm float-right" type="submit">OK</button> </td>
                                {!! Form::close() !!}
                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>
        
        </div>

    </div>

    @push('scripts')

        <script type="text/javascript">

            $(document).ready(function() {
                $('#example').DataTable({
                    responsive: true,
                    autoWidth: false,
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