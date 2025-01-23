<?php

include("./conexion.php");

session_start();

// Verifica si el usuario ha iniciado sesión y tiene el rol de administrador (id_rol == 2)
if (!isset($_SESSION['id_rol']) || $_SESSION['id_rol'] != 1) {
    // Si no tiene el rol correcto, redirigir al usuario a la página principal
    header("Location: ../index.php");
    exit();
}


// Actualizar el estado del pedido
if (isset($_GET['aprobar'])) {
    $id_pedido = intval($_GET['aprobar']);

    // Verificar que el pedido esté en estado 'pendiente'
    $verificar = $conexion->query("SELECT estado FROM Pedidos WHERE id_pedido = $id_pedido");
    $pedido = $verificar->fetch_assoc();

    if ($pedido && $pedido['estado'] == 'pendiente') {
        $conexion->query("UPDATE Pedidos SET estado = 'pagado' WHERE id_pedido = $id_pedido");
        echo "<script>alert('Pedido aprobado'); window.location.href='pedidos.php';</script>";
    } else {
        echo "<script>alert('El pedido ya fue procesado.'); window.location.href='pedidos.php';</script>";
    }
}

if (isset($_GET['rechazar'])) {
    $id_pedido = intval($_GET['rechazar']);

    // Verificar que el pedido esté en estado 'pendiente'
    $verificar = $conexion->query("SELECT estado FROM Pedidos WHERE id_pedido = $id_pedido");
    $pedido = $verificar->fetch_assoc();

    if ($pedido && $pedido['estado'] == 'pendiente') {
        // Restaurar el stock de los productos
        $detalles = $conexion->query("SELECT id_producto, cantidad FROM Detalles WHERE id_pedido = $id_pedido");
        while ($detalle = $detalles->fetch_assoc()) {
            $id_producto = $detalle['id_producto'];
            $cantidad = $detalle['cantidad'];
            $conexion->query("UPDATE Productos SET stock = stock + $cantidad WHERE id_producto = $id_producto");
        }

        // Cambiar el estado del pedido a 'cancelado'
        $conexion->query("UPDATE Pedidos SET estado = 'cancelado' WHERE id_pedido = $id_pedido");
        echo "<script>alert('Pedido rechazado y stock restaurado'); window.location.href='pedidos.php';</script>";
    } else {
        echo "<script>alert('El pedido ya fue procesado.'); window.location.href='pedidos.php';</script>";
    }
}

// Obtener todos los pedidos pendientes
$pedidos = $conexion->query("SELECT * FROM Pedidos ORDER BY fecha_pedido DESC");
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
            <main>
                <div class="container-fluid px-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Administrar Pedidos
                        </div>
                        <?php if (isset($_GET['detalles'])): ?>
                            <?php
                            $id_pedido = intval($_GET['detalles']);

                            // Obtener los detalles del cliente y la dirección asociada al pedido
                            $pedido_info = $conexion->query("
        SELECT p.id_pedido, p.id_usuario, p.total, p.fecha_pedido, u.nombre, u.email, u.telefono, d.ciudad, d.codigo_postal, d.direccion, p.estado
        FROM Pedidos p
        JOIN Usuarios u ON p.id_usuario = u.id_usuario
        LEFT JOIN Direcciones d ON p.id_pedido = d.id_pedido
        WHERE p.id_pedido = $id_pedido
    ");

                            // Verifica si hay resultados
                            if ($pedido_info && $pedido_info->num_rows > 0) {
                                $info = $pedido_info->fetch_assoc();
                            } else {
                                $info = null;
                            }

                            // Obtener los detalles de los productos en el pedido
                            $detalles = $conexion->query("
        SELECT d.id_producto, d.cantidad, d.precio_unitario, p.nombre_producto 
        FROM Detalles d 
        JOIN Productos p ON d.id_producto = p.id_producto 
        WHERE d.id_pedido = $id_pedido
    ");
                            ?>

                            <div class="container my-5">
                                <h2 class="text-center mb-4">Detalles del Pedido #<?php echo $id_pedido; ?></h2>

                                <!-- Información del Cliente -->
                                <div class="card mb-4">
                                    <div class="card-header bg-primary text-white">Información del Cliente</div>
                                    <div class="card-body">
                                        <p><strong>Cliente:</strong> <?php echo htmlspecialchars($info['nombre'] ?? 'No disponible'); ?></p>
                                        <p><strong>Email:</strong> <?php echo htmlspecialchars($info['email'] ?? 'No disponible'); ?></p>
                                        <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($info['telefono'] ?? 'No disponible'); ?></p>
                                        <p><strong>Fecha del Pedido:</strong> <?php echo htmlspecialchars($info['fecha_pedido'] ?? 'No disponible'); ?></p>
                                        <p><strong>Total:</strong> $<?php echo number_format($info['total'] ?? 0, 2); ?></p>
                                    </div>
                                </div>

                                <!-- Dirección de Envío -->
                                <div class="card mb-4">
                                    <div class="card-header bg-secondary text-white">Dirección de Envío</div>
                                    <div class="card-body">
                                        <p><strong>Dirección:</strong> <?php echo htmlspecialchars($info['direccion'] ?? 'No disponible'); ?></p>
                                        <p><strong>Ciudad:</strong> <?php echo htmlspecialchars($info['ciudad'] ?? 'No disponible'); ?></p>
                                        <p><strong>Código Postal:</strong> <?php echo htmlspecialchars($info['codigo_postal'] ?? 'No disponible'); ?></p>
                                    </div>
                                </div>


                                <!-- Productos del Pedido -->
                                <div class="card-header bg-info text-white">Productos del Pedido</div>
                                <div class="card-body">
                                    <table class="table table-striped table-bordered">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Producto</th>
                                                <th>Cantidad</th>
                                                <th>Precio Unitario</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $total_pagar = 0; // Inicializa la variable para el total
                                            while ($detalle = $detalles->fetch_assoc()):
                                                $subtotal = $detalle['precio_unitario'] * $detalle['cantidad'];
                                                $total_pagar += $subtotal; // Acumula el subtotal
                                            ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($detalle['nombre_producto']); ?></td>
                                                    <td><?php echo $detalle['cantidad']; ?></td>
                                                    <td>$<?php echo number_format($detalle['precio_unitario'], 2); ?></td>
                                                    <td>$<?php echo number_format($subtotal, 2); ?></td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                    <!-- Muestra el total a pagar -->
                                    <div class="mt-3">
                                        <h5 class="text-end">Total a Pagar: $<?php echo number_format($total_pagar, 2); ?></h5>
                                    </div>
                                    <div class="mt-3">
                                        <h5 class="text-end">Estado del Pedido: <span class="badge bg-<?php echo ($info['estado'] == 'pendiente') ? 'warning' : ($info['estado'] == 'aprobado' ? 'success' : 'danger'); ?>">
                                                <?php echo ucfirst($info['estado'] ?? 'No disponible'); ?>
                                            </span></h5>
                                    </div>
                                </div>


                                <!-- Botón de regreso -->
                                <div class="mt-4 text-center">
                                    <a href="pedidos.php" class="btn btn-outline-primary">
                                        <i class="fas fa-arrow-left"></i> Volver a la lista de pedidos
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID Pedido</th>
                                        <th>ID Usuario</th>
                                        <th>Fecha</th>
                                        <th>Total</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($pedido = $pedidos->fetch_assoc()): ?>
                                        <tr>
                                            <td><?php echo $pedido['id_pedido']; ?></td>
                                            <td><?php echo $pedido['id_usuario']; ?></td>
                                            <td><?php echo $pedido['fecha_pedido']; ?></td>
                                            <td>$<?php echo number_format($pedido['total'], 2); ?></td>
                                            <td><?php echo $pedido['estado']; ?></td>
                                            <td>
                                                <?php if ($pedido['estado'] == 'pendiente'): ?>
                                                    <a class="btn btn-success btn-sm" href="pedidos.php?aprobar=<?php echo $pedido['id_pedido']; ?>">Aprobar</a>
                                                    <a class="btn btn-danger btn-sm" href="pedidos.php?rechazar=<?php echo $pedido['id_pedido']; ?>">Rechazar</a>
                                                <?php else: ?>
                                                    Procesado
                                                <?php endif; ?>
                                                <a class="btn btn-primary btn-sm" href="pedidos.php?detalles=<?php echo $pedido['id_pedido']; ?>">Ver detalles</a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>


                    </div>





                </div>
            </main>
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