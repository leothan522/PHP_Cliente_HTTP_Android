<div class="row m-2 justify-content-center <?php echo $index->row_login; ?>" id="row_login">

    <div class="col-md-6">
        <div class="card">
            <h5 class="card-header">
                <i class="fa-solid fa-address-card"></i>
                Login
                <button type="button" class="btn btn-sm float-right <?php echo $index->btn_cerrar_sesion; ?>" id="btn_cerrar_sesion">
                    <!--Cerrar Sesión-->
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                </button>
            </h5>
            <div class="card-body <?php echo $index->card_body_login; ?>" id="card_body_login">
                <form id="form_login">
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="input_email">
                                Email
                            </label>
                            <input type="email" name="email" class="form-control" placeholder="Ingrese Email">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="input_password">
                                Contraseña
                            </label>
                            <input type="password" name="password" class="form-control" placeholder="Ingrese Contraseña">
                        </div>
                    </div>
                    <input type="hidden" class="form-control mb-3" name="fcm_token" value="<?php echo $index->token;; ?>" readonly>
                    <div class="form-row justify-content-end">
                        <button type="reset" class="d-none" id="btn_reset_login">Reset</button>
                        <button type="button" class="btn btn-link" onclick="rowVisible('register')">
                            Registrarse
                        </button>
                        <button type="button" class="btn btn-link" onclick="rowVisible('recuperar')">
                            ¿Olvidó su contraseña?
                        </button>
                        <button class="btn btn-primary" type="submit">
                            Iniciar sesión
                        </button>
                    </div>
                </form>
            </div>
            <div class="card-footer <?php echo $index->card_footer_login; ?> p-0" id="card_footer_login">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <span class="nav-link">
                            ID <span class="float-right text-primary font-weight-bold" id="span_id"><?php echo $index->user_id ?></span>
                        </span>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link">
                            Nombre <span class="float-right text-primary font-weight-bold" id="span_nombre"><?php echo $index->user_name ?></span>
                        </span>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link">
                            Email <span class="float-right text-primary font-weight-bold" id="span_email"><?php echo $index->user_email ?></span>
                        </span>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link">
                            Teléfono <span class="float-right text-primary font-weight-bold" id="span_telefono"><?php echo $index->user_telefono ?></span>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>