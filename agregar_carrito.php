<?php
session_start();
include './admin/conexion.php';

// Asegurarse de que el carrito sea un array
if (!isset($_SESSION['carrito']) || !is_array($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

if (isset($_POST['id_producto']) && isset($_POST['cantidad'])) {
    $id_producto = intval($_POST['id_producto']);
    $cantidad = intval($_POST['cantidad']);

    // Verificar si el producto tiene suficiente stock
    $query = $conexion->prepare("SELECT * FROM Productos WHERE id_producto = ? AND stock >= ?");
    $query->bind_param("ii", $id_producto, $cantidad);
    $query->execute();
    $result = $query->get_result();
    $producto = $result->fetch_assoc();

    if ($producto) {
        // Si el producto ya está en el carrito, actualizamos la cantidad
        if (isset($_SESSION['carrito'][$id_producto]) && is_array($_SESSION['carrito'][$id_producto])) {
            $_SESSION['carrito'][$id_producto]['cantidad'] += $cantidad;
        } else {
            // Si no está en el carrito, lo añadimos
            $_SESSION['carrito'][$id_producto] = [
                'id' => $producto['id_producto'],
                'nombre' => $producto['nombre_producto'],
                'precio' => $producto['precio'],
                'cantidad' => $cantidad
            ];
        }

        // Redirigir al carrito
        header("Location: carrito.php");
    } else {
        echo "<script>alert('Stock insuficiente'); window.location.href='index.php';</script>";
    }
    exit;
}
?>
