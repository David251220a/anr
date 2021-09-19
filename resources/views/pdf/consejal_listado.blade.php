<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">            
        {{-- <link rel="stylesheet" href="{{asset('css/style.css')}}"> --}}

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
                /* background: url(manuel.jpg); */
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

            <header style="background: url({{Auth::user()->url}})"></header>

            <div class="rows">

                <h3 style="text-align: center"><b>LISTA 1 / OPCION {{$consejal->Id_Consejal}} - {{$consejal->Nombre}} {{$consejal->Apellido}} </b></h3>

                <h2 style="text-align: center">{{date('d-m-Y H:i', strtotime(Carbon\Carbon::now()))}}</h2>
                
                <br>        
            
                @if ($comprometidos)
                
                    <div class="table table-responsive table-bordered">
                        
                        <table class="table">
                        
                            <thead >

                                <tr style="background-color:#f71808a8">
                                    
                                    <th scope="col" style="text-align: center" width="50px">Cedula</th>
                                    <th scope="col" style="text-align: center" width="200px">Apellido y Nombre</th>
                                    <th scope="col" style="text-align: center" width="15px">C</th>
                                    <th scope="col" style="text-align: center" width="15px">V</th>
                                    <th scope="col" style="text-align: center" width="230px">Referente</th>
                                    <th scope="col" style="text-align: center" width="60px">Usuario</th>

                                </tr>
                            </thead>

                            @php
                                $total = 0;
                            @endphp

                            @php
                                $total_voto = 0;
                            @endphp
                            
                            <tbody>

                                @foreach ($comprometidos as $comprometido)
                                    
                                    <tr>

                                        <td style="text-align: right;font-size: 0.9rem">{{number_format($comprometido->cedula, 0, ".", ".")}}</td>
                                        <td style="text-align: center;font-size: 0.9rem">{{$comprometido->apellido_nombre}}</td>
                                        <td style="text-align: center;font-size: 0.9rem"> {!! Form::checkbox('comprometido', null, $comprometido->comprometido) !!} </td>
                                        <td style="text-align: center;font-size: 0.9rem">{!! Form::checkbox('voto', null, $comprometido->voto) !!} </td>
                                        <td style="text-align: center;font-size: 0.9rem">{{$comprometido->apellido_nombre_Referente}}</td>
                                        <td style="text-align: center;font-size: 0.9rem">{{$comprometido->name}}</td>

                                    </tr>
                                    @php
                                        $total = $total +1;
                                    @endphp

                                    @if ($comprometido->voto == 1)
                                        
                                        @php
                                            $total_voto = $total_voto + 1;
                                        @endphp
                                    @endif

                                @endforeach

                            </tbody>

                            <tfoot>

                                <tr>

                                    <td colspan="5" style="text-align: center"><b> TOTAL DE COMPROMETIDOS </b></td>
                                    <td colspan="1" style="text-align: left"><b>{{number_format($total, 0, ".", ".")}}</b></td>

                                </tr>

                                <tr>

                                    <td colspan="5" style="text-align: center"><b> TOTAL DE VOTADOS </b></td>
                                    <td colspan="1" style="text-align: left"><b>{{number_format($total_voto, 0, ".", ".")}}</b></td>

                                </tr>

                            </tfoot>

                        </table>

                    </div>

                @endif

            </div>

        </div>
        
    </body>
</html>