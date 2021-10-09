
@php
$total = 0;
@endphp

@php
$total_voto = 0;
@endphp

@foreach ($comprometidos as $comprometido)

    @php
        $total = $total +1;
    @endphp

    @if ($comprometido->voto == 1)
        
        @php
            $total_voto = $total_voto + 1;
        @endphp
    @endif
    
@endforeach

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
            .saltopagina{
                page-break-after:always;
            }

        </style>

    </head>
    
    <body>

        <div class="container">

            <h3 style="text-align: center"><b>LISTA 1 / OPCION {{$consejal->Id_Consejal}} - {{$consejal->Nombre}} {{$consejal->Apellido}} </b></h3>

            <h2 style="text-align: center">{{date('d-m-Y H:i', strtotime(Carbon\Carbon::now()))}}</h2>
            
            <br>
            
            @if ($comprometidos)

                @php
                    $cont = 0;
                @endphp

                @foreach ($locales as $local)

                    @php
                        $cont = $cont + 1;
                    @endphp
                    
                    <div class="table table-responsive table-bordered">
                        
                        <table class="table">
                        
                            <thead >

                                <tr>
                                    <th colspan="6" style="text-align: center">{{$local->Desc_Local}} </th>
                                </tr>
                                <tr style="background-color:#f71808a8">
                                    
                                    <th scope="col" style="text-align: center" width="50px">Cedula</th>
                                    <th scope="col" style="text-align: center" width="200px">Apellido y Nombre</th>
                                    <th scope="col" style="text-align: center" width="15px">C</th>
                                    <th scope="col" style="text-align: center" width="15px">V</th>
                                    <th scope="col" style="text-align: center" width="230px">Referente</th>
                                    <th scope="col" style="text-align: center" width="60px">Usuario</th>

                                </tr>
                            </thead>
                            
                            <tbody>

                                @foreach ($comprometidos as $comprometido)
                                    
                                    @if ($local->Id_Local == $comprometido->local)
                                    
                                        <tr>

                                            <td style="text-align: right;font-size: 0.9rem">{{number_format($comprometido->cedula, 0, ".", ".")}}</td>
                                            <td style="text-align: center;font-size: 0.9rem">{{$comprometido->apellido_nombre}}</td>
                                            <td style="text-align: center;font-size: 0.9rem"> {!! Form::checkbox('comprometido', null, $comprometido->comprometido) !!} </td>
                                            <td style="text-align: center;font-size: 0.9rem">{!! Form::checkbox('voto', null, $comprometido->voto) !!} </td>
                                            <td style="text-align: center;font-size: 0.9rem">{{$comprometido->apellido_nombre_Referente}}</td>
                                            <td style="text-align: center;font-size: 0.9rem">{{$comprometido->name}}</td>

                                        </tr>
                                    
                                    @endif

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @endforeach

                @if ($cont < 12)
            
                    <div class="saltopagina">
                    </div>    
            
                @endif

            @endif


        </div>

        <div class="saltopagina">
        </div>

        <div>

            <h3 style="text-align: center">TOTAL COMPROMETIDOS: {{$total}} </h3>total
            <h3 style="text-align: center">TOTAL vOTO: {{$total_voto}} </h3>

        </div>

        
    </body>
</html>