<?php

include("./conexion.php");

session_start();

// Verifica si el usuario ha iniciado sesión y tiene el rol de administrador (id_rol == 2)
if (!isset($_SESSION['id_rol']) || $_SESSION['id_rol'] != 1) {
    // Si no tiene el rol correcto, redirigir al usuario a la página principal
    header("Location: ../index.php");
    exit();
}


// Agregar una categoría
if (isset($_POST['agregar'])) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $conexion->query("INSERT INTO Categorias (nombre_categoria, descripcion) VALUES ('$nombre', '$descripcion')");
    header('Location: categorias.php');
}

// Eliminar una categoría
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $conexion->query("DELETE FROM Categorias WHERE id_categoria = $id");
    header('Location: categorias.php');
}

$result = $conexion->query("SELECT * FROM categorias");
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
                            Gestionar Categorías
                        </div>
                        <div class="card-body">
                            <form method="POST" class="row g-3">
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="nombre" placeholder="Nombre de la categoría" required>
                                </div>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="descripcion" placeholder="Descripción" required>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" name="agregar" class="btn btn-success w-100">
                                        <i class="fas fa-save"></i> Agregar Categoría
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php if ($result->num_rows > 0) { ?>
                                        <?php while ($row = $result->fetch_assoc()) { ?>
                                            <tr>
                                                <td><?php echo $row['id_categoria']; ?></td>
                                                <td><?php echo $row['nombre_categoria']; ?></td>
                                                <td><?php echo $row['descripcion']; ?></td>
                                                <td>
                                                    <a class="btn btn-danger" href="categorias.php?eliminar=<?php echo $row['id_categoria'] ?>" onclick="return confirm('¿Estás seguro de eliminar este usuario?');">Eliminar</a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    <?php } else {

                                        echo "<tr><td colspan='4'>No hay categorías disponibles</td></tr>";
                                    } ?>
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