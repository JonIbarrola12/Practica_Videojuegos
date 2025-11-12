<?php
require_once("../crud/conexion.php");
require_once("../crud/VideojuegosCRUD.php");
session_start();

// Usuario simulado
$_SESSION['TrabajadorId'] = 2;

$mensaje = "";

// Insertar videojuego
if (isset($_POST['insertar'])) {
    $mensaje = insertarVideojuego(
        $conexion,
        $_POST['titulo'],
        $_POST['anio'],
        $_POST['estudio'],
        $_POST['plataforma'],
        $_SESSION['TrabajadorId']
    );
}

// Eliminar videojuego
if (isset($_POST['eliminar'])) {
    $mensaje = eliminarVideojuego(
        $conexion,
        $_POST['videojuegoId'],
        $_SESSION['TrabajadorId']
    );
}

// Obtener videojuegos actualizados
$videojuegos = obtenerVideojuegos($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Videojuegos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

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
                    <option value="<?= $row['VideojuegoId'] ?>"><?= htmlspecialchars($row['Titulo']) ?></option>
                <?php endwhile;
            else: ?>
                <option value="">No hay videojuegos disponibles</option>
            <?php endif; ?>
        </select>
        <button type="submit" name="eliminar" class="btn btn-danger w-100">Eliminar</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>