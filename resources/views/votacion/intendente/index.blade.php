@extends('layouts.admin')

@section('contenido')

    <div class="rows">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            @if (session()->has('msj'))
            
                <div class="alert alert-danger" role="alert">{{session('msj')}}</div>
                
            @endif        

        </div>

    </div>

    {{-- {!! Form::open(array('url'=>'votacion/intendente', 'method'=>'POST', 'autocomplete'=>'off', 'file'=>'true', 'enctype'=>"multipart/form-data"))!!} --}}
    {!! Form::open(['route' => 'intendente.store', 'autocomplete' => 'off', 'files' => true]) !!}

        <div class="row">

            <div class="panel panel-danger">

            

                <div class="panel-body">
                
                    <div class="row">

                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

                            <div class="form-group">
                
                                <label form="id_local" >Local Votacion</label>
                                <select name="id_local" id="id_local" class="form-control ">
                                    
                                    <option value="">Seleccione un local</option>

                                    @foreach ($local_votacion as $vot)
                                        
                                        <option value="{{$vot->Id_Local}}">{{$vot->Desc_Local}} </option>
                
                                    @endforeach
                
                                </select>
                
                            </div>

                            {{-- <div class="form-group">
                            
                                {!! Form::label('id_local', 'Local Votacion') !!}
                                {!! Form::select('id_local', $local_votacion, null, ['class' => 'form-control selectpicker', 'data-live-search="true"']) !!}
            
                            </div> --}}
                
                        </div>
        
                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        
                            <div class="form-group">
                
                                <label form="id_mesa" >Mesa</label>
                                <select name="id_mesa" id="id_mesa" class="form-control">
                                    
                                    {{-- @foreach ($mesa as $me)
                                        
                                        <option value="{{$me->Id_Mesa}}">{{$me->Mesa}} </option>
                
                                    @endforeach --}}
                
                                </select>
                                @error('id_mesa')

                                    <span class="text-danger">{{$message}}</span>

                                @enderror
                
                            </div>
                
                        </div>

                    </div>

                    <hr style="width: 100% ; border: 1px solid red; height: 2px;">

                    <div class="container">
                        
                        <div class="row">

                            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">

                                <div class="form-group md-form mt-3" style="text-align: center">
                    
                                    <label form="intendente" ><b><h3>LISTA</h3></b> </label>                                    
                    
                                </div>
                    
                            </div>

                            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">

                                <div class="form-group mt-3" style="text-align: center">
                    
                                    <label form="intendente" ><b><h3>VOTOS</h3></b> </label>                                    
                    
                                </div>
                    
                            </div>

                        </div>

                        @php
                            $cont = 0;
                        @endphp

                        @foreach ($intendentes as $intendente)                        

                            <div class="row">

                                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">

                                    <div class="form-group mt-3" style="text-align: center">
                        
                                        <label form="intendente" ><b>  </b> </label>
                                        <input type="hidden" name="intendente[]" id="intendente" class="form-control" value={{$intendente->Id_Intendente}}>
                                        <br>
                                        <h5>{{$intendente->Intendente}}</h5>
                                        @error('intendente')

                                            <span class="text-danger">{{$message}}</span>

                                        @enderror
                        
                                    </div>
                        
                                </div>

                                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">

                                    <div class="form-group mt-3">
                        
                                        <label form="votos" ></label>
                                        <input type="number" name="votos[]" id="votos[]" class="form-control Can_Produc" value="{{old('votos.'.$cont, 0)}}">
                                    
                                        @php
                                            $cont = $cont + 1;
                                        @endphp
                                        @error('votos[]')

                                            <span class="text-danger">{{$message}}</span>

                                        @enderror
                                    </div>
                        
                                </div>

                            </div>
                        
                        @endforeach

                        <div class="row">

                            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">

                                <div class="form-group mt-3" style="text-align: center">                                
                                    
                                    <br>
                                    <label form="intendente" ><b>TOTAL DE VOTOS</b> </label>                                    
                                </div>
                    
                            </div>

                            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">

                                <div class="form-group" style="text-align: center">
                                    
                                    <label for="total_votos"></label>
                                    <input type="number"  readonly id="total_votos" name="total_votos" class="form-control " value="{{old('total_votos', 0)}}">
                                    @error('total_votos')

                                        <span class="text-danger">{{$message}}</span>

                                    @enderror
                    
                                </div>
                    
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">

                                <div class="form-group" style="text-align: center">                                
                                    
                                    <br>
                                    <label form="acta" ><b>ACTA</b> </label>
                    
                                </div>
                    
                            </div>

                            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">

                                <div class="form-group" style="text-align: center">
                                    
                                    <label for="file"></label>
                                    <input type="file" name="acta" id="acta" accept="image/*" class="form-control" placeholder="Acta.." >
                                    @error('acta')

                                        <span class="text-danger">{{$message}}</span>

                                    @enderror
                    
                                </div>
                    
                            </div>

                        </div>

                        <div class="form-row text-center">

                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" id="guardar">

                                <div class="form-group">
                                    
                                    <button class="btn btn-primary" type="submit" style="align-items: center" id="btnGuardar">Guardar</button>
                            
                                </div>
                            
                            </div>

                        </div>

                    </div>

                </div>
        
            </div>

        </div>

    {!! Form::close() !!}


    @push('scripts')

        <script type="text/javascript">

            $(document).ready(function(){  
                // let votos=[];
                // const btnGuardar=document.querySelector(".Can_Produc");
                // btnGuardar.addEventListener("keydown", guardar);
                // function guardar(e){
                    
                //     btnGuardar.addEventListener("keydown", guardar);

                //     if (event.keyCode == 13) {
                //         e.preventDefault();
                //         console.log(btnGuardar);
                //         // votos=[..., btnGuardar.value];
                //     }
                //     console.log(votos);
                    
                // } 

                $('.Can_Produc').on('keydown',function(event){
                    
                    const btnGuardar=document.querySelector(".Can_Produc");

                    if (event.keyCode == 13) {
                        event.preventDefault();
                        //console.log(btnGuardar);
                    }
                });

                $('.Can_Produc').keyup(function() {
                    
                    var nuevo_valor =  $(this).val();
                    var importe_total = 0;

                    $(".Can_Produc").each(
                        function(index, value) {
                            if ( $.isNumeric($(this).val()) ){
                                importe_total += parseInt($(this).val());
                            }
                        }
                    );
  
                    $("#total_votos").val(importe_total);
                });            
                
            });

        </script>

    @endpush

@endsection
