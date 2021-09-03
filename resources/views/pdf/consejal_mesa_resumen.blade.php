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
            
            @if ($id == 9999)        
            
                @foreach ($consejales as $consejal)

                    <div class="table table-responsive table-bordered">
                        
                        <table class="table">
                                                                
                            <thead class="thead-light">                    

                                <tr style="text-align: center">
                                    
                                    <th colspan="2">{{$consejal->consejal}}</th>
                                    
                                </tr>
                                <tr style="text-align: center">

                                    <th scope="col">Mesa</th>                                
                                    <th scope="col">Votos</th>

                                </tr>

                            </thead>
                            
                            @php
                                $total= 0;
                            @endphp
                            
                            <tbody>

                                @foreach ($votacion_consejal as $vot)
                                    
                                    @if($vot->Id_Consejal == $consejal->Id_Consejal)
                                        
                                        <tr style="text-align: center">
                                            
                                            <th scope="row">{{$vot->Mesa}}</th>                                    
                                            <td style="text-align: right">{{number_format($vot->votos,0, ".", ".")}}</td>
                                            @php
                                                $total = $vot->consejal_votos;
                                            @endphp 
                                            
                                        </tr>

                                    @endif

                                @endforeach


                            </tbody>

                            <tfoot>
                                
                                <tr style="background-color:#f71808a8">

                                    <th> <b>Total de Votos</b></th>
                                    <th style="text-align: right"><b>{{number_format($total,0, ".", ".")}} </b></th>

                                </tr>
                            
                            </tfoot>

                        </table>

                    </div>

                @endforeach

                
                    
            @else

                @php
                    $consejal_1= "";
                @endphp

                @foreach ($consejales as $conse)
                    
                    @if ($conse->Id_Consejal == $id)

                        @php
                            $consejal_1= $conse->consejal;
                        @endphp
                        
                    @endif

                @endforeach

                <div class="table table-responsive table-bordered">
                            
                    <table class="table">
                                                            
                        <thead class="thead-light">                    

                            <tr style="text-align: center">
                                
                                <th colspan="2">{{$consejal_1}}</th>
                                
                            </tr>
                            <tr style="text-align: center">

                                <th scope="col">Mesa</th>                                
                                <th scope="col">Votos</th>

                            </tr>

                        </thead>
                        
                        @php
                            $total= 0;
                        @endphp
                        
                        <tbody>

                            @foreach ($votacion_consejal as $vot)
                                    
                                <tr style="text-align: center">
                                    
                                    <th scope="row">{{$vot->Mesa}}</th>                                    
                                    <td style="text-align: right">{{number_format($vot->votos,0, ".", ".")}}</td>
                                    @php
                                        $total = $vot->consejal_votos;
                                    @endphp 
                                    
                                </tr>

                            @endforeach


                        </tbody>

                        <tfoot>
                            
                            <tr style="background-color:#f71808a8">

                                <th> <b>Total de Votos</b></th>
                                <th style="text-align: right"><b>{{number_format($total,0, ".", ".")}} </b></th>

                            </tr>
                        
                        </tfoot>

                    </table>

                </div>

                    
                
            @endif
            

        </div>    
        
    </body>

</html>
