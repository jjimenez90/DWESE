<?php

require_once '../require/comun.php';
$nombre = Peticion::get("nombre");
$carpeta = Peticion::get("carpeta");
$archivo = Ruta::getRutaPadre(Ruta::getRutaServidor()) . "repaso/$carpeta/$nombre";
header('Content-type:');
readfile($archivo);
?>
  