<?php 
session_start();

include ('./admin/conexion.php');

if (isset($_POST['ingresar'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = $conexion->prepare("SELECT id_usuario, nombre, contrasena, id_rol FROM Usuarios WHERE email = ?");
    $query->bind_param("s", $email);
    $query->execute();
    $result = $query->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['contrasena'])) {
        $_SESSION['usuario'] = $user['nombre'];
        $_SESSION['id_usuario'] = $user['id_usuario'];
        $_SESSION['id_rol'] = $user['id_rol']; // Guardar el rol en la sesión

        // Redirigir según el rol
        if ($user['id_rol'] == 1 ) { // Supongamos que 1 es 'Cliente'
			
            header("Location: index.php");
        } else { // Cualquier otro rol se considera 'Administrador'
            
            $_SESSION['id_rol'] == 2;
            header("Location: ./admin/admin.php");
        }
        exit;
    } else {
        echo "Usuario o contraseña incorrectos.";
    }
}


if (isset($_POST['registrar'])) {
    // Obtener datos del formulario
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT);
    $telefono = trim($_POST['telefono']);

    // Verificar si el correo ya está registrado
    $checkEmail = $conexion->prepare("SELECT email FROM Usuarios WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $checkEmail->store_result();

    if ($checkEmail->num_rows > 0) {
        echo "<script>alert('El correo ya está registrado.'); window.location.href='login.php';</script>";
    } else {
        // Insertar usuario en la tabla Usuarios
        $insertUser = $conexion->prepare("INSERT INTO Usuarios (nombre, email, contrasena, id_rol, telefono) VALUES (?, ?, ?, 1, ?)");
        $insertUser->bind_param("ssss", $nombre, $email, $contrasena, $telefono);
        
        if ($insertUser->execute()) {
            echo "<script>alert('Registro exitoso.'); window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Error al registrar.');</script>";
        }
    }
}


?>
<!DOCTYPE php>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1.0"
		/>
		<title>Esencia Chocoana</title>
		<!-- ===== CSS ===== -->
		<link rel="stylesheet" href="./assets/css/style.css">
		<link href="./assets/css/bootstrap/bootstrap.min.css" rel="stylesheet">

		<!-- ===== favicon ===== -->
		<link rel="shortcut icon" href="./assets/icon/image-removebg-preview.png" type="image/x-icon">
		<!-- ===== Explorador de iconos CSS ===== -->
		<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
	</head>
	<body>
	<?php include("./header.php"); ?>


		<section>
			<div class="container-pincipal">
				<div class="container2">
					<div class="forms">
						<div class="form login">
							<span class="title">Iniciar sesion</span>
								<form method="POST">
									<div class="input-field">
										<input type="text" name="email" placeholder="Correo electronico" required>
										<i class="uil uil-envelope icon"></i>
									</div>
									<div class="input-field">
										<input type="password" name="password" class="password" placeholder="Ingresa tu contraseña" required>
										<i class="uil uil-lock icon"></i>
									</div>
									<div class="checkbox-text">
										<div class="checkbox-content">
											<input type="checkbox" id="logCheck">
											<label for="logCheck" class="text"></label>
										</div>
										
										<a href="#" class="text">Olvido su contraseña?</a>
									</div>
									<div class="input-field button">
										<input name="ingresar" type="submit" value="Iniciar sesion">
									</div>
								</form>

								
							<div class="login-signup">
								<span class="text">¿No es miembro?
									<a href="#" class="text registro">Regístrese ahora</a>
								</span>
							</div>
						</div>
						<!-- Formulario de inscripción -->
						<div class="form signup">
							<span class="title">Registro</span>
							<form method="POST">
    <div class="input-field">
        <input type="text" name="nombre" placeholder="Nombre" required>
        <i class="uil uil-user"></i>
    </div>
    <div class="input-field">
        <input type="text" name="telefono" placeholder="Teléfono" required>
        <i class="uil uil-phone"></i>
    </div>
    <div class="input-field">
        <input type="email" name="email" placeholder="Correo electrónico" required>
        <i class="uil uil-envelope"></i>
    </div>
    <div class="input-field">
        <input type="password" name="contrasena" placeholder="Crea una contraseña" required>
        <i class="uil uil-lock"></i>
    </div>
    <div class="input-field button">
        <input type="submit" name="registrar" value="Registrarse">
    </div>
</form>
							<div class="login-signup">
								<span class="text">¿Ya eres miembro?
									<a href="#" class="text inicio-de-sesión">Iniciar sesión ahora</a>
								</span>
							</div>
						</div>
					</div>
				</div>			
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
							<li>Teléfono: 123-456-7890</li>
							<li>Fax: 55555300</li>
							<li>EmaiL: baristas@support.com</li>
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

					<img src="img/payment.png" alt="Pagos">
				</div>
			</div>
		</footer>

		<script type="module" src="./assets/js/ico.js"></script>
		<script type="module" src="./assets/js/login.js"></script>
	</body>
</html>
