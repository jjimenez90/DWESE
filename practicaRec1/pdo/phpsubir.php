<?php

require_once '../require/comun.php';
$subir = new SubirArchivos("archivo");
$carpeta = Peticion::post("carpeta");
$limite = Peticion::post("limite");
$limite = $limite * 1024;
$limite = $limite * 1024;
$bd = new BaseDatos(Configuracion::SERVIDOR, Configuracion::BASEDATOS, Configuracion::USUARIO, Configuracion::CLAVE);
$modelo = new ModeloArchivos($bd);
$tipo = $subir->getTipoArchivo();
if ($tipo[0] == "image/jpeg") {
    $subir->setCarpetadestino($carpeta);
    $subir->setTamanomax($limite);
    $r = $subir->subir();
    $nombre = $subir->getNombres();
    $nombreoriginal = $subir->getNombreOriginal();
    for ($j = 0; count($nombreoriginal) > $j; $j++) {
        $archivo = new Archivos($nombre[$j], $carpeta, $nombreoriginal[$j]);
        $i = $modelo->add($archivo);
    }
    $bd->cerrarConexion();
    header("Location:index.php?insert&r=$i&subido=$r");
} else {
    $r = -1;
    $i = -1;
    header("Location:index.php?insert&r=$i&subido=$r");
}

