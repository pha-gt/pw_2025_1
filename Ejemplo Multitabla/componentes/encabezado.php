<?php 
session_start();
$URL_SERVICIO = "192.168.10.69/tareas_almacen";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAyP Web</title>
   
    <!--link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" /-->


    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"> </script>

    <script src="node_modules/jquery/dist/jquery.min.js"> </script>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script>
    </script>

</head>

        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
        </symbol>
        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
        </symbol>
        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </symbol>
        </svg>



   
    <body class="sb-nav-fixed">

    <?php require("./componentes/notificaciones.php"); ?>



        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="home.php">Ejemplo </a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                
            </div>
            <!-- Navbar-->

            <?php if(isset($_SESSION['userId'])){ ?>
                <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i>  <?php echo $_SESSION['userNombre']; ?></a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="./API/seguridad/seguridad.php?opt=1">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            <?php }else{ ?>
                <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                    <li class="nav-item ">
                        <a type="button"  href="login.php" class="nav-link" >
                            Login
                        </a>
                        
                    </li>
                </ul>

            <?php }?>




        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">







                            <div class="sb-sidenav-menu-heading">Actividades</div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseActividades" aria-expanded="false" aria-controls="collapseActividades">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-person-chalkboard"></i></div>
                                Operaciones
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>

                            <div class="collapse" id="collapseActividades" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="index.php" >Registro</a>

                                    <?php if(isset($_SESSION['userId']) && isset($_SESSION['permisoAcceso']) && $_SESSION['permisoAcceso'] ==1 ){ ?>
                                        <a class="nav-link" href="nuevo_registro.php">
                                            <div class="sb-nav-link-icon"><i class="fa-solid fa-plus"></i></div>
                                            Nuevo Registro
                                        </a>
                                    <?php }
                                        if(isset($_SESSION['userId']) && isset($_SESSION['permisoAdm']) && $_SESSION['permisoAdm'] ==1 ){
                                        ?>
                                            <a class="nav-link" href="actividades.php">
                                                <div class="sb-nav-link-icon"><i class="fa-solid fa-list-check"></i></div>
                                                Actividades
                                            </a>
                                            <a class="nav-link" href="reporte.php">
                                                <div class="sb-nav-link-icon"><i class="fa-solid fa-book-open"></i></div>
                                                Reportes
                                            </a>
            
                                    <?php }?>

                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseDoc" aria-expanded="false" aria-controls="collapseDoc">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-truck"></i></div>
                                Documentaci&oacute;n
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            
                            <div class="collapse" id="collapseDoc" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    
                                        <a class="nav-link" href="registrar_guia.php" >Registro Guías PE.</a>
                                    
                                    
                                        <a class="nav-link" href="producto_peso_volumen.php" >Registro de productos</a>

                                </nav>
                            </div>


                            <div class="sb-sidenav-menu-heading">CAyP</div>


                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAlmacen" aria-expanded="false" aria-controls="collapseAlmacen">
                                <div class="sb-nav-link-icon"><i class="fas fa-boxes"></i></div>
                                Almac&eacute;n
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseAlmacen" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="almacen_recepcion.php">Recepci&oacute;n de producto</a>
                                    <a class="nav-link" href="almacen_admon.php">Admin. de Amac&eacute;n</a>
                                </nav>
                            </div>


                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseOperaciones" aria-expanded="false" aria-controls="collapseOperaciones">
                                <div class="sb-nav-link-icon"><i class="fas fa-tools"></i></div>
                                Operaciones
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseOperaciones" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">

                                <?php if(isset($_SESSION['userId']) && isset($_SESSION['permisoEmpaque']) && $_SESSION['permisoEmpaque'] ==1 ){ ?>
                                    <a class="nav-link" href="empaque.php">
                                        Empacado
                                    </a>
                                <?php }?>
                                   
                                </nav>
                            </div>


                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseReporte" aria-expanded="false" aria-controls="collapseReporte">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-book-open"></i></div>
                                Reportes
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseReporte" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="reporte_empaque.php">
                                        Reporte empacado
                                    </a>
                                   
                                </nav>
                            </div>
                            




                            

                        </div>
                    </div>
                    
                </nav>
            </div>
                <div id="layoutSidenav_content">

                
    <!-- Modal -->
    <div class="modal fade" id="modal_editor" tabindex="-1" aria-labelledby="modal_editor_titulo" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modal_editor_titulo"> </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="modal_contenido">
        
        </div>
        <div class="modal-footer" id="modal_editor_footer">
        </div>
        </div>
    </div>
    </div>


    



            








    