<?php
// Inclusión de archivos y configuración inicial
include './conexion.php';

session_start();

// Verificar si el usuario es administrador (id_rol == 1)
if (!isset($_SESSION['id_rol']) || $_SESSION['id_rol'] != 1) {
    header("Location: ../index.php");
    exit();
}

// Obtener todos los proyectos disponibles
$proyectos = $conexion->query("SELECT id_proyecto, nombre FROM Proyectos");

// Función para obtener productos asignados a un proyecto específico
function obtenerProductosPorProyecto($conexion, $id_proyecto)
{
    $stmt = $conexion->prepare("
        SELECT p.nombre_producto, p.descripcion, pp.cantidad 
        FROM stock_Proyectos pp
        JOIN Productos p ON pp.id_producto = p.id_producto
        WHERE pp.id_proyecto = ?
    ");
    $stmt->bind_param("i", $id_proyecto);
    $stmt->execute();
    return $stmt->get_result();
}

// Variables para manejar datos del proyecto seleccionado
$proyecto_seleccionado = null;
$productos = null;

// Manejo del formulario de selección de proyecto
if (isset($_POST['seleccionar_proyecto'])) {
    $id_proyecto = intval($_POST['id_proyecto']);

    // Obtener detalles del proyecto seleccionado
    $stmt = $conexion->prepare("SELECT * FROM Proyectos WHERE id_proyecto = ?");
    $stmt->bind_param("i", $id_proyecto);
    $stmt->execute();
    $proyecto_seleccionado = $stmt->get_result()->fetch_assoc();

    // Obtener los productos asignados al proyecto seleccionado
    $productos = obtenerProductosPorProyecto($conexion, $id_proyecto);
}
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
                <h2 class="text-center mb-4">Ver Productos por Proyecto</h2>

                <!-- Formulario para seleccionar un proyecto -->
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Seleccione un Proyecto</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" class="row g-3">
                            <div class="col-md-10">
                                <label for="id_proyecto" class="form-label">Seleccione un proyecto</label>
                                <select name="id_proyecto" id="id_proyecto" class="form-select" required>
                                    <option value="" disabled selected>-- Seleccionar --</option>
                                    <?php while ($proyecto = $proyectos->fetch_assoc()): ?>
                                        <option value="<?php echo $proyecto['id_proyecto']; ?>">
                                            <?php echo htmlspecialchars($proyecto['id_proyecto'] . " - " . $proyecto['nombre']); ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="col-md-2 align-self-end">
                                <button type="submit" name="seleccionar_proyecto" class="btn btn-success w-100">
                                    Buscar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Mostrar los detalles del proyecto seleccionado y sus productos -->
                <?php if ($proyecto_seleccionado): ?>
                    <div class="mt-5">
                        <h3 class="text-center mb-4">Proyecto Seleccionado: <?php echo htmlspecialchars($proyecto_seleccionado['nombre']); ?></h3>
                        <div class="card">
                            <div class="card-header bg-secondary text-white">
                                <h4 class="mb-0">Productos Asignados</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-bordered">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Producto</th>
                                            <th>Descripción</th>
                                            <th>Cantidad Asignada</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($productos && $productos->num_rows > 0): ?>
                                            <?php while ($producto = $productos->fetch_assoc()): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($producto['nombre_producto']); ?></td>
                                                    <td><?php echo htmlspecialchars($producto['descripcion']); ?></td>
                                                    <td><?php echo intval($producto['cantidad']); ?></td>
                                                </tr>
                                            <?php endwhile; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="3" class="text-center">No hay productos asignados a este proyecto.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>


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