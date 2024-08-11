<?php
require_once "conexion.php";

class ModeloFormularios
{
    static public function mdlRegistro($tabla, $datos)
    {
        echo "Valor de email: " . $datos["email"] . "\n";
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre ,email, password) VALUES (:nombre, :email, :password)");
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
        if ($stmt->execute()) {
            return "ok";
        } else {
            print_r(Conexion::conectar()->errorInfo());
        }
    }
    #listar todos los registros
    static public function mdlListarRegistros($tabla, $item, $valor)
    {
        if ($item == null && $valor == null) {
            $stmt = Conexion::conectar()->prepare("SELECT * , DATE_FORMAT(fecha, '%d/%m/%Y') AS fecha FROM $tabla ORDER BY fecha DESC");
            $stmt->execute();
            return $stmt->fetchAll();
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT * , DATE_FORMAT(fecha, '%d/%m/%Y') AS fecha FROM $tabla WHERE $item = :$item ORDER BY fecha DESC");
            $stmt->bindParam(":". $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        }

    }
    #listar un registro
    static public function mdlListarUnRegistro($tabla, $item, $valor)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }
    #actualizar registro
    static public function mdlActualizar($tabla, $datos)
    {
        echo "Valor de email: " . $datos["email"] . "\n";
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre=:nombre, email=:email, password=:password WHERE id=:id");
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
        if ($stmt->execute()) {
            return "ok";
        } else {
            print_r(Conexion::conectar()->errorInfo());
        }
    }
}
?>