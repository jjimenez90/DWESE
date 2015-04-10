<?php

class Peticion {

    //leer los datos a traves de get
    public static function get($nombre) {
        if (isset($_GET[$nombre])) {
            if(is_array($_GET[$nombre])){
                return self::leerArray($_GET[$nombre]);
            }
            return $_GET[$nombre];
        } else {
            return NULL;
        }
    }

    //leer los datos a traves de post
    public static function post($nombre) {
        if (isset($_POST[$nombre])) {
            if(is_array($_POST[$nombre])){
                return self::leerArray($_POST[$nombre]);
            }
            return $_POST[$nombre];
        } else {
            return NULL;
        }
    }

    private static function leerArray($param, $filtrar=true) {
        $array = array();
        foreach ($param as $key => $value) {
            $array[] = $value;
        }
        return $array;
    }

    //comprobamos si es get
    public static function isGet() {
        return $_SERVER['REQUEST_METHOD'] == "GET";
    }

    //comprobamos si es post
    public static function isPost() {
        return $_SERVER['REQUEST_METHOD'] == "POST";
    }

    //comprobamos si es get
    public static function isGetV2() {
        return !self::isPostV2();
    }

    public static function isGetV3() {
        return isset($_GET);
    }

    //comprobamos si es post
    public static function isPostV2() {
        return isset($_POST);
    }

    //leer datos request 
    public static function request($nombre) {
        if (self::isGet()) {
            return self::get($nombre);
        } else if (self::isPost()) {
            return self::post($nombre);
        }
    }

    public static function requestV2($nombre) {
        if (self::isPost()) {
            $v = self::post($nombre);
            if ($v != NULL) {
                return $v;
            }
        }
        return self::get($nombre);
    }

    public static function requestV3($nombre) {
        $r = array();
        $r[] = self::get($nombre);
        $r[] = self::post($nombre);
        return $r;
    }
    
    public static function requestV4($nombre) {
        $v = self::get($nombre);
        if($v==NULL){
            return self::post($nombre);
        }
        return $v;
    }

    //ver cuantos parametros son get
    public static function getParams() {
        if (isset($_GET)) {
            return count($_GET);
        } else {
            return 0;
        }
    }

    //ver cuantos parametros son post
    public static function postParams() {
        if (isset($_POST)) {
            return count($_POST);
        } else {
            return 0;
        }
    }

    //ver cuantos parametros en total
    public static function params() {
        if (self::isGet()) {
            return self::getParams();
        }
        return self::postParams();
    }

    public static function paramsV2() {
        return self::getParams() + self::postParams();
    }

}
