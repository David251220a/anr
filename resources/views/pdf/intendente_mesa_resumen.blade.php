@php $intendente_voto_1 = 0 @endphp

@php $intendente_voto_2 = 0 @endphp

@php $intendente_voto_3 = 0 @endphp

@php $intendente_voto_4 = 0 @endphp

@php $intendente_voto_5 = 0 @endphp

@foreach ($resumen_mesa as $res)

    @if($res->Id_Intendente == 1)

        @php $intendente_voto_1 += $res->Votos @endphp           

    @endif

    @if($res->Id_Intendente == 2)

        @php $intendente_voto_2 += $res->Votos @endphp           

    @endif
    
    @if($res->Id_Intendente == 3)

        @php $intendente_voto_3 += $res->Votos @endphp           

    @endif

    @if($res->Id_Intendente == 4)

        @php $intendente_voto_4 += $res->Votos @endphp

    @endif

    @if($res->Id_Intendente == 5)

        @php $intendente_voto_5 += $res->Votos @endphp           

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

        <u><h3 align="center" ><strong>Resumen de Votos Intendente por Mesa</strong></h3></u>
        
        <br>                
        
        @foreach ($intendente as $int)

            <div class="table table-responsive table-bordered">
                
                <table class="table">
                                                        
                    <thead class="thead-light">                    

                        <tr style="text-align: center">
                            
                            <th colspan="2">{{$int->Nombre}} {{$int->Apellido}}</th>
                            
                        </tr>
                        <tr style="text-align: center">

                            <th scope="col">Mesa</th>                                
                            <th scope="col">Votos</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($resumen_mesa as $resu)
                            
                            @if($int->Id_Intendente == $resu->Id_Intendente)
                                
                                <tr style="text-align: center">
                                    
                                    <th scope="row">{{$resu->Mesa}}</th>                                    
                                    <td style="text-align: right">{{number_format($resu->Votos,0, ".", ".")}}</td>
                                    
                                </tr>

                            @endif

                        @endforeach


                    </tbody>

                    <tfoot>

                        <tr>

                            <th scope="row">Total de Votos</th>
                            
                            @if($int->Id_Intendente == 1)
                                
                                <td style="text-align: right"> <b>{{number_format($intendente_voto_1,0, ".", ".")}} </b></td>

                            @endif
                            
                            @if($int->Id_Intendente == 2)
                                
                                <td style="text-align: right"> <b>{{number_format($intendente_voto_2,0, ".", ".")}} </b></td>

                            @endif

                            @if($int->Id_Intendente == 3)
                                
                                <td style="text-align: right"> <b>{{number_format($intendente_voto_3, 0, ".", ".")}} </b></td>

                            @endif
                            
                            @if($int->Id_Intendente == 4)
                                
                                <td style="text-align: right"> <b>{{number_format($intendente_voto_4, 0, ".", ".")}} </b></td>

                            @endif
                            
                            @if($int->Id_Intendente == 5)
                                
                                <td style="text-align: right"> <b>{{number_format($intendente_voto_5, 0, ".", ".")}} </b></td>

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
