@php $local_1_voto = 0 @endphp
@php $local1_error = 0 @endphp

@php $local_2_voto = 0 @endphp
@php $local2_error = 0 @endphp

@php $local_3_voto = 0 @endphp
@php $local3_error = 0 @endphp

@php $local_4_voto = 0 @endphp
@php $local4_error = 0 @endphp

@php $local_5_voto = 0 @endphp
@php $local5_error = 0 @endphp

@foreach ($local1 as $lo1)

    @if(empty($lo1->Votos))

        @php $local1_error = 1 @endphp

    @else

        @php $local_1_voto += $lo1->Votos  @endphp        

    @endif        

@endforeach

@foreach ($local2 as $lo2)

    @if(empty($lo2->Votos))

        @php $local2_error = 1 @endphp

    @else

        @php $local_2_voto += $lo2->Votos  @endphp        

    @endif        

@endforeach

@foreach ($local3 as $lo3)

    @if(empty($lo3->Votos))

        @php $local3_error = 1 @endphp

    @else

        @php $local_3_voto += $lo3->Votos  @endphp        

    @endif        

@endforeach

@foreach ($local4 as $lo4)

    @if(empty($lo4->Votos))

        @php $local4_error = 1 @endphp

    @else

        @php $local_4_voto += $lo4->Votos  @endphp        

    @endif        

@endforeach

@foreach ($local5 as $lo5)

    @if(empty($lo5->Votos))

        @php $local5_error = 1 @endphp

    @else

        @php $local_5_voto += $lo5->Votos  @endphp        

    @endif        

@endforeach



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">            
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>

    <header>
        
        <p><strong>ANR</strong></p>    

    </header>
    
    <div class="container">

        <u><h3 align="center" ><strong>Resumen de Votos por Local</strong></h3></u>
        
        <br>        

        @if($local1_error == 0)

            <div class="table table-responsive table-bordered">
                
                <table class="table">
                
                    <thead class="thead-light">                    

                        <tr style="text-align: center">
                            
                            <th colspan="3">{{$local1_desc->Desc_Local}}</th>
                            
                        </tr>
                        <tr style="text-align: center">

                            <th scope="col">Lista</th>
                            <th scope="col">Intendente</th>
                            <th scope="col">Votos</th>

                        </tr>

                    </thead>
                    
                    <tbody>
                        @foreach ($local1 as $loc1)
                            
                            <tr style="text-align: center">
                                
                                <th scope="row">{{$loc1->Desc_Lista}}</th>
                                <td>{{$loc1->Nombre}} {{$loc1->Apellido}}</td>
                                <td style="text-align: right">{{number_format($loc1->Votos,0, ".", ".")}}</td>
                                
                            </tr>
                        
                        @endforeach                    


                    </tbody>

                    <tfoot>

                        <tr>

                            <td colspan="2">Total de Votos</td> 
                            <td style="text-align: right"> <b>{{number_format($local_1_voto,0, ".", ".")}} </b></td>

                        </tr>
                    
                    </tfoot>

                </table>

            </div>
            
        @endif

        <br>

        @if($local2_error == 0)
        
            <div class="table table-responsive table-bordered">
                
                <table class="table">
                
                    <thead class="thead-light">                    

                        <tr style="text-align: center">
                            
                            <th colspan="3">{{$local2_desc->Desc_Local}}</th>
                            
                        </tr>
                        <tr style="text-align: center">

                            <th scope="col">Lista</th>
                            <th scope="col">Intendente</th>
                            <th scope="col">Votos</th>

                        </tr>

                    </thead>
                    
                    <tbody>
                        @foreach ($local2 as $loc2)
                            
                            <tr style="text-align: center">
                                
                                <th scope="row">{{$loc2->Desc_Lista}}</th>
                                <td>{{$loc2->Nombre}} {{$loc2->Apellido}}</td>
                                <td style="text-align: right">{{number_format($loc2->Votos,0, ".", ".")}}</td>
                                
                            </tr>
                        
                        @endforeach                    


                    </tbody>

                    <tfoot>

                        <tr>

                            <td colspan="2">Total de Votos</td> 
                            <td style="text-align: right"> <b>{{number_format($local_2_voto,0, ".", ".")}} </b></td>

                        </tr>
                    
                    </tfoot>

                </table>

            </div>
            
        @endif

        <br>

        @if($local3_error == 0)
        
            <div class="table table-responsive table-bordered">
                
                <table class="table">
                
                    <thead class="thead-light">                    

                        <tr style="text-align: center">
                            
                            <th colspan="3">{{$local3_desc->Desc_Local}}</th>
                            
                        </tr>
                        <tr style="text-align: center">

                            <th scope="col">Lista</th>
                            <th scope="col">Intendente</th>
                            <th scope="col">Votos</th>

                        </tr>

                    </thead>
                    
                    <tbody>
                        @foreach ($local3 as $loc3)
                            
                            <tr style="text-align: center">
                                
                                <th scope="row">{{$loc3->Desc_Lista}}</th>
                                <td>{{$loc3->Nombre}} {{$loc3->Apellido}}</td>
                                <td style="text-align: right">{{number_format($loc3->Votos,0, ".", ".")}}</td>
                                
                            </tr>
                        
                        @endforeach                    


                    </tbody>

                    <tfoot>

                        <tr>

                            <td colspan="2">Total de Votos</td> 
                            <td style="text-align: right"> <b>{{number_format($local_3_voto,0, ".", ".")}} </b></td>

                        </tr>
                    
                    </tfoot>

                </table>

            </div>
            
        @endif

        <br>

        @if($local4_error == 0)
        
            <div class="table table-responsive table-bordered">
                
                <table class="table">
                
                    <thead class="thead-light">                    

                        <tr style="text-align: center">
                            
                            <th colspan="3">{{$local4_desc->Desc_Local}}</th>
                            
                        </tr>
                        <tr style="text-align: center">

                            <th scope="col">Lista</th>
                            <th scope="col">Intendente</th>
                            <th scope="col">Votos</th>

                        </tr>

                    </thead>
                    
                    <tbody>
                        @foreach ($local4 as $loc4)
                            
                            <tr style="text-align: center">
                                
                                <th scope="row">{{$loc4->Desc_Lista}}</th>
                                <td>{{$loc4->Nombre}} {{$loc4->Apellido}}</td>
                                <td style="text-align: right">{{number_format($loc4->Votos,0, ".", ".")}}</td>
                                
                            </tr>
                        
                        @endforeach                    


                    </tbody>

                    <tfoot>

                        <tr>

                            <td colspan="2">Total de Votos</td> 
                            <td style="text-align: right"> <b>{{number_format($local_4_voto,0, ".", ".")}} </b></td>

                        </tr>
                    
                    </tfoot>

                </table>

            </div>
            
        @endif

        <br>

        @if($local5_error == 0)
        
            <div class="table table-responsive table-bordered">
                
                <table class="table">
                
                    <thead class="thead-light">                    

                        <tr style="text-align: center">
                            
                            <th colspan="3">{{$local5_desc->Desc_Local}}</th>
                            
                        </tr>
                        <tr style="text-align: center">

                            <th scope="col">Lista</th>
                            <th scope="col">Intendente</th>
                            <th scope="col">Votos</th>

                        </tr>

                    </thead>
                    
                    <tbody>
                        @foreach ($local5 as $loc5)
                            
                            <tr style="text-align: center">
                                
                                <th scope="row">{{$loc5->Desc_Lista}}</th>
                                <td>{{$loc5->Nombre}} {{$loc5->Apellido}}</td>
                                <td style="text-align: right">{{number_format($loc5->Votos,0, ".", ".")}}</td>
                                
                            </tr>
                        
                        @endforeach                    


                    </tbody>

                    <tfoot>

                        <tr>

                            <td colspan="2">Total de Votos</td> 
                            <td style="text-align: right"> <b>{{number_format($local_5_voto,0, ".", ".")}} </b></td>

                        </tr>
                    
                    </tfoot>

                </table>

            </div>
            
        @endif

    </div>
    
    
</body>
</html>
