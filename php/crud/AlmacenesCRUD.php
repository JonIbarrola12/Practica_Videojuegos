<?php
    require_once 'conexion.php';
    class AlmacenesCRUD{
        public static function recibirRegistros(){
            global $conexion;
            $selectSql = "Select * from Almacenes";
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
        public static function anadirAlmacen(Almacen $Almacen){
            global $conexion;
            $insertSql = "Insert into almacenes (AlmacenId,TiendaId) values (?,?)";
            try {
                $stmt = mysqli_prepare($conexion, $insertSql);
                if (!$stmt) {
                    throw new Exception("Error al preparar la consulta: " . mysqli_error($conexion));
                }

                $AlmacenId = $Almacen->getAlmacenId();
                $TiendaId = $Almacen->getTiendaId();

                mysqli_stmt_bind_param(
                    $stmt,
                    "ii",
                    $AlmacenId,
                    $TiendaId

                );

                $resultado = mysqli_stmt_execute($stmt);

                if (!$resultado) {
                    throw new Exception("Error al ejecutar el INSERT: " . mysqli_stmt_error($stmt));
                }

                mysqli_stmt_close($stmt);

            } catch (Exception $e) {
                echo "Error al añadir almacen: " . $e->getMessage();
            }
        }
        public static function eliminarAlmacen(int $AlmacenId){
            global $conexion;
            $deleteSql = "Delete from almacenes where AlmacenId = ? ";

            try {
                $stmt = mysqli_prepare($conexion, $deleteSql);
                if (!$stmt) {
                    throw new Exception("Error al preparar la consulta: " . mysqli_error($conexion));
                }

                mysqli_stmt_bind_param(
                    $stmt,
                    "i",
                    $AlmacenId
                );

                $resultado = mysqli_stmt_execute($stmt);

                if (!$resultado) {
                    throw new Exception("Error al ejecutar el DELETE: " . mysqli_stmt_error($stmt));
                }
                mysqli_stmt_close($stmt);

            } catch (Exception $e) {
                echo "Error al eliminar alamacen: " . $e->getMessage();
            }
        }
        
    }