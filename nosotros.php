<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- ===== CSS ===== -->
		<link href="./assets/css/style.css" rel="stylesheet">
		<link href="./assets/css/bootstrap/bootstrap.min.css" rel="stylesheet">



		<!-- ===== favicon ===== -->
		<link href="./icon/image-removebg-preview.png" rel="stylesheet">

		<!-- ===== Explorador de iconos CSS ===== -->
		<link href="./assets/css/line.css" rel="stylesheet">

</head>
<body>
<?php include("./header.php"); ?>
		<main class="container-xl py-5">
			<h2 class="text-center my-5">Sobre Nosotros</h2>

			<div class="row g-5 align-items-center">
				<div class="col-md-6">
					<img src="./assets/img/banner.jpg" alt="imagen sobre nosotros" class="img-fluid">
				</div>
				<div class="col-md-6 ">
					<p>
					En Esencias Chocoanas, celebramos la riqueza cultural y natural del Chocó a través de artesanías únicas y auténticas. Actuamos como el puente entre los talentosos artesanos de la región y aquellos que buscan piezas especiales con un profundo valor cultural. Cada producto refleja la esencia de su origen, hecho con dedicación y materiales naturales de la selva y los ríos del Chocó. Nuestro compromiso es apoyar el talento local y promover la economía regional, ofreciendo una experiencia de compra en línea que te conecta directamente con los creadores y sus historias. ¡Descubre la magia del Chocó con nosotros!

					</p>
					
				</div>
			</div>
		</main>

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

		<script	src="./assets/js/ico.js"	crossorigin="anonymous"></script>
</body>
</html>