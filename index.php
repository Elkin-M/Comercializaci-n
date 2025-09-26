<?php
// lista_productos.php

// Incluir el archivo de conexión
include 'db/conexion.php';

// Obtener los tres productos más recientes
$sql = "SELECT * FROM productos ORDER BY id DESC LIMIT 3";
$result = $conn->query($sql);
?>


<?php
include 'db/conexion.php';
$sql2 = "SELECT * FROM campesinos ORDER BY id DESC LIMIT 3";
$result2 = $conn->query($sql2);

?>




<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

	<meta http-equiv="Expires" content="0">
	<meta http-equiv="Last-Modified" content="0">
	<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
	<meta http-equiv="Pragma" content="no-cache">
	<!-- title -->
	<title>FrutiK - Comercio del Caribe</title>

	<!-- favicon -->
	<link rel="shortcut icon" type="image/png" href="assets/img/favicon.png">
	<!-- google font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
	<!-- fontawesome -->
	<link rel="stylesheet" href="assets/css/all.min.css?1">
	<!-- bootstrap -->
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css?1">
	<!-- owl carousel -->
	<link rel="stylesheet" href="assets/css/owl.carousel.css?1">
	<!-- magnific popup -->
	<link rel="stylesheet" href="assets/css/magnific-popup.css?1">
	<!-- animate css -->
	<link rel="stylesheet" href="assets/css/animate.css?1">
	<!-- mean menu css -->
	<link rel="stylesheet" href="assets/css/meanmenu.min.css?1">
	<!-- main style -->
	<link rel="stylesheet" href="assets/css/main.css?1">
	<!-- responsive -->
	<link rel="stylesheet" href="assets/css/responsive.css?1">

</head>

<body>

	<!--PreLoader-->
	<div class="loader">
		<div class="loader-inner">
			<div class="circle"></div>
		</div>
	</div>
	<!--PreLoader Ends-->

	<!-- header -->
	<div class="top-header-area" id="sticker">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 text-center">
					<div class="main-menu-wrap">
						<!-- logo -->
						<div class="site-logo">
							<a href="index.html">
								<img src="assets/img/company-logos/6.png" alt="">
							</a>
						</div>
						<!-- logo -->

						<!-- menu start -->
						<nav class="main-menu">
							<ul>
								<li class="current-list-item"><a href="#">INICIO</a></li>
								<li><a href="#">NOSOTROS</a></li>
								<li><a href="views/tienda.php">TIENDA</a></li>
								<li><a href="views/campesinos.php">CAMPESINOS</a></li>

								<li><a href="#">INTELIGENCIA ARTIFICIAL</a>
									<ul class="sub-menu">
										<li><a href="views/IA/reconocimiento_de_frutas.html">Reconocimiento de frutas</a></li>
										<li><a href="views/IA/chatbot.html">Chatbot Experto en Mercado Hortofrutícola</a></li>
										<li><a href="views/IA/detector_de_plagas.html">Detector de plagas </a></li>
									</ul>
								</li>

								<li>
									<div class="header-icons">
										<a class="mobile-hide user-bar-icon" href="views/login_vendedor.php"><i class="fas fa-user"></i> INICIAR SESIÓN</a>
									</div>
								</li>
							</ul>
						</nav>
						<a class="mobile-show user-bar-icon" href=""><i class="fas fa-user"></i></a>
						<div class="mobile-menu"></div>
						<!-- menu end -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end header -->



	<!-- home page slider -->
	<div class="homepage-slider">
		<!-- single home slider -->
		<div class="single-homepage-slider homepage-bg-1">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-lg-7 offset-lg-1 offset-xl-0">
						<div class="hero-text">
							<div class="hero-text-tablecell">
								<p class="subtitle">Frescos & Orgánicos del Caribe</p>
								<h1>Frutas y Verduras de Temporada en Bolívar</h1>
								<div class="hero-btns">
									<a href="shop.html" class="boxed-btn">Colección Hortofrutícola</a>
									<a href="contact.html" class="bordered-btn">Contáctanos</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- single home slider -->

		<div class="single-homepage-slider homepage-bg-2">
			<div class="container">
				<div class="row">
					<div class="col-lg-10 offset-lg-1 text-center">
						<div class="hero-text">
							<div class="hero-text-tablecell">
								<p class="subtitle">Frescura Diaria del Campo a tu Mesa</p>
								<h1>Colección 100% Orgánica de Bolívar</h1>
								<div class="hero-btns">
									<a href="shop.html" class="boxed-btn">Explora la Tienda</a>
									<a href="contact.html" class="bordered-btn">Contáctanos</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- single home slider -->
		<div class="single-homepage-slider homepage-bg-3">
			<div class="container">
				<div class="row">
					<div class="col-lg-10 offset-lg-1 text-right">
						<div class="hero-text">
							<div class="hero-text-tablecell">
								<p class="subtitle">¡Gran Promoción de Temporada!</p>
								<h1>Descuentos Especiales de Diciembre</h1>
								<div class="hero-btns">
									<a href="shop.html" class="boxed-btn">Explora la Tienda</a>
									<a href="contact.html" class="bordered-btn">Contáctanos</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
	<!-- end home page slider -->

	

	<!-- product section -->
	<div class="product-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-title">
						<h3><span class="orange-text">Nuestros</span> Productos</h3>
						<p>Descubre la frescura y calidad de nuestros productos hortofrutícolas cultivados en el corazón de Bolívar. Cada fruta y verdura refleja la dedicación de nuestros agricultores locales.</p>
						<a href="views/tienda.php" class="btn btn-custom mt-3">Ver todos los productos</a>
					</div>
					<style>
						.btn-custom {
							display: inline-block;
							padding: 0.75rem 2rem;
							background-color: #23f22d;
							/* Color verde */
							color: #fff;
							border-radius: 30px;
							/* Bordes circulares */
							font-size: 1rem;
							font-weight: bold;
							text-transform: uppercase;
							text-decoration: none;
							transition: background-color 0.3s ease, transform 0.2s ease;
						}

						.btn-custom:hover {
							background-color: #28a745;
							/* Color verde oscuro al hacer hover */
							transform: translateY(-2px);
							/* Efecto de elevación en hover */
						}
					</style>

				</div>
			</div>

			<div class="row g-4">
				<?php
				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						echo "<div class='col-lg-4 col-md-6 mb-4'>";
						echo "<div class='single-product-item card h-100 text-center'>"; // Añadido text-center para centrar el contenido
						echo "<div class='product-image'>";
						echo "<a href='views/detalle_producto.php?id=" . $row['id'] . "'><img src='backend/" . $row['imagen_url'] . "' alt='" . $row['titulo'] . "' class='img-fluid card-img-top'></a>";
						echo "</div>";
						echo "<div class='card-body d-flex flex-column'>";
						echo "<h3 class='card-title'>" . $row['titulo'] . "</h3>";
						echo "<p class='product-description text-center'>" . $row['descripcion'] . "</p>"; // Centrado y con clase específica para control
						echo "<p class='product-price text-center'>$" . number_format($row['precio'], 2) . " COP/kg</p>"; // Centrado y separado
						echo "<a href='views/carrito.php?id=" . $row['id'] . "' class='cart-btn mt-auto btn btn-primary'><i class='fas fa-shopping-cart'></i> Agregar al carrito</a>";
						echo "</div>";
						echo "</div>";
						echo "</div>";
					}
				} else {
					echo "<p>No hay productos disponibles en este momento.</p>";
				}
				?>
			</div>
		</div>
	</div>

	<style>
		.single-product-item {
			display: flex;
			flex-direction: column;
			justify-content: space-between;
			height: 100%;
			text-align: center;
		}

		.product-image img {
			width: 100%;
			height: 200px;
			/* Establece una altura fija */
			object-fit: cover;
			/* Ajusta la imagen dentro del contenedor */
		}

		.card-body {
			display: flex;
			flex-direction: column;
			justify-content: space-between;
		}

		.card-title {
			font-size: 1.25rem;
			margin-top: 10px;
		}

		.product-description {
			height: 60px;
			/* Altura fija para mantener consistencia */
			overflow: hidden;
			/* Oculta el texto si es demasiado largo */
			margin-top: 10px;
		}

		.product-price {
			font-weight: bold;
			margin-top: 5px;
			margin-bottom: 10px;
		}
	</style>

	<!-- end product section -->

	<!-- IA banner -->
	<section class="shop-banner">
		<div class="container">
			<h3><span class="orange-text">Registra tus productos <br> con tan solo una foto </span></h3>
			<div class="sale-percent"><span>Ahora, los campesinos pueden registrar <br>sus productos de manera fácil y rápida <br>gracias a una IA avanzada que reconoce <br>las imágenes. </span></div>
			<a href="views/login_vendedor.php" class="cart-btn btn-lg">Registra tus productos</a>
		</div>
	</section>
	<!-- end IA banner -->



	<!-- Detector de Plagas banner section -->
	<section class="cart-banner pt-100 pb-100">
		<div class="container">
			<div class="row clearfix">
				<!--Image Column-->
				<div class="image-column col-lg-6">
					<div class="image">
						<img src="assets/img/detector_plagas1.png" alt="Detector de Plagas IA">
					</div>
				</div>
				<!--Content Column-->
				<div class="content-column col-lg-6">
					<h3><span class="orange-text">Detector de Plagas con</span> IA</h3>

					<div class="text">Nuestra herramienta avanzada de detección de plagas, potenciada por inteligencia artificial, permite a los campesinos analizar el estado de sus cultivos con solo una foto. Este sistema identifica plagas de manera precisa y rápida, facilitando un manejo efectivo para proteger sus productos y optimizar el rendimiento de sus cosechas.</div>
					<a href="views/IA/detector_de_plagas.html" class="cart-btn mt-3"> Más Información</a>
				</div>
			</div>
		</div>
	</section>
	<!-- end Detector de Plagas -->



	<!-- advertisement section -->
	<div class="abt-section mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-12">
					<div class="abt-bg">
						<a href="https://www.youtube.com/watch?v=crRqrBPTaOw" class="video-play-btn popup-youtube"><i class="fas fa-play"></i></a>
					</div>
				</div>
				<div class="col-lg-6 col-md-12">
					<div class="abt-text">
						<p class="top-sub">SGPS-12826-2024</p>
						<h2><span class="orange-text">Conoce Más del Proyecto</span></h2>
						<p>Este proyecto nace con el objetivo de apoyar a los campesinos de Bolívar, brindándoles una plataforma para comercializar sus productos hortofrutícolas de manera justa y directa. Aquí, la tecnología se une a la agricultura tradicional para fortalecer la economía local y ofrecer productos frescos y de alta calidad.</p>
						<p>A través de nuestra plataforma, los campesinos pueden registrar sus productos de forma sencilla, alcanzando nuevos mercados y recibiendo el reconocimiento que merecen por su trabajo diario.</p>
						<a href="https://www.youtube.com/watch?v=crRqrBPTaOw" class="boxed-btn mt-4">Conoce Más</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- end advertisement section -->



	<!-- latest news -->
	<div class="latest-news pt-150 pb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-title">
						<h3><span class="orange-text">Nuestros</span> Campesinos</h3>
						<p>Conoce a los campesinos de Bolívar, quienes con esfuerzo y dedicación cultivan productos frescos y de alta calidad.</p>
					</div>
				</div>
			</div>

			<div class="row">
				<?php if ($result2->num_rows > 0) {
					while ($row2 = $result2->fetch_assoc()) { ?>
						<div class="col-lg-4 col-md-6">
							<div class="single-latest-news">
								<div class="news-text-box">
									<h3><a href="single-news.html"><?php echo $row2['nombre'] . " " . $row2['apellidos']; ?></a></h3>
									<p class="blog-meta">
										<span class="author"><i class="fas fa-user"></i> Campesino</span>
										<span class="date"><i class="fas fa-map-marker-alt"></i> <?php echo $row2['municipio']; ?></span>
									</p>
									<p class="excerpt">
										<b>Correo:</b> <?php echo $row2['correo']; ?> <br>
										<b>Teléfono:</b> <?php echo $row2['telefono']; ?>
									</p>
									<a href="views/productos_campesino.php?id=<?php echo $row2['id']; ?>" class="read-more-btn">Ver productos <i class="fas fa-angle-right"></i></a>
								</div>
							</div>
						</div>
				<?php }
				} else {
					echo "<p>No hay productos disponibles en este momento.</p>";
				} ?>
			</div>

			<div class="row">
				<div class="col-lg-12 text-center">
					<a href="views/campesinos.php" class="boxed-btn">Ver todos los campesinos</a>
				</div>
			</div>
		</div>
	</div>
	<!-- end latest news -->

	<!-- logo carousel -->
	

	<!-- footer -->
	<div class="footer-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<div class="footer-box about-widget">
						<h2 class="widget-title">Sobre Nosotros</h2>
						<p>Nos dedicamos a ofrecer productos hortofrutícolas frescos y orgánicos de la región de Bolívar, trabajando junto a agricultores locales para llevar lo mejor de nuestra tierra hasta tu mesa.</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box get-in-touch">
						<h2 class="widget-title">Contáctanos</h2>
						<ul>
							<li>Calle Principal, Cartagena, Bolívar, Colombia</li>
							<li>contacto@hortifru-bolivar.com</li>
							<li>+57 300 123 4567</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box pages">
						<h2 class="widget-title">Páginas</h2>
						<ul>
							<li><a href="index.html">Inicio</a></li>
							<li><a href="about.html">Sobre Nosotros</a></li>
							<li><a href="services.html">Tienda</a></li>
							<li><a href="news.html">Noticias</a></li>
							<li><a href="contact.html">Contacto</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box subscribe">
						<h2 class="widget-title">Suscríbete</h2>
						<p>Únete a nuestra lista de correos para recibir las últimas noticias y ofertas.</p>
						<form action="index.html">
							<input type="email" placeholder="Correo electrónico">
							<button type="submit"><i class="fas fa-paper-plane"></i></button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- end footer -->

	<!-- copyright -->
	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-12">
					<p>Copyright &copy; 2024 - Frutik Bolívar. Todos los Derechos Reservados.<br>
						Desarrollado por - <a href="http://localhost/proyectocomercializacion/index.php">Frutik Bolívar</a>
					</p>
				</div>
				<div class="col-lg-6 text-right col-md-12">
					<div class="social-icons">
						<ul>
							<li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-linkedin"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- end copyright -->

	<!-- jquery -->
	<script src="assets/js/jquery-1.11.3.min.js?2"></script>
	<!-- bootstrap -->
	<script src="assets/bootstrap/js/bootstrap.min.js?2"></script>
	<!-- count down -->
	<script src="assets/js/jquery.countdown.js?2"></script>
	<!-- isotope -->
	<script src="assets/js/jquery.isotope-3.0.6.min.js?2"></script>
	<!-- waypoints -->
	<script src="assets/js/waypoints.js?2"></script>
	<!-- owl carousel -->
	<script src="assets/js/owl.carousel.min.js?2"></script>
	<!-- magnific popup -->
	<script src="assets/js/jquery.magnific-popup.min.js?2"></script>
	<!-- mean menu -->
	<script src="assets/js/jquery.meanmenu.min.js?2"></script>
	<!-- sticker js -->
	<script src="assets/js/sticker.js?2"></script>
	<!-- main js -->
	<script src="assets/js/main.js?2"></script>

</body>

</html>