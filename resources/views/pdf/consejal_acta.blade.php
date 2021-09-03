<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">    
     
        <style rel="stylesheet">

            @page {
                margin: 0cm 0cm;
                font-size: 0.7em;
            }

            body {
                margin: 2cm 1cm 1cm;
            }

            header {
                position: fixed;
                margin-left: 0.1cm;
                margin-top: 0.1cm;
                height: 105px;
                width: 110px;
                background: url(manuel_1.jpg);
                color: white;
                text-align: center;
                line-height: 50px;
                
            }            

            footer {
                position: fixed;
                bottom: 0cm;
                left: 0cm;
                right: -2cm;
                height: 2cm;
                background-color: red;
                color: white;
                text-align: center;
                line-height: 35px;
            }
            br { 
                display:block;
                margin-top:10px; 
                line-height:22px; 
            }
            .br1 { 
                display:block;
                margin-top:5px; 
                line-height:5%; 
            }

            .caja{
                background: white;
                width: 90%;
                height: 100px;
                margin-top: 150px;
                margin-left: 50px;
                border-width: 2px;
                border-style: solid;
                position: absolute;                                
            }

            .caja1{
                
                width: 500px;
                height: 100px;
                margin-top: 200px;
                margin-left: 50px;
                margin-right: 50px;
                border-width: 4px;
                position: absolute;                                
            }

            p {                
                margin-left: 2px;
                margin-bottom: 1px;
                margin-top: 1px;
            }
            p.mypline{
                margin-left: 2px;
                margin-bottom: 1px;
                margin-top: 10px;
                border: 2px;
                border-width: 2px;
                border-style: solid;
            }
            hr.myhrline{
                margin-top: 1px;
                margin-bottom: 1px;
            }
            label.mylabel{
                margin-left: 2px;
                margin-top: 1px;
                margin-bottom: 1px;
            }

        </style>
        
  
    </head>

    <body>

        <div class="container">

            <div class="row">
                
                <header>                
                </header>

            </div>

            <div class="row">

                <div class="form-group">
                                    
                    <label for="justicia"><h2 style="text-align: center">CERTIFICADO DE RESULTADO - JUNTA MUNICIPAL</h2></label>

                </div>

            </div>

            <div class="row">

                <p class="mypline" style="font-size: 1.2rem"> 
                    ELECIONES MUNICIPALES: JUNTA MUNICIPAL
                    <br>                    
                    DEPTO    : 11 - CENTRAL
                    <br>
                    DISTRITO : 15 - LIMPIO 
                    <br>
                    LOCAL    : {{$local_votacion->Desc_Local}}
                    <br>
                    MESA     : {{$id2}}

                </p>


            </div>

            <br>
            <br>
            <div class="row">

                <div class="table table-responsive table-bordered">

                    <table class="table">

                        <thead class="thead-light">  
                            <tr style="text-align: center; font-size: 0.9rem">
                            
                                <th style="text-align: center; font-size: 1.2rem">Orden/Lista</th>
                                @foreach ($listas as $lista)
                                
                                    <th  style="text-align: center; font-size: 1.2rem">{{$lista->numero_lista}}</th>

                                @endforeach

                            </tr>

                        </thead>

                        <tbody>
                            @php
                                $cont = 0;
                            @endphp

                            @foreach ($ordenes as $orden)
    
                                <tr style="font-size: 0.9rem">
                                    
                                    <td width="99px"> {{$orden->Orden}} </td>
                                    <td style="text-align: right">{{$votaciones[$cont]->Votos}} </td>
                                    @php
                                        $cont = $cont + 1;
                                    @endphp
                                    <td style="text-align: right">{{$votaciones[$cont]->Votos}} </td>
                                    @php
                                        $cont = $cont + 1;
                                    @endphp
                                    <td style="text-align: right">{{$votaciones[$cont]->Votos}} </td>
                                    @php
                                        $cont = $cont + 1;
                                    @endphp
                                    <td style="text-align: right">{{$votaciones[$cont]->Votos}} </td>
                                    @php
                                        $cont = $cont + 1;
                                    @endphp
                                    <td style="text-align: right">{{$votaciones[$cont]->Votos}} </td>
                                    @php
                                        $cont = $cont + 1;
                                    @endphp
                                    <td style="text-align: right">{{$votaciones[$cont]->Votos}} </td>
                                    @php
                                        $cont = $cont + 1;
                                    @endphp
                                    <td style="text-align: right">{{$votaciones[$cont]->Votos}} </td>
                                    @php
                                        $cont = $cont + 1;
                                    @endphp
                                    <td style="text-align: right">{{$votaciones[$cont]->Votos}} </td>
                                    @php
                                        $cont = $cont + 1;
                                    @endphp
                                    <td style="text-align: right">{{$votaciones[$cont]->Votos}} </td>
                                    @php
                                        $cont = $cont + 1;
                                    @endphp
                                    <td style="text-align: right">{{$votaciones[$cont]->Votos}} </td>
                                    @php
                                        $cont = $cont + 1;
                                    @endphp
                                    <td style="text-align: right">{{$votaciones[$cont]->Votos}} </td>
                                    @php
                                        $cont = $cont + 1;
                                    @endphp
                                    <td style="text-align: right">{{$votaciones[$cont]->Votos}} </td>
                                    @php
                                        $cont = $cont + 1;
                                    @endphp
                                </tr>
                                
                            @endforeach

                            @php
                                $cont_total = 0;
                            @endphp


                            <tr style="font-size: 0.9rem">
                                    
                                <td width="99px"> TOT</td>
                                <td style="text-align: right">{{ $totales[$cont_total]->total}} </td>
                                @php
                                    $cont_total = $cont_total + 1 ;
                                @endphp
                                <td style="text-align: right">{{ $totales[$cont_total]->total}} </td>
                                @php
                                    $cont_total = $cont_total + 1 ;
                                @endphp
                                <td style="text-align: right">{{ $totales[$cont_total]->total}} </td>
                                @php
                                    $cont_total = $cont_total + 1 ;
                                @endphp
                                <td style="text-align: right">{{ $totales[$cont_total]->total}} </td>
                                @php
                                    $cont_total = $cont_total + 1 ;
                                @endphp
                                <td style="text-align: right">{{ $totales[$cont_total]->total}} </td>
                                @php
                                    $cont_total = $cont_total + 1 ;
                                @endphp
                                <td style="text-align: right">{{ $totales[$cont_total]->total}} </td>
                                @php
                                    $cont_total = $cont_total + 1 ;
                                @endphp
                                <td style="text-align: right">{{ $totales[$cont_total]->total}} </td>
                                @php
                                    $cont_total = $cont_total + 1 ;
                                @endphp
                                <td style="text-align: right">{{ $totales[$cont_total]->total}} </td>
                                @php
                                    $cont_total = $cont_total + 1 ;
                                @endphp
                                <td style="text-align: right">{{ $totales[$cont_total]->total}} </td>
                                @php
                                    $cont_total = $cont_total + 1 ;
                                @endphp
                                <td style="text-align: right">{{ $totales[$cont_total]->total}} </td>
                                @php
                                    $cont_total = $cont_total + 1 ;
                                @endphp
                                <td style="text-align: right">{{ $totales[$cont_total]->total}} </td>
                                @php
                                    $cont_total = $cont_total + 1 ;
                                @endphp
                                <td style="text-align: right">{{ $totales[$cont_total]->total}} </td>
                                @php
                                    $cont_total = $cont_total + 1 ;
                                @endphp
                                
                            </tr>
    
                        </tbody>

                    </table>
                    
                </div>                

            </div>
            <br style="margin-bottom: 8cm">

            <div class="row">

                <div class="table table-responsive table-bordered">
                    
                    <table class="table">

                        <tbody>

                            <tr>
                                <td width="80px">NULL</td>
                                <td>Votos Nulos</td>
                                <td width="80px"> {{$votaciones[$cont]->Votos}}</td>
                                @php
                                    $cont = $cont + 1;
                                @endphp
                            </tr>

                            <tr>
                                <td width="80px">BLC</td>
                                <td>Votos en Blanco</td>
                                <td width="80px"> {{$votaciones[$cont]->Votos}}</td>
                                @php
                                    $cont = $cont + 1;
                                @endphp
                            </tr>

                            <tr>
                                <td width="80px">VAC</td>
                                <td>Votos a Computar</td>
                                <td width="80px"> {{$votaciones[$cont]->Votos}}</td>
                                @php
                                    $cont = $cont + 1;
                                @endphp
                            </tr>

                            <tr>
                                <td width="80px">TOT</td>
                                <td> <b>TOTAL GENERAL </b></td>
                                <td width="80px"> {{$total->total}}</td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

            {{-- <div class="row">

                <div class="table table-responsive table-bordered">

                    <table class="table">

                        <tbody>

                            @foreach ($votacion_nulos as $vot)
    
                                <tr style="font-size: 0.9rem">
                                    
                                    <td width="100px">{{$vot->Alias}}</td>
                                    <td>{{$vot->Nombre}} {{$vot->Apellido}}</td>
                                    <td width="280px">{{$vot->Votos}}</td>
    
                                </tr>
                                
                            @endforeach
                            
                            <tr style="font-size: 0.9rem">
                                    
                                <td width="100px">TOT</td>
                                <td> <b> TOTAL GENERAL </b></td>
                                <td width="280px"> <b> {{$total->votos}} </b></td>

                            </tr>
    
                        </tbody>

                    </table>

                    
                    
                </div>
            </div> --}}

        </div>

      
    </body>    

</html>

