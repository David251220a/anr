@php $local_1 = 0 @endphp

@php $local_2 = 0 @endphp

@php $local_3 = 0 @endphp

@php $local_4 = 0 @endphp

@php $local_5 = 0 @endphp

@foreach ($votacion_consejal as $res)

    @if($res->Id_Local == 1)

        @if(empty($res->Votos))        
            
        @else
            @php $local_1 += $res->Votos @endphp

        @endif

    @endif

    @if($res->Id_Local == 2)

        @if(empty($res->Votos))        
                
        @else
            @php $local_2 += $res->Votos @endphp

        @endif

    @endif
    
    @if($res->Id_Local == 3)

        @if(empty($res->Votos))        
                
        @else
            @php $local_3 += $res->Votos @endphp

        @endif

    @endif

    @if($res->Id_Local == 4)

        @if(empty($res->Votos))        
                
        @else
            @php $local_4 += $res->Votos @endphp

        @endif

    @endif

    @if($res->Id_Local == 5)

        @if(empty($res->Votos))        
                
        @else
            @php $local_5 += $res->Votos @endphp

        @endif

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
        
        @foreach ($local_votacion as $loca)

            <div class="table table-responsive table-bordered">
                
                <table class="table">
                                                        
                    <thead class="thead-light">                    

                        <tr style="text-align: center">
                            
                            <th colspan="3">{{$loca->Desc_Local}}</th>
                            
                        </tr>
                        <tr style="text-align: center">

                            <th scope="col">Lista</th>
                            <th scope="col">Consejal</th>
                            <th scope="col">Votos</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($votacion_consejal as $vot)
                            
                            @if($vot->Id_Local == $loca->Id_Local)
                                
                                <tr style="text-align: center">
                                    
                                    <th scope="row">{{$vot->Desc_Lista}}</th>
                                    <th scope="row">{{$vot->Nombre}} {{$vot->Apellido}}</th>
                                    <td style="text-align: right">{{number_format($vot->Votos,0, ".", ".")}}</td>
                                    
                                </tr>

                            @endif

                        @endforeach


                    </tbody>

                    <tfoot>

                        <tr>

                            <th  colspan="2" scope="row">Total de Votos</th>
                            
                            @if($loca->Id_Local == 1)
                                
                                <td style="text-align: right"> <b>{{number_format($local_1,0, ".", ".")}} </b></td>

                            @endif
                            
                            @if($loca->Id_Local == 2)
                                
                                <td style="text-align: right"> <b>{{number_format($local_2,0, ".", ".")}} </b></td>

                            @endif

                            @if($loca->Id_Local == 3)
                                
                                <td style="text-align: right"> <b>{{number_format($local_3, 0, ".", ".")}} </b></td>

                            @endif
                            
                            @if($loca->Id_Local == 4)
                                
                                <td style="text-align: right"> <b>{{number_format($local_4, 0, ".", ".")}} </b></td>

                            @endif
                            
                            @if($loca->Id_Local == 5)
                                
                                <td style="text-align: right"> <b>{{number_format($local_5, 0, ".", ".")}} </b></td>

                            @endif
                        </tr>
                    
                    </tfoot>                    

                </table>

            </div>
            
            <br>

        @endforeach

    </div>    
    
</body>
</html>
