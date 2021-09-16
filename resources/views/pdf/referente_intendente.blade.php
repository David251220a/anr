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
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 200px;
                width: 800px;
                background: url(manuel.jpg);
                color: white;
                text-align: center;
                line-height: 50px;
                
            }

            .rows {
                margin-top: 3.5cm;
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
                height: 270px;
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
            
            <header></header>
            
            <div class="rows">

                <h2 style="text-align: center">{{date('d-m-Y H:i', strtotime(Carbon\Carbon::now()))}}</h2>
                <h2 style="text-align: center"><b>TOTAL COMPROMETIDOS POR REFERENTES</b></h2>

                @if ($totales)

                    @foreach ($listas as $lista)
                    
                        <div class="table table-responsive table-bordered">
            
                            <table class="table">

                                <thead style="background-color:#f71808a8">
            
                                    <tr>
                                        <th scope="col" colspan="4" style="text-align: center">LISTA 1 - OPCION: {{$lista->Id_Consejal}} / {{$lista->Nombre}} {{$lista->Apellido}}</th>
                                    </tr>
                                    
                                    <tr>
                                        <th scope="col" style="text-align: center; align-items: center" width="50px">Referente Cedula</th>
                                        <th scope="col" style="text-align: center; align-items: center">Apellido y Nombre</th>
                                        <th scope="col" style="text-align: center; align-items: center" width="110px">Usuario Encargado</th>
                                        <th scope="col" style="text-align: center; align-items: center" width="50px">Total Comprometido</th>
                                    </tr>
            
                                </thead>

                                @php
                                    $total_lista = 0;
                                @endphp
                                @php
                                    $total_general = 0;
                                @endphp

                                <tbody>
                                    
                                    @foreach ($totales as $total)

                                        @if ($total->Id_Consejal == $lista->Id_Consejal)

                                            <tr>
                                                <td style="text-align: right">{{number_format($total->Cedula_Referente, 0, ".", ".")}}</td>
                                                <td style="text-align: center">{{$total->Nombre_Referente}}</td>
                                                <td style="text-align: center">{{$total->Usuario}}</td>
                                                <td style="text-align: right">{{number_format($total->Total_Referente, 0, ".", ".")}}</td>
                                                @php
                                                    $total_lista = $total_lista + $total->Total_Referente;
                                                @endphp
                                            </tr>

                                        @endif

                                        @php
                                            $total_general = $total_general + $total->Total_Referente;
                                        @endphp
                                        
                                    @endforeach
                                    
                                </tbody>

                                <tfoot>
                                    
                                    <tr>
                                        <th colspan="3" style="text-align: center"><b> Total por Lista/Opcion </b></th>
                                        <th style="text-align: right"> <b> {{number_format($total_lista, 0, ".", ".")}} </b></th>
                                    </tr>
                                
                                </tfoot>
            
                            </table>
                            
                        </div>

                    @endforeach

                    <div class="table table-responsive table-bordered">
            
                        <table class="table">

                            <thead style="background-color:#f71808a8">
                                <th style="text-align: center"><b>TOTAL GENERAL DE COMPROMETIDOS</b> </th>
                                <th style="text-align: right"> <b> {{number_format($total_general, 0, ".", ".")}} </b></th>
                            </thead>

                        </table>

                    </div>
            
                @endif

            </div>

        </div>

    </body>

</html>