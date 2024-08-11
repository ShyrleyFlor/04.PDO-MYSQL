<?php
if (!isset($_SESSION["validarIngreso"])) {
    echo "<script>window.location = 'index.php?pagina=login';</script>";
    return;
} else {
    if ($_SESSION["validarIngreso"] != "ok") {
        echo "<script>window.location = 'index.php?pagina=login';</script>";
    }
}
$usuarios = ControladorFormularios::listaregistro(null, null);

?>

<table class="table table-hover ">
    <thead>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <!--LISTAMOS LOS USUARIOS-->
    <tbody>
        <?php if (is_iterable($usuarios)): ?>
            <?php foreach ($usuarios as $key => $value): ?>
                <tr>
                    <td><?php echo $key + 1; ?></td>
                    <td><?php echo $value["nombre"]; ?></td>
                    <td><?php echo $value["email"]; ?></td>
                    <td><?php echo $value["fecha"]; ?></td>
                    <td>
                        <div class="btn-group">
                            <div class="px-1">
                                <a href="index.php?pagina=editar&id=<?php echo $value["id"]; ?>" class="btn btn-primary"><i
                                        class="fa-solid fa-pencil"></i></a>
                            </div>


                            <form method="post">
                                <input type="hidden" name="eliminar" value="<?php echo $value["id"]; ?>">
                                <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                <?php
                                $eliminar = new ControladorFormularios();
                                $eliminar -> CTReliminar();
                                if ($eliminar == "ok") {
                                    echo "<script>
                                        if(window.history.replaceState){
                                            window.history.replaceState(null,null,window.location.href);
                                        }
                                    </script>";
                                    echo "<div class='alert alert-success'>Eliminado exitosamente</div>
                                    <script>
                                        setTimeout(function(){
                                            window.location = 'index.php?pagina=inicio';
                                        }, 3000);
                                    </script>
                                    ";
                                }
                                ?>
                            </form>


                        </div>
                    </td>
                </tr>
            <?php endforeach ?>
        <?php else: ?>
            <tr>
                <td colspan="5">No hay usuarios para mostrar.</td>
            </tr>
        <?php endif ?>


    </tbody>
</table>