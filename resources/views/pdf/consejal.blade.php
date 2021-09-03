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

            <u><h3 align="center" ><strong>Resumen de Votos de: {{$consejal->consejal}}</strong></h3></u>
            
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
                        @php
                            $total_local= 0;
                        @endphp

                        @php
                            $total_general= 0;
                        @endphp


                        <tbody>

                            @foreach ($votacion_consejal as $conse)
                                
                                @if($conse->Id_Local == $loca->Id_Local)
                                    
                                    <tr style="text-align: center">
                                        
                                        <th scope="row">{{$conse->Mesa}}</th>                                    
                                        <td style="text-align: right">{{number_format($conse->Votos,0, ".", ".")}}</td>
                                        
                                    </tr>

                                    @php
                                        $total_local = $conse->total_local;
                                    @endphp

                                @endif

                                @php
                                    $total_general = $conse->total_general;
                                @endphp

                            @endforeach


                        </tbody>

                        <tfoot>
                            
                            <tr style="background-color:rgb(145, 143, 143)">

                                <td style="text-align: center"> <b>Total de Votos</b></td>
                                <td style="text-align: right"><b>{{number_format($total_local,0, ".", ".")}} </b></td>

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