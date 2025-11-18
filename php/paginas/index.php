<!doctype html>
<?php session_start() ?>
<html lang="en">
    <head>
        <link rel="icon" type="image/png" href="../../images/favicon.png">
        <title>GAME</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />
        
        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

        <link href="../../css/estilos.css" rel="stylesheet"/>

        <?php require_once('../crud/conexion.php'); require_once('../crud/TrabajadoresCRUD.php'); require_once('../crud/TiendaCRUD.php') ?>
    </head>

    <body>
        <header>
            
            <div class="container">
                <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
                <a href="index.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
                    <img src="../../images/Game.png" class="img w-25">
                </a>
                <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="index.php" class="nav-link px-2 link-secondary">Pagina Principal</a></li>
                    <li><a href="inventario.php" class="nav-link px-2 link-dark">Inventario</a></li>
                    <li><a href="GestionEmpleados.php" class="nav-link px-2 link-dark">Gestionar Empleados</a></li>
                    <li><a href="GestionarVideojuegos.php" class="nav-link px-2 link-dark">Gestionar Videojuegos</a></li>
                </ul>
                <div class="col-md-3 text-end">
                    <!--Editar Para que aparezca el Usuario Registrado-->
                <?php
                    if (isset($_SESSION['Usuario'])) {
                        echo '
                        <span class="text-purple fw-bold"> Trabajador: ' . htmlspecialchars($_SESSION['Usuario']) . '</span>
                        <a href="./Login/Logout.php" class="btn btn-outline-danger ms-2">Cerrar Sesión</a>';
                    } else {
                        echo '
                        <a href="./Login/Index.php" class="btn btn-outline-purple me-2">Iniciar Sesión</a>
                        <a href="./Login/Index.php" class="btn btn-purple me-2">Registrarse</a>';
                    }
                ?>
                </header>
            </div>
        </header>
        <div class="container text-center my-5">
            <h2 class="fw-bold text-purple">Bienvenido a GAME Store</h2>
            <p class="lead text-muted">
                Gestiona tu tienda de forma rápida y sencilla: controla inventarios, empleados y videojuegos.
            </p>
            <p class="lead text-muted">

                Actualmente somos <?php if(TrabajadoresCRUD::cuantostrabajadores() == 1){
                    echo TrabajadoresCRUD::cuantostrabajadores() . " trabajador"; 
                }else{
                    echo TrabajadoresCRUD::cuantostrabajadores() . " trabajadores";
                }
                ?> 
            </p>
            <hr class="w-25 mx-auto">
        </div>
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                <img src="../../images/TiendaGame1.jpg" class="d-block w-100" alt="FotoTiendaGame1">
                </div>
                <div class="carousel-item">
                <img src="../../images/TiendaGame2.jpg" class="d-block w-100" alt="FotoTiendaGame2">
                </div>
                <div class="carousel-item">
                <img src="../../images/TiendaGame3.jpg" class="d-block w-100" alt="FotoTiendaGame3">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="container px-4" id="featured-3">
            <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
            <div class="feature col">
                <div class="d-flex align-items-center">
                    <div class="feature-icon d-inline-flex bg-purple bg-gradient rounded p-2 me-3">
                        <i class="bi bi-stack fs-4 text-white"></i>
                    </div>
                    <h2 class="m-0">Inventario</h2>
                </div>
                <p>Pagina para manejar el inventario de la tienda.</p>
                <a href="inventario.php" class="icon-link link-purple">
                Ir a Inventario
                </a>
            </div>
            <div class="feature col">
                <div class="d-flex align-items-center">
                    <div class="feature-icon d-inline-flex bg-purple bg-gradient rounded p-2 me-3">
                        <i class="bi bi-stack fs-4 text-white"></i>
                    </div>
                    <h2 class="m-0">Gestionar Empleados</h2>
                </div>
                <p>Pagina para gestionar los empleados de la tienda.</p>
                <a href="GestionEmpleados.php" class="icon-link link-purple">
                Ir a Gestionar Empleados 
                </a>
            </div>
            <div class="feature col">
                <div class="d-flex align-items-center">
                    <div class="feature-icon d-inline-flex bg-purple bg-gradient rounded p-2 me-3">
                        <i class="bi bi-stack fs-4 text-white"></i>
                    </div>
                    <h2 class="m-0">Gestionar Videojuegos</h2>
                </div>
                <p>Pagina para gestionar Videojuegos a todas las tiendas de GAME.</p>
                <a href="GestionarVideojuegos.php" class="icon-link link-purple">
                Ir a Gestionar Videojuegos 
                </a>
            </div>
            </div>
        </div>
        <div class="container my-5">
            <h1 class="text-center mb-4">Buscar Videojuegos</h1>

            <?php if (!empty($mensaje)): ?>
                <div class="alert alert-success"><?= htmlspecialchars($mensaje) ?></div>
            <?php endif; ?>

            <form method="post" class="mb-4">
                <select name="tiendaId" class="form-select mb-2" required>
                    <option value="">Seleccione una Tienda</option>
                    <?php 
                        $tiendas = TiendaCRUD::recibirRegistros();
                    if ($tiendas && mysqli_num_rows($tiendas) > 0):
                        while ($row = $tiendas->fetch_assoc()): ?>
                            <option value="<?= $row['TiendaId'] ?>"><?= "Direccion: " . htmlspecialchars($row['Direccion']) . " Pais: " . htmlspecialchars($row['Pais']) ?></option>
                        <?php endwhile;
                    else: ?>
                        <option value="">No hay videojuegos disponibles</option>
                    <?php endif; ?>
                </select>
                <label for="plataforma">Plataforma</label>
                <input type="text" name="plataforma" id="plataforma" placeholder="PS4" class="form-control mb-2" required>

                <button type="submit" name="buscar" class="btn btn-purple w-100">Buscar Videojuegos por Plataforma</button>
            </form>
            <?php 
                if (isset($_POST['buscar'])) {
                    TiendaCRUD::queVideojuegos($_POST['plataforma'], $_POST['tiendaId']);
                }
                ?>
        </div>
        <footer class="bg-dark text-white pt-4 pb-3">
            <div class="container">

                <!-- Sección superior: GAME y Enlaces -->
                <div class="d-flex flex-column flex-md-row justify-content-around align-items-start text-center text-md-start mb-4">
                
                <!-- Columna izquierda -->
                <div class="mb-3 mb-md-0">
                    <h4 class="fw-bold mb-1">GAME</h4>
                    <p class="mb-0">© 2025 Todos los derechos reservados.</p>
                </div>

                <!-- Columna derecha -->
                <div class="mb-3 mb-md-0">
                    <h5 class="fw-semibold mb-2">Enlaces</h5>
                    <ul class="list-unstyled mb-0">
                    <li><a href="./index.php" class="text-white text-decoration-none">Inicio</a></li>
                    <li><a href="./sobreNosotros" class="text-white text-decoration-none">Acerca de</a></li>
                    <li><a href="./contacto" class="text-white text-decoration-none">Contacto</a></li>
                    </ul>
                </div>

                </div>

                <hr class="border-secondary">

                <!-- Sección inferior: redes sociales -->
                <div class="text-center pt-2">
                <h5 class="fw-semibold mb-3">Redes Sociales:</h5>
                <a href="#" class="text-white me-3"><i class="bi bi-facebook"></i>Facebook</a>
                <a href="#" class="text-white me-3"><i class="bi bi-twitter"></i>Twitter</a>
                <a href="#" class="text-white"><i class="bi bi-instagram"></i>Instagram</a>
                </div>

            </div>
        </footer>

        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>