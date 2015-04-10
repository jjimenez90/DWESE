<?php
require_once '../require/comun.php';
$bd = new BaseDatos(Configuracion::SERVIDOR, Configuracion::BASEDATOS, Configuracion::USUARIO, Configuracion::CLAVE);
$modeloArchivos = new ModeloArchivos($bd);
$nombres = $modeloArchivos->getList();
$ruta = Ruta::getRutaPadre(Ruta::getRutaServidor()) . "repaso/";
$directorio = opendir($ruta); //ruta actual
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
                        <a href="#">Carpetas</a>
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
                                <?php
                                echo "<h3>directorio /</h3><br>";
                                echo '<table border="1">';
                                echo "<tr>";
                                echo '<th style="text-align: center">&nbsp;&nbsp;Carpetas&nbsp;&nbsp;</th>';
                                echo "</tr>";
                                while (($archivo = readdir($directorio)) !== false) {
                                    if ((is_dir($ruta . $archivo) && $archivo != "." && $archivo != "..")) {
                                        ?>
                                        <tr>
                                            <td style="text-align: center">&nbsp;&nbsp;<a href='viewlista.php?carpeta=<?php echo $archivo; ?>'><?php echo $archivo; ?></a>&nbsp;&nbsp;</td>
                                            <?php
                                        }
                                    }
                                    closedir($directorio);
                                    ?>
                                </tr>
                            </table>
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
