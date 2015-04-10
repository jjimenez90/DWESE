<?php

require_once '../require/comun.php';
$nombre = Peticion::post("nombre");
$carpeta = Peticion::post("carpeta");
$nombreoriginal = Peticion::post("nombreoriginal");
$bd = new BaseDatos(Configuracion::SERVIDOR, Configuracion::BASEDATOS, Configuracion::USUARIO, Configuracion::CLAVE);
$modeloArchivos = new ModeloArchivos($bd);
$archivo=new Archivos($nombre, $carpeta, $nombreoriginal);
$i = $modeloArchivos->edit($archivo);
$bd->cerrarConexion();
header("Location: index.php?update&r=$i");
