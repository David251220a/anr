@php
    $total_voto = 0
@endphp

@if(empty($aux->cont))

@else

    @foreach ($votacion_consejal as $vota)

        @php $total_voto += $vota->Votos  @endphp        
        
    @endforeach

@endif
@extends('layouts.admin')

@section('contenido')

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    
        <div class="container">

            <u><h3 align="center" ><strong>Resumen General de Votos</strong></h3></u>
            
            <br>        

            @if(empty($votacion_consejal))

            @else        

                <div class="table-responsive">
                    
                    <table class="table table-condensed table-bordered table-hover table-responsive">
                    
                        <thead style="background-color:#f71808a8">

                            <tr style="text-align: center">
                                <th scope="col">Lista</th>
                                <th scope="col">Consejal</th>
                                <th scope="col">Votos</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @foreach ($votacion_consejal as $vot)
                                
                                <tr style="text-align: center">
                                    
                                    <th scope="row">{{$vot->Desc_Lista}}</th>
                                    <td>{{$vot->Nombre}} {{$vot->Apellido}}</td>
                                    <td style="text-align: right">{{number_format($vot->Votos,0, ".", ".")}}</td>
                                    
                                </tr>
                            
                            @endforeach                    


                        </tbody>

                        <tfoot>

                            <tr style="background-color:#f71808a8">

                                <td colspan="2"><b>Total de Votos</b></td> 
                                <td style="text-align: right"> <b>{{number_format($total_voto,0, ".", ".")}} </b></td>

                            </tr>
                        
                        </tfoot>

                    </table>

                </div>
                
            @endif

        </div>
    
    </div>

@endsection