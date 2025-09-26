<?php
// lista_productos.php

// Incluir el archivo de conexión
include '../db/conexion.php';


$sql2 = "SELECT * FROM campesinos;";
$result2 = $conn->query($sql2);
?>



<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

	<!-- title -->
	<title>FrutiK - Comercio del Caribe</title>

	<!-- favicon -->
	<link rel="shortcut icon" type="image/png" href="assets/img/favicon.png">
	<!-- google font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
	<!-- fontawesome -->
	<link rel="stylesheet" href="../assets/css/all.min.css?2">
	<!-- bootstrap -->
	<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css?2">
	<!-- owl carousel -->
	<link rel="stylesheet" href="../assets/css/owl.carousel.css?2">
	<!-- magnific popup -->
	<link rel="stylesheet" href="../assets/css/magnific-popup.css?2">
	<!-- animate css -->
	<link rel="stylesheet" href="../assets/css/animate.css?2">
	<!-- mean menu css -->
	<link rel="stylesheet" href="../assets/css/meanmenu.min.css?2">
	<!-- main style -->
	<link rel="stylesheet" href="../assets/css/main.css?2">
	<!-- responsive -->
	<link rel="stylesheet" href="../assets/css/responsive.css?2">

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
							<a href="../index.php">
								<img src="../assets/img/company-logos/6.png" alt="">
							</a>
						</div>
						<!-- logo -->

						<!-- menu start -->
						<nav class="main-menu">
							<ul>
								<li class="current-list-item"><a href="../index.php">INICIO</a></li>
								<li><a href="../views/nosotros.html">NOSOTROS</a></li>
								<li><a href="../views/tienda.php">TIENDA</a></li>
								<li><a href="../views/campesinos.php">CAMPESINOS</a></li>

								<li><a href="#">INTELIGENCIA ARTIFICIAL</a>
									<ul class="sub-menu">
										<li><a href="../views/IA/reconocimiento_de_frutas.html">Reconocimiento de frutas</a></li>
										<li><a href="../views/IA/chatbot.html">Chatbot Experto en Mercado Hortofrutícola</a></li>
										<li><a href="../views/IA/detector_de_plagas.html">Detector de plagas </a></li>
									</ul>
								</li>

								<li>
									<div class="header-icons">
										<a class="mobile-hide user-bar-icon" href="../views/login_vendedor.php"><i class="fas fa-user"></i> INICIAR SESIÓN</a>
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

	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>Frescos y Orgánicos del Caribe</p>
						<h1>Nuestros Campesinos</h1>
					</div>
				</div>
			</div>
		</div>

	</div>
	<!-- end breadcrumb section -->

    <!-- campesinos -->
	<div class="latest-news pt-150 pb-150">
		<div class="container">
			

			<div class="row">
				<?php if ($result2->num_rows > 0) {
					while ($row2 = $result2->fetch_assoc()) { ?>
						<div class="col-lg-4 col-md-6">
							<div class="single-latest-news">
								<div class="news-text-box">
								<h3><a href="productos_campesino.php?id=<?php echo $row2['id']; ?>"><?php echo $row2['nombre'] . " " . $row2['apellidos']; ?></a></h3>
									<p class="blog-meta">
										<span class="author"><i class="fas fa-user"></i> Campesino</span>
										<span class="date"><i class="fas fa-map-marker-alt"></i> <?php echo $row2['municipio']; ?></span>
									</p>
									<p class="excerpt">
										<b>Correo:</b> <?php echo $row2['correo']; ?> <br>
										<b>Teléfono:</b> <?php echo $row2['telefono']; ?>
									</p>
									<a href="productos_campesino.php?id=<?php echo $row2['id']; ?>" class="read-more-btn">Ver productos <i class="fas fa-angle-right"></i></a>
								</div>
							</div>
						</div>
				<?php }
				} else {
					echo "<p>No hay productos disponibles en este momento.</p>";
				} ?>
			</div>

			
		</div>
	</div>
	<!-- end campesinos -->





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
	<script src="../assets/js/jquery-1.11.3.min.js?2"></script>
	<!-- bootstrap -->
	<script src="../assets/bootstrap/js/bootstrap.min.js?2"></script>
	<!-- count down -->
	<script src="../assets/js/jquery.countdown.js?2"></script>
	<!-- isotope -->
	<script src="../assets/js/jquery.isotope-3.0.6.min.js?2"></script>
	<!-- waypoints -->
	<script src="../assets/js/waypoints.js?2"></script>
	<!-- owl carousel -->
	<script src="../assets/js/owl.carousel.min.js?2"></script>
	<!-- magnific popup -->
	<script src="../assets/js/jquery.magnific-popup.min.js?2"></script>
	<!-- mean menu -->
	<script src="../assets/js/jquery.meanmenu.min.js?2"></script>
	<!-- sticker js -->
	<script src="../assets/js/sticker.js?2"></script>
	<!-- main js -->
	<script src="../assets/js/main.js?2"></script>

</body>

</html>