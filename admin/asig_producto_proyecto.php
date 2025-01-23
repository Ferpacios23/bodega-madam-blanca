<?php
include './conexion.php';
session_start();

// Verifica si el usuario tiene el rol de administrador (id_rol == 1)
if (!isset($_SESSION['id_rol']) || $_SESSION['id_rol'] != 1) {
    header("Location: ../index.php");
    exit();
}

// Obtener categorías
$categorias = $conexion->query("SELECT * FROM Categorias");

// Obtener proyectos
$proyectos = $conexion->query("SELECT * FROM Proyectos");

// Asignar producto a un proyecto
if (isset($_POST['asignar_producto'])) {
    $id_proyecto = intval($_POST['id_proyecto']);
    $id_producto = intval($_POST['id_producto']);
    $cantidad = intval($_POST['cantidad']);

    // Verificar stock disponible
    $producto = $conexion->query("SELECT stock FROM Productos WHERE id_producto = $id_producto")->fetch_assoc();
    if ($producto['stock'] >= $cantidad) {
        // Restar stock en Productos
        $conexion->query("UPDATE Productos SET stock = stock - $cantidad WHERE id_producto = $id_producto");

        // Verificar si ya existe el producto asignado al proyecto
        $resultado = $conexion->query("SELECT cantidad FROM stock_Proyectos WHERE id_proyecto = $id_proyecto AND id_producto = $id_producto");
        if ($resultado->num_rows > 0) {
            // Si existe, actualizar la cantidad
            $conexion->query("UPDATE stock_Proyectos SET cantidad = cantidad + $cantidad WHERE id_proyecto = $id_proyecto AND id_producto = $id_producto");
        } else {
            // Si no existe, insertar el nuevo registro
            $stmt = $conexion->prepare("INSERT INTO stock_Proyectos (id_proyecto, id_producto, cantidad) VALUES (?, ?, ?)");
            $stmt->bind_param("iii", $id_proyecto, $id_producto, $cantidad);
            $stmt->execute();
        }
        header('Location: asig_producto_proyecto.php');
        exit();
    } else {
        echo "<script>alert('Stock insuficiente para asignar este producto.');</script>";
    }
}




// Obtener productos
$result_productos = $conexion->query("SELECT * FROM Productos");
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
        <div id="layoutSidenav_content">

            <div class="container mt-5">
                <h2 class="text-center mb-4">Gestionar Productos</h2>

                <!-- Formulario para asignar productos a proyectos -->
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Asignar Producto a Proyecto</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <!-- Selección de proyecto -->
                            <div class="mb-3">
                                <label for="id_proyecto" class="form-label">Seleccione un proyecto</label>
                                <select name="id_proyecto" id="id_proyecto" class="form-select" required>
                                    <option value="">Seleccione un proyecto</option>
                                    <?php while ($proyecto = $proyectos->fetch_assoc()): ?>
                                        <option value="<?php echo $proyecto['id_proyecto']; ?>">
                                            <?php echo htmlspecialchars($proyecto['nombre']); ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <!-- Selección de producto -->
                            <div class="mb-3">
                                <label for="id_producto" class="form-label">Seleccione un producto</label>
                                <select name="id_producto" id="id_producto" class="form-select" required>
                                    <option value="">Seleccione un producto</option>
                                    <?php
                                    // Volver a consultar los productos para el formulario de asignación
                                    $result_productos->data_seek(0);  // Resetear el puntero del resultado
                                    while ($producto = $result_productos->fetch_assoc()):
                                    ?>
                                        <option value="<?php echo $producto['id_producto']; ?>">
                                            <?php echo htmlspecialchars($producto['nombre_producto']); ?>
                                            (Stock: <?php echo $producto['stock']; ?>)
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <!-- Campo para ingresar la cantidad -->
                            <div class="mb-3">
                                <label for="cantidad" class="form-label">Cantidad</label>
                                <input type="number" name="cantidad" id="cantidad" class="form-control"
                                    placeholder="Ingrese la cantidad" required>
                            </div>

                            <!-- Botón de envío -->
                            <div class="text-end">
                                <button type="submit" name="asignar_producto" class="btn btn-success">
                                    Asignar Producto
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>






            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
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