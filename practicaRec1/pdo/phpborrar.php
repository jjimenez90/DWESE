<?php

require_once '../require/comun.php';
$nombre = Peticion::get("nombre");
$carpeta = Peticion::get("carpeta");
$bd = new BaseDatos(Configuracion::SERVIDOR, Configuracion::BASEDATOS, Configuracion::USUARIO, Configuracion::CLAVE);
$modeloArchivos = new ModeloArchivos($bd);
$archivo = new Archivos($nombre, $carpeta);
$i = $modeloArchivos->delete($archivo);
$bd->cerrarConexion();
$ruta = Ruta::getRutaPadre(Ruta::getRutaServidor()) . "repaso/" . $carpeta;
unlink($ruta . "/" . $nombre);
if (Metodos::is_dir_empty($ruta)) {
    rmdir($ruta);
    $r = 1;
    header("Location: index.php?delete&r=$i&folderdelete=$r");
} else {
    $r = 0;
    header("Location: index.php?delete&r=$i&folderdelete=$r");
}  

