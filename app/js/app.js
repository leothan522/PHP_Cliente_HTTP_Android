//Inicializamos InputMask
//$('#cedula').inputmask("9{1,8}");
//let telefono = $('#telefono').inputmask("isComplete");
$('#input_telefono').inputmask({"mask": "(9999) 999-99.99",});

//Procesamos el Formulario LOGIN
$('#form_login').submit(function (e) {
    e.preventDefault();
    Cargando.fire();
    $.ajax({
        type: 'POST',
        url: 'login/',
        data: $(this).serialize(),
        success: function (response) {
            let data = JSON.parse(response);
            if (data.result) {
                $('#btn_reset_login').click();
                $('#btn_reset_register').click();
                $('#btn_reset_recuperar').click();
                showUsuario(data.id, data.name, data.email, data.telefono);
                Toast.fire({
                    icon: data.icon,
                    title: data.title
                });
            } else {
                Alerta.fire({
                    icon: data.icon,
                    title: data.title,
                    text: data.text
                });
            }
        }
    });
});

//mostramos los datos recibidos
function showUsuario(id, name, email, telefono) {
    $('#span_id').text(id);
    $('#span_nombre').text(name);
    $('#span_email').text(email);
    $('#span_telefono').text(telefono);
    $('#card_body_login').addClass('d-none');
    $('#btn_cerrar_sesion').removeClass('d-none');
    $('#card_footer_login').removeClass('d-none');
    $('#input_telefono')
        .removeClass('is-invalid')
        .removeClass('is-valid');
    $('#input_password')
        .removeClass('is-invalid')
        .removeClass('is-valid');
    $('#input_confirmar')
        .removeClass('is-invalid')
        .removeClass('is-valid');
    $('#input_email')
        .removeClass('is-invalid')
        .removeClass('is-valid');
    $('#input_name')
        .removeClass('is-invalid')
        .removeClass('is-valid');
}

//Cerramos sesion
$('#btn_cerrar_sesion').click(function (e) {
    Cargando.fire();
    $.ajax({
        type: 'POST',
        url: 'login/',
        data: {
            cerrar_sesion: true
        },
        success: function (response) {

            let data = JSON.parse(response);

            if (data.result === true) {
                $('#card_body_login').removeClass('d-none');
                $('#btn_cerrar_sesion').addClass('d-none');
                $('#card_footer_login').addClass('d-none');
                Toast.fire({
                    icon: data.icon,
                    title: data.title
                });
            } else {
                Alerta.fire({
                    icon: data.icon,
                    title: data.title,
                    text: data.text
                });
            }

        }
    });
});

//Cambiamos Visibilidad de los ROWS
function rowVisible(opcion) {
    if (opcion === 'register') {
        $('#row_login').addClass('d-none');
        $('#row_recuperar').addClass('d-none');
        $('#row_register').removeClass('d-none');
    } else {
        if (opcion === 'recuperar') {
            $('#row_register').addClass('d-none');
            $('#row_login').addClass('d-none');
            $('#row_recuperar').removeClass('d-none');
        } else {
            $('#row_register').addClass('d-none');
            $('#row_recuperar').addClass('d-none');
            $('#row_login').removeClass('d-none');
        }
    }
}

//Procesamos el Formulario REGISTER
$('#form_register').submit(function (e) {
    e.preventDefault();

    let telefono = $('#input_telefono').inputmask("isComplete");
    let password = $('#input_password').val();
    let confirmar = $('#input_confirmar').val();
    let name = $('#input_name').val();
    let email = $('#input_email').val();

    if (telefono && password === confirmar && name !== "" && email !== "" && password !== "") {
        Cargando.fire();
        $.ajax({
            type: 'POST',
            url: 'register/',
            data: $(this).serialize(),
            success: function (response) {
                let data = JSON.parse(response);
                if (data.result) {
                    $('#btn_reset_register').click();
                    $('#btn_reset_login').click();
                    $('#btn_reset_recuperar').click();
                    showUsuario(data.id, data.name, data.email, data.telefono);
                    rowVisible('login');
                    Toast.fire({
                        icon: data.icon,
                        title: data.title
                    });
                } else {
                    Alerta.fire({
                        icon: data.icon,
                        title: data.title,
                        text: data.text,
                    });
                }
            }
        });
    } else {

        if (!telefono) {
            $('#input_telefono').addClass('is-invalid');
        } else {
            $('#input_telefono').removeClass('is-invalid');
            $('#input_telefono').addClass('is-valid');
        }

        if (password !== confirmar) {
            $('#input_confirmar').addClass('is-invalid');
        } else {
            $('#input_confirmar').removeClass('is-invalid');
            $('#input_confirmar').addClass('is-valid');
        }

        if (name === "") {
            $('#input_name').addClass('is-invalid');
        } else {
            $('#input_name').removeClass('is-invalid');
            $('#input_name').addClass('is-valid');
        }

        if (email === "") {
            $('#input_email').addClass('is-invalid');
        } else {
            $('#input_email').removeClass('is-invalid');
            $('#input_email').addClass('is-valid');
        }

        if (password === "") {
            $('#input_password').addClass('is-invalid');
        } else {
            $('#input_password').removeClass('is-invalid');
            $('#input_password').addClass('is-valid');
        }
    }
});

//Procesamos el Formulario RECUPEAR CLAVE
$('#form_recuperar').submit(function (e) {
    e.preventDefault();
    Cargando.fire();
    $.ajax({
        type: 'POST',
        url: 'recover/',
        data: $(this).serialize(),
        success: function (response) {
            let data = JSON.parse(response);
            if (data.result) {
                $('#btn_reset_recuperar').click();
                $('#btn_reset_login').click();
                $('#btn_reset_register').click();
                rowVisible('login');
                Toast.fire({
                    icon: data.icon,
                    title: data.title
                });
            } else {
                Alerta.fire({
                    icon: data.icon,
                    title: data.title,
                    text: data.text
                });
            }
        }
    });
});

console.log('Hi!');