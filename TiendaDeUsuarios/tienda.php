<?php
session_start();

include('../admin/conexion.php');

// Verificar la conexión
if ($conexion->connect_error) {
	die("Conexión fallida: " . $conexion->connect_error);
}

// Obtener las categorías para el filtro de búsqueda
$categorias = $conexion->query("SELECT * FROM Categorias");

// Inicializar variables
$search = '';
$category_filter = '';

// Procesar formulario de búsqueda
if (isset($_GET['buscar'])) {
	$search = trim($_GET['nombre']);
	$category_filter = $_GET['categoria'];
}

// Consulta para obtener los productos con filtros usando prepared statements
$query = "SELECT * FROM Productos WHERE stock > 0";
$params = [];
$types = "";

if (!empty($search)) {
	$query .= " AND nombre_producto LIKE ?";
	$params[] = "%$search%";
	$types .= "s";
}

if (!empty($category_filter) && $category_filter != 'todas') {
	$query .= " AND id_categoria = ?";
	$params[] = $category_filter;
	$types .= "i";
}

// Preparar la consulta
$stmt = $conexion->prepare($query);
if (!empty($params)) {
	$stmt->bind_param($types, ...$params);
}
$stmt->execute();
$productos = $stmt->get_result();


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta
		name="viewport"
		content="width=device-width, initial-scale=1.0" />

	<!-- ===== CSS ===== -->
	<link href="../assets/css/style.css" rel="stylesheet">
	<link href="../assets/css/bootstrap/bootstrap.min.css" rel="stylesheet">
	<!-- ===== favicon ===== -->
	<link href="../assets/icon/image-removebg-preview.png" rel="stylesheet">
	<!-- ===== Explorador de iconos CSS ===== -->
	<link rel="icon" type="image/png" href="../assets/icon/logo.png">

</head>

<body>

	<header>
		<div class="container-hero">
			<div class="container hero">
				<div class="customer-support">
					<i class="fa-solid fa-headset"></i>
					<div class="content-customer-support">
						<span class="text">Soporte al cliente</span>
						<span class="number">123-456-7890</span>
					</div>
				</div>

				<div class="container-logo">
					<h1 class="logo">
						<a href="../index.php">
							<img src="../assets/icon/logo.png" alt="logo principal">
						</a>
					</h1>
				</div>

				<div class="container-user">
					<?php if (!isset($_SESSION['usuario'])): ?>
						<!-- Mostrar ícono de usuario si no está en sesión -->
						<a href="../login.php"><i class="fa-solid fa-user"></i></a>
					<?php else: ?>
						<!-- Mostrar ícono de la web si está en sesión -->
						<div class="dropdown">
							<a href="#" class="fa-solid fa-globe" id="userMenuToggle"></a>
							<div class="dropdown-menu" id="userMenu">
								<p class="user-name"><?php echo htmlspecialchars($_SESSION['usuario']); ?></p>
								<a href="../logout.php" class="logout">Cerrar sesión</a>
							</div>
						</div>
					<?php endif; ?>

					<!-- Ícono de carrito siempre visible -->
					<a href="./carrito.php"><i class="fa-solid fa-basket-shopping"></i></a>
				</div>

			</div>
		</div>

		<div class="container-navbar">
			<nav class="navbar container p-3">
				<i class="fa-solid fa-bars"></i>
				<ul class="menu">
					<li><a href="../index.php">Inicio</a></li>
					<li><a href="../index.php#nosotros">Nosotros</a></li>
					<li><a href="../index.php#blogs">Blogs</a></li>
					<li><a href="../index.php#contactos">Contacto</a></li>
					<li><a href="./tienda.php">productos</a></li>
				</ul>
			</nav>
		</div>
	</header>


	<section class="container my-5">
		<h1 class="text-center mb-4">Tienda de Productos</h1>

		

		<!-- Formulario de búsqueda -->
		<form method="GET" class="d-flex mb-4 gap-2">
			<input type="text" class="form-control" name="nombre" placeholder="Buscar producto..." value="<?php echo htmlspecialchars($search); ?>">
			<select name="categoria" class="form-select">
				<option value="todas">Todas las categorías</option>
				<?php while ($cat = $categorias->fetch_assoc()) { ?>
					<option value="<?php echo $cat['id_categoria']; ?>" <?php echo ($category_filter == $cat['id_categoria']) ? 'selected' : ''; ?>>
						<?php echo htmlspecialchars($cat['nombre_categoria']); ?>
					</option>
				<?php } ?>
			</select>
			<button type="submit" name="buscar" class="btn btn-primary">Buscar</button>
		</form>

		<!-- Lista de productos -->
		<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
			<?php if ($productos->num_rows > 0): ?>
				<?php while ($producto = $productos->fetch_assoc()) { ?>
					<div class="col">
						<div class="card h-100 shadow-sm">
							<img src="<?php echo $producto['imagen_url']; ?>" class="card-img-top" alt="Producto">
							<div class="card-body">
								<h5 class="card-title"><?php echo htmlspecialchars($producto['nombre_producto']); ?></h5>
								<p class="card-text"><?php echo htmlspecialchars($producto['descripcion']); ?></p>
								<p class="text-success fw-bold">Precio: $<?php echo number_format($producto['precio'], 2); ?></p>
								<p class="text-muted">Stock: <?php echo $producto['stock']; ?></p>
							</div>
							<div class="card-footer">
								<form method="POST" action="agregar_carrito.php" class="d-flex justify-content-between align-items-center">
									<input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']; ?>">
									<input type="number" name="cantidad" min="1" max="<?php echo $producto['stock']; ?>" value="1" class="form-control w-25 me-2" required>
									<button type="submit" class="btn btn-success">Agregar al carrito</button>
								</form>

							</div>
						</div>
					</div>
				<?php } ?>
			<?php else: ?>
				<div class="col">
					<p class="alert alert-warning text-center">No se encontraron productos.</p>
				</div>
			<?php endif; ?>
		</div>
	</section>



	<footer class="footer">
		<div class="container container-footer">
			<div class="menu-footer">
				<div class="contact-info">
					<p class="title-footer">Información de Contacto</p>
					<ul>
						<li>
							Dirección: 71 Pennington Lane Vernon Rockville, CT
							06066
						</li>
						<li>Teléfono: 323-416-3627</li>
						<li>Fax: 55555300</li>
						<li>EmaiL: EsenciaChocoana@Gmail.com .com</li>
					</ul>
					<div class="social-icons">
						<span class="facebook">
							<i class="fa-brands fa-facebook-f"></i>
						</span>
						<span class="twitter">
							<i class="fa-brands fa-twitter"></i>
						</span>
						<span class="youtube">
							<i class="fa-brands fa-youtube"></i>
						</span>
						<span class="pinterest">
							<i class="fa-brands fa-pinterest-p"></i>
						</span>
						<span class="instagram">
							<i class="fa-brands fa-instagram"></i>
						</span>
					</div>
				</div>

				<div class="information">
					<p class="title-footer">Información</p>
					<ul>
						<li><a href="#">Acerca de Nosotros</a></li>
						<li><a href="#">Información Delivery</a></li>
						<li><a href="#">Politicas de Privacidad</a></li>
						<li><a href="#">Términos y condiciones</a></li>
						<li><a href="#">Contactános</a></li>
					</ul>
				</div>

				<div class="my-account">
					<p class="title-footer">Mi cuenta</p>

					<ul>
						<li><a href="#">Mi cuenta</a></li>
						<li><a href="#">Historial de ordenes</a></li>
						<li><a href="#">Lista de deseos</a></li>
						<li><a href="#">Boletín</a></li>
						<li><a href="#">Reembolsos</a></li>
					</ul>
				</div>

				<div class="newsletter">
					<p class="title-footer">Boletín informativo</p>

					<div class="content">
						<p>
							Suscríbete a nuestros boletines ahora y mantente al
							día con nuevas colecciones y ofertas exclusivas.
						</p>
						<input type="email" placeholder="Ingresa el correo aquí...">
						<button>Suscríbete</button>
					</div>
				</div>
			</div>

			<div class="copyright">
				<p>
					Desarrollado por Programación para el mundo &copy; 2022
				</p>

				<img src="./assets/img/payment.png" alt="Pagos">
			</div>
		</div>
	</footer>

	<script src="../assets/js/ico.js" crossorigin="anonymous"></script>
	<script src="../assets/js/filtrar_productos.js" crossorigin="anonymous"></script>
	<script type="module" src="../assets/js/scripts.js"></script>

</body>

</html>