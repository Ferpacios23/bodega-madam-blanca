
<?php
// Datos de conexión a la base de datos
$host = "localhost";
$user = "root";
$password = "";
$database = "pruebabodega";

// Crear la conexión
$conexion = new mysqli($host, $user, $password, $database);

// Verificar la conexión
if ($conexion->connect_error) {
   die("Conexión fallida: " . $conexion->connect_error);
}
?>
