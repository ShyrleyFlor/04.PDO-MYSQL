<?php
if(!isset($_SESSION["validarIngreso"])){
    echo "<script>window.location = 'index.php?pagina=login';</script>";
    return;
    
}else{
    if($_SESSION["validarIngreso"] != "ok"){
        echo "<script>window.location = 'index.php?pagina=login';</script>";
    }
}
$usuarios = ControladorFormularios::listaregistro();
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
        <?php foreach ($usuarios as $key => $value) { ?>
            <tr>
                <td><?php echo $key+1; ?></td>
                <td><?php echo $value["nombre"]; ?></td>
                <td><?php echo $value["email"]; ?></td>
                <td><?php echo $value["fecha"]; ?></td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary"><i class="fa-solid fa-pencil"></i></button>
                        <button type="button" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                    </div>
                </td>
            </tr>
        <?php } ?>
        
    </tbody>
</table>