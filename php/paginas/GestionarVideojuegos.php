<?php
require_once("../crud/conexion.php");
require_once("../crud/VideojuegosCRUD.php");
require_once("../clases/Videojuego.php");

session_start();

// Usuario simulado
$_SESSION['TrabajadorId'] = 2;

$mensaje = "";

// Insertar videojuego
if (isset($_POST['insertar'])) {
    $videojuego = new Videojuego(null, $_POST['titulo'], $_POST['anio'], $_POST['estudio'], $_POST['plataforma']);
    VideojuegosCRUD::anadirVideojuego(
        $videojuego
    );
    $mensaje = "Videojuego " . $videojuego->getTitulo() . " creado correctamente";
}

// Eliminar videojuego
if (isset($_POST['eliminar'])) {
    VideojuegosCRUD::eliminarVideojuego(
        $_POST['videojuegoId'],
    );
    $mensaje = "Videojuego eliminado correctamente";
}

// Obtener videojuegos actualizados
$videojuegos = VideojuegosCRUD::recibirRegistros();
?>

<!doctype html>
<html lang="en">
    <head>
        <link rel="icon" type="image/png" href="../../images/favicon.png">
        <title>Gestionar Videojuegos</title>
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
    </head>

    <body>
        <header>
            <div class="container">
                <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
                <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
                    <img src="../../images/Game.png" class="img w-25">
                </a>
                <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="index.php" class="nav-link px-2 link-dark">Pagina Principal</a></li>
                    <li><a href="inventario.php" class="nav-link px-2 link-dark">Inventario</a></li>
                    <li><a href="GestionEmpleados.php" class="nav-link px-2 link-dark">Gestionar Empleados</a></li>
                    <li><a href="GestionarVideojuegos.php" class="nav-link px-2 link-secondary">Gestionar Videojuegos</a></li>
                </ul>
                <div class="col-md-3 text-end">
                    <!--Editar Para que aparezca el Usuario Registrado-->
                <?php
                    if (isset($_SESSION['Usuario'])) {
                        echo '
                        <span class="text-purple fw-bold"> ' . htmlspecialchars($_SESSION['Usuario']) . '</span>
                        <a href="./Login/Logout.php" class="btn btn-outline-danger ms-2">Cerrar Sesión</a>';
                    } else {
                        echo '
                        <a href="./Login/Index.php" class="btn btn-outline-purple me-2">Iniciar Sesión</a>';
                    }
                ?>
                </div>
                </header>
            </div>
        </header>
        <div class="container my-5">
            <h1 class="text-center mb-4">Gestión de Videojuegos</h1>

            <?php if (!empty($mensaje)): ?>
                <div class="alert alert-success"><?= htmlspecialchars($mensaje) ?></div>
            <?php endif; ?>

            <h2>Insertar videojuego</h2>
            <form method="post" class="mb-4">
                <input type="text" name="titulo" placeholder="Título" class="form-control mb-2" required>
                <input type="number" name="anio" placeholder="Año de publicación" class="form-control mb-2">
                <input type="text" name="estudio" placeholder="Estudio de desarrollo" class="form-control mb-2">
                <input type="text" name="plataforma" placeholder="Plataforma" class="form-control mb-2">
                <button type="submit" name="insertar" class="btn btn-success w-100">Insertar</button>
            </form>

            <h2>Eliminar videojuego</h2>
            <form method="post" class="mb-4">
                <select name="videojuegoId" class="form-select mb-2" required>
                    <option value="">Seleccione un videojuego</option>
                    <?php 
                    if ($videojuegos && mysqli_num_rows($videojuegos) > 0):
                        while ($row = $videojuegos->fetch_assoc()): ?>
                            <option value="<?= $row['VideojuegoId'] ?>"><?= "Videojuego: " . htmlspecialchars($row['Titulo']) . " Plataforma: " . htmlspecialchars($row['Plataforma']) ?></option>
                        <?php endwhile;
                    else: ?>
                        <option value="">No hay videojuegos disponibles</option>
                    <?php endif; ?>
                </select>
                <button type="submit" name="eliminar" class="btn btn-danger w-100">Eliminar</button>
            </form>
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
                    <li><a href="./index.html" class="text-white text-decoration-none">Inicio</a></li>
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