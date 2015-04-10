<?php
require_once '../require/comun.php';
$bd = new BaseDatos(Configuracion::SERVIDOR, Configuracion::BASEDATOS, Configuracion::USUARIO, Configuracion::CLAVE);
$modeloArchivos = new ModeloArchivos($bd);
$carpeta = Peticion::get("carpeta");
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Listado De carpetas</title>

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/simple-sidebar.css" rel="stylesheet">

    </head>

    <body>

        <div id="wrapper">

            <!-- Sidebar -->
            <div id="sidebar-wrapper">
                <ul class="sidebar-nav">
                    <li class="sidebar-brand">
                        <a href="#">
                            Practica Archivos
                        </a>
                    </li>
                    <li>
                        <a href="index.php">Carpetas</a>
                    </li>
                    <li>
                        <a href="viewsubida.php">Subir Archivo/s</a>
                    </li>

                </ul>
            </div>
            <!-- /#sidebar-wrapper -->

            <!-- Page Content -->
            <div id="page-content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1>Listado de Carpetas y Archivos</h1>
                            <table border="1">
                                <tr>
                                    <th style="text-align: center">Nombre</th>
                                    <th style="text-align: center" colspan="3">Accion</th>
                                </tr>
                                <?php
                                echo "<h3>directorio /$carpeta</h3>";
                                $nombres = $modeloArchivos->getList(0, 10, "carpeta=:carpeta", array("carpeta" => $carpeta));
                                foreach ($nombres as $objeto) {
                                    ?>
                                    <tr>
                                        <td style="text-align: center">&nbsp;<?php echo $objeto->getNombreoriginal(); ?>&nbsp;</td>
                                        <td style="text-align: center">&nbsp;&nbsp;<a href='phpfotocarpetas.php?nombre=<?php echo $objeto->getNombre(); ?>&carpeta=<?php echo $carpeta; ?>'>Ver</a>&nbsp;&nbsp;</td>
                                        <td style="text-align: center">&nbsp;&nbsp;<a href="vieweditar.php?nombre=<?php echo $objeto->getNombre(); ?>&carpeta=<?php echo $carpeta; ?>">Editar </a>&nbsp;&nbsp;</td>
                                        <td style="text-align: center">&nbsp;&nbsp;<a href='phpborrar.php?nombre=<?php echo $objeto->getNombre(); ?>&carpeta=<?php echo $carpeta; ?>'>Borrar</a>&nbsp;&nbsp;</td>
                                        <?php
                                    }
                                    
                                    ?>
                                </tr>
                            </table>
                            <br>
                            <a href="index.php"><input type="button" value="Volver al directorio anterior"></a>
                        </div>




                        <!-- <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
                     </div>
                 </div>
             </div>
         </div>
                        <!-- /#page-content-wrapper -->

                    </div>
                    <!-- /#wrapper -->

                    <!-- jQuery -->
                    <script src="js/jquery.js"></script>

                    <!-- Bootstrap Core JavaScript -->
                    <script src="js/bootstrap.min.js"></script>

                    <!-- Menu Toggle Script -->
                    <script>
                        $("#menu-toggle").click(function (e) {
                            e.preventDefault();
                            $("#wrapper").toggleClass("toggled");
                        });
                    </script>

                    </body>

                    </html>
