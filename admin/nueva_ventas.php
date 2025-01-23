<?php
session_start();

// Verifica si el usuario ha iniciado sesión y tiene el rol de administrador (id_rol == 2)
if (!isset($_SESSION['id_rol']) || $_SESSION['id_rol'] != 1) {
    // Si no tiene el rol correcto, redirigir al usuario a la página principal
    header("Location: ../index.php");
    exit();
}

include("./conexion.php");


// Obtener categorías para el select
$categorias = $conexion->query("SELECT * FROM Categorias");

// Agregar un producto
if (isset($_POST['agregar'])) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $id_categoria = $_POST['id_categoria'];

    // Subir imagen
    $imagen = $_FILES['imagen']['name'];
    $ruta = '../assets/img/tienda/' . basename($imagen);
    move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);

    $conexion->query("INSERT INTO Productos (nombre_producto, descripcion, precio, stock, imagen_url, id_categoria) 
                  VALUES ('$nombre', '$descripcion', '$precio', '$stock', '$ruta', '$id_categoria')");
    header('Location: productos.php');
}

// Eliminar un producto
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $conexion->query("DELETE FROM Productos WHERE id_producto = $id");
    header('Location: productos.php');
}

// Obtener el producto a editar
if (isset($_GET['editar'])) {
    $id_editar = $_GET['editar'];
    $producto_editar = $conexion->query("SELECT * FROM Productos WHERE id_producto = $id_editar")->fetch_assoc();
}

// Actualizar un producto
if (isset($_POST['actualizar'])) {
    $id_producto = $_POST['id_producto'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $id_categoria = $_POST['id_categoria'];

    // Subir nueva imagen si se proporciona
    if (!empty($_FILES['imagen']['name'])) {
        $imagen = $_FILES['imagen']['name'];
        $ruta = './assets/img/' . basename($imagen);
        move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);
        $conexion->query("UPDATE Productos SET nombre_producto='$nombre', descripcion='$descripcion', precio='$precio', 
                      stock='$stock', imagen_url='$ruta', id_categoria='$id_categoria' WHERE id_producto='$id_producto'");
    } else {
        $conexion->query("UPDATE Productos SET nombre_producto='$nombre', descripcion='$descripcion', precio='$precio', 
                      stock='$stock', id_categoria='$id_categoria' WHERE id_producto='$id_producto'");
    }
    header('Location: productos.php');
}

$result = $conexion->query("SELECT * FROM Productos");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../assets/css/styles2.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/png" href="../assets/icon/logo.png">

</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="./admin.php">Administrator</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

    </nav>
    <div id="layoutSidenav">
        <?php include("./nav.php"); ?>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../assets/js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>