<?php
require_once("../crud/conexion.php");
require_once("../crud/TrabajadoresCRUD.php");
require_once("../clases/Trabajador.php");
require_once("../crud/TiendaCRUD.php");
session_start();


$mensaje = "";

$sesionActiva = isset($_SESSION['Usuario']);

// Insertar Empleado
if (isset($_POST['insertar'])) {
    if ($sesionActiva) {
        $fechaNacimiento = new DateTime($_POST['fechaNacimiento']);
        $trabajador = new Trabajador(
            $_POST['nombre'],
            $_POST['apellidos'],
            $_POST['dni'],
            $fechaNacimiento,
            $_POST['email'],
            $_POST['usuario'],
            $_POST['contrasena'],
            (int)$_POST['tiendaId']
        );

        TrabajadoresCRUD::anadirTrabajador($trabajador);

        $mensaje = "Empleado '{$trabajador->getNombre()}' creado correctamente";
    } else {
        $mensaje = "⚠️ Debes iniciar sesión para insertar empleados.";
    }
}

// Modificar Empleado
if (isset($_POST['modificar'])) {
    if ($sesionActiva) {
        $nombreNuevo = $_POST['nombreNuevo'] ?? "";
        $apellidosNuevo = $_POST['apellidosNuevo'] ?? "";
        $dniNuevo = $_POST['dniNuevo'] ?? "";
        $fechaNacimientoNuevo = new DateTime($_POST['fechaNacimientoNuevo']);
        $emailNuevo = $_POST['emailNuevo'] ?? "";
        $usuarioNuevo = $_POST['usuarioNuevo'] ?? "";
        $tiendaIdNuevo = (int)$_POST['tiendaIdNuevo'];

        $trabajador = new Trabajador(
            $nombreNuevo,
            $apellidosNuevo,
            $dniNuevo,
            $fechaNacimientoNuevo,
            $emailNuevo,
            $usuarioNuevo,
            "",   // No cambiamos contraseña
            $tiendaIdNuevo
        );

        TrabajadoresCRUD::modificarTrabajador($trabajador, $_POST['usuarioExistente']);

        $mensaje = "Empleado '{$_POST['usuarioExistente']}' modificado con éxito.";
    } else {
        $mensaje = "⚠️ Debes iniciar sesión para modificar empleados.";
    }
}

if (isset($_POST['eliminar'])) {
    if ($sesionActiva) {

        // Verificar si intenta eliminarse a sí mismo
        if ($_POST['usuarioEliminar'] === $_SESSION['Usuario']) {
            $mensaje = "⚠️ No puedes eliminar tu propio usuario mientras tienes sesión activa.";
        } else {
            TrabajadoresCRUD::eliminarTrabajador($_POST['usuarioEliminar']);
            $mensaje = "Empleado eliminado con éxito.";
        }

    } else {
        $mensaje = "⚠️ Debes iniciar sesión para eliminar empleados.";
    }
}

// Obtener empleados y tiendas actualizados
$empleados = TrabajadoresCRUD::recibirRegistros();
$tiendas = TiendaCRUD::recibirRegistros();
?>

<!doctype html>
<html lang="en">
    <head>
        <link rel="icon" type="image/png" href="../../images/favicon.png">
        <title>Inventario</title>
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
                <a href="index.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
                    <img src="../../images/Game.png" class="img w-25">
                </a>
                <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="index.php" class="nav-link px-2 link-dark">Pagina Principal</a></li>
                    <li><a href="inventario.php" class="nav-link px-2 link-dark">Inventario</a></li>
                    <li><a href="GestionEmpleados.php" class="nav-link px-2 link-secondary">Gestionar Empleados</a></li>
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
                </div>
                </header>
            </div>
        </header>
        <div class="container my-5">
            <h1 class="text-center mb-4">Gestión de Empleados</h1>

            <?php if (!empty($mensaje)): ?>
                <div class="alert alert-success"><?= htmlspecialchars($mensaje) ?></div>
            <?php endif; ?>

            <h2>Insertar Empleados</h2>
            <form method="post" class="mb-4">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Ej: Eder" class="form-control mb-2" required>

                <label for="apellidos">Apellidos</label>
                <input type="text" name="apellidos" id="apellidos" placeholder="Ej: Pérez barrenetxea" class="form-control mb-2" required>

                <label for="dni">DNI</label>
                <input type="text" name="dni" id="dni" placeholder="Ej: 12345678A" class="form-control mb-2" required>

                <label for="fechaNacimiento">Fecha de Nacimiento</label>
                <input type="date" name="fechaNacimiento" id="fechaNacimiento" class="form-control mb-2" required>

                <label for="email">Correo electrónico</label>
                <input type="email" name="email" id="email" placeholder="Ej: correo@ejemplo.com" class="form-control mb-2" required>

                <label for="usuario">Usuario</label>
                <input type="text" name="usuario" id="usuario" placeholder="Ej: juan123" class="form-control mb-2" required>

                <label for="contrasena">Contraseña</label>
                <input type="password" name="contrasena" id="contrasena" placeholder="********" class="form-control mb-2" required>

                <label for="tiendaId">Tienda</label>
                <select name="tiendaId" class="form-select mb-2" required>
                    <option value="">Seleccione una Tienda</option>
                    <?php 
                    if ($tiendas && mysqli_num_rows($tiendas) > 0):
                        while ($row = $tiendas->fetch_assoc()): ?>
                            <option value="<?= $row['TiendaId'] ?>"><?= "Direccion: " . htmlspecialchars($row['Direccion']) . " Pais: " . htmlspecialchars($row['Pais']) ?></option>
                        <?php endwhile;
                    else: ?>
                        <option value="">No hay tiendas disponibles</option>
                    <?php endif; ?>
                </select>

                <button type="submit" name="insertar" class="btn btn-success w-100">Insertar Empleado</button>
            </form>
            
            <h2>Modificar empleado</h2>
            <form method="post" class="mb-5">
                <select name="usuarioExistente" class="form-select mb-2" required>
                    <option value="">Seleccione el usuario a modificar</option>
                    <?php 
                    if (!empty($empleados)): 
                        foreach ($empleados as $row): ?>
                            <option value="<?= htmlspecialchars($row['Usuario']) ?>">
                                <?= htmlspecialchars($row['Usuario']) ?> (<?= htmlspecialchars($row['Nombre'] . ' ' . $row['Apellidos']) ?>)
                            </option>
                        <?php endforeach; 
                    endif; ?>
                </select>
                <input type="text" name="nombreNuevo" placeholder="Nuevo nombre" class="form-control mb-2" required>
                <input type="text" name="apellidosNuevo" placeholder="Nuevos apellidos" class="form-control mb-2" required>
                <input type="text" name="dniNuevo" placeholder="Nuevo DNI" class="form-control mb-2" required>
                <input type="date" name="fechaNacimientoNuevo" class="form-control mb-2" required>
                <input type="email" name="emailNuevo" placeholder="Nuevo correo electrónico" class="form-control mb-2" required>
                <input type="number" name="tiendaIdNuevo" placeholder="Nuevo ID de Tienda" class="form-control mb-2" required>

                <button type="submit" name="modificar" class="btn btn-warning w-100 text-white">Modificar Empleado</button>
            </form>

            <h2>Eliminar empleados</h2>
            <form method="post" class="mb-4">
                <select name="usuarioEliminar" class="form-select mb-2" required>
                    <option value="">Seleccione un empleado</option>
                    <?php 
                    if (!empty($empleados)):
                        foreach ($empleados as $row): ?>
                            <option value="<?= htmlspecialchars($row['Usuario']) ?>">
                                <?= htmlspecialchars($row['Nombre'] . ' ' . $row['Apellidos']) ?> (<?= htmlspecialchars($row['Usuario']) ?>)
                            </option>
                        <?php endforeach;
                    else: ?>
                        <option value="">No hay empleados registrados</option>
                    <?php endif; ?>
                </select>

                <button type="submit" name="eliminar" class="btn btn-danger w-100"> Eliminar Empleado</button>
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