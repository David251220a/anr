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

        <u><h3 align="center" ><strong>Resumen de Votos por Lista</strong></h3></u>
        
        <br>                
        
        @foreach ($lista as $marca)            

            <div class="table table-responsive table-bordered">
                
                <table class="table">
                                                        
                    <thead class="thead-light">                    

                        <tr style="text-align: center">
                            
                            <th colspan="2">{{$marca->Desc_Lista}}</th>
                            
                        </tr>
                        <tr style="text-align: center">

                            <th scope="col">Consejal</th>                            
                            <th scope="col">Votos</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($consejal as $vot)
                            
                            @if($vot->Id_Lista == $marca->Id_Lista)
                                
                                <tr style="text-align: center">
                                    
                                    <th scope="row">{{$vot->Nombre}} {{$vot->Apellido}}</th>                                    
                                    <td style="text-align: right">{{number_format($vot->Votos,0, ".", ".")}}</td>
                                    
                                </tr>

                            @endif

                        @endforeach


                    </tbody>

                    <tfoot>

                        @foreach ($consejal_monto as $vot1)
                            
                            @if($vot1->Id_Lista == $marca->Id_Lista)
                                
                                <tr style="text-align: center">
                                    
                                    <th scope="row">TOTAL GENERAL</th>                                    
                                    <td style="text-align: right">{{number_format($vot1->Votos,0, ".", ".")}}</td>
                                    
                                </tr>

                            @endif

                        @endforeach

                    
                    </tfoot>                    

                </table>

            </div>
            
            <br>

        @endforeach

    </div>    
    
</body>
</html>
