<?php
    require_once 'conexion.php';
    class TiendaCRUD{
        public static function recibirRegistros(){
            global $conexion;
            $selectSql = "Select * from tiendas";
            try{
                $query = mysqli_query($conexion,$selectSql);
                if (!$query) {
                    throw new Exception("Error en la consulta: " . mysqli_error($conexion));
                }

                $resultados = [];
                while ($fila = mysqli_fetch_assoc($query)) {
                    $resultados[] = $fila;
                }

                return $resultados;
            }catch(Exception $e){
                echo "Error al obtener registros: " . $e->getMessage();
                return [];
            }
        }
        public static function añadirTienda(Tienda $tienda){
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
        
    }