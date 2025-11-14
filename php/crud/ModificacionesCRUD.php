<?php
    require_once 'conexion.php';
    class ModificacionesCRUD{
        public static function recibirRegistros(){
            global $conexion;
            $selectSql = "Select * from modificaciones";
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
        public static function anadirModificacion(Modificacion $modificacion){
            global $conexion;
            $insertSql = "Insert into modificaciones (TipoMovimiento,Fecha,TrabajadorId,CopiaVideoJuegoId,VideojuegoId) values (?,?,?,?,?)";
            try {
                $stmt = mysqli_prepare($conexion, $insertSql);
                if (!$stmt) {
                    throw new Exception("Error al preparar la consulta: " . mysqli_error($conexion));
                }

                $TipoMovimiento = $modificacion->getTipoMovimiento();
                $Fecha = $modificacion->getFecha()->format('Y-m-d H:i:s');
                $TrabajadorId = $modificacion->getTrabajadorId();
                $CopiaVideoJuegoId = $modificacion->getCopiaVideojuegoId();
                $VideojuegoId = $modificacion->getVideojuegoId();

                mysqli_stmt_bind_param(
                    $stmt,
                    "ssiii",
                    $TipoMovimiento,
                    $Fecha,
                    $TrabajadorId,
                    $CopiaVideoJuegoId,
                    $VideojuegoId
                );

                $resultado = mysqli_stmt_execute($stmt);

                if (!$resultado) {
                    throw new Exception("Error al ejecutar el INSERT: " . mysqli_stmt_error($stmt));
                }

                mysqli_stmt_close($stmt);

            } catch (Exception $e) {
                echo "Error al añadir modificacion: " . $e->getMessage();
            }
        }
        public static function eliminarModificacion(int $ModificacionId){
            global $conexion;
            $deleteSql = "Delete from modificaciones where ModificacionId = ? ";

            try {
                $stmt = mysqli_prepare($conexion, $deleteSql);
                if (!$stmt) {
                    throw new Exception("Error al preparar la consulta: " . mysqli_error($conexion));
                }

                mysqli_stmt_bind_param(
                    $stmt,
                    "i",
                    $ModificacionId
                );

                $resultado = mysqli_stmt_execute($stmt);

                if (!$resultado) {
                    throw new Exception("Error al ejecutar el DELETE: " . mysqli_stmt_error($stmt));
                }
                mysqli_stmt_close($stmt);

            } catch (Exception $e) {
                echo "Error al eliminar modificacion: " . $e->getMessage();
            }
        }
        public static function modificarModificacion(Modificacion $modificacion, int $ModificacionId){
            global $conexion;
            $modificarSql = "Update modificaciones set TipoMovimiento = ?, Fecha = ?, TrabajadorId = ?, CopiaVideoJuegoId = ? where ModificacionId = ?";

            try {
                $stmt = mysqli_prepare($conexion, $modificarSql);
                if (!$stmt) {
                    throw new Exception("Error al preparar la consulta: " . mysqli_error($conexion));
                }

                $TipoMovimiento = $modificacion->getTipoMovimiento();
                $Fecha = $modificacion->getFecha()->format('Y-m-d H:i:s');
                $TrabajadorId = $modificacion->getTrabajadorId();
                $CopiaVideoJuegoId = $modificacion->getCopiaVideojuegoId();
                $ModificacionId = $modificacion->getModificacionId();

                mysqli_stmt_bind_param(
                    $stmt,
                    "ssiii",
                    $TipoMovimiento,
                    $Fecha,
                    $TrabajadorId,
                    $CopiaVideoJuegoId,
                    $ModificacionId
                );

                $resultado = mysqli_stmt_execute($stmt);

                if (!$resultado) {
                    throw new Exception("Error al ejecutar el UPDATE: " . mysqli_stmt_error($stmt));
                }

                mysqli_stmt_close($stmt);

            } catch (Exception $e) {
                echo "Error al modificar Modificacion: " . $e->getMessage();
            }
        }
        
    }