<?php
require_once("conexion.php");
require_once("ModificacionesCRUD.php");
require_once("../clases/Modificacion.php");
class VideojuegosCRUD{
    public static function recibirRegistros(){
            global $conexion;
            $selectSql = "Select * from videojuegos";
            return mysqli_query($conexion,$selectSql);
        }
        public static function anadirVideojuego(Videojuego $videojuego){
            global $conexion;
            $insertSql = "Insert into videojuegos (Titulo,AnioPublicacion,EstudioDesarrollo,Plataforma) values (?,?,?,?)";
            try {
                $stmt = mysqli_prepare($conexion, $insertSql);
                if (!$stmt) {
                    throw new Exception("Error al preparar la consulta: " . mysqli_error($conexion));
                }

                $titulo = $videojuego->getTitulo();
                $anioPublicacion = $videojuego->getAnioPublicacion();
                $estudioDesarrollo = $videojuego->getEstudioDesarrollo();
                $plataforma = $videojuego->getPlataforma();

                mysqli_stmt_bind_param(
                    $stmt,
                    "siss",
                    $titulo,
                    $anioPublicacion,
                    $estudioDesarrollo,
                    $plataforma
                );

                $resultado = mysqli_stmt_execute($stmt);

                if (!$resultado) {
                    throw new Exception("Error al ejecutar el INSERT: " . mysqli_stmt_error($stmt));
                }


                mysqli_stmt_close($stmt);
                $videojuegoId = mysqli_insert_id($conexion);
                $videojuego->setVideojuegoId($videojuegoId);
                $modificacion = new Modificacion(null,'Insertar Videojuego',$_SESSION['TrabajadorId'],null,$videojuegoId);

                ModificacionesCRUD::anadirModificacion($modificacion);
            } catch (Exception $e) {
                echo "Error al añadir videojuego: " . $e->getMessage();
            }
        }
        public static function eliminarVideojuego(int $videojuegoId){
            global $conexion;
            $deleteSql = "Delete from videojuegos where VideojuegoId = ? ";

            try {
                $stmt = mysqli_prepare($conexion, $deleteSql);
                if (!$stmt) {
                    throw new Exception("Error al preparar la consulta: " . mysqli_error($conexion));
                }

                mysqli_stmt_bind_param(
                    $stmt,
                    "i",
                    $videojuegoId
                );
                $resultado = mysqli_stmt_execute($stmt);

                if (!$resultado) {
                    throw new Exception("Error al ejecutar el DELETE: " . mysqli_stmt_error($stmt));
                }
                mysqli_stmt_close($stmt);
                $modificacion = new Modificacion(null,'Eliminar Videojuego',$_SESSION['TrabajadorId'],null,$videojuegoId);
                ModificacionesCRUD::anadirModificacion($modificacion);

            } catch (Exception $e) {
                echo "Error al eliminar videojuego: " . $e->getMessage();
            }
        }
        public static function modificarVideojuego(Videojuego $videojuego, int $videojuegoId){
            global $conexion;

            $modificarSql = "UPDATE videojuegos SET Titulo = ?, AnioPublicacion = ?, Dni = ?, EstudioDesarrollo = ?, Plataforma = ? WHERE VideojuegoId = ?";

            try {
                $stmt = mysqli_prepare($conexion, $modificarSql);
                if (!$stmt) {
                    throw new Exception("Error al preparar la consulta: " . mysqli_error($conexion));
                }

                $titulo = $videojuego->getTitulo();
                $anioPublicacion = $videojuego->getAnioPublicacion();
                $estudioDesarrollo = $videojuego->getEstudioDesarrollo();
                $plataforma = $videojuego->getPlataforma();

                mysqli_stmt_bind_param(
                    $stmt,
                    "siss", 
                    $titulo,
                    $anioPublicacion,
                    $estudioDesarrollo,
                    $plataforma
                );

                $resultado = mysqli_stmt_execute($stmt);

                if (!$resultado) {
                    throw new Exception("Error al ejecutar el UPDATE: " . mysqli_stmt_error($stmt));
                }

                mysqli_stmt_close($stmt);
                $modificacion = new Modificacion(null,'Eliminar Videojuego',$_SESSION['TrabajadorId'],null,$videojuegoId);
                ModificacionesCRUD::anadirModificacion($modificacion);

            } catch (Exception $e) {
                echo "Error al modificar videojuego: " . $e->getMessage();
            }
        }
}
?>