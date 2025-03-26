<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--Script para Jquery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</head>

    <body class="sb-nav-fixed">
        
        <nav class="navbar navbar-dark bg-dark fixed-top">
            <div class="d-inline-flex ">
              <button class="navbar-toggler d-flex ms-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <a class="navbar-brand mx-2" href="#">Proyecto</a>

              <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                  <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Men&uacute;</h5>
                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                  <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">

                    <li class="nav-item mb-2">
                        <div >
                            <img class="d-inline-flex" style="width:3em;height:3em;" src="./imgs/user.png">
                            <a class="nav-link  mx-3 d-inline-flex" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Usuario Ejemplo
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark inline my-2">
                            <li><a class="dropdown-item" href="#">Configuraci&oacute;n</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Cerrar sesion</a></li>
                            </ul>

                        </div>
                        
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">P&aacute;gina Principal</a>
                    </li>


                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Cat&aacute;logos
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark">
                          <li><a class="dropdown-item" href="#">Melodia</a></li>
                          <li><a class="dropdown-item" href="#">Libros</a></li>
                          <li>
                            <hr class="dropdown-divider">
                          </li>
                          <li><a class="dropdown-item" href="#">Otros datos</a></li>
                        </ul>
                      </li>

                    <li class="nav-item">
                      <a class="nav-link" href="ipod.html">Ipod</a>
                    </li>
                    
                  </ul>
                  
                </div>
              </div>
            </div>
        </nav>
        <div class="my-3">&nbsp;</div>
        <div class="px-3"><!--contenido-->