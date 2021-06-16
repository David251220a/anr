
<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-edit-{{$vot->Id_Votacion}}">

{!! Form::open(array('action'=> array('ConsultaController@destroy', $vot->Id_Votacion), 'method'=>'delete', 'file'=>'true', 'enctype'=>"multipart/form-data" ) ) !!}

    <div class="modal-dialog modal-dialog-centered" >
    
        <div class="modal-content">

            <div class="modal-header">
                <h2 class="modal-title">Editar Votacion:</h2>
            </div>                
                            
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
        
                <div class="form-group">

                    <label for="recipient-name" class="col-form-label">Intendente:</label>
                    <input type="text" value="{{$vot->Nombre}} {{$vot->Apellido}}" readonly name="intendente" class="form-control">
                    <input type="hidden" value="{{$vot->Id_Intendente}}" name="id_intendente" class="form-control">

                </div>

            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
        
                <div class="form-group">

                    <label for="recipient-name" class="col-form-label">Lista:</label>
                    <input type="text" value="{{$vot->Desc_Lista}}" name="lista" readonly class="form-control">                    

                </div>

            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
        
                <div class="form-group">

                    <label for="recipient-name" class="col-form-label">Local:</label>
                    <input type="text" value="{{$vot->Desc_Local}}" name="local" readonly class="form-control">
                    <input type="hidden" value="{{$vot->Id_Local}}" name="id_local" class="form-control">

                </div>

            </div>
            
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
        
                <div class="form-group">

                    <label for="recipient-name" class="col-form-label">Mesa:</label>
                    <input type="text" value="{{$vot->Mesa}}" readonly name="mesa" class="form-control">
                    <input type="hidden" value="{{$vot->Id_Mesa}}" name="id_mesa" class="form-control">

                </div>

            </div>
            
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
        
                <div class="form-group">

                    <label for="recipient-name" class="col-form-label">Votos:</label>
                    <input type="number" style="text-align:right" value="{{$vot->Votos}}" id="votos" name="votos" class="form-control">
                    <input type="hidden" value="{{$vot->Votos}}" name="votos_anterior" class="form-control">

                </div>

            </div>

            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

                <div class="form-group">
    
                    <label form="pacta" > Acta</label>
                    <input type="file" name="pacta" id="pacta" class="form-control" placeholder="Acta.." >
    
                </div>
    
            </div>

            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">

                    <div class="modal-footer">

                        <button id="guardar" type="submit" class="btn btn-primary">Confirmar</button>
                        <button type="button" class="btn btn-defaul" data-dismiss="modal">Cerrar</button>
    
                    </div>
                
                </div>

            </div>
            

        </div>

    </div>
    
{!! Form::close() !!}

</div>


