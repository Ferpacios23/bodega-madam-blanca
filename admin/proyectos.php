<?php

include("./conexion.php");


session_start();

// Verifica si el usuario ha iniciado sesión y tiene el rol de administrador (id_rol == 2)
if (!isset($_SESSION['id_rol']) || $_SESSION['id_rol'] != 1) {
    // Si no tiene el rol correcto, redirigir al usuario a la página principal
    header("Location: ../index.php");
    exit();
}


// Agregar un nuevo rol
if (isset($_POST['agregar'])) {
    // Obtener datos del formulario
    $id_proyecto = intval($_POST['id_proyecto']);
    $nombre = trim($_POST['nombre']);
    $descripcion = trim($_POST['descripcion']);

    // Verificar si el correo ya está registrado
    $checkProyecto = $conexion->prepare("SELECT id_proyecto FROM proyectos WHERE id_proyecto = ?");
    $checkProyecto->bind_param("i", $id_proyecto);
    $checkProyecto->execute();
    $checkProyecto->store_result();

    if ($checkProyecto->num_rows > 0) {
        echo "<script>alert('El codigo ya está registrado.'); window.location.href='proyectos.php';</script>";
    } else {
        // Insertar proyecto en la tabla proyectos
        $insertProyecto = $conexion->prepare("INSERT INTO proyectos (id_proyecto, nombre, descripcion) VALUES (?, ?, ?)");
        $insertProyecto->bind_param("iss", $id_proyecto, $nombre, $descripcion);

        if ($insertProyecto->execute()) {
            echo "<script>alert('Registro exitoso.'); window.location.href='proyectos.php';</script>";
        } else {
            echo "<script>alert('Error al registrar.');</script>";
        }
    }
}

// Eliminar un rol
if (isset($_GET['eliminar'])) {
    $id = intval($_GET['eliminar']);
    $deleteProyecto = $conexion->prepare("DELETE FROM proyectos WHERE id_proyecto = ?");
    $deleteProyecto->bind_param("i", $id);

    if ($deleteProyecto->execute()) {
        echo "<script>alert('Proyecto eliminado correctamente.'); window.location.href='proyectos.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar el proyecto.');</script>";
    }
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
            <main>
                <!-- Formulario para agregar un rol -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <i class="fas fa-plus me-2"></i>Agregar proyecto
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" class="container p-4 bg-light rounded shadow">
                            <div class="mb-3">
                                <label for="id_proyecto" class="form-label">ID del Proyecto</label>
                                <input type="number" class="form-control" id="id_proyecto" name="id_proyecto" placeholder="Ingrese el ID del proyecto" required>
                            </div>
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre del Proyecto</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del proyecto" required>
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Descripción del proyecto" required></textarea>
                            </div>
                            <button type="submit" name="agregar" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Agregar Proyecto
                            </button>
                        </form>

                    </div>
                </div>
                <div class="container-fluid px-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            DataTable Example
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">ID_proyecto</th>
                                        <th scope="col">nombre</th>
                                        <th scope="col">Descripcio</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * FROM proyectos";
                                    $result = $conexion->query($query);

                                    if ($result->num_rows > 0):
                                        while ($row = $result->fetch_assoc()):
                                    ?>
                                            <tr>
                                                <td><?= htmlspecialchars($row['id_proyecto']) ?></td>
                                                <td><?= htmlspecialchars($row['nombre']) ?></td>
                                                <td><?= htmlspecialchars($row['descripcion']) ?></td>
                                                <td>
                                                    <a href="proyectos.php?eliminar=<?= $row['id_proyecto'] ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este proyecto?');">Eliminar</a>
                                                </td>
                                            </tr>
                                        <?php
                                        endwhile;
                                    else:
                                        ?>
                                        <tr>
                                            <td colspan="4" class="text-center">No hay proyectos registrados.</td>
                                        </tr>
                                    <?php endif; ?>


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