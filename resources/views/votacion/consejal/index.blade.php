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

        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

            <div class="alert alert-danger" style="text-align: center" role="alert">
                CONSEJAL
            </div>

        </div>

    </div>

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

    <div class="row">

        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

            <div class="table-responsive">

                <table id="detalles" class="table table-striped table-condensed table-bordered table-hover table-responsive">

                    <thead style="background-color:#f71808a8">

                        <th style="text-align: center; font-size: 1.2rem"><i class="fa fa-arrow-down" aria-hidden="true"></i>Orden / <i class="fa fa-arrow-right" aria-hidden="true"></i>Lista</th>
                        @foreach ($listas as $lista)
                        
                            <th style="text-align: center; font-size: 1.2rem">{{$lista->numero_lista}}</th>
                            <input type="hidden" name="lista[]" value="{{$lista->Id_Lista}}">

                        @endforeach
                        
                    </thead>
                    
                    <tbody>

                        @foreach ($ordenes as $orden)

                            <tr style="align-items: center">

                                <td style="text-align: right">{{$orden->Orden}} <input type="hidden" name="orden[]" value="{{$orden->Orden}}"></td>
                                <td style="text-align: right"> <input type="number" style="text-align: right" class="form-control Can_Produc primer_11"  name="votos[]" value="0"> </td>
                                <td style="text-align: right"> <input type="number" style="text-align: right" class="form-control Can_Produc primer_12" name="votos[]" value="0"> </td>
                                <td style="text-align: right"> <input type="number" style="text-align: right" class="form-control Can_Produc primer_13" name="votos[]" value="0"> </td>
                                <td style="text-align: right"> <input type="number" style="text-align: right" class="form-control Can_Produc primer_15" name="votos[]" value="0"> </td>
                                <td style="text-align: right"> <input type="number" style="text-align: right" class="form-control Can_Produc primer_16" name="votos[]" value="0"> </td>
                                <td style="text-align: right"> <input type="number" style="text-align: right" class="form-control Can_Produc primer_17" name="votos[]" value="0"> </td>
                                <td style="text-align: right"> <input type="number" style="text-align: right" class="form-control Can_Produc primer_18" name="votos[]" value="0"> </td>

                            </tr>
                            
                        @endforeach

                    </tbody>

                    <tfoot>
                        
                        <tr>

                            <td style="text-align: right">TOTAL:</td>
                            <td style="text-align: right"> <input type="number" id="total_11" style="text-align: right" class="form-control" value="0" readonly> </td>
                            <td style="text-align: right"> <input type="number" id="total_12" style="text-align: right" class="form-control" value="0" readonly> </td>
                            <td style="text-align: right"> <input type="number" id="total_13" style="text-align: right" class="form-control" value="0" readonly> </td>
                            <td style="text-align: right"> <input type="number" id="total_15" style="text-align: right" class="form-control" value="0" readonly> </td>
                            <td style="text-align: right"> <input type="number" id="total_16" style="text-align: right" class="form-control" value="0" readonly> </td>
                            <td style="text-align: right"> <input type="number" id="total_17" style="text-align: right" class="form-control" value="0" readonly> </td>
                            <td style="text-align: right"> <input type="number" id="total_18" style="text-align: right" class="form-control" value="0" readonly> </td>

                        </tr>

                    </tfoot>
                    
                </table>

            </div>

        </div>

    </div>

    <div class="row">
                    
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">                        
            
            <div class="form-group md-form mt-3" style="text-align: right">
                                            
                <label for="consejal" data-error="wrong">VOTOS NULOS:</label>
                <input type="hidden" name="id_lista[]" id="consejal" class="form-control" value="999">

            </div>

        </div>

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">
            
            <div class="form-group md-form mt-3">
                                                            
                <input id="votos" name="votos_varios[]" type="number" required="required" value="0" class="form-control Can_Produc">

            </div>                        
            

        </div>

    </div>

    <div class="row">
                    
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">                        
            
            <div class="form-group md-form mt-3" style="text-align: right">
                                            
                <label for="consejal" data-error="wrong">VOTOS EN BLANCO:</label>
                <input type="hidden" name="id_lista[]" id="consejal" class="form-control" value="998">

            </div>

        </div>

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">
            
            <div class="form-group md-form mt-3">
                                                            
                <input id="votos" name="votos_varios[]" type="number" required="required" value="0" class="form-control Can_Produc">

            </div>                        
            

        </div>

    </div>

    <div class="row">
                    
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">                        
            
            <div class="form-group md-form mt-3" style="text-align: right">
                                            
                <label for="consejal" data-error="wrong">VOTOS A COMPUTAR:</label>
                <input type="hidden" name="id_lista[]" id="consejal" class="form-control" value="997">

            </div>

        </div>

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">
            
            <div class="form-group md-form mt-3">
                                                            
                <input id="votos" name="votos_varios[]" type="number" required="required" value="0" class="form-control Can_Produc">

            </div>                        
            

        </div>

    </div>

    <div class="row">
                    
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">                        
            
            <div class="form-group md-form mt-3" style="text-align: right">
                                            
                <label for="consejal" data-error="wrong">TOTAL DE VOTOS:</label>

            </div>

        </div>

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">
            
            <div class="form-group md-form mt-3">
                                                            
                <input id="total_votos" type="number" required="required" value="0" class="form-control">

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

            <button class="btn btn-success btn-default btn-rounded float-right" type="submit">Procesar</button>

        </div>
    
    </div>

{!! Form::close() !!}

@push('scripts')

    <script type="text/javascript">

        $(document).ready(function () {

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

            $('.primer_11').keyup(function() {
                    
                var nuevo_valor =  $(this).val();
                var importe_total = 0;                    

                $(".primer_11").each(
                    function(index, value) {
                        if ( $.isNumeric($(this).val()) ){
                            importe_total += parseInt($(this).val());
                        }
                    }
                );

                $("#total_11").val(importe_total);
    
            });

            $('.primer_12').keyup(function() {
                    
                var nuevo_valor =  $(this).val();
                var importe_total = 0;                    

                $(".primer_12").each(
                    function(index, value) {
                        if ( $.isNumeric($(this).val()) ){
                            importe_total += parseInt($(this).val());
                        }
                    }
                );

                $("#total_12").val(importe_total);
    
            });
            
            $('.primer_13').keyup(function() {
                    
                var nuevo_valor =  $(this).val();
                var importe_total = 0;                    

                $(".primer_13").each(
                    function(index, value) {
                        if ( $.isNumeric($(this).val()) ){
                            importe_total += parseInt($(this).val());
                        }
                    }
                );

                $("#total_13").val(importe_total);
    
            });

            // $('.primer_14').keyup(function() {
                    
            //     var nuevo_valor =  $(this).val();
            //     var importe_total = 0;                    

            //     $(".primer_14").each(
            //         function(index, value) {
            //             if ( $.isNumeric($(this).val()) ){
            //                 importe_total += parseInt($(this).val());
            //             }
            //         }
            //     );

            //     $("#total_14").val(importe_total);
    
            // });

            $('.primer_15').keyup(function() {
                    
                var nuevo_valor =  $(this).val();
                var importe_total = 0;                    

                $(".primer_15").each(
                    function(index, value) {
                        if ( $.isNumeric($(this).val()) ){
                            importe_total += parseInt($(this).val());
                        }
                    }
                );

                $("#total_15").val(importe_total);
    
            });

            $('.primer_16').keyup(function() {
                    
                var nuevo_valor =  $(this).val();
                var importe_total = 0;                    

                $(".primer_16").each(
                    function(index, value) {
                        if ( $.isNumeric($(this).val()) ){
                            importe_total += parseInt($(this).val());
                        }
                    }
                );

                $("#total_16").val(importe_total);
    
            });

            $('.primer_17').keyup(function() {
                    
                var nuevo_valor =  $(this).val();
                var importe_total = 0;                    

                $(".primer_17").each(
                    function(index, value) {
                        if ( $.isNumeric($(this).val()) ){
                            importe_total += parseInt($(this).val());
                        }
                    }
                );

                $("#total_17").val(importe_total);
    
            });

            $('.primer_18').keyup(function() {
                    
                var nuevo_valor =  $(this).val();
                var importe_total = 0;                    

                $(".primer_18").each(
                    function(index, value) {
                        if ( $.isNumeric($(this).val()) ){
                            importe_total += parseInt($(this).val());
                        }
                    }
                );

                $("#total_18").val(importe_total);
    
            });

        });

    </script>

@endpush

@endsection