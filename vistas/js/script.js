$(".email").change(function () {

    $(".alert").remove();
    var email = $(this).val();
    var datos = new FormData();
    datos.append("validarEmail", email);

    $.ajax({
        url: "ajax/formulario.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        setTimeout: 3000,
        success:function (response) {
            console.log('Respuesta del servidor:', response);
            if (response && response.email) {
                console.log('Mostrando mensaje de error');
                $("#email").val("");
                $("#email").parent().after(`
                <div class="alert alert-warning">
                    <b>ERROR:</b> El correo ${response.email} ya existe, por favor elige otro.
                </div>
                `);
            }
        },
        error: function (status, error) {
            console.error("Error en la solicitud AJAX:", status, error);
        }
    })
})