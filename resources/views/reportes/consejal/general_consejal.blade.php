@php
    $total_voto = 0
@endphp

@if(empty($votacion_consejal))

@else

    @foreach ($votacion_consejal as $vota1)

        @php $total_voto += $vota1->votos  @endphp        
        
    @endforeach

@endif
@extends('layouts.admin')

@section('contenido')

    <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            
            <div class="form-group">

                <div class="input-group">
    
                    <u><h3 align="center" ><strong>Resumen General de Votos</strong></h3></u>
                    <span class="input-group-btn">
                    <a href=" {{ route('electores_pdf') }}" target="_blank">
                        <button class="btn btn-info float-right"><li  class="fa fa-file-pdf-o"></li> PDF</button>
                    </a>
    
                </span>
    
                </div>
    
            </div>

            <br>       

        </div>

    </div>

    <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">         

            @if(empty($votacion_consejal))
    
            @else        
    
                <div class="table-responsive">
                    
                    <table class="table table-striped table-condensed table-bordered table-hover table-responsive">
                    
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
                                    
                                    <td>{{$vot->Desc_Lista}}</th>
                                    <td>{{$vot->consejal}}</td>
                                    <td style="text-align: right">{{number_format($vot->votos,0, ".", ".")}}</td>
                                    
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