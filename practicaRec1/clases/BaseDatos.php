<?php

/*
 * Constructor que le pasamos como parametros (servidor, basededatos,usuario,clave, debe establecer la conexion con la base de datos.
 * Metodos:
 * cerrarConexion() -->cerrar la conexion contra la base de datos.
 * ejecutarConsulta(cadenaconsultaSQL,Aarray Asociativo con todos los parametros de la consulta)-->
 * obtenerAutoNumerico()-->metodo que devuelva el valor del ultimo autonumerico.
 * obtenerFila()-->nos devuelve la siguiente fila de la consulta que acabamos de ejecutar.
 * obtenerNumeroFilas()-->devuelve el rowcount.
 */

class BaseDatos {

    private $conexion = null;
    private $consulta=null;
    private $servidor=null;
    private $basedeDatos=null;
    private $usuario=null;
    private $clave=null;

    function __construct($servidor, $basedeDatos, $usuario, $clave) {
        try {
            $this->conexion = new PDO(
                    'mysql:host=' . $servidor . ';dbname=' . $basedeDatos, $usuario, $clave, array(
                PDO::ATTR_PERSISTENT => true,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8')
            );
        } catch (PDOException $e) {
            $this->conexion = "null";
        }
    }

    function ejecutarConsulta($consultaSQL, $arrayParametros) {
        $this->consulta = $this->conexion->prepare($consultaSQL);
        foreach ($arrayParametros as $key => $value) {
            $this->consulta->bindValue($key, $value);
        }
        return $this->consulta->execute();
    }

    function cerrarConexion() {
        $this->conexion = null;
    }

    function obtenerAutoNumerico() {
        return $this->conexion->lastInsertId();
    }

    function obtenerFila() {
        if ($this->consulta != null) {
            return $this->consulta->fetch();
        }
        return false;
    }

    function obtenerNumeroFilas() {
        if ($this->consulta != null) {
            return $this->consulta->rowCount();
        }
        return -1;
    }

}
