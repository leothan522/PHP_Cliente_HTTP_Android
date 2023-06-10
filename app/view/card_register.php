<div class="row m-2 justify-content-center <?php echo $index->row_register; ?>" id="row_register">

    <div class="col-md-6">
        <div class="card">
            <h5 class="card-header">
                <i class="fa-solid fa-user-plus"></i>
                Regístrarse
            </h5>
            <div class="card-body">
                <form id="form_register">
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="input_password">
                                Nombre
                            </label>
                            <input type="text" name="name" class="form-control" placeholder="Ingrese Nombre" aria-describedby="nameFeedback" id="input_name">
                            <div id="nameFeedback" class="invalid-feedback">
                                El campo nombre es obligatorio.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="input_email">
                                Email
                            </label>
                            <input type="email" name="email" class="form-control" placeholder="Ingrese Email" aria-describedby="emailFeedback" id="input_email">
                            <div id="emailFeedback" class="invalid-feedback">
                                El campo email es obligatorio.
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="input_email">
                                Teléfono
                            </label>
                            <input type="text" name="telefono" class="form-control" placeholder="Ingrese Teléfono" aria-describedby="telefonoFeedback"  id="input_telefono">
                            <div id="telefonoFeedback" class="invalid-feedback">
                                El campo telefono esta incompleto.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="input_password">
                                Contraseña
                            </label>
                            <input type="password" name="password" class="form-control" placeholder="Ingrese Contraseña"  id="input_password">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="input_confirmar">
                                Repetir Contraseña
                            </label>
                            <input type="password" name="nuevo_password" class="form-control" placeholder="Confirma Contraseña" aria-describedby="confirmarFeedback" id="input_confirmar">
                            <div id="confirmarFeedback" class="invalid-feedback">
                                Las contraseñas NO coinciden.
                            </div>
                        </div>
                    </div>
                    <input type="hidden" class="form-control mb-3" name="fcm_token" value="<?php echo $index->token;; ?>" readonly>
                    <div class="form-row justify-content-end">
                        <button type="reset" class="d-none" id="btn_reset_register">Reset</button>
                        <button type="button" class="btn btn-link" onclick="rowVisible('login')">
                            ¿Ya se registró?
                        </button>
                        <button class="btn btn-primary" type="submit">
                            Regístrarse
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>