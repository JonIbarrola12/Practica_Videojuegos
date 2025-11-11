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
    registrarModificacion($conexion, 'Eliminar', $trabajadorId, $idJuego);

    mysqli_query($conexion, "DELETE FROM copiasvideojuegos WHERE VideojuegoId = $idJuego");
    mysqli_query($conexion, "DELETE FROM videojuegos WHERE VideojuegoId = $idJuego");

    return "Videojuego y sus copias eliminados con éxito y registrados en modificaciones.";
}

function registrarModificacion($conexion, $tipo, $trabajadorId, $idJuego) {
    $query = "INSERT INTO modificaciones (TipoMovimiento, Fecha, TrabajadorId, VideojuegoId)
            VALUES ('$tipo', NOW(), $trabajadorId, $idJuego)";
    mysqli_query($conexion, $query);
}

function obtenerVideojuegos($conexion) {
    return mysqli_query($conexion, "SELECT VideojuegoId, Titulo FROM videojuegos");
}
?>