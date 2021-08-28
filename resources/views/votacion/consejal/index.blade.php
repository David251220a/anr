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

{!! Form::open(['route' => 'consejal.store', 'autocomplete' => 'off', 'files' => true]) !!}

    <div class="row">

        <div class="panel panel-danger">

            <div class="panel panel-heading">

                <h3 style="text-align: center; color: red"><b>Consejal</b></h3>

            </div>

            <div class="panel-body">

                <div class="row">

                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

                        <div class="form-group">
            
                            <label form="id_local" >Local Votacion</label>
                            <select name="id_local" id="id_local" class="form-control selectpicker"  data-live-search="true">
    
                                @foreach ($local_votacion as $vot)
                                    
                                    <option value="{{$vot->Id_Local}}">{{$vot->Desc_Local}} </option>
            
                                @endforeach
            
                            </select>
            
                        </div>
            
                    </div>
    
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    
                        <div class="form-group">
            
                            <label form="id_mesa" >Mesa</label>
                            <select name="id_mesa" id="id_mesa" class="form-control selectpicker"  data-live-search="true">
    
                                @foreach ($mesa as $me)
                                    
                                    <option value="{{$me->Id_Mesa}}">{{$me->Mesa}} </option>
            
                                @endforeach
            
                            </select>
            
                        </div>
            
                    </div>

                </div>

                <hr style="width: 100% ; border: 1px solid red; height: 2px;">
                
                <div class="steps-form">

                    <div class="steps-row setup-panel">
            
                        <div class="steps-step">
                        
                            <a href="#step-1" type="button" class="btn btn-indigo btn-circle">1</a>            
                            <p>Paso 1</p>
                        
                        </div>
                        
                        <div class="steps-step">
                        
                            <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>            
                            <p>Paso 2</p>
                        
                        </div>
        
                        <div class="steps-step">
                        
                            <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>            
                            <p>Paso 3</p>
                        
                        </div>
        
                        <div class="steps-step">
                        
                            <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>            
                            <p>Paso 4</p>
                        
                        </div>
        
                        <div class="steps-step">
                        
                            <a href="#step-5" type="button" class="btn btn-default btn-circle" disabled="disabled">5</a>
                            <p>Paso 5</p>
                        
                        </div>

                        <div class="steps-step">
                        
                            <a href="#step-6" type="button" class="btn btn-default btn-circle" disabled="disabled">6</a>
                            <p>Paso 6</p>
                        
                        </div>
                    
                    </div>                    

                </div>
                
                <br>

                <div class="row setup-content" id="step-1">
                    
                    <div class="row">
                        
                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">                        
                            
                            <div class="form-group md-form mt-3" style="text-align: center">
                
                                <label for="consejal" data-error="wrong">CONSEJAL</label>
                
                            </div>
                
                        </div>

                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">
                            
                            <div class="form-group md-form mt-3" style="text-align: center">
                                            
                                <label for="consejal" data-error="wrong">VOTOS</label>
                
                            </div>                        
                            
                
                        </div>

                    </div>

                    @foreach ($primero as $primer)

                        <div class="row">
                            
                            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">                        
                                
                                <div class="form-group md-form mt-3" style="text-align: right">
                    
                                    <label for="consejal" data-error="wrong">{{$primer->Consejal}}</label>
                                    <input type="hidden" name="consejal[]" id="consejal" class="form-control" value={{$primer->Id_Consejal}}>
                    
                                </div>
                    
                            </div>

                            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">
                                
                                <div class="form-group md-form mt-3">
                                                
                                    <input id="votos" name="votos[]" type="number" required="required" value="0" class="form-control validate Can_Produc primer">
                    
                                </div>                        
                                
                    
                            </div>

                        </div>

                    @endforeach

                    <div class="row">
                        
                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">                        
                            
                            <div class="form-group md-form mt-3" style="text-align: right">
                                                            
                                <label for="consejal" data-error="wrong">TOTAL:</label>
                
                            </div>
                
                        </div>

                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">
                            
                            <div class="form-group md-form mt-3">
                                                                            
                                <input id="primer_total" type="number" required="required" readonly value="0" class="form-control validate">
                
                            </div>                        
                            
                
                        </div>

                    </div>


                    <div class="form-row text-center">
                        
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

                            <button class="btn btn-primary btn-indigobtn-rounded nextBtn float-right" type="button">Siguiente</button>

                        </div>
                    
                    </div>
            
                </div>

                <div class="row setup-content" id="step-2">
                    
                    <div class="row">
                        
                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">                        
                            
                            <div class="form-group md-form mt-3" style="text-align: center">
                
                                <label for="consejal" data-error="wrong">CONSEJAL</label>
                
                            </div>
                
                        </div>

                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">
                            
                            <div class="form-group md-form mt-3" style="text-align: center">
                                            
                                <label for="consejal" data-error="wrong">VOTOS</label>
                
                            </div>                        
                            
                
                        </div>

                    </div>

                    @foreach ($segundo as $segund)

                        <div class="row">
                            
                            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">                        
                                
                                <div class="form-group md-form mt-3" style="text-align: right">
                    
                                    <label for="consejal" data-error="wrong">{{$segund->Consejal}}</label>
                                    <input type="hidden" name="consejal[]" id="consejal" class="form-control" value={{$segund->Id_Consejal}}>
                    
                                </div>
                    
                            </div>

                            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">
                                
                                <div class="form-group md-form mt-3">
                                                
                                    <input id="votos" name="votos[]" type="number" required="required" value="0" class="form-control validate Can_Produc segundo">
                    
                                </div>                        
                                
                    
                            </div>

                        </div>

                    @endforeach

                    <div class="row">
                        
                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">                        
                            
                            <div class="form-group md-form mt-3" style="text-align: right">
                                                            
                                <label for="consejal" data-error="wrong">TOTAL:</label>
                
                            </div>
                
                        </div>

                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">
                            
                            <div class="form-group md-form mt-3">
                                                                            
                                <input id="segundo_total" type="number" required="required" readonly value="0" class="form-control validate">
                
                            </div>                        
                            
                
                        </div>

                    </div>


                    <div class="form-row text-center">
                        
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

                            <button class="btn btn-primary btn-indigo btn-rounded prevBtn float-left" type="button">Atras</button>
                            <button class="btn btn-primary btn-indigo btn-rounded nextBtn float-right" type="button">Siguiente</button>

                        </div>
                    
                    </div>
            
                </div>

                <div class="row setup-content" id="step-3">
                    
                    <div class="row">
                        
                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">                        
                            
                            <div class="form-group md-form mt-3" style="text-align: center">
                
                                <label for="consejal" data-error="wrong">CONSEJAL</label>
                
                            </div>
                
                        </div>

                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">
                            
                            <div class="form-group md-form mt-3" style="text-align: center">
                                            
                                <label for="consejal" data-error="wrong">VOTOS</label>
                
                            </div>                        
                            
                
                        </div>

                    </div>

                    @foreach ($tercero as $tercer)

                        <div class="row">
                            
                            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">                        
                                
                                <div class="form-group md-form mt-3" style="text-align: right">
                    
                                    <label for="consejal" data-error="wrong">{{$tercer->Consejal}}</label>
                                    <input type="hidden" name="consejal[]" id="consejal" class="form-control" value={{$tercer->Id_Consejal}}>
                    
                                </div>
                    
                            </div>

                            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">
                                
                                <div class="form-group md-form mt-3">
                                                
                                    <input id="votos" name="votos[]" type="number" required="required" value="0" class="form-control validate Can_Produc tercero">
                    
                                </div>                        
                                
                    
                            </div>

                        </div>

                    @endforeach

                    <div class="row">
                        
                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">                        
                            
                            <div class="form-group md-form mt-3" style="text-align: right">
                                                            
                                <label for="consejal" data-error="wrong">TOTAL:</label>
                
                            </div>
                
                        </div>

                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">
                            
                            <div class="form-group md-form mt-3">
                                                                            
                                <input id="tercer_total" type="number" required="required" readonly value="0" class="form-control validate">
                
                            </div>                        
                            
                
                        </div>

                    </div>


                    <div class="form-row text-center">
                        
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

                            <button class="btn btn-primary btn-indigo btn-rounded prevBtn float-left" type="button">Atras</button>
                            <button class="btn btn-primary btn-indigo btn-rounded nextBtn float-right" type="button">Siguiente</button>

                        </div>
                    
                    </div>
            
                </div>

                <div class="row setup-content" id="step-4">
                    
                    <div class="row">
                        
                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">                        
                            
                            <div class="form-group md-form mt-3" style="text-align: center">
                
                                <label for="consejal" data-error="wrong">CONSEJAL</label>
                
                            </div>
                
                        </div>

                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">
                            
                            <div class="form-group md-form mt-3" style="text-align: center">
                                            
                                <label for="consejal" data-error="wrong">VOTOS</label>
                
                            </div>                        
                            
                
                        </div>

                    </div>

                    @foreach ($cuarto as $cuart)

                        <div class="row">
                            
                            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">                        
                                
                                <div class="form-group md-form mt-3" style="text-align: right">
                    
                                    <label for="consejal" data-error="wrong">{{$cuart->Consejal}}</label>
                                    <input type="hidden" name="consejal[]" id="consejal" class="form-control" value={{$cuart->Id_Consejal}}>
                    
                                </div>
                    
                            </div>

                            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">
                                
                                <div class="form-group md-form mt-3">
                                                
                                    <input id="votos" name="votos[]" type="number" required="required" value="0" class="form-control validate Can_Produc cuarto">
                    
                                </div>                        
                                
                    
                            </div>

                        </div>

                    @endforeach

                    <div class="row">
                        
                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">                        
                            
                            <div class="form-group md-form mt-3" style="text-align: right">
                                                            
                                <label for="consejal" data-error="wrong">TOTAL:</label>
                
                            </div>
                
                        </div>

                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">
                            
                            <div class="form-group md-form mt-3">
                                                                            
                                <input id="cuarto_total" type="number" required="required" readonly value="0" class="form-control validate">
                
                            </div>                        
                            
                
                        </div>

                    </div>

                    <div class="form-row text-center">
                        
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

                            <button class="btn btn-primary btn-indigo btn-rounded prevBtn float-left" type="button">Atras</button>
                            <button class="btn btn-primary btn-indigo btn-rounded nextBtn float-right" type="button">Siguiente</button>

                        </div>
                    
                    </div>
            
                </div>

                <div class="row setup-content" id="step-5">
                    
                    <div class="row">
                        
                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">                        
                            
                            <div class="form-group md-form mt-3" style="text-align: center">
                
                                <label for="consejal" data-error="wrong">CONSEJAL</label>
                
                            </div>
                
                        </div>

                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">
                            
                            <div class="form-group md-form mt-3" style="text-align: center">
                                            
                                <label for="consejal" data-error="wrong">VOTOS</label>
                
                            </div>                        
                            
                
                        </div>

                    </div>

                    @foreach ($quinto as $quint)

                        <div class="row">
                            
                            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">                        
                                
                                <div class="form-group md-form mt-3" style="text-align: right">
                    
                                    <label for="consejal" data-error="wrong">{{$quint->Consejal}}</label>
                                    <input type="hidden" name="consejal[]" id="consejal" class="form-control" value={{$quint->Id_Consejal}}>
                    
                                </div>
                    
                            </div>

                            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">
                                
                                <div class="form-group md-form mt-3">
                                                
                                    <input id="votos" name="votos[]" type="number" required="required" value="0" class="form-control validate Can_Produc quinto">
                    
                                </div>                        
                                
                    
                            </div>

                        </div>

                    @endforeach

                    <div class="row">
                        
                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">                        
                            
                            <div class="form-group md-form mt-3" style="text-align: right">
                                                            
                                <label for="consejal" data-error="wrong">TOTAL:</label>
                
                            </div>
                
                        </div>

                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">
                            
                            <div class="form-group md-form mt-3">
                                                                            
                                <input id="quinto_total" type="number" required="required" readonly value="0" class="form-control validate">
                
                            </div>                        
                            
                
                        </div>

                    </div>

                    <div class="form-row text-center">
                        
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

                            <button class="btn btn-primary btn-indigo btn-rounded prevBtn float-left" type="button">Atras</button>
                            <button class="btn btn-primary btn-indigo btn-rounded nextBtn float-right" type="button">Siguiente</button>

                        </div>
                    
                    </div>
            
                </div>

                <div class="row setup-content" id="step-6">

                    <div class="row">
                        
                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">                        
                            
                            <div class="form-group md-form mt-3" style="text-align: right">
                                                            
                                <label for="consejal" data-error="wrong">VOTOS NULOS:</label>
                                <input type="hidden" name="consejal[]" id="consejal" class="form-control" value="99">
                
                            </div>
                
                        </div>

                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">
                            
                            <div class="form-group md-form mt-3">
                                                                            
                                <input id="votos" name="votos[]" type="number" required="required" value="0" class="form-control validate Can_Produc">
                
                            </div>                        
                            
                
                        </div>

                    </div>

                    <div class="row">
                        
                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">                        
                            
                            <div class="form-group md-form mt-3" style="text-align: right">
                                                            
                                <label for="consejal" data-error="wrong">TOTAL GENERAL DE VOTOS:</label>                                
                
                            </div>
                
                        </div>

                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">
                            
                            <div class="form-group md-form mt-3">
                                                                            
                                <input id="total_general" type="number" required="required" readonly value="0" class="form-control validate">
                
                            </div>                        
                            
                
                        </div>

                    </div>

                    <div class="row">
                        
                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">                        
                            
                            <div class="form-group md-form mt-3" style="text-align: right">
                                                            
                                <label form="acta" ><b>ACTA:</b> </label>
                
                            </div>
                
                        </div>

                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">
                            
                            <div class="form-group md-form mt-3">
                                
                                <input type="file" name="acta" id="acta" accept="image/*" class="form-control" placeholder="Acta.." >
                                @error('acta')

                                    <span class="text-danger">{{$message}}</span>

                                @enderror
                
                            </div>                        
                            
                
                        </div>

                    </div>


                    <div class="form-row text-center">
                        
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

                            <button class="btn btn-primary btn-indigo btn-rounded prevBtn float-left" type="button">Atras</button>
                            <button class="btn btn-success btn-default btn-rounded float-right" type="submit">Procesar</button>

                        </div>
                    
                    </div>
            
                </div>

            </div>

        </div>

    </div>

{!! Form::close() !!}

@push('scripts')

    <script type="text/javascript">

        $(document).ready(function () {
            var navListItems = $('div.setup-panel div a'),
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn'),
            allPrevBtn = $('.prevBtn');

            allWells.hide();

            navListItems.click(function (e) {
                e.preventDefault();
                var $target = $($(this).attr('href')),
                $item = $(this);

                if (!$item.hasClass('disabled')) {
                    navListItems.removeClass('btn-indigo').addClass('btn-default');
                    $item.addClass('btn-indigo');
                    allWells.hide();
                    $target.show();
                    $target.find('input:eq(0)').focus();
                }
            });

            allPrevBtn.click(function(){
            var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            prevStepSteps = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().prev().children("a");

            prevStepSteps.removeAttr('disabled').trigger('click');
        });

        allNextBtn.click(function(){
            var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='url']"),
            isValid = true;

            $(".form-group").removeClass("has-error");
            for(var i=0; i< curInputs.length; i++){
                if (!curInputs[i].validity.valid){
                    isValid = false;
                    $(curInputs[i]).closest(".form-group").addClass("has-error");
                }
            }            

            if (isValid)
                nextStepWizard.removeAttr('disabled').trigger('click');
            });

            $('div.setup-panel div a.btn-indigo').trigger('click');

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

                $("#total_general").val(importe_total);

            });

            $('.primer').keyup(function() {
                    
                var nuevo_valor =  $(this).val();
                var importe_total = 0;

                $(".primer").each(
                    function(index, value) {
                        if ( $.isNumeric($(this).val()) ){
                            importe_total += parseInt($(this).val());
                        }
                    }
                );

                $("#primer_total").val(importe_total);
                
            });

            $('.segundo').keyup(function() {
                    
                var nuevo_valor =  $(this).val();
                var importe_total = 0;

                $(".segundo").each(
                    function(index, value) {
                        if ( $.isNumeric($(this).val()) ){
                            importe_total += parseInt($(this).val());
                        }
                    }
                );

                $("#segundo_total").val(importe_total);
                
            });

            $('.tercero').keyup(function() {
                    
                var nuevo_valor =  $(this).val();
                var importe_total = 0;

                $(".tercero").each(
                    function(index, value) {
                        if ( $.isNumeric($(this).val()) ){
                            importe_total += parseInt($(this).val());
                        }
                    }
                );

                $("#tercer_total").val(importe_total);
                
            });

            $('.cuarto').keyup(function() {
                    
                var nuevo_valor =  $(this).val();
                var importe_total = 0;

                $(".cuarto").each(
                    function(index, value) {
                        if ( $.isNumeric($(this).val()) ){
                            importe_total += parseInt($(this).val());
                        }
                    }
                );

                $("#cuarto_total").val(importe_total);
                
            });

            $('.quinto').keyup(function() {
                    
                var nuevo_valor =  $(this).val();
                var importe_total = 0;

                $(".quinto").each(
                    function(index, value) {
                        if ( $.isNumeric($(this).val()) ){
                            importe_total += parseInt($(this).val());
                        }
                    }
                );

                $("#quinto_total").val(importe_total);
                
            });

        });

    </script>

@endpush

@endsection