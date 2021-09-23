
<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-edit">

{!! Form::open(array('action'=> array('acc_UsuarioController@store'), 'method'=>'POST' ) ) !!}

    <div class="modal-dialog modal-dialog-centered" >
    
        <div class="modal-content">

            <div class="modal-header">
                <h2 class="modal-title">Nuevo Usuario:</h2>
            </div>                
                            
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
        
                <div class="form-group">

                    <label for="recipient-name" class="col-form-label">Nombre Usuario:</label>
                    <input type="text" name="name" class="form-control" placeholder="Nombre Usuario...">                    

                </div>

            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
        
                <div class="form-group">

                    <label for="recipient-name" class="col-form-label">Email:</label>
                    <input type="text" name="email" class="form-control" placeholder="Email...">

                </div>

            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
        
                <div class="form-group">

                    <label for="recipient-name" class="col-form-label">Contraseña:</label>
                    <input type="password" name="contraseña"class="form-control" placeholder="Contraseña...">                    

                </div>

            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
        
                <div class="form-group">

                    <label for="recipient-name" class="col-form-label">Nivel:</label>
                    <select name="id_rol" id="id_rol" class="form-control selectpicker"  data-live-search="true">
                                
                        <option value="1">NIVEL 1</option>
                        <option value="2">NIVEL 2</option>
                        <option value="3">NIVEL 3</option>
                        <option value="4">NIVEL 4</option>
    
                    </select>

                </div>

            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
        
                <div class="form-group">

                    <label for="recipient-name" class="col-form-label">Nivel:</label>
                    <select name="url" id="url" class="form-control selectpicker"  data-live-search="true">
                                
                        <option value="cesar_mendez">1- Cesar Mendez</option>
                        <option value="hector_avila">2 -Hector Avila</option>
                        <option value="mabel_gomez">3- Mabel Gomez</option>
                        <option value="santiago_barreto">4- Santiago Barreto</option>
                        <option value="pereira_bello">5- Pereira Bello</option>
                        <option value="lorenzo_gonzalez">6- Lorenzo Gonzalez</option>
                        <option value="susana_medina">7- Susana Medina</option>
                        <option value="carlos_acosta">8- Carlos Acosta</option>
                        <option value="juan_roche">9- Juan Roche</option>
                        <option value="higinia_gomez">10- Higinia Gómez</option>
                        <option value="carlos_britez">11- Carlos Britez</option>
                        <option value="diego_candia">12-Diego Candia</option>
    
                    </select>

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