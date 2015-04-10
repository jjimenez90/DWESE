<?php

class Archivos {

    private $nombre;
    private $carpeta;
    private $nombreoriginal;

    function __construct($nombre = null, $carpeta = null, $nombreoriginal = null) {
        $this->nombre = $nombre;
        $this->carpeta = $carpeta;
        $this->nombreoriginal = $nombreoriginal;
    }

    function set($datos, $inicio = 0) {
        $this->nombre = $datos[0 + $inicio];
        $this->carpeta = $datos[1 + $inicio];
        $this->nombreoriginal = $datos[2 + $inicio];
    }
    
    function getNombre() {
        return $this->nombre;
    }

    function getCarpeta() {
        return $this->carpeta;
    }

    function getNombreoriginal() {
        return $this->nombreoriginal;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setCarpeta($carpeta) {
        $this->carpeta = $carpeta;
    }

    function setNombreoriginal($nombreoriginal) {
        $this->nombreoriginal = $nombreoriginal;
    }



}
