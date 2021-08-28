@extends('layouts.admin')

@section('contenido')

<div class="rows">

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        @if (session()->has('msj'))
        
        <div class="alert alert-danger" role="alert">{{session('msj')}}</div>
        
        @else
            
        @endif
    </div>
</div>

<u><h3><strong>Intendente</strong></h3></u>

<div class="row">
    
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <label > <h4 class="alert alert-info">Ingresar VOTOS</h4></label>
    
    </div>

</div>



{!! Form::open(array('url'=>'votacion/intendente', 'method'=>'POST', 'autocomplete'=>'off', 'file'=>'true', 'enctype'=>"multipart/form-data"))!!}
{{Form::token()}}

<div class="row">

    <div class="panel panel-primary">

        <div class="panel-body">
        
            <div class="row">

                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">

                    <div class="form-group">
        
                        <label form="local1" >Local Votacion</label>
                        <select name="plocal" id="plocal" class="form-control selectpicker"  data-live-search="true">

                            @foreach ($local_votacion as $vot)
                                
                                <option value="{{$vot->Id_Local}}">{{$vot->Desc_Local}} </option>
        
                            @endforeach
        
                        </select>
        
                    </div>
        
                </div>

                <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">

                    <div class="form-group">
        
                        <label form="pmesa1" >Mesa</label>
                        <select name="pmesa" id="pmesa" class="form-control selectpicker"  data-live-search="true">

                            @foreach ($mesa as $me)
                                
                                <option value="{{$me->Id_Mesa}}">{{$me->Mesa}} </option>
        
                            @endforeach
        
                        </select>
        
                    </div>
        
                </div>

                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">

                    <div class="form-group">
        
                        <label form="pintendente1" >Intendente</label>
                        <select name="pintendente" id="pintendente" class="form-control selectpicker"  data-live-search="true">

                            @foreach ($intendente as $int)
                                
                                <option value="{{$int->Id_Intendente}}">{{$int->Desc_Lista}} - {{$int->Nombre}} {{$int->Apellido}} </option>
        
                            @endforeach
        
                        </select>
        
                    </div>
        
                </div>

                <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">

                    <div class="form-group">
        
                        <label form="pvotos" > Votos</label>
                        <input type="number" name="pvotos" id="pvotos" class="form-control"
                        placeholder="Cantidad Votos.." value="0">
        
                    </div>
        
                </div>

                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

                    <div class="form-group">
        
                        <label form="pacta">Acta</label>
                        <input type="file" name="pacta" id="pacta" class="form-control" placeholder="Acta.." >
        
                    </div>
        
                </div>

                <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">

                    <div class="form-group">
                        
                        <button type="button"  id="bt_add" class="btn btn-primary">Agregar</button>
                
                    </div>
        
                </div>

            </div>                                                                

            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

                <table id="detalles" class="table table-striped table-condensed table-bordered table-hover">

                    <thead style="background-color:#f20a0ade">

                        <th style="text-align: center">Opciones</th>
                        <th style="text-align: center">Local Votacion</th>
                        <th style="text-align: center">Mesa</th>
                        <th style="text-align: center">Intendente</th>
                        <th style="text-align: center">Votos</th>

                    </thead>

                    <tfoot>

                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>

                    </tfoot>

                    <tbody>

                    </tbody>
                </table>

            </div>

        </div>

    </div>

</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">

    <div class="form-group">
    <input name="_token" value="{{ csrf_token() }}" type="hidden" > 
        <button class="btn btn-primary" type="submit">Guardar</button>
        <button class="btn btn-danger" type="reset">Cancelar</button>  

    </div>

</div>    


{!! Form::close() !!}

<br>

<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" id="guardar">

    <div class="form-group">

        <a href="{{URL::action('PDFController@Resumen_General')}}" target="_blank">
            <button class="btn btn-info"><li  class="fa fa-file-pdf-o"></li> Resumen General</button>
        </a>

        <a href="{{URL::action('PDFController@Resumen_Local')}}" target="_blank">
            <button class="btn btn-info"><li  class="fa fa-file-pdf-o"></li> Resumen por Local</button>
        </a>

        <a href="{{URL::action('PDFController@Resumen_Mesa')}}" target="_blank">
            <button class="btn btn-info"><li  class="fa fa-file-pdf-o"></li> Resumen por Mesa</button>
        </a>
        
        <div class="btn-group">
            <button type="button" class="btn btn-info dropdown-toggle"
                    data-toggle="dropdown"><li  class="fa fa-file-pdf-o"></li>
                Mas Opciones <span class="caret"></span>
            </button>

            <ul class="dropdown-menu" role="menu">
                
                @foreach ($aux_intendente as $aux)
                                
                    <li><a href="{{URL::action('PDFController@Intendente' , $aux->Id_Intendente)}}" target="_blank"><li  class="fa fa-file-pdf-o"></li> {{$aux->Nombre}} {{$aux->Apellido}}</a></li>                
        
                @endforeach                
                                                        
            </ul>

        </div>        

    </div>

</div>   

<br>

<div class="rows">

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="table table-responsive">

            <table class="table table-striped table-bordered table-condensed table-hover">                
                
                <thead class="thead-light">
                    
                    <th style="text-align: center">Lista</th>                                                
                    <th style="text-align: center">Intendente</th>                    
                    <th style="text-align: center">Votos</th>
                    <!-- <th style="text-align: center">Opcion</th> -->

                </thead>                
                @foreach ($votos_intendente as $vot)

                    <tr style="vertical-align: middle ; text-align: center">
                                            
                        <td>{{$vot->Desc_Lista}}</td>                    
                        <td>{{$vot->Nombre}} {{$vot->Apellido}}</td>
                        <td style="text-align: right">{{number_format($vot->Votos,0, ".", ".")}}</td>
                        <!--<td>
                            <div class="btn-group">
                                
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default dropdown-toggle"
                                            data-toggle="dropdown">
                                      Accion <span class="caret"></span>
                                    </button>
    
                                    <ul class="dropdown-menu" role="menu">

                                        <li><a href="{{URL::action('PDFController@Resumen_General')}}" target="_blank"><li  class="fa fa-file-pdf-o"></li> Resumen General</a></li>
                                        <li><a href="{{URL::action('PDFController@Resumen_Local')}}" target="_blank"><li  class="fa fa-file-pdf-o"></li>Local de Votacion</a></li>
                                                                                
                                    </ul>
    
                                </div>
                            
                            </div>                                   
                           
                        </td>  -->              
                    
                    </tr>
                @endforeach

            </table>

        </div>        

    </div>

</div>


@push('scripts')

<script type="text/javascript">

    $(document).ready(function(){
        $('.table-responsive').on('show.bs.dropdown', function () {
                $('.table-responsive').css( "overflow", "inherit" );
            });

        $('.table-responsive').on('hide.bs.dropdown', function () {
            $('.table-responsive').css( "overflow", "auto" );
        })
        $("#bt_add").click(function(){
            agregar();
        });
        
    });

    $("#guardar").hide();    


    function agregar() {

        var opcion = document.getElementById("pintendente");
        var opcion1 = document.getElementById("plocal");
        var opcion2 = document.getElementById("pmesa");

        var intendente_text = opcion.options[opcion.selectedIndex].text;
        var intendente = opcion.options[opcion.selectedIndex].value;

        var local_text = opcion1.options[opcion1.selectedIndex].text;
        var local = opcion1.options[opcion1.selectedIndex].value;

        var mesa_text = opcion2.options[opcion2.selectedIndex].text;
        var id_mesa = opcion2.options[opcion2.selectedIndex].value;

        var votos = document.getElementById("pvotos").value;        
        
        
        var cont = 0;
        var X = 'X';

        if (votos > 0 ) {
           
            var fila= '<tr class="select" id="fila'+ cont +'">' +
                '<td> <button type="button" class="btn btn-warning" onclick="eliminar('+cont +')">' + X +'</button> </td>' +                    
                '<td> <input type="hidden" name="local[]" value="' + local + '">' + local_text + '</td>'+
                '<td> <input type="hidden" name="mesa[]" value="' + id_mesa + '">' + mesa_text + '</td>'+
                '<td> <input type="hidden" name="intendente[]" value="' + intendente + '">' + intendente_text + '</td>'+
                '<td> <input type="number" name="votos[]" value="' + votos + '"> </td>'+
                '</tr>';
            cont++;
            $('#detalles').append(fila);
            Evaluar();
            Limpiar();

        }else{

            alert("Debe de ingresar la cantidad de votos.");

        }
    }

    function Limpiar() {
        
        $("#pintendente").val("");
        $("#pvotos").val(0);

    }

    function eliminar(index) {
        
        $('#fila' +index).remove();
        $("#bt_add").show();
        Evaluar();
        
    }

    function Evaluar() {
    
        var votos = document.getElementById("pvotos").value;            

        sal = parseInt(votos);            

        if ( sal> 0 ) {                            
                                    
            $("#bt_add").hide();
            $("#guardar").show();

        } else {
                    
            $("#bt_add").show();
            $("#guardar").hide();
            
        }

    }


</script>

@endpush

@endsection