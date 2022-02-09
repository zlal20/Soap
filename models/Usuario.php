<?php

class Usuario extends Conectar
{
    public function insert_usuario($nombre, $apellido, $correo)
    {
        $conectar = parent::conexion();
        $sql = "INSERT INTO usuario (id,nombre,apellido,correo,estado) VALUES (NULL,?,?,?,'1');";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1, $nombre);
        $stmt->bindValue(2, $apellido);
        $stmt->bindValue(3, $correo);
        $stmt->execute();
    }
}
