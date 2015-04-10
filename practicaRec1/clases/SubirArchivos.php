<?php

/**
 * Description of SubirArchivos
 *
 * @author juanpablo
 * metodos:
 * setcarpetadestino($carpeta)[fijar el destino en el que queremos que se guarde el archivo,
 *       filtro solo texto en el parametro, no barras. 
 *       dentro de la carpeta repaso, al mismo nivel de htdocs(si no existe la carpeta se crea)
 * ]
 * settamaniomaximo($numero)
 * subir()[sube el archivo a la carpeta destino prefijada siempre que no supere el tamño maximo,
 *  si no esta establecido el tamaño o destino no lo sube.
 *       si son varios archivos debera de subirlos todos], los renombramos con numeros 1 2 3.. sin importar extension
 * constructor
 * 
 * --subir archivos y aplicacion que permita verlos
 *
 *   error 1: tamaño maximo excedido
 *   error 1.1: tamaño maximo no valido
 *   error 1.2: tamaño maximo no establecido
 *   error 2.1: no hay nombre carpeta
 *   error 2.2: no es valido el nombre carpeta
 *   error 3: no se ha elegido carpeta destino
 *   error 4: no existe un parametro file con el nombre especificado
 */
class SubirArchivos {

    private $nombre;
    private $carpetadestino;
    private $tamanomax;
    private $files;
    private $error;
    private $errores = array(
        "0" => "Sin error",
        "1" => "Tamaño máximo excedido",
        "1.1" => "Tamaño máximo no válido",
        "1.2" => "Tamaño máximo no establecido",
        "2.1" => "No hay nombre de carpeta",
        "2.2" => "Nombre de carpeta no válido",
        "3" => "No se ha elegido carpeta de destino",
        "4" => "No existe un parámetro con el nombre especificado"
    );

    function __construct($param) {
        $this->error = "0";
        if (!isset($_FILES[$param])) {
            $this->error = "4";
            return;
        }
        if (is_array($_FILES[$param]["name"])) {
            foreach ($_FILES[$param]['name'] as $file) {
                $this->nombre[] = "";
            }
            foreach ($_FILES[$param] as $key => $value) {
                $this->files[] = $value;
            }
            $contador = sizeof($_FILES[$param]['name']);
            for ($c = 0; $contador > $c; $c++) {
                $this->files[5][$c] = 0;
                $this->files[6][$c] = "";
            }
        } else {
            echo '<hr>';
            $this->nombre[] = "";
            $this->files[0][] = $_FILES[$param]["name"];
            $this->files[1][] = $_FILES[$param]["type"];
            $this->files[2][] = $_FILES[$param]["tmp_name"];
            $this->files[3][] = $_FILES[$param]["error"];
            $this->files[4][] = $_FILES[$param]["size"];
            $this->files[5][] = "0";
            $this->files[6][] = "";
        }
        $this->carpetadestino = "";
        $this->tamanomax = 0;
    }

    public function getNombreOriginal() {
        return $this->files[0];
    }
    
    public function getTipoArchivo(){
        return $this->files[1];
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getTamanomax() {
        return $this->tamanomax;
    }

    public function getError() {
        return $this->error;
    }

    public function getMensajeError() {
        return $this->errores[$this->error];
    }

    public function getFiles() {
        return $this->files;
    }

    public function setTamanomax($tamanomax) {
        if ($tamanomax == "") {
            $this->error = "1.1";
            return false;
        } else {
            if (!is_integer($tamanomax)) {
                $this->tamanomax = -1; // para controlar que no le asigne otro error
                $this->error = "1.1";
                return false;
            }
        }
        $this->tamanomax = $tamanomax;
        $this->error = "0";
        return $this->tamanomax;
    }

    //estamos obligados a escoger una carpeta de destino
    public function setCarpetadestino($param) {
        if (!$param) {
            $this->error = "2.1";
            return false;
        } else {
            $permitidos = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz _-123456789";
            for ($i = 0; $i < strlen($param); $i++) {
                if (strpos($permitidos, substr($param, $i, 1)) === false) {
                    $this->error = "2.2";
                    return false;
                }
            }
        }
        $this->carpetadestino = Ruta::getRutaPadre(Ruta::getRutaServidor()) . "repaso/" . $param . "/";
        $this->error = "0";
        //crear carpeta si no existe
        if (!file_exists($this->carpetadestino)) {
            mkdir($this->carpetadestino);
            return 1;
        }
        return true;
    }

    public function getCarpetadestino() {
        return $this->carpetadestino;
    }

    public function getNombres(){
//        var_dump($this->files[6]);
//        echo '<hr>';
        return $this->files[6];
    }


    public function subir() {
        if ($this->error != "0") {
            return false;
        }
        if ($this->carpetadestino == "") {
            $this->error = "3";
            return false;
        }
        if ($this->tamanomax == 0) {
            $this->error = "1.2";
            return false;
        }
        $contador = 0;
        for ($i = 0; $i < sizeof($this->files[0]); $i++) {
            if (($this->tamanomax) <= ($this->files[4][$i])) {
                $this->files[5][$i] = "1";
            } else {
                if ($this->files[3][$i] == 0) {
                    $contadornombre = 0;
                    $contador++;
                    while (file_exists($this->carpetadestino . $contadornombre)) {
                        $contadornombre++;
                    }
                    $this->nombre = (String) $contadornombre;
                    $this->files[6][$i] = $this->nombre;
                    move_uploaded_file($this->files[2][$i], $this->carpetadestino . $this->nombre);
                }
            }
        }
        return $contador;
    }

}
