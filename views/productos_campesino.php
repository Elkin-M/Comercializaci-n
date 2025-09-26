<?php
include '../db/conexion.php';

if (isset($_GET['id'])) {
    $campesino_id = $_GET['id'];

    // Obtener datos del campesino
    $sql_campesino = "SELECT nombre, apellidos, cedula, telefono, correo, direccion, departamento, municipio 
                     FROM campesinos WHERE id = ?";
    $stmt_campesino = $conn->prepare($sql_campesino);
    $stmt_campesino->bind_param("i", $campesino_id);
    $stmt_campesino->execute();
    $resultado_campesino = $stmt_campesino->get_result();

    if ($resultado_campesino->num_rows === 0) {
        die("<div class='alert alert-danger'>Campesino no encontrado</div>");
    }

    $campesino = $resultado_campesino->fetch_assoc();
    $stmt_campesino->close();

    // Obtener productos del campesino
    $sql_productos = "SELECT * FROM productos WHERE campesino_id = ?";
    $stmt_productos = $conn->prepare($sql_productos);
    $stmt_productos->bind_param("i", $campesino_id);
    $stmt_productos->execute();
    $resultado_productos = $stmt_productos->get_result();
    $stmt_productos->close();

} else {
    die("<div class='alert alert-danger'>ID de campesino no proporcionado</div>");
}
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

    <!-- product section -->
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><?= $campesino['nombre'] . " " . $campesino['apellidos'] ?></h3>
                        <p>
                            <?= $campesino['municipio'] ?>, <?= $campesino['departamento'] ?><br>
                            <?= $campesino['correo'] ?> | <?= $campesino['telefono'] ?>
                        </p>
                    </div>
                </div>
            </div>

            <div class="row">
                <?php if ($resultado_productos->num_rows > 0): ?>
                    <?php while ($producto = $resultado_productos->fetch_assoc()): ?>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="single-product-item">
                                <div class="product-image">
                                    <a href="detalle_producto.php?id=<?= $producto['id'] ?>">
                                        <img src="../backend/<?= $producto['imagen_url'] ?>" 
                                             alt="<?= $producto['titulo'] ?>" 
                                             class="img-fluid">
                                    </a>
                                </div>
                                <h3 class="mt-3"><?= $producto['titulo'] ?></h3>
                                <p class="product-price text-success">
                                    $<?= number_format($producto['precio'], 0) ?> COP/kg
                                </p>
                                <a href="carrito.php?id=<?= $producto['id'] ?>" 
                                   class="btn btn-primary btn-sm btn-block">
                                    <i class="fas fa-shopping-cart"></i> Agregar
                                </a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="alert alert-warning text-center">
                            <strong>¡Sin productos!</strong> Este campesino aún no ha registrado productos
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- end product section -->








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