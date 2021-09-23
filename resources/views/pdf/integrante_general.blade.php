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

                <h2 style="text-align: center"><b>REPORTE GENERAL - INGRANTE DE MESA</b></h2>
                    
                <div class="table table-responsive table-bordered">
    
                    <table class="table">

                        <thead style="background-color:#f71808a8">

                            <tr>
                                
                                <th scope="col" style="text-align: center; align-items: center">Cedula</th>
                                <th scope="col" style="text-align: center; align-items: center">Apellido y Nombre</th>
                                <th scope="col" style="text-align: center; align-items: center">Cargo</th>
                                <th scope="col" style="text-align: center; align-items: center">Local</th>
                                <th scope="col" style="text-align: center; align-items: center">M</th> 
                                {{-- <th scope="col" style="text-align: center; align-items: center">1/C</th> 
                                <th scope="col" style="text-align: center; align-items: center">2/C</th> 
                                <th scope="col" style="text-align: center; align-items: center">3/C</th> 
                                <th scope="col" style="text-align: center; align-items: center">4/C</th> 
                                <th scope="col" style="text-align: center; align-items: center">5/C</th> 
                                <th scope="col" style="text-align: center; align-items: center">6/C</th> 
                                <th scope="col" style="text-align: center; align-items: center">7/C</th> 
                                <th scope="col" style="text-align: center; align-items: center">8/C</th> 
                                <th scope="col" style="text-align: center; align-items: center">9/C</th> 
                                <th scope="col" style="text-align: center; align-items: center">10/C</th>  --}}
                            </tr>
    
                        </thead>

                        <tbody>
                            
                            @foreach ($integrantes as $integrante)

                                <tr>
                                    <td style="text-align: right">{{number_format($integrante->Cedula_Integrante, 0, ".", ".")}}</td>
                                    <td style="text-align: center">{{$integrante->apellido_nombre}}</td>
                                    <td style="text-align: center">{{$integrante->Cargo}}</td>
                                    <td style="text-align: center">{{$integrante->Desc_Local}}</td>
                                    <td style="text-align: right">{{$integrante->Id_Mesa}}</td>
                                    {{-- <td style="text-align: center"> {!! Form::checkbox('Primera_Session', null, $integrante->Primera_Session) !!} </td>
                                    <td style="text-align: center"> {!! Form::checkbox('Segunda_Session', null, $integrante->Segunda_Session) !!} </td>
                                    <td style="text-align: center"> {!! Form::checkbox('Tercera_Session', null, $integrante->Tercera_Session) !!} </td>
                                    <td style="text-align: center"> {!! Form::checkbox('Tercera_Session', null, $integrante->Cuarta_Session) !!} </td>
                                    <td style="text-align: center"> {!! Form::checkbox('Tercera_Session', null, $integrante->Quinta_Session) !!} </td>
                                    <td style="text-align: center"> {!! Form::checkbox('Tercera_Session', null, $integrante->Sexta_Session) !!} </td>
                                    <td style="text-align: center"> {!! Form::checkbox('Tercera_Session', null, $integrante->Septima_Session) !!} </td>
                                    <td style="text-align: center"> {!! Form::checkbox('Tercera_Session', null, $integrante->Octava_Session) !!} </td>
                                    <td style="text-align: center"> {!! Form::checkbox('Tercera_Session', null, $integrante->Novena_Session) !!} </td>
                                    <td style="text-align: center"> {!! Form::checkbox('Tercera_Session', null, $integrante->Decima_Session) !!} </td> --}}
                                    
                                </tr>
                                
                            @endforeach
                            
                        </tbody>
    
                    </table>
                    
                </div>

            </div>

        </div>

    </body>

</html>