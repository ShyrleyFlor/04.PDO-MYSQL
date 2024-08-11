<?php

if (isset($_GET["id"])) {
    $item = "id";
    $valor = $_GET["id"];
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
                <input type="text" class="form-control" value="<?php echo $usuario["nombre"]; ?>" placeholder="Escriba su nombre" id="nombre"
                    name="actualizarNombre">
            </div>

        </div>

        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fa-solid fa-envelope"></i>
                    </span>
                </div>
                <input type="email" class="form-control" value="<?php echo $usuario["email"]; ?>" placeholder="Escriba su email" id="email"
                    name="actualizarEmail">
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
                <input type="hidden" value="<?php echo $usuario["id"]; ?>" name="id">
            </div>

        </div>

        <?php
        $actualizar = new ControladorFormularios();
        $actualizar -> CTRactualizar();
        ?>
       


        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>