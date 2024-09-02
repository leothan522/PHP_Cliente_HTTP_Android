<div class="row col-12 m-2 justify-content-center <?php echo $controller->row_edit; ?>" id="row_edit">

    <div class="col-md-6">
        <div class="card">
            <h5 class="card-header">
                <i class="fa-solid fa-edit"></i>
                Editar
            </h5>
            <div class="card-body">
                <form id="form_update">
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="input_password">
                                Nombre
                            </label>
                            <input type="text" name="name" class="form-control" placeholder="Ingrese Nombre" aria-describedby="nameEditFeedback" id="input_edit_name">
                            <div id="nameEditFeedback" class="invalid-feedback">
                                El campo nombre es obligatorio.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="input_email">
                                Email
                            </label>
                            <input type="email" name="email" class="form-control" placeholder="Ingrese Email" aria-describedby="emailEditFeedback" id="input_edit_email">
                            <div id="emailEditFeedback" class="invalid-feedback">
                                El correo electronico ya ha sido registrado anteriormente.
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="input_email">
                                Teléfono
                            </label>
                            <input type="text" name="telefono" class="form-control" placeholder="Ingrese Teléfono" aria-describedby="telefonoEditFeedback"  id="input_edit_telefono">
                            <div id="telefonoEditFeedback" class="invalid-feedback">
                                El campo telefono esta incompleto.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="input_password">
                                Contraseña Actual
                            </label>
                            <input type="password" name="password" class="form-control" placeholder="Ingrese Contraseña" aria-describedby="passwordEditFeedback"  id="input_edit_password">
                            <div id="passwordEditFeedback" class="invalid-feedback">
                                Contraseña Incorrecta.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="input_confirmar">
                                Nueva Contraseña
                            </label>
                            <input type="password" name="nuevo_password" class="form-control" placeholder="Confirma Contraseña" aria-describedby="confirmarEditFeedback" id="input_edit_nueva">
                            <div id="confirmarEditFeedback" class="invalid-feedback">
                                Las contraseñas NO coinciden.
                            </div>
                        </div>
                    </div>
                    <input type="text" class="form-control mb-3" name="id" readonly id="input_edit_id">
                    <input type="text" class="form-control mb-3" name="fcm_token" value="<?php echo FCM_TOKEN_TEST; ?>" readonly id="input_edit_fcm_token">
                    <div class="form-row justify-content-end">
                        <button type="reset" class="d-none" id="btn_reset_edit">Reset</button>
                        <button type="button" class="btn btn-link" onclick="rowVisible('login')">
                            Cancelar
                        </button>
                        <button class="btn btn-primary" type="submit">
                            Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>