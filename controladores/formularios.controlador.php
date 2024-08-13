<?php
class ControladorFormularios
{
    #registro metodo
    static public function ctrRegistros()
    {

        if (isset($_POST["registroNombre"])) {
            #validacion de datos
            if (
                preg_match("/^[a-zA-ZáéíóúñÁÉÍÓÚÑ\s]{3,30}$/", $_POST["registroNombre"]) &&
                preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+[a-zA-Z]{2,}$/", $_POST["registroEmail"]) &&

                #esto obliga a que el password contenga al menos una letra minúscula, una letra mayúscula, un número y un caracter especial
                preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{2,30}$/", $_POST["registroPassword"])
            ) {
                $tabla = "registros";

                #Generamos token con md5()
                $token = md5($_POST["registroNombre"] . "+" . $_POST["registroEmail"]);

                #encriptar password
                $encriptarPassword = $_POST["registroPassword"];
                $datos = array(
                    "token" => $token,
                    "nombre" => $_POST["registroNombre"],
                    "email" => $_POST["registroEmail"],
                    "password" => $encriptarPassword,
                );
                $respuesta = ModeloFormularios::mdlRegistro($tabla, $datos);
                return $respuesta;
            } else {
                $respuesta = "error";
                return $respuesta;
            }
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
            $encriptarPassword = $_POST["ingresoPassword"];


            if ($respuesta["email"] == $_POST["ingresoEmail"] && $respuesta["password"] == $encriptarPassword) {
                ModeloFormularios::mdlActualizarIntentos($tabla, 0, $respuesta["token"]);
                $_SESSION["validarIngreso"] = "ok";
                echo "<script>
                if(window.history.replaceState){
                    window.history.replaceState(null,null,window.location.href);
                }
                window.location = 'inicio';
            </script>";
                echo "<div class='alert alert-success'>Ingreso exitoso</div>";
            } else {
                if ($respuesta["intentos_fallidos"] < 3) {
                    $intentosfallidos = $respuesta["intentos_fallidos"] + 1;
                    ModeloFormularios::mdlActualizarIntentos($tabla, $intentosfallidos, $respuesta["token"]);
                } else {
                    echo '<div class="alert alert-warning">Intentos fallidos maximos alcanzado</div>';
                }
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
            if (
                preg_match("/^[a-zA-ZáéíóúñÁÉÍÓÚÑ\s]{3,30}$/", $_POST["actualizarNombre"]) &&
                preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+[a-zA-Z]{2,}$/", $_POST["actualizarEmail"])
            ) {
                $tabla = "registros";
                $item = "token";
                $valor = $_POST["tokenUsuario"];

                $usuario = ModeloFormularios::mdlListarRegistros($tabla, $item, $valor);

                $compararUsuario = md5($usuario["nombre"] . "+" . $usuario["email"]);

                if ($compararUsuario == $_POST["tokenUsuario"] && $_POST["idUsuario"] == $usuario["id"]) {

                    if ($_POST["actualizarPassword"] != "") {
                        if (
                            #esto obliga a que el password contenga al menos una letra minúscula, una letra mayúscula, un número y un caracter especial
                            preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{2,30}$/", $_POST["actualizarPassword"])
                        ) {
                            #encriptar password
                            $password = $_POST["actualizarPassword"];

                        }
                    } else {
                        $password = $_POST["passwordActual"];
                    }

                    $actualizar_token = md5($_POST["actualizarNombre"] . "+" . $_POST["actualizarEmail"]);

                    $datos = array(
                        "token" => $actualizar_token,
                        "nombre" => $_POST["actualizarNombre"],
                        "email" => $_POST["actualizarEmail"],
                        "password" => $password
                    );

                    $respuesta = ModeloFormularios::mdlActualizar($tabla, $datos);
                    return $respuesta;
                } else {
                    $respuesta = "error";
                    return $respuesta;
                }
            }
        }
    }

    #eliminar registro sera no statico
    public function CTReliminar()
    {
        if (isset($_POST["eliminar"])) {
            $tabla = "registros";
            $item = "token";
            $valor = $_POST["tokenUsuario"];

            $usuario = ModeloFormularios::mdlListarRegistros($tabla, $item, $valor);

            $compararUsuario = md5($usuario["nombre"] . "+" . $usuario["email"]);

            if ($compararUsuario != $_POST["eliminar"]) {

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
                        window.location = 'inicio';
                    }, 3000);
                </script>
                ";
                }
            }
        }
    }

}
