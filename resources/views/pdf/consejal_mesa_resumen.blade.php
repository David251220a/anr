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

        <u><h3 align="center" ><strong>Resumen de Votos Consejal por Mesa</strong></h3></u>
        
        <br>                
        
        @foreach ($consejal as $int)

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
                            
                            @if($int->Id_Consejal == $resu->Id_Consejal)
                                
                                <tr style="text-align: center">
                                    
                                    <th scope="row">{{$resu->Mesa}}</th>                                    
                                    <td style="text-align: right">{{number_format($resu->Votos,0, ".", ".")}}</td>
                                    
                                </tr>

                            @endif

                        @endforeach


                    </tbody>
                                          
                    @foreach ($total as $tota)
                
                        @if($int->Id_Consejal == $tota->Id_Consejal)
                        
                            @if(empty($tota->Votos))                                    
                                
                            @else
                            
                                <tfoot>

                                    <tr style="text-align: center">
                                        <th scope="row">Total de Votos</th>             
                                        <td style="text-align: right">{{number_format($resu->Votos,0, ".", ".")}}</td>
                                        
                                    </tr>
                                
                                </tfoot>
                            
                            @endif

                        @endif

                    @endforeach

                    
                    

                </table>

            </div>
            
            <br>

        @endforeach

    </div>    
    
</body>
</html>
