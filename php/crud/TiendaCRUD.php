<?php
    require_once 'conexion.php';
    require_once 'CopiasVideojuegosCRUD.php';
    require_once 'VideojuegosCRUD.php';
    class TiendaCRUD{
        public static function recibirRegistros(){
            global $conexion;
            $selectSql = "Select * from tiendas";
            return mysqli_query($conexion,$selectSql);
        }
        public static function anadirTienda(Tienda $tienda){
            global $conexion;
            $insertSql = "Insert into tiendas (Direccion, Pais) values (?,?)";
            try {
                $stmt = mysqli_prepare($conexion, $insertSql);
                if (!$stmt) {
                    throw new Exception("Error al preparar la consulta: " . mysqli_error($conexion));
                }

                $direccion = $tienda->getDireccion();
                $pais = $tienda->getPais();

                mysqli_stmt_bind_param(
                    $stmt,
                    "ss",
                    $direccion,
                    $pais
                );

                $resultado = mysqli_stmt_execute($stmt);

                if (!$resultado) {
                    throw new Exception("Error al ejecutar el INSERT: " . mysqli_stmt_error($stmt));
                }

                mysqli_stmt_close($stmt);

            } catch (Exception $e) {
                echo "Error al añadir tienda: " . $e->getMessage();
            }
        }
        public static function eliminarTienda(int $TiendaId){
            global $conexion;
            $deleteSql = "Delete from tiendas where TiendaId = ?";

            try {
                $stmt = mysqli_prepare($conexion, $deleteSql);
                if (!$stmt) {
                    throw new Exception("Error al preparar la consulta: " . mysqli_error($conexion));
                }

                mysqli_stmt_bind_param(
                    $stmt,
                    "i",
                    $TiendaId,
                );

                $resultado = mysqli_stmt_execute($stmt);

                if (!$resultado) {
                    throw new Exception("Error al ejecutar el DELETE: " . mysqli_stmt_error($stmt));
                }
                mysqli_stmt_close($stmt);

            } catch (Exception $e) {
                echo "Error al eliminar tienda: " . $e->getMessage();
            }
        }
        public static function modificarTienda(Tienda $tienda, int $TiendaId){
            global $conexion;
            $modificarSql = "Update tiendas set Direccion = ?, Pais = ? where TiendaId = ?";

            try {
                $stmt = mysqli_prepare($conexion, $modificarSql);
                if (!$stmt) {
                    throw new Exception("Error al preparar la consulta: " . mysqli_error($conexion));
                }
                $TiendaId = $tienda->getTiendaId();
                $direccion = $tienda->getDireccion();
                $pais = $tienda->getPais();

                mysqli_stmt_bind_param(
                    $stmt,
                    "ssi",
                    $direccion,
                    $pais,
                    $TiendaId,
                );

                $resultado = mysqli_stmt_execute($stmt);

                if (!$resultado) {
                    throw new Exception("Error al ejecutar el UPDATE: " . mysqli_stmt_error($stmt));
                }

                mysqli_stmt_close($stmt);

            } catch (Exception $e) {
                echo "Error al modificar tienda: " . $e->getMessage();
            }
        }

        public static function queVideojuegos(string $plataforma, int $tiendaId) {
            $copiasVideojuegos = CopiasVideojuegosCRUD::recibirRegistros();
            $videojuegos = VideojuegosCRUD::recibirRegistros();
            $idvideojuegos = [];
            echo '<div class="container my-4">';
            echo '<h2 class="mb-4">Videojuegos encontrados</h2>';
            echo '<table class="table table-striped table-hover">';
            echo '<thead class="table-dark">';
            echo '<tr>';
            echo '<th>Título</th>';
            echo '<th>Año de Publicación</th>';
            echo '<th>Estudio</th>';
            echo '<th>Plataforma</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            while ($row = $copiasVideojuegos->fetch_assoc()) {
                if (!in_array($row['VideojuegoId'], $idvideojuegos)) {
                    $idvideojuegos[] = $row['VideojuegoId'];
                }
            }

            while ($row = $videojuegos->fetch_assoc()) {
                if (in_array($row['VideojuegoId'], $idvideojuegos) 
                    && $row['Plataforma'] == $plataforma) {

                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($row['Titulo']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['AnioPublicacion']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['EstudioDesarrollo']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['Plataforma']) . '</td>';
                    echo '</tr>';
                }
            }
            echo '</tbody>';
            echo '</table>';
            echo '</div>';
        }

    }