<?php
session_start();
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
		<link href="./assets/css/style.css" rel="stylesheet">
		<link href="./assets/css/principal.css" rel="stylesheet">
		<link href="./assets/css/bootstrap/bootstrap.min.css" rel="stylesheet">

		<!-- ===== favicon ===== -->
		<link href="./assets/icon/image-removebg-preview.png" rel="stylesheet">
		<!-- ===== Explorador de iconos CSS ===== --> 
		<link href="css/line.css" rel="stylesheet">
	</head>
	<body>
	<?php include("./header.php"); ?>


		<section class="banner">
			<div class="content-banner">
				<h2>100% Tradicion <br />Chocoana</h2>
				<a href="#">Comprar ahora</a>
			</div>
		</section>

		<main class="main-content">
			<section class="container container-features cont">
				
				<div class="card-feature">
					<i class="fa-solid fa-plane-up"></i>
					<div class="feature-content">
						<span>Envío gratuito a nivel mundial</span>
						<p>En pedido superior a $150</p>
					</div>
				</div>
				<div class="card-feature">
					<i class="fa-solid fa-wallet"></i>
					<div class="feature-content">
						<span>Contrareembolso</span>
						<p>100% garantía de devolución de dinero</p>
					</div>
				</div>
				<div class="card-feature">
					<i class="fa-solid fa-gift"></i>
					<div class="feature-content">
						<span>Tarjeta regalo especial</span>
						<p>Ofrece bonos especiales con regalo</p>
					</div>
				</div>
				<div class="card-feature">
					<i class="fa-solid fa-headset"></i>
					<div class="feature-content">
						<span>Servicio al cliente 24/7</span>
						<p>LLámenos 24/7 al 123-456-7890</p>
					</div>
				</div>
			</section>

			<section class="container top-categories">
				<h1 class="heading-1">Mejores Categorías</h1>
				<div class="container-categories">
					<div class="card-category category-bolsos">
						<p>Bolsos</p>
						<span>Ver más</span>
					</div>
					<div class="card-category category-joyeria">
						<p>joyeria </p>
						<span>Ver más</span>
					</div>
					<div class="card-category category-canastas">
						<p>canastas</p>
						<span>Ver más</span>
					</div>
				</div>
			</section>
			<section class="container py-5 contenfor">

			<h2 class="text-center my-5">Nuevos Productos</h2>

			<div class="row g-0 pt-5 producto mb-4 ">
				<div class="col-md-8">  
					<img src="./assets/img/tienda/productos_1.jpg" alt="imagen producto" class="img-fluid">
				</div>
				<div class="col-md-4 btn-primary text-center p-5 text-white d-flex flex-column justify-content-center ">
					<h3>Producto 1</h3>   
					<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sequi accusamus earum magnam necessitatibus ex doloremque eligendi repudiandae soluta corporis.</p>
					<p class="fs-1 fw-bold">$300.000.00</p>
					<a href="#" class="btn btn-success fs-3 fw-bold text-uppercase py-3">Agregar al Carrito</a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 mb-4 ">
					<div class="card">
						<img class="card-img-top img-cartas" src="./assets/img/tienda/productos_2.jpeg" alt="imagen producto">

						<div class="card-body text-center btn-primary text-white p-4 ">
							<h3>Producto 2</h3>   
							<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sequi accusamus earum magnam necessitatibus ex doloremque eligendi repudiandae soluta corporis.</p>
							<p class="fs-1 fw-bold">$1000.000.00</p>
							<a href="#" class="btn btn-success fs-3 fw-bold text-uppercase py-3 d-block">Agregar al Carrito</a>
						</div>
					</div>
				</div>
				<div class="col-md-6 mb-4">
					<div class="card">
						<img class="card-img-top" src="./assets/img/tienda/productos_4.png" alt="imagen producto">

						<div class="card-body text-center btn-primary text-white p-4 ">
							<h3>Producto 3</h3>   
							<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sequi accusamus earum magnam necessitatibus ex doloremque eligendi repudiandae soluta corporis.</p>
							<p class="fs-1 fw-bold">$500.000.00</p>
							<a href="#" class="btn btn-success fs-3 fw-bold text-uppercase py-3 d-block boton-es">Agregar al Carrito</a>
						</div>
					</div>
				</div>
			</div>



			<div class="row">
				<div class="col-md-4 mb-4">
					
						<div class="card">
							<img class="card-img-top" src="./assets/img/tienda/productos_4.png" alt="imagen producto">

							<div class="card-body text-center btn-primary text-white p-4 ">
								<h3>Producto 4</h3>   
								<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sequi accusamus earum magnam necessitatibus ex doloremque eligendi repudiandae soluta corporis.</p>
								<p class="fs-1 fw-bold">$200.000.00</p>
								<a href="#" class="btn btn-success fs-3 fw-bold text-uppercase py-3 d-block">Agregar al Carrito</a>
							</div>
						</div>
				</div>
				<div class="col-md-4 mb-4">
						<div class="card">
							<img class="card-img-top" src="./assets/img/tienda/productos_5.jpg" alt="imagen producto">

							<div class="card-body text-center btn-primary text-white p-4 ">
								<h3>Producto 5</h3>   
								<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sequi accusamus earum magnam necessitatibus ex doloremque eligendi repudiandae soluta corporis.</p>
								<p class="fs-1 fw-bold">$1.000.000.00</p>
								<a href="#" class="btn btn-success fs-3 fw-bold text-uppercase py-3 d-block">Agregar al Carrito</a>
							</div>
						</div>
				</div>
				<div class="col-md-4">
					
						<div class="card">
							<img class="card-img-top" src="./assets/img/tienda/productos_6.jpg" alt="imagen producto">

							<div class="card-body text-center btn-primary text-white p-4 ">
								<h3>Producto 6</h3>   
								<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sequi accusamus earum magnam necessitatibus ex doloremque eligendi repudiandae soluta corporis.</p>
								<p class="fs-1 fw-bold">$1,100.000.00</p>
								<a href="#" class="btn btn-success fs-3 fw-bold text-uppercase py-3 d-block">Agregar al Carrito</a>
							</div>
						</div>
				</div>
			</div>
			</section>

			<section class="gallery">
				<img
					src="./assets/img/poster.png"
					alt="Gallery Img1"
					class="gallery-img-1"
				/><img
					src="./assets/img/poster_1.png"
					alt="Gallery Img2"
					class="gallery-img-2"
				/><img
					src="./assets/img/poster(2).png"
					alt="Gallery Img3"
					class="gallery-img-3"
				/><img
					src="./assets/img/poster(3).png"
					alt="Gallery Img4"
					class="gallery-img-4"
				/><img
					src="./assets/img/poster(5).png"
					alt="Gallery Img5"
					class="gallery-img-5"
				/>
			</section>

			<section class="container specials">
				<h1 class="heading-1">Especiales</h1>

				<div class="container-products">
					<!-- Producto 1 -->
					<div class="card-product">
						<div class="container-img">
							<img src="./assets/img/bolsos(1).jpg" alt="bolso tejido" />
							<span class="discount">-13%</span>
							<div class="button-group">
								<span>
									<i class="fa-regular fa-eye"></i>
								</span>
								<span>
									<i class="fa-regular fa-heart"></i>
								</span>
								<span>
									<i class="fa-solid fa-code-compare"></i>
								</span>
							</div>
						</div>
						<div class="content-card-product">
							<div class="stars">
								<i class="fa-solid fa-star"></i>
								<i class="fa-solid fa-star"></i>
								<i class="fa-solid fa-star"></i>
								<i class="fa-solid fa-star"></i>
								<i class="fa-regular fa-star"></i>
							</div>
							<h3>bolso tejido</h3>
							<span class="add-cart">
								<i class="fa-solid fa-basket-shopping"></i>
							</span>
							<p class="price">$4.60 <span>$5.30</span></p>
						</div>
					</div>
					<!-- Producto 2 -->
					<div class="card-product">
						<div class="container-img">
							<img
								src="./assets/img/bolsos(2).jpg"
								alt="bolso tejido"
							/>
							<span class="discount">-22%</span>
							<div class="button-group">
								<span>
									<i class="fa-regular fa-eye"></i>
								</span>
								<span>
									<i class="fa-regular fa-heart"></i>
								</span>
								<span>
									<i class="fa-solid fa-code-compare"></i>
								</span>
							</div>
						</div>
						<div class="content-card-product">
							<div class="stars">
								<i class="fa-solid fa-star"></i>
								<i class="fa-solid fa-star"></i>
								<i class="fa-solid fa-star"></i>
								<i class="fa-regular fa-star"></i>
								<i class="fa-regular fa-star"></i>
							</div>
							<h3>bolso tejido</h3>
							<span class="add-cart">
								<i class="fa-solid fa-basket-shopping"></i>
							</span>
							<p class="price">$5.70 <span>$7.30</span></p>
						</div>
					</div>
					<!--  -->
					<div class="card-product">
						<div class="container-img">
							<img src="./assets/img/joyeria(5).jpg" alt="collar chocoano" />
							<span class="discount">-30%</span>
							<div class="button-group">
								<span>
									<i class="fa-regular fa-eye"></i>
								</span>
								<span>
									<i class="fa-regular fa-heart"></i>
								</span>
								<span>
									<i class="fa-solid fa-code-compare"></i>
								</span>
							</div>
						</div>
						<div class="content-card-product">
							<div class="stars">
								<i class="fa-solid fa-star"></i>
								<i class="fa-solid fa-star"></i>
								<i class="fa-solid fa-star"></i>
								<i class="fa-solid fa-star"></i>
								<i class="fa-solid fa-star"></i>
							</div>
							<h3>Collar</h3>
							<span class="add-cart">
								<i class="fa-solid fa-basket-shopping"></i>
							</span>
							<p class="price">$3.85 <span>$5.50</span></p>
						</div>
					</div>
					<!--  -->
					<div class="card-product">
						<div class="container-img">
							<img src="./assets/img/joyeria(2).jpg" alt="aretes tipo candongas" />
							<div class="button-group">
								<span>
									<i class="fa-regular fa-eye"></i>
								</span>
								<span>
									<i class="fa-regular fa-heart"></i>
								</span>
								<span>
									<i class="fa-solid fa-code-compare"></i>
								</span>
							</div>
						</div>
						<div class="content-card-product">
							<div class="stars">
								<i class="fa-solid fa-star"></i>
								<i class="fa-solid fa-star"></i>
								<i class="fa-solid fa-star"></i>
								<i class="fa-solid fa-star"></i>
								<i class="fa-regular fa-star"></i>
							</div>
							<h3>aretes</h3>
							<span class="add-cart">
								<i class="fa-solid fa-basket-shopping"></i>
							</span>
							<p class="price">$5.60</p>
						</div>
					</div>
				</div>
			</section>

			<section class="container blogs">
				<h1 class="heading-1">Últimos Blogs</h1>

				<div class="container-blogs">
					<div class="card-blog">
						<div class="container-img">
							<img src="./assets/img/blogs.jpg" alt="Imagen Blog 1" />
							<div class="button-group-blog">
								<span>
									<i class="fa-solid fa-magnifying-glass"></i>
								</span>
								<span>
									<i class="fa-solid fa-link"></i>
								</span>
							</div>
						</div>
						<div class="content-blog">
							<h3>Lorem, ipsum dolor sit</h3>
							<span>29 Noviembre 2023</span>
							<p>
								Lorem ipsum dolor sit amet consectetur adipisicing
								elit. Iste, molestiae! Ratione et, dolore ipsum
								quaerat iure illum reprehenderit non maxime amet dolor
								voluptas facilis corporis, consequatur eius est sunt
								suscipit?
							</p>
							<div class="btn-read-more">Leer más</div>
						</div>
					</div>
					<div class="card-blog">
						<div class="container-img">
							<img src="./assets/img/blogs(1).jpg" alt="Imagen Blog 2" />
							<div class="button-group-blog">
								<span>
									<i class="fa-solid fa-magnifying-glass"></i>
								</span>
								<span>
									<i class="fa-solid fa-link"></i>
								</span>
							</div>
						</div>
						<div class="content-blog">
							<h3>Lorem, ipsum dolor sit</h3>
							<span>19 Noviembre 2020</span>
							<p>
								Lorem ipsum dolor sit amet consectetur adipisicing
								elit. Iste, molestiae! Ratione et, dolore ipsum
								quaerat iure illum reprehenderit non maxime amet dolor
								voluptas facilis corporis, consequatur eius est sunt
								suscipit?
							</p>
							<div class="btn-read-more">Leer más</div>
						</div>
					</div>
					<div class="card-blog">
						<div class="container-img">
							<img src="./assets/img/blogs(2).jpg" alt="Imagen Blog 3" />
							<div class="button-group-blog">
								<span>
									<i class="fa-solid fa-magnifying-glass"></i>
								</span>
								<span>
									<i class="fa-solid fa-link"></i>
								</span>
							</div>
						</div>
						<div class="content-blog">
							<h3>Lorem, ipsum dolor sit</h3>
							<span>1 Abril 2024</span>
							<p>
								Lorem ipsum dolor sit amet consectetur adipisicing
								elit. Iste, molestiae! Ratione et, dolore ipsum
								quaerat iure illum reprehenderit non maxime amet dolor
								voluptas facilis corporis, consequatur eius est sunt
								suscipit?
							</p>
							<div class="btn-read-more">Leer más</div>
						</div>
					</div>
				</div>
			</section>
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

		<script	src="./assets/js/ico.js"crossorigin="anonymous"></script>  
	</body>
</html>
