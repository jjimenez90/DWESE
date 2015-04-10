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
                            <?php
                            require_once '../require/comun.php';
                            $carpeta = Peticion::get("carpeta");
                            $nombre = Peticion::get("nombre");
                            $bd = new BaseDatos(Configuracion::SERVIDOR, Configuracion::BASEDATOS, Configuracion::USUARIO, Configuracion::CLAVE);
                            $modelo = new ModeloArchivos($bd);
                            $archivos = $modelo->get($nombre, $carpeta);
                            echo "<h1> Editar nombre de " . $archivos->getNombreoriginal() . "</h1>";
                            ?>
                            <form action = "phpeditar.php" method = "POST">
                                <input type = "hidden" name = "nombre" value = "<?php echo $archivos->getNombre(); ?>"/>
                                <input type = "hidden" name = "carpeta" value = "<?php echo $archivos->getCarpeta(); ?>"/>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>Carpeta </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id = "" type = "text" name = "" value = "<?php echo $archivos->getCarpeta(); ?>" placeholder = "nombre" readonly/><br><br>
                                <label>Nombre Archivo </label>&nbsp;&nbsp;&nbsp;<input id = "nombreoriginal" type = "text" name = "nombreoriginal" value = "<?php echo $archivos->getNombreoriginal(); ?>" placeholder = "nombre" required = "">
                                <br><br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type = "submit" value = "Editar">
                            </form>
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
