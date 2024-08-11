<?php
class ControladorFormularios
{
    #registro metodo
    static public function ctrRegistros()
    {
        if (isset($_POST["registroNombre"])) {
            $tabla = "registros";
            $datos = array(
                "nombre" => $_POST["registroNombre"],
                "email" => $_POST["registroEmail"],
                "password" => $_POST["registroPassword"],
            );
            $respuesta = ModeloFormularios::mdlRegistro($tabla, $datos);
            return $respuesta;
        }
    }
    #seleccionar registro (listar)
    static public function listaregistro()
    {
        $tabla = "registros";
        $respuesta = ModeloFormularios::mdlListarRegistros($tabla, null, null);
        return $respuesta;
    }
    #verificar si el usuario existe para permitir iniciar sesion
    public function CTRingreso()
    {
        if (isset($_POST["ingresoEmail"])) {
            $tabla = "registros";
            $item = "email";
            $valor = $_POST["ingresoEmail"];
            #validar email
            $respuesta = ModeloFormularios::mdlListarRegistros($tabla, $item, $valor);
            if (($respuesta["email"]) == $_POST["ingresoEmail"] && ($respuesta["password"])== $_POST["ingresoPassword"]) 
            {
                if($respuesta["password"] == $_POST["ingresoPassword"]){
                    $_SESSION["validarIngreso"] = "ok";
                    echo "<script>
                    if(window.history.replaceState){
                        window.history.replaceState(null,null,window.location.href);
                    }
                        window.location = 'index.php?pagina=inicio';
    
                    </script>";
                    echo "<div class='alert alert-success'>Ingreso exitoso</div>";
                } else {
                    echo "<script>
                    if(window.history.replaceState){
                        window.history.replaceState(null,null,window.location.href);
                    }
    
                    </script>";
                    echo "<div class='alert alert-danger'>Error al iniciar sesion</div>";

                    print_r($respuesta);
                }
            }
        }
    }

}
?>