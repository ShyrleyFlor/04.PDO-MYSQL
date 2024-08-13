<form class="p-5 bg-light" method="post">
    <div class="form-group">
        <label for="email">Email:</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fa-solid fa-envelope"></i>
                </span>
            </div>
            <input type="email" class="form-control" name="ingresoEmail">
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
            <input type="password" class="form-control"  name="ingresoPassword">
        </div>

    </div>
    <?php
    #metodo dinamico
    $registro = new ControladorFormularios();
    $registro -> CTRingreso();

   /* if($ingreso == "ok"){
        echo "<div class='alert alert-success'>Ingresaste correctamente</div>";
        echo "<script>window.location = 'index.php?pagina=inicio'</script>";
    }else{
        echo "<div class='alert alert-danger'>Error al Ingresar</div>";
        #LLEVE A LA PAGINA DE REGISTRO
        echo "<script>window.location = 'index.php?pagina=registro'</script>";
    }*/

    ?>
    <button type="submit" class="btn btn-primary">Ingresar</button>
</form>