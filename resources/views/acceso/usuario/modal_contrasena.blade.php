
<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-delete-{{$usu->id}}">

{!! Form::open(array('action'=> array('acc_UsuarioController@destroy', $usu->id), 'method'=>'delete' ) ) !!}

    <div class="modal-dialog modal-dialog-centered" >
    
        <div class="modal-content">

            <div class="modal-header">
                <h2 class="modal-title">Usuario:</h2>
            </div>                
                            
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
        
                <div class="form-group">

                    <label for="recipient-name" class="col-form-label">Nombre Usuario:</label>
                    <input type="text" name="name" class="form-control" value="{{$usu->name}}" placeholder="Nombre Usuario...">

                </div>

            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
        
                <div class="form-group">

                    <label for="recipient-name" class="col-form-label">Email:</label>
                    <input type="text" name="email"  value="{{$usu->email}}" class="form-control" placeholder="Email...">

                </div>

            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
        
                <div class="form-group">

                    <label for="recipient-name" class="col-form-label">Contraseña:</label>
                    <input type="password" name="contraseña"class="form-control" placeholder="Contraseña...">                    

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