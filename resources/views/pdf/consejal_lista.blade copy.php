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

        <u><h3 align="center" ><strong>Resumen de Votos Consejales por Lista</strong></h3></u>
        
        <br>                
        
        @if ($id == 999)        
        
            @foreach ($listas as $lista)

                <div class="table table-responsive table-bordered">
                    
                    <table class="table">
                                                            
                        <thead class="thead-light">                    

                            <tr style="text-align: center">
                                
                                <th colspan="2">{{$lista->Desc_Lista}}</th>
                                
                            </tr>
                            <tr style="text-align: center">

                                <th scope="col">Consejal</th>                                
                                <th scope="col">Votos</th>

                            </tr>

                        </thead>
                        
                        @php
                            $votos_lista= 0;
                        @endphp

                        @php
                            $total_general = 0;
                        @endphp
                        
                        <tbody>

                            @foreach ($votacion_consejal as $vot)
                                
                                @if($vot->Id_Lista == $lista->Id_Lista)
                                    
                                    <tr style="text-align: center">
                                        
                                        <th scope="row">{{$vot->consejal}}</th>
                                        <td style="text-align: right">{{number_format($vot->votos_consejal,0, ".", ".")}}</td>
                                        @php
                                            $votos_lista = $vot->votos_lista;
                                        @endphp
                                        @php
                                            $total_general = $vot->Total;
                                        @endphp
                                        
                                    </tr>

                                @endif

                            @endforeach


                        </tbody>

                        <tfoot>
                            
                            <tr style="background-color:#f71808a8">

                                <th> <b>Total de Votos</b></th>
                                <th style="text-align: right"><b>{{number_format($votos_lista,0, ".", ".")}} </b></th>

                            </tr>
                        
                        </tfoot>

                    </table>

                </div>

            @endforeach

            <div class="table table-responsive table-bordered">

                <table class="table">

                    <thead style="background-color:#f71808a8">
                        
                        <tr>

                            <th style="text-align: center"><b>TOTAL GENERAL DE VOTOS</b></th>
                            <th style="text-align: center"><b>{{$total_general}}</b></th>

                        </tr>
                        
                    </thead>

                </table>

            </div>

            
                
        @else

            @php
                $lista_nombre = "";
            @endphp

            @foreach ($listas as $lis)

                @if ($lis->Id_Lista == $id)

                    @php
                        $lista_nombre = $lis->Desc_Lista;
                    @endphp
                    
                @endif
                
            @endforeach

            @if ($votacion_consejal)

                <div class="table table-responsive table-bordered">
                            
                    <table class="table">
                                                            
                        <thead class="thead-light">                    

                            <tr style="text-align: center">
                                
                                <th colspan="2">{{$lista_nombre}}</th>
                                
                            </tr>
                            <tr style="text-align: center">

                                <th scope="col">Consejal</th>                                
                                <th scope="col">Votos</th>

                            </tr>

                        </thead>
                        
                        @php
                            $votos_lista= 0;
                        @endphp

                        @php
                            $total_general = 0;
                        @endphp
                        
                        <tbody>

                            @foreach ($votacion_consejal as $vot)
                                    
                                <tr style="text-align: center">
                                    
                                    <th scope="row">{{$vot->consejal}}</th>                                    
                                    <td style="text-align: right">{{number_format($vot->votos_consejal,0, ".", ".")}}</td>
                                    @php
                                        $votos_lista = $vot->votos_lista;
                                    @endphp
                                    @php
                                        $total_general = $vot->Total;
                                    @endphp
                                    
                                </tr>

                            @endforeach

                        </tbody>

                        <tfoot>
                            
                            <tr style="background-color:#f71808a8">

                                <th> <b>Total de Votos</b></th>
                                <th style="text-align: right"><b>{{number_format($votos_lista,0, ".", ".")}} </b></th>

                            </tr>
                        
                        </tfoot>

                    </table>

                </div>

            @endif
            
        @endif
        

    </div>    
    
</body>

</html>
