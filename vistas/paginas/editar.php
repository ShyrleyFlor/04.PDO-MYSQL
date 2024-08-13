<?php

if (isset($_GET["token"])) {
    $item = "token";
    $valor = $_GET["token"];
    $usuario = ControladorFormularios::listaregistro($item, $valor);

}

?>


<div class="d-flex justify-content-center text-center">
    <form class="p-5 bg-light" method="post">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fa-solid fa-user"></i>
                    </span>
                </div>
                <input type="text" class="form-control" value="<?php echo $usuario["nombre"]; ?>"
                    placeholder="Escriba su nombre" id="actualizarNombre" name="actualizarNombre">
            </div>

        </div>

        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fa-solid fa-envelope"></i>
                    </span>
                </div>
                <input type="email" class="form-control" value="<?php echo $usuario["email"]; ?>"
                    placeholder="Escriba su email" id="actualizarEmail" name="actualizarEmail">
            </div>

        </div>

        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fa-solid fa-lock"></i>
                    </span>
                </div>
                <input type="password" class="form-control" placeholder="Escriba su password" id="pwd"
                    name="actualizarPassword">
                <input type="hidden" value="<?php echo $usuario["password"]; ?>" name="passwordActual">
                <input type="hidden" value="<?php echo $usuario["token"]; ?>" name="tokenUsuario">
                <input type="hidden" value="<?php echo $usuario["id"]; ?>" name="idUsuario">
            </div>

        </div>

        <?php
        $actualizar = ControladorFormularios::CTRactualizar();
        if ($actualizar == "ok") {
            echo "<script>
                if(window.history.replaceState){
                    window.history.replaceState(null,null,window.location.href);
                }
                    
            </script>";
            echo "<div class='alert alert-success'>Actualizado exitosamente</div>
            <script>
                setTimeout(function(){
                    window.location = 'index.php?pagina=inicio';
                }, 3000);
                    
            </script>
            ";


        }

        if ($actualizar == "error") {
            echo "<script>
                if(window.history.replaceState){
                    window.history.replaceState(null,null,window.location.href);
                }
            </script>";
            echo "<div class='alert alert-danger'>Error al actualizar usuario</div>";
        }
        ?>
        <script>
            var datos = new FormData();
            datos.append("validarToken","<?php echo $usuario['token']; ?>");

            $.ajax({
                url: "ajax/formulario.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (response) {
                    $("#actualizarEmail").val(response.email);
                    $("#actualizarNombre").val(response.nombre);
                },
                error: function (status, error) {
                    console.error("Error en la solicitud AJAX:", status, error);
                }
            })

        </script>


        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>

</div>