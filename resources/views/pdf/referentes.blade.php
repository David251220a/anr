@php
    $total = 0;
@endphp
@php
    $nombre_referente= "";
@endphp

@foreach ($comprometidos as $comprometido)

    @php
        $total = $total + 1;
    @endphp
    @php
        $nombre_referente= $comprometido->apellido_nombre_Referente;
    @endphp

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
            height: 1.5cm;
            background-color: red;
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

    </style>
</head>
<body>

    <header>
        
        <p><strong>ANR</strong></p>    

    </header>
    
    <div class="container">

        <h3 style="text-align: center"><b>REFERENTE: {{$nombre_referente}}</b></h3>
        
        <br>        
    
        <div class="table table-responsive table-bordered">
            
            <table class="table">
            
                <thead >

                    <tr style="background-color:#f71808a8">
                        
                        <th scope="col" style="text-align: center">Cedula</th>
                        <th scope="col" style="text-align: center">Apellido y Nombre</th>
                        <th scope="col" style="text-align: center">Local</th>
                        <th scope="col" style="text-align: center">M</th>
                        <th scope="col" style="text-align: center">O</th>
                        <th scope="col" style="text-align: center">C</th>

                    </tr>
                </thead>
                
                <tbody>

                    @foreach ($comprometidos as $comprometido)
                        
                        <tr>

                            <td style="text-align: right">{{number_format($comprometido->cedula, 0, ".", ".")}}</td>
                            <td style="text-align: center">{{$comprometido->apellido_nombre}}</td>
                            <td style="text-align: center">{{$comprometido->Desc_Local}}</td>
                            <td style="text-align: right">{{$comprometido->mesa}}</td>
                            <td style="text-align: right">{{$comprometido->orden}}</td>
                            <td style="text-align: center"> {!! Form::checkbox('voto', null, $comprometido->comprometido) !!} </td>

                        </tr>
                    @endforeach

                </tbody>

                <tfoot>

                    <tr style="background-color:#f71808a8">

                        <td colspan="5" style="text-align: center"><b> TOTAL DE COMPROMETIDOS </b></td>
                        <td style="text-align: right"><b>{{number_format($total, 0, ".", ".")}}</b></td>

                    </tr>

                </tfoot>

            </table>

        </div>            


    </div>
    
</body>
</html>