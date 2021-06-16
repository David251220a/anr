@php $local_1 = 0 @endphp

@php $local_2 = 0 @endphp

@php $local_3 = 0 @endphp

@php $local_4 = 0 @endphp

@php $local_5 = 0 @endphp

@php $total_general = 0 @endphp

@foreach ($intendente as $res)

    @if($res->Id_Local == 1)

        @php $local_1 += $res->Votos @endphp           

    @endif

    @if($res->Id_Local == 2)

        @php $local_2 += $res->Votos @endphp           

    @endif
    
    @if($res->Id_Local == 3)

        @php $local_3 += $res->Votos @endphp           

    @endif

    @if($res->Id_Local == 4)

        @php $local_4 += $res->Votos @endphp

    @endif

    @if($res->Id_Local == 5)

        @php $local_5 += $res->Votos @endphp           

    @endif

    @php $total_general += $res->Votos @endphp

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

        <u><h3 align="center" ><strong>Resumen de Votos de: {{$aux_intendente->Nombre}} {{$aux_intendente->Apellido}}</strong></h3></u>
        
        <br>                
        
        @foreach ($local_votacion as $loca)
            
            <div class="table table-responsive table-bordered">
                    
                <table class="table">
                                                        
                    <thead class="thead-light">                    

                        <tr style="text-align: center">
                            
                            <th colspan="2">{{$loca->Desc_Local}}</th>
                            
                        </tr>
                        <tr style="text-align: center">

                            <th scope="col">Mesa</th>                                
                            <th scope="col">Votos</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($intendente as $inte)
                            
                            @if($inte->Id_Local == $loca->Id_Local)
                                
                                <tr style="text-align: center">
                                    
                                    <th scope="row">{{$inte->Mesa}}</th>                                    
                                    <td style="text-align: right">{{number_format($inte->Votos,0, ".", ".")}}</td>
                                    
                                </tr>

                            @endif

                        @endforeach


                    </tbody>

                    <tfoot>

                        <tr>

                            <th scope="row">Total de Votos</th>
                            
                            @if($loca->Id_Local == 1)
                                
                                <td style="text-align: right"> <b>{{number_format($local_1, 0, ".", ".")}} </b></td>

                            @endif
                            
                            @if($loca->Id_Local == 2)
                                
                                <td style="text-align: right"> <b>{{number_format($local_2, 0, ".", ".")}} </b></td>

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

        <div class="table table-responsive table-bordered">
                    
            <table class="table">
                                                    
                <thead class="thead-light">

                    <tr style="text-align: center">

                        <th scope="col"> <b> TOTAL GENERAL DE VOTOS: </b></th>
                        <th scope="col">{{number_format($total_general, 0, ".", ".")}} </th>

                    </tr>

                </thead>
            
            </table>   
        
        </div>
    
    </div>    
    
</body>

</html>