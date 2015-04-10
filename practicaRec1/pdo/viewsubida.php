<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Listado De carpetas</title>

        <script src="js/script.js"></script>
        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/simple-sidebar.css" rel="stylesheet">
        <style>
            .thumb {
                height: 75px;
                border: 1px solid #000;
                margin: 10px 5px 0 0;
            }
        </style>
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
                        <a href="#">Subir Archivo/s</a>
                    </li>

                </ul>
            </div>
            <!-- /#sidebar-wrapper -->

            <!-- Page Content -->
            <div id="page-content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1>Subir Archivos</h1>
                            <form action="phpsubir.php" method="POST" enctype="multipart/form-data">
                                <label>Carpeta</label>&nbsp;<input type=text name="carpeta" required/><br><br>
                                <label>Limite</label>&nbsp;&nbsp;&nbsp;<input type=text name="limite" required/>&nbsp;<label>MB</label><br><br>
                                <input type="file" id="files" name="archivo[]" value="" multiple required />
                                <output id="list"></output>
                                <br>
                                <input type="submit" value="Enviar" />
                            </form>
                        </div>
                        <!-- <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>-->
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
