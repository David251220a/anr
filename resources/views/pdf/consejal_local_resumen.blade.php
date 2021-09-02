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
        
        @if ($id == 99)

            @foreach ($local_votacion as $loca)

                <div class="table table-responsive table-bordered">
                    
                    <table class="table">
                                                            
                        <thead class="thead-light">                    

                            <tr style="text-align: center">
                                
                                <th colspan="3">{{$loca->Id_Local}}-{{$loca->Desc_Local}}</th>
                                
                            </tr>

                            <tr style="text-align: center">

                                <th scope="col">Lista</th>
                                <th scope="col">Consejal</th>
                                <th scope="col">Votos</th>

                            </tr>

                        </thead>

                        @php
                            $total_local=0;
                        @endphp
                        @php
                            $total_general = 0;
                        @endphp

                        <tbody>

                            @foreach ($votacion_consejal as $vot)
                                
                                @if($vot->Id_Local == $loca->Id_Local)
                                    
                                    <tr style="text-align: center">
                                        
                                        <th scope="row">{{$vot->Desc_Lista}}</th>
                                        <th scope="row">{{$vot->consejal}}</th>
                                        <td style="text-align: right">{{number_format($vot->votos,0, ".", ".")}}</td>
                                        @php
                                            $total_local = $vot->total_general_local;
                                        @endphp
                                        
                                    </tr>

                                @endif

                                @php
                                    $total_general = $vot->total_general;
                                @endphp

                            @endforeach


                        </tbody>

                        <tfoot>

                            <tr style="background-color:#f71808a8">

                                <th  colspan="2"> <b>Total de Votos</b></th>
                                <th style="text-align: right"><b>{{number_format($total_local,0, ".", ".")}} </b></th>

                            </tr>

                        </tfoot>

                    </table>

                </div>

            @endforeach

            <div class="table table-responsive table-bordered">

                <table class="table">

                    <thead style="background-color:#f71808a8">
                        
                        <tr style="text-align: center">
                        
                            <th scope="row"><b>TOTAL GENERAL DE VOTOS</b></th>
                            <th scope="row"><b>{{$total_general}}</b></th>

                        </tr>
                        
                    </thead>

                </table>

            </div>
            
        @else
            
            @php
                $local1= "";
            @endphp

            @foreach ($local_votacion as $loca1)
                
                @if ($loca1->Id_Local == $id)

                    @php
                        $local1=$loca1->Id_Local. "-".$loca1->Desc_Local;
                    @endphp
                    
                @endif

            @endforeach
            
            <div class="table table-responsive table-bordered">

                <table class="table">
                                                                
                    <thead class="thead-light">                    

                        <tr style="text-align: center">
                            
                            <th colspan="3">{{$local1}}</th>
                            
                        </tr>
                        <tr style="text-align: center">

                            <th scope="col">Lista</th>
                            <th scope="col">Consejal</th>
                            <th scope="col">Votos</th>

                        </tr>

                    </thead>

                    @php
                        $total_local=0;
                    @endphp
                    @php
                        $total_general = 0;
                    @endphp

                    <tbody>

                        @foreach ($votacion_consejal as $vot)
                                
                            <tr style="text-align: center">
                                
                                <th scope="row">{{$vot->Desc_Lista}}</th>
                                <th scope="row">{{$vot->consejal}}</th>
                                <td style="text-align: right">{{number_format($vot->votos,0, ".", ".")}}</td>
                                @php
                                    $total_local = $vot->total_general_local;
                                @endphp
                                
                            </tr>

                            @php
                                $total_general = $vot->total_general;
                            @endphp

                        @endforeach


                    </tbody>

                    <tfoot>

                        <tr style="background-color:#f71808a8">

                            <td  colspan="2"> <b>Total de Votos</b></td>
                            <td style="text-align: right"><b>{{number_format($total_local,0, ".", ".")}} </b></td>

                        </tr>

                    </tfoot>                  

                </table>

            </div>

            <div class="table table-responsive table-bordered">

                <table class="table">

                    <thead style="background-color:#f71808a8">
                        
                        <tr style="text-align: center">
                        
                            <th scope="row"><b>TOTAL GENERAL DE VOTOS</b></th>
                            <th scope="row"><b>{{$total_local}}</b></th>

                        </tr>
                        
                    </thead>

                </table>

            </div>


        @endif


    </div>    
    
</body>
</html>
