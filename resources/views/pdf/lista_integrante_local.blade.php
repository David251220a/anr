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

            .saltopagina{
                page-break-after:always;
            }

        </style>
        
    </head>

    <body>

        <div class="container">
            
            <h2 style="text-align: center"><b>INGRANTE DE MESA</b></h2>

            @php
                $cont = 0;
            @endphp
            @foreach ($locales as $local)

                @php
                    $cont = $cont + 1;
                @endphp
                <div class="table table-responsive table-bordered">
    
                    <table class="table">

                        <thead style="background-color:#f71808a8">

                            <tr>
                                <th scope="col" colspan="8" style="text-align: center">{{$local->Desc_Local}}</th>
                            </tr>
                            <tr>
                                
                                <th scope="col" style="text-align: center; align-items: center">Cedula</th>
                                <th scope="col" style="text-align: center; align-items: center">Apellido y Nombre</th>
                                <th scope="col" style="text-align: center; align-items: center">Cargo</th>
                                <th scope="col" style="text-align: center; align-items: center">M</th> 
                                <th scope="col" style="text-align: center; align-items: center">Celular</th> 

                            </tr>
    
                        </thead>                        

                        <tbody>
                            
                            @foreach ($integrantes as $integrante)

                                @if ($local->Id_Local == $integrante->Id_Local)
                                
                                    <tr>
                                        <td style="text-align: right">{{number_format($integrante->Cedula_Integrante, 0, ".", ".")}}</td>
                                        <td style="text-align: center">{{$integrante->apellido_nombre}}</td>
                                        <td style="text-align: center">{{$integrante->Cargo}}</td>
                                        <td style="text-align: right">{{$integrante->Id_Mesa}}</td>
                                        <td style="text-align: right">{{$integrante->celular}}</td>
                                        
                                    </tr>

                                @endif
                                
                            @endforeach
                            
                        </tbody>
    
                    </table>
                    
                </div>

                @if ($cont < 12)
                
                    <div class="saltopagina">
                    </div>    
                
                @endif

                
            
            @endforeach

        </div>

    </body>

</html>