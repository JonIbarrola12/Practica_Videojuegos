<?php
    require_once 'conexion.php';
    class TrabajadoresCRUD{
        public static function recibirRegistros(){
            global $conexion;
            $selectSql = "Select * from trabajadores";
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
        public static function anadirTrabajador(Trabajador $trabajador){
            global $conexion;
            $insertSql = "Insert into trabajadores (Nombre,Apellidos,Dni,FechaNacimiento,Email,Usuario,Contrasena,TiendaId) values (?,?,?,?,?,?,?,?)";
            try {
                $stmt = mysqli_prepare($conexion, $insertSql);
                if (!$stmt) {
                    throw new Exception("Error al preparar la consulta: " . mysqli_error($conexion));
                }

                $nombre = $trabajador->getNombre();
                $apellidos = $trabajador->getApellidos();
                $dni = $trabajador->getDni();
                $fechaNacimiento = $trabajador->getFechaNacimiento()->format('Y-m-d');
                $email = $trabajador->getEmail();
                $usuario = $trabajador->getUsuario();
                $contrasena = $trabajador->getContrasena();
                $tiendaId = $trabajador->getTiendaId();

                $contrasena = password_hash($contrasena, PASSWORD_DEFAULT);

                mysqli_stmt_bind_param(
                    $stmt,
                    "sssssssi",
                    $nombre,
                    $apellidos,
                    $dni,
                    $fechaNacimiento,
                    $email,
                    $usuario,
                    $contrasena,
                    $tiendaId
                );

                $resultado = mysqli_stmt_execute($stmt);

                if (!$resultado) {
                    throw new Exception("Error al ejecutar el INSERT: " . mysqli_stmt_error($stmt));
                }

                mysqli_stmt_close($stmt);

            } catch (Exception $e) {
                echo "Error al añadir trabajador: " . $e->getMessage();
            }
        }
        public static function eliminarTrabajador(string $usuario){
            global $conexion;
            $deleteSql = "Delete from trabajadores where Usuario = ? ";

            try {
                $stmt = mysqli_prepare($conexion, $deleteSql);
                if (!$stmt) {
                    throw new Exception("Error al preparar la consulta: " . mysqli_error($conexion));
                }

                mysqli_stmt_bind_param(
                    $stmt,
                    "s",
                    $usuario
                );

                $resultado = mysqli_stmt_execute($stmt);

                if (!$resultado) {
                    throw new Exception("Error al ejecutar el DELETE: " . mysqli_stmt_error($stmt));
                }
                mysqli_stmt_close($stmt);

            } catch (Exception $e) {
                echo "Error al eliminar trabajador: " . $e->getMessage();
            }
        }
        public static function modificarTrabajador(Trabajador $trabajador, string $usuario){
            global $conexion;

            $modificarSql = "UPDATE trabajadores SET Nombre = ?, Apellidos = ?, Dni = ?, FechaNacimiento = ?, Email = ?, TiendaId = ? WHERE Usuario = ?";

            try {
                $stmt = mysqli_prepare($conexion, $modificarSql);
                if (!$stmt) {
                    throw new Exception("Error al preparar la consulta: " . mysqli_error($conexion));
                }

                $nombre = $trabajador->getNombre();
                $apellidos = $trabajador->getApellidos();
                $dni = $trabajador->getDni();
                $fechaNacimiento = $trabajador->getFechaNacimiento()->format('Y-m-d');
                $email = $trabajador->getEmail();
                $tiendaId = $trabajador->getTiendaId();

                mysqli_stmt_bind_param(
                    $stmt,
                    "sssssis", 
                    $nombre,
                    $apellidos,
                    $dni,
                    $fechaNacimiento,
                    $email,
                    $tiendaId,
                    $usuario
                );

                $resultado = mysqli_stmt_execute($stmt);

                if (!$resultado) {
                    throw new Exception("Error al ejecutar el UPDATE: " . mysqli_stmt_error($stmt));
                }

                mysqli_stmt_close($stmt);

            } catch (Exception $e) {
                echo "Error al modificar trabajador: " . $e->getMessage();
            }
        }
        public static function cuantostrabajadores(){
            $trabajadores = self::recibirRegistros();
            return count($trabajadores);
        }
        
    }