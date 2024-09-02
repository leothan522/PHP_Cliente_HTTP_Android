<div class="row col-12 m-2 justify-content-center <?php echo $controller->row_recuperar; ?>" id="row_recuperar">

    <div class="col-md-6">
        <div class="card">
            <h5 class="card-header">
                <i class="fa-solid fa-key"></i>
                Recuperar Contraseña
            </h5>
            <div class="card-body">
                <form id="form_recuperar">
                    <div class="form-row justify-content-center">
                        <div class="col-md-6 mb-3">
                            <label for="input_email">
                                Email
                            </label>
                            <input type="email" name="email" class="form-control" placeholder="Ingrese Email">
                        </div>
                    </div>
                    <div class="form-row justify-content-end">
                        <button type="reset" class="d-none" id="btn_reset_recuperar">Reset</button>
                        <button type="button" class="btn btn-link" onclick="rowVisible('login')">
                            Iniciar sesión
                        </button>
                        <button class="btn btn-primary" type="submit">
                            <i class="fa-regular fa-envelope"></i> Solicitar Contraseña
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>