<?php
require_once("conexion.php");
require_once("funcionesVideojuego.php");

// Inserta una copia de videojuego
function insertarCopiaVideojuego($conexion, $videojuegoId, $tiendaId, $precioNuevo, $precioSeminuevo, $precioCompra, $unidades) {
    // Obtener el AlmacenId de la tienda
    $res = mysqli_query($conexion, "SELECT AlmacenId FROM almacenes WHERE TiendaId = $tiendaId LIMIT 1");
    if ($res && mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $almacenId = $row['AlmacenId'];
    } else {
        return "Error: No existe un almacén para esta tienda.";
    }

    $query = "INSERT INTO copiasvideojuegos 
              (PrecioNuevo, PrecioSeminuevo, PrecioCompraGame, Unidades, VideojuegoId, AlmacenId) 
              VALUES ($precioNuevo, $precioSeminuevo, $precioCompra, $unidades, $videojuegoId, $almacenId)";
    if (mysqli_query($conexion, $query)) {
        return "Copia de videojuego insertada correctamente.";
    } else {
        return "Error al insertar copia: " . mysqli_error($conexion);
    }
}

function eliminarCopiaVideojuego($conexion, $copiaId) {
    mysqli_query($conexion, "DELETE FROM copiasvideojuegos WHERE CopiaVideojuegoId = $copiaId");
}

function registrarModificacionCopia($conexion, $tipo, $trabajadorId, $videojuegoId, $copiaId = null) {
    mysqli_query($conexion, "INSERT INTO modificaciones (TipoMovimiento, Fecha, TrabajadorId, VideojuegoId, CopiaVideojuegoId)
                             VALUES ('$tipo', NOW(), $trabajadorId, $videojuegoId, ".($copiaId ?? "NULL").")");
}

function obtenerCopias($conexion) {
    return mysqli_query($conexion, "SELECT c.CopiaVideojuegoId, v.Titulo, t.Direccion, c.Unidades, 
                                           c.PrecioNuevo, c.PrecioSeminuevo, c.PrecioCompraGame, v.VideojuegoId
                                    FROM copiasvideojuegos c
                                    JOIN almacenes a ON c.AlmacenId = a.AlmacenId
                                    JOIN tiendas t ON a.TiendaId = t.TiendaId
                                    JOIN videojuegos v ON c.VideojuegoId = v.VideojuegoId");
}
?>