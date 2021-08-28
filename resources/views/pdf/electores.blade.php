@php
    $total_lectores = 0;
@endphp

@php
    $total_mesas = 0;
@endphp

@extends('layouts.admin')

@section('contenido')

    <div class="row">
        
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            
            <h3><b>CANTIDAD DE ELECTORES Y MESAS HABILITADAS POR LOCAL DE VOTACIÓN</b></h3>
            {{-- <a class="btn btn-secondary btn-sm float-right" href="#">PDF</a> --}}
            <a href=" {{ route('electores_pdf') }}" target="_blank">
                <button class="btn btn-info float-right"><li  class="fa fa-file-pdf-o"></li> PDF</button>
            </a>
        
        </div>

    </div>
    
    <br>    

    <div class="row">

        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

            <table id="detalles" class="table table-striped table-condensed table-bordered table-hover table-responsive">

                <thead style="background-color:#f71808a8">
                    

                    <th style="text-align: center">Orden</th>
                    <th style="text-align: center">Local</th>
                    <th style="text-align: center">Lectores</th>
                    <th style="text-align: center">Mesa</th>                    

                </thead>                

                <tbody>

                    @foreach ($electores as $elector)
                        
                        <tr>

                            <td style="text-align: right">{{$elector->Orden}}</td>
                            <td style="text-align: center">{{$elector->Local}}</td>
                            <td style="text-align: right">{{number_format($elector->Lectores, 0, ".", ".")}}</td>
                            <td style="text-align: right">{{number_format($elector->Mesas, 0, ".", ".")}}</td>
                            @php
                                $total_lectores = $total_lectores + $elector->Lectores;
                            @endphp
                            @php
                                $total_mesas = $total_mesas + $elector->Mesas;
                            @endphp
                        </tr>
                    @endforeach

                </tbody>

                <tfoot>

                    <tr style="background-color:#f71808a8">
                        <td colspan="2" style="text-align: center"><b> TOTAL </b></td>
                        <td style="text-align: right"><b>{{number_format($total_lectores, 0, ".", ".")}}</b></td>
                        <td style="text-align: right"> <b>{{number_format($total_mesas, 0, ".", ".")}}</b></td>
                    </tr>

                </tfoot>

            </table>

        </div>

    </div>

@endsection