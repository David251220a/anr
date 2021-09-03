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
                /* background: url(manuel.jpg); */
                color: white;
                text-align: center;
                line-height: 50px;
                
            }

            header.prueba {                
                margin-top: 0px;
                margin-right: -0.9cm;
                height: 200px;
                width: 200px;
                /* background: url(manuel.jpg); */
                color: white;
                text-align: center;
                line-height: 50px;
                float: right;
                
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
                height: 250px;
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

            <div class="row">
                
                @if (Auth::user())
                
                    <header style="background: url({{Auth::user()->url}})">
    
                    </header> 
                @else
                
                   <header>                
                    </header>
                    
                @endif

            </div>

            <br>
            
            <div class="caja1"></div>

            <div class="caja">

                <label for="" class="mylabel" style="font-size: 1.5rem"><b>El Sr/Sra:</b></label> 
                <p style="font-size: 1.5rem"><b>{{$persona->apellido_nombre}}</b></p>
                <label for="" class="mylabel" style="font-size: 1.5rem"><b>C.I.N°.:{{$persona->cedula}}</b></label>                
                
                <hr class="myhrline">
                
                <label for="" class="mylabel" style="font-size: 1.5rem"><b>Inscripto en</b></label>
                <p></p>
                <label for="" class="mylabel" style="font-size: 1.5rem"> Dpto.   :<b>LIMPIO</b></label>
                
                <hr class="myhrline">

                <label for="" class="mylabel" style="font-size: 1.5rem"> <b>Deberá votar en el Local:</b></label>
                <p></p>
                <label for="" class="mylabel" style="font-size: 1.5rem"> <b>{{$persona->Desc_Local}}</b></label>
                <p></p>
                <label for="" class="mylabel" style="font-size: 1.5rem"> <b>Mesa :  {{$persona->mesa}}</b></label>
                <p></p>
                <label for="" class="mylabel" style="font-size: 1.5rem"> <b>Orden : {{$persona->orden}}</b></label>


            </div>             

        </div>

    </body>

</html>