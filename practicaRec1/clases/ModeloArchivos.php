<?php


class ModeloArchivos {
   private $bd;
    private $tabla = "archivos";

    function __construct(BaseDatos $bd) {
        $this->bd = $bd;
    }

    function add(Archivos $objeto) {
        $sql = "INSERT INTO $this->tabla VALUES(:nombre,:carpeta,:nombreoriginal);";
        $params["nombre"] = $objeto->getNombre();
        $params["carpeta"] = $objeto->getCarpeta();
        $params["nombreoriginal"] = $objeto->getNombreoriginal();
        $r = $this->bd->ejecutarConsulta($sql, $params);
        if (!$r) {
            return -1;
        }
        return $this->bd->obtenerAutoNumerico(); //0
    }

    function delete(Archivos $objeto) {
        $sql = "DELETE from $this->tabla where carpeta=:carpeta and nombre=:nombre;";
        $params["nombre"] = $objeto->getNombre();
        $params["carpeta"] = $objeto->getCarpeta();
        $r = $this->bd->ejecutarConsulta($sql, $params);
        if (!$r) {
            return -1;
        }
        return $this->bd->obtenerAutoNumerico(); //0
    }

//    function deletePorMatricula($id) {
//        //hemos creado un constructor de persona pasandole el id, haciendo lo mismo que delete, solo que con id.
//        return $this->delete(new Vehiculo($id));
//    }

    function edit(Archivos $objeto) {
        $sql = "update $this->tabla set nombreoriginal=:nombreoriginal where nombre=:nombre and carpeta=:carpeta;";
        $params["nombreoriginal"] = $objeto->getNombreoriginal();
        $params["carpeta"]=$objeto->getCarpeta();
        $params["nombre"] = $objeto->getNombre();
        $r = $this->bd->ejecutarConsulta($sql, $params);
        if (!$r) {
            return -1;
        }
        return $this->bd->obtenerAutoNumerico(); //0
    }

//    function editPK(Archivos $objetoOriginal, Archivos $objetoNuevo) {
//        $sql = "update $this->tabla set matricula=:matricula, modelo=:modelo,dnipropietario=:dnipropietario where matricula=:matriculapk;";
//        $params["modelo"] = $objetoNuevo->getModelo();
//        $params["dnipropietario"] = $objetoNuevo->getDnipropietario();
//        $params["matricula"] = $objetoNuevo->getMatricula();
//        $params["matriculapk"] = $objetoOriginal->getMatricula();
//        $r = $this->bd->setConsulta($sql, $params);
//        if (!$r) {
//            return -1;
//        }
//        return $this->bd->getAutonumerico(); //0
//    }

    function get($nombre,$carpeta) {
        $sql = "select * from $this->tabla where nombre=:nombre and carpeta=:carpeta;";
        $parametros["nombre"] = $nombre;
        $parametros["carpeta"] = $carpeta;
        $r = $this->bd->ejecutarConsulta($sql, $parametros);
        if ($r) {
            $archivo = new Archivos();
            $archivo->set($this->bd->obtenerFila());
            return $archivo;
        }
        return NULL;
    }

    function getCount($condicion = "1=1", $parametros = array()) {
        $sql = "select count(*) from $this->tabla where $condicion";
        $r = $this->bd->ejecutarConsulta($sql, $parametros);
        $resultado = $this->bd->obtenerFila();
        return $resultado[0];
//        return $r;
    }

    function getList($pagina = 0, $rpp = 10, $condicion = "1=1", $parametros = array(), $orderby = "1") {
        $list = array();
        //paginacion
        $principio = $pagina * $rpp;
        $sql = "select * from $this->tabla where $condicion order by $orderby limit $principio,$rpp";
        $r = $this->bd->ejecutarConsulta($sql, $parametros);
        if ($r) {
            while ($fila = $this->bd->obtenerFila()) {
                $archivo = new Archivos();
                $archivo->set($fila);
                $list[] = $archivo;
            }
        } else {
            return NULL;
        }

        return $list;
    }

    //
    function selectHtml($id, $name, $condicion, $parametros, $orderby = "1", $valorSeleccionado = "", $blanco = true, $textoBlanco = "&nbsp;") {
        $select = "<select name='$name' id='$id'>";
        if ($blanco) {
            $select.="<option value=''>$textoBlanco;</option>";
        }
        $lista = $this->getList($condicion, $parametros, $orderby);
        foreach ($lista as $objeto) {
            $selected = "";
            if ($objeto->getId() == $valorSeleccionado) {
                $selected = "selected";
            }
            $select.="<option $selected value='" . $objeto->getMatricula() . "'>" . $objeto->getModelo() . "," . $objeto->getDnipropietario() . "</option>";
        }
        $select.="</select>";
        return $select;
    }
}
