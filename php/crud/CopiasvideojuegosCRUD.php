<?php
require_once("conexion.php");
require_once("ModificacionesCRUD.php");
require_once("../clases/Modificacion.php");
class CopiasVideojuegosCRUD{
    public static function recibirRegistros(){
            global $conexion;
            $selectSql = "Select * from copiasvideojuegos";
            return mysqli_query($conexion,$selectSql);
        }
        public static function obtenerCopiasConTitulo() {
            global $conexion;
            $selectSql = "select c.* , v.Titulo from copiasvideojuegos c join videojuegos v on c.VideojuegoId = v.VideojuegoId";
            return mysqli_query($conexion, $selectSql);

        }
        public static function anadirCopiaVideojuego(CopiaVideojuego $copiaVideojuego){
            global $conexion;
            $insertSql = "Insert into copiasvideojuegos (PrecioNuevo,PrecioSeminuevo,PrecioCompraGame,Unidades,VideojuegoId,TiendaId) values (?,?,?,?,?,?)";
            try {
                $stmt = mysqli_prepare($conexion, $insertSql);
                if (!$stmt) {
                    throw new Exception("Error al preparar la consulta: " . mysqli_error($conexion));
                }

                $precioNuevo = $copiaVideojuego->getPrecioNuevo();
                $precioSeminuevo = $copiaVideojuego->getPrecioSeminuevo();
                $precioCompraGame = $copiaVideojuego->getPrecioCompraGame();
                $unidades = $copiaVideojuego->getUnidades();
                $tiendaId = $copiaVideojuego->getTiendaId();
                $videojuegoId = $copiaVideojuego->getVideojuegoId();

                mysqli_stmt_bind_param(
                    $stmt,
                    "dddiii",
                    $precioNuevo,
                    $precioSeminuevo,
                    $precioCompraGame,
                    $unidades,
                    $videojuegoId,
                    $tiendaId
                );

                $resultado = mysqli_stmt_execute($stmt);

                if (!$resultado) {
                    throw new Exception("Error al ejecutar el INSERT: " . mysqli_stmt_error($stmt));
                }

                mysqli_stmt_close($stmt);
                $copiaVideojuegoId = mysqli_insert_id($conexion);
                $copiaVideojuego->setCopiaVideojuegoId($copiaVideojuegoId);
                $modificacion = new Modificacion(null,'Insertar Copia de Videojuego',$_SESSION['id'],$copiaVideojuegoId,null);

                ModificacionesCRUD::anadirModificacion($modificacion);
            } catch (Exception $e) {
                echo "Error al añadir copia de videojuego: " . $e->getMessage();
            }
        }
        public static function eliminarCopiaVideojuego(int $copiaVideojuegoId){
            global $conexion;
            $deleteSql = "Delete from copiasvideojuegos where CopiaVideojuegoId = ? ";

            try {
                $stmt = mysqli_prepare($conexion, $deleteSql);
                if (!$stmt) {
                    throw new Exception("Error al preparar la consulta: " . mysqli_error($conexion));
                }

                mysqli_stmt_bind_param(
                    $stmt,
                    "i",
                    $copiaVideojuegoId
                );
                $resultado = mysqli_stmt_execute($stmt);

                if (!$resultado) {
                    throw new Exception("Error al ejecutar el DELETE: " . mysqli_stmt_error($stmt));
                }
                mysqli_stmt_close($stmt);
                $modificacion = new Modificacion(null,'Eliminar Copia de Videojuego',$_SESSION['id'],$copiaVideojuegoId,null);
                ModificacionesCRUD::anadirModificacion($modificacion);

            } catch (Exception $e) {
                echo "Error al eliminar copia de videojuego: " . $e->getMessage();
            }
        }
        public static function modificarVideojuego(CopiaVideojuego $copiaVideojuego, int $videojuegoId){
            global $conexion;

            $modificarSql = "UPDATE copiasvideojuegos SET PrecioNuevo = ?, PrecioSeminuevo = ?, PrecioCompraGame = ?, Unidades = ?, TiendaId = ? WHERE CopiaVideojuegoId = ?";

            try {
                $stmt = mysqli_prepare($conexion, $modificarSql);
                if (!$stmt) {
                    throw new Exception("Error al preparar la consulta: " . mysqli_error($conexion));
                }

                $precioNuevo = $copiaVideojuego->getPrecioNuevo();
                $precioSeminuevo = $copiaVideojuego->getPrecioSeminuevo();
                $precioCompraGame = $copiaVideojuego->getPrecioCompraGame();
                $unidades = $copiaVideojuego->getUnidades();
                $tiendaId = $copiaVideojuego->getTiendaId();

                mysqli_stmt_bind_param(
                    $stmt,
                    "dddiii", 
                    $precioNuevo,
                    $precioSeminuevo,
                    $precioCompraGame,
                    $unidades,
                    $tiendaId,
                    $copiaVideojuegoId
                );

                $resultado = mysqli_stmt_execute($stmt);

                if (!$resultado) {
                    throw new Exception("Error al ejecutar el UPDATE: " . mysqli_stmt_error($stmt));
                }

                mysqli_stmt_close($stmt);
                $modificacion = new Modificacion(null,'Modificar Copia de Videojuego',$_SESSION['id'],$copiaVideojuegoId,null);
                ModificacionesCRUD::anadirModificacion($modificacion);

            } catch (Exception $e) {
                echo "Error al modificar copia de videojuego: " . $e->getMessage();
            }
        }
    }

?>