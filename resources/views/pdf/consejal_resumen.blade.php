@php
    $total_voto = 0
@endphp

@if(empty($votacion_consejal))

@else

    @foreach ($votacion_consejal as $vota)

        @php $total_voto += $vota->votos  @endphp        
        
    @endforeach

@endif

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

        <u><h3 align="center" ><strong>Resumen General de Votos</strong></h3></u>
        
        <br>        

        @if(empty($votacion_consejal))

        @else        

            <div class="table table-responsive table-bordered">
                
                <table class="table">
                
                    <thead class="thead-light">                    

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
                                <td>{{$vot->consejal}}</td>
                                <td style="text-align: right">{{number_format($vot->votos,0, ".", ".")}}</td>
                                
                            </tr>
                        
                        @endforeach                    


                    </tbody>

                    <tfoot>

                        <tr>

                            <td colspan="2">Total de Votos</td> 
                            <td style="text-align: right"> <b>{{number_format($total_voto,0, ".", ".")}} </b></td>

                        </tr>
                    
                    </tfoot>

                </table>

            </div>
            
        @endif

    </div>
    
    
</body>
</html>