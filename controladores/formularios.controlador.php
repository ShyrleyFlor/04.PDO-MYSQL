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
    static public function listaregistro($item, $valor)
    {
        $tabla = "registros";
        $respuesta = ModeloFormularios::mdlListarRegistros($tabla, $item, $valor);
        return $respuesta;
    }
    #verificar si el usuario existe para permitir iniciar sesion
    public function CTRingreso()
    {
        if (isset($_POST["ingresoEmail"])) {
            $tabla = "registros";
            $item = "email";
            $valor = $_POST["ingresoEmail"];
            $respuesta = ModeloFormularios::mdlListarRegistros($tabla, $item, $valor);
    
            echo "Email: " . $_POST["ingresoEmail"] . "<br>";
            echo "Contraseña: " . $_POST["ingresoPassword"] . "<br>";
            echo "Contraseña almacenada: " . $respuesta["password"] . "<br>";
    
            if ($respuesta["email"] == $_POST["ingresoEmail"] && $respuesta["password"] == $_POST["ingresoPassword"]) {
                $_SESSION["validarIngreso"] = "ok";
                echo "<script>
                    if(window.history.replaceState){
                        window.history.replaceState(null,null,window.location.href);
                    }
                    window.location = 'index.php?pagina=inicio';
                </script>";
                echo "<div class='alert alert-success'>Ingreso exitoso</div>
                ";
            } else {
                echo "<script>
                    if(window.history.replaceState){
                        window.history.replaceState(null,null,window.location.href);
                    }
                </script>";
                echo "<div class='alert alert-danger'>Error al iniciar sesion</div>";
            }
        }
    }

    #actualizar registro creamos el metodo
    
    static public function CTRactualizar()
    {
        if (isset($_POST["actualizarNombre"])) {
            if($_POST["actualizarPassword"] != ""){
                $password = $_POST["actualizarPassword"];
            }else{
                $password = $_POST["passwordActual"];
            }

            $tabla = "registros";
            $datos = array(
                "id" => $_POST["id"],
                "nombre" => $_POST["actualizarNombre"], 
                "email" => $_POST["actualizarEmail"], 
                "password" => $password
            );

            $respuesta = ModeloFormularios::mdlActualizar($tabla, $datos);
            return $respuesta;
        }
    }

    #eliminar registro sera no statico
    public function CTReliminar()
    {
        if (isset($_POST["eliminar"])) {
            $tabla = "registros";
            $datos = $_POST["eliminar"];
            $respuesta = ModeloFormularios::mdlEliminarRegistro($tabla, $datos);
            if ($respuesta == "ok") {
                echo "<script>
                    if(window.history.replaceState){
                        window.history.replaceState(null,null,window.location.href);
                    }
                </script>";
                echo "
                <script>
                    setTimeout(function(){
                        window.location = 'index.php?pagina=inicio';
                    }, 3000);
                </script>
                ";
            }
        }
    }

}
?>