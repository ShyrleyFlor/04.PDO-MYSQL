<?php
require_once "../controladores/formularios.controlador.php";
require_once "../modelos/formularios.modelos.php";

class AjaxFormularios
{

    public $validarEmail;

    public function ajaxValidarEmail()
    {
        $item = "email";
        $valor = $this->validarEmail;

        // Depuración: Verifica que el valor se reciba correctamente
        // var_dump($valor);

        $respuesta = ControladorFormularios::listaregistro($item, $valor);
        // Filtrar la respuesta para que no incluya índices numéricos
        if (is_array($respuesta)) {
            $respuesta = array_filter($respuesta, function ($key) {
                return !is_numeric($key);
            }, ARRAY_FILTER_USE_KEY);
        }

        echo json_encode($respuesta);
        exit();

        // echo var_dump($respuesta);
    }
}

if (isset($_POST["validarEmail"])) {
    $valEmail = new AjaxFormularios();
    $valEmail->validarEmail = $_POST["validarEmail"];
    $valEmail->ajaxValidarEmail();
}
