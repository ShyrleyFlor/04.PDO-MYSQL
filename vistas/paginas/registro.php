<div class="d-flex justify-content-center text-center">
    <form class="p-5 bg-light" method="post">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fa-solid fa-user"></i>
                    </span>
                </div>
                <input type="text" class="form-control" id="nombre" name="registroNombre">
            </div>

        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fa-solid fa-envelope"></i>
                    </span>
                </div>
                <input type="email" class="form-control email" id="email" name="registroEmail">
            </div>

        </div>

        <div class="form-group">
            <label for="pwd">Password:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fa-solid fa-lock"></i>
                    </span>
                </div>
                <input type="password" class="form-control" id="pwd" name="registroPassword">
            </div>

        </div>

        <?php
        #metodo dinamico
        //$registro = new ControladorFormularios();
        //$registro->ctrRegistros();
        #metodo estatico
        $registro = ControladorFormularios::ctrRegistros();
        if($registro == "ok"){
            #borramos la cache del navegador
            echo"<script>
                if(window.history.replaceState){
                    window.history.replaceState(null,null,window.location.href);
                }
            </script>";
            #mensaje de exito
            echo"<div class='alert alert-success'>Registro exitoso</div>";
        }

        if($registro == "error"){
            #borramos la cache del navegador
            echo"<script>
                if(window.history.replaceState){
                    window.history.replaceState(null,null,window.location.href);
                }
            </script>";
            #mensaje de error
            echo"<div class='alert alert-danger'>Error, no se permiten caracteres especiales</div>";
        }

        ?>

        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>

<!-- <script src="C:/xampp/htdocs/cursoPHP/04.PDO-MYSQL/vistas/js/script.js"></script> -->