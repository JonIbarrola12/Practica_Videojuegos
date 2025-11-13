<?php
require_once("conexion.php");

function insertarVideojuego($conexion, $titulo, $anio, $estudio, $plataforma, $trabajadorId) {
    $query = "INSERT INTO videojuegos (Titulo, AnioPublicacion, EstudioDesarrollo, Plataforma)
            VALUES ('$titulo', '$anio', '$estudio', '$plataforma')";
    mysqli_query($conexion, $query);

    $idJuego = mysqli_insert_id($conexion);

    registrarModificacion($conexion, 'Insertar', $trabajadorId, $idJuego);

    return "Videojuego '$titulo' insertado con éxito y añadido a la tabla modificaciones.";
}

function eliminarVideojuego($conexion, $idJuego, $trabajadorId) {
    // Registrar la eliminación antes de borrar
    registrarModificacion($conexion, 'Eliminar', $trabajadorId, $idJuego);

    // Borrar las copias relacionadas
    mysqli_query($conexion, "DELETE FROM copiasvideojuegos WHERE VideojuegoId = $idJuego");

    // Borrar el videojuego
    mysqli_query($conexion, "DELETE FROM videojuegos WHERE VideojuegoId = $idJuego");

    return "Videojuego eliminado y registrado en modificaciones.";
}

function registrarModificacion($conexion, $tipo, $trabajadorId, $idJuego) {
    $query = "INSERT INTO modificaciones (TipoMovimiento, Fecha, TrabajadorId, VideojuegoId)
              VALUES ('$tipo', NOW(), $trabajadorId, $idJuego)";
    if (!mysqli_query($conexion, $query)) {
        echo "Error al registrar modificación: " . mysqli_error($conexion);
    }
}

function obtenerVideojuegos($conexion) {
    return mysqli_query($conexion, "SELECT VideojuegoId, Titulo FROM videojuegos");
}
?>