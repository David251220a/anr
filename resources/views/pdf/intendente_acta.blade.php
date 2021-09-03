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
                                    
                    <label for="justicia"><h2 style="text-align: center">CERTIFICADO DE RESULTADO - INTENDENTE</h2></label>

                </div>

            </div>

            <div class="row">

                <p class="mypline" style="font-size: 1.2rem"> 
                    ELECIONES MUNICIPALES: ELECCIÓN DE INTENDENTE
                    <br>                    
                    DEPTO    : 11 - CENTRAL
                    <br>
                    DISTRITO : 15 - LIMPIO 
                    <br>
                    LOCAL    : {{$local->Desc_Local}}
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
                                
                                <th scope="col" colspan="2">AGRUPACIONES</th>
                                <th scope="col"> VOTOS </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($votacion_intendente as $vot)
    
                                <tr style="font-size: 0.9rem">
                                    
                                    <td width="99px">{{$vot->Desc_Lista}}</td>
                                    <td>{{$vot->Nombre}} {{$vot->Apellido}} - {{$vot->Alias}}</td>
                                    <td>{{$vot->Votos}}</td>
    
                                </tr>
                                
                            @endforeach
    
                        </tbody>

                    </table>

                    
                    
                </div>                

            </div>

            <div class="row">

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
                
            </div>

        </div>


    </body>

</html>