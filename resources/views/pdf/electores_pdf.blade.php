
@php
$total_lectores = 0;
@endphp

@php
$total_mesas = 0;
@endphp

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

        <h3 style="text-align: center"><b>CANTIDAD DE ELECTORES Y MESAS HABILITADAS POR LOCAL DE VOTACIÓN</b></h3>
        
        <br>        
    
        <div class="table table-responsive table-bordered">
            
            <table class="table">
            
                <thead >

                    <tr style="background-color:#f71808a8">
                        
                        <th scope="col" style="text-align: center">Orden</th>
                        <th scope="col" style="text-align: center">Local</th>
                        <th scope="col" style="text-align: center">Lectores</th>
                        <th scope="col" style="text-align: center">Mesa</th>

                    </tr>
                </thead>
                
                <tbody>

                    @foreach ($electores as $elector)
                        
                        <tr>

                            <td style="text-align: right">{{$elector->Orden}}</td>
                            <td style="text-align: center">{{$elector->Local}}</td>
                            <td style="text-align: right">{{number_format($elector->Lectores, 0, ".", ".")}}</td>
                            <td style="text-align: right">{{number_format($elector->Mesas, 0, ".", ".")}}</td>
                            @php
                                $total_lectores = $total_lectores + $elector->Lectores;
                            @endphp
                            @php
                                $total_mesas = $total_mesas + $elector->Mesas;
                            @endphp
                        </tr>
                    @endforeach

                </tbody>

                <tfoot>

                    <tr style="background-color:#f71808a8">
                        <td colspan="2" style="text-align: center"><b> TOTAL </b></td>
                        <td style="text-align: right"><b>{{number_format($total_lectores, 0, ".", ".")}}</b></td>
                        <td style="text-align: right"> <b>{{number_format($total_mesas, 0, ".", ".")}}</b></td>
                    </tr>

                </tfoot>

            </table>

        </div>            


    </div>
    
</body>
</html>
