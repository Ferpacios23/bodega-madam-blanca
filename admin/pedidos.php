<?php

include("./conexion.php");

session_start();

// Verifica si el usuario ha iniciado sesión y tiene el rol de administrador (id_rol == 2)
if (!isset($_SESSION['id_rol']) || $_SESSION['id_rol'] != 2) {
    // Si no tiene el rol correcto, redirigir al usuario a la página principal
    header("Location: ../index.php");
    exit();
}

// Actualizar el estado del pedido
if (isset($_GET['aprobar'])) {
    $id_pedido = intval($_GET['aprobar']);
    $conexion->query("UPDATE Pedidos SET estado = 'pagado' WHERE id_pedido = $id_pedido");
    echo "<script>alert('Pedido aprobado'); window.location.href='pedidos.php';</script>";
}

if (isset($_GET['rechazar'])) {
    $id_pedido = intval($_GET['rechazar']);

    // Obtener los detalles del pedido para restaurar el stock
    $detalles = $conexion->query("SELECT id_producto, cantidad FROM Detalles WHERE id_pedido = $id_pedido");
    
    while ($detalle = $detalles->fetch_assoc()) {
        $id_producto = $detalle['id_producto'];
        $cantidad = $detalle['cantidad'];

        // Restaurar el stock del producto
        $conexion->query("UPDATE Productos SET stock = stock + $cantidad WHERE id_producto = $id_producto");
    }

    // Cambiar el estado del pedido a 'cancelado'
    $conexion->query("UPDATE Pedidos SET estado = 'cancelado' WHERE id_pedido = $id_pedido");
    echo "<script>alert('Pedido rechazado y stock restaurado'); window.location.href='pedidos.php';</script>";
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

    // Obtener los detalles del cliente y la dirección asociada al pedido (usando LEFT JOIN)
    $pedido_info = $conexion->query("
        SELECT p.id_pedido, p.id_usuario, p.total, p.fecha_pedido, u.nombre, u.email, u.telefono, d.direccion, d.ciudad, d.codigo_postal
        FROM Pedidos p
        JOIN Usuarios u ON p.id_usuario = u.id_usuario
        LEFT JOIN Direcciones d ON u.id_usuario = d.id_usuario
        WHERE p.id_pedido = $id_pedido
    ");
    $info = $pedido_info->fetch_assoc();

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
        <div class="card">
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
                        <?php while ($detalle = $detalles->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($detalle['nombre_producto']); ?></td>
                            <td><?php echo $detalle['cantidad']; ?></td>
                            <td>$<?php echo number_format($detalle['precio_unitario'], 2); ?></td>
                            <td>$<?php echo number_format($detalle['precio_unitario'] * $detalle['cantidad'], 2); ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
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
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID Pedido</th>
                                            <th scope="col">ID Usuario</th>
                                            <th scope="col">Fecha del Pedido</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col">Acciones</th>                 
                                        </tr>
                                    </thead>           
                                    <tbody>                                                             
                                        <?php
                                            $conexion=mysqli_connect("localhost","root","","tienda");               
                                            $SQL="SELECT *FROM pedidos";
                                            $dato = mysqli_query($conexion, $SQL);

                                            if($dato -> num_rows >0){

                                                while($fila=mysqli_fetch_array($dato)){
                                                                        
                                            ?>
                                            <tr>
                                            <td><?php echo $fila['id_pedido']; ?></td>
                                            <td><?php echo $fila['id_usuario']; ?></td>
                                            <td><?php echo $fila['fecha_pedido']; ?></td>
                                            <td>$<?php echo number_format($fila['total'], 2); ?></td>
                                            <td><?php echo $fila['estado']; ?></td>

                                            <td>
                                            <a  class="btn btn-primary" href="pedidos.php?aprobar=<?php echo $fila['id_pedido']?>   ">Aprobar</a>

                                            <a class="btn btn-danger" href="pedidos.php?rechazar=<?php echo $fila['id_pedido']?>   ">Rechazar</a>                                    
                                            <a class="btn btn-secondary" href="pedidos.php?detalles=<?php echo $fila['id_pedido']?>   ">ver detalles</a>                                    
                                            </td>
                                            </tr>


                                            <?php
                                            }
                                            }else{

                                                ?>
                                                <tr class="text-center">
                                                <td colspan="16">No existen registros</td>
                                                </tr>

                                                                        
                                                <?php
                                                                        
                                            }
                                            ?>
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
