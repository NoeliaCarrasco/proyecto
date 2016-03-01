<?PHP
include_once("./db_configuration.php");
	session_start();
	if(!isset($_SESSION['rol'])){header('location: login.php');}
	$categoria = 0;
	$edad = 0;
	$sexo = 0;
	if(isset($_REQUEST['p']) && intval($_REQUEST['p']) >= 0 && intval($_REQUEST['p']) <= 4){
		$categoria = intval($_REQUEST['p']);
	}else{
		$categoria = 0;
	}
	if(isset($_REQUEST['s']) && intval($_REQUEST['s']) > 0 && intval($_REQUEST['s']) <= 4){
		$sexo = intval($_REQUEST['s']);
	}else{
		$sexo = 0;
	}
	if(isset($_REQUEST['e']) && intval($_REQUEST['e']) > 0 && intval($_REQUEST['e']) <= 4){
		$edad = intval($_REQUEST['e']);
	}else{
		$edad = 0;
	}
	
	$mysqli = new mysqli($db_host, $db_user, $db_password, "deportes");

	/* comprobar la conexión */
	if (mysqli_connect_errno()) {
		printf("Falló la conexión: %s\n", mysqli_connect_error());
		exit();
	}

	$consulta = "SELECT * FROM productos WHERE IDCATEGORIA = '".$categoria."'";
	$productos = [];
	if ($resultado = $mysqli->query($consulta)) {
		if($resultado->num_rows > 0){
			while ( $fila = $resultado->fetch_assoc() ) {
			/* liberar el conjunto de resultados */
				array_push($productos, $fila);
			}
		}
		$resultado->close();
	}

	/* cerrar la conexión */
	$mysqli->close();
?>

<!DOCTYPE html>
<html>
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />





    <!-- ============================================
    ================= Stylesheets ===================
    ============================================= -->
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,700,700italic|Raleway:300,400,500,600,700|Open+Sans+Condensed:700" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="assets/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="assets/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="assets/css/animate.css" type="text/css" />
    <link rel="stylesheet" href="assets/js/vendor/flexslider/flexslider.css" type="text/css" />
    <link rel="stylesheet" href="assets/js/vendor/magnific/magnific-popup.css" type="text/css" />
    <link rel="stylesheet" href="assets/js/vendor/owl/assets/owl.carousel.css" type="text/css" />
    <link rel="stylesheet" href="assets/js/vendor/bootstrap-select/css/bootstrap-select.min.css" type="text/css" />
    <link rel="stylesheet" href="assets/js/vendor/range-slider/css/styles.css" type="text/css" />
    <link rel="stylesheet" href="assets/js/vendor/touchspin/jquery.bootstrap-touchspin.css" type="text/css" />
    <link rel="stylesheet" href="assets/js/vendor/starrr/starrr.css" type="text/css" />

    <!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->
    <link rel="stylesheet" type="text/css" href="assets/js/vendor/rs-plugin/css/settings.css" media="screen" />

    <!-- animsition CSS -->
    <link rel="stylesheet" href="assets/js/vendor/animsition/css/animsition.min.css">



    <!-- jQuery -->
    <script type="text/javascript" src="assets/js/vendor/jquery-1.11.2.min.js"></script>






    <!-- ============================================
    ============= Main App Stylesheet ===============
    ============================================= -->

    <link rel="stylesheet" href="assets/css/style.css" type="text/css" />







    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <!--[if lt IE 9]>
    	<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->









    <!-- ============================================
    ================== Page Title ===================
    ============================================= -->

    <title>Web Noelia | Tienda de deportes </title>







</head>

<body>








    <!-- ============================================
    ================= Page Wrapper ==================
    ============================================= -->

    <div id="wrapper" class="clearfix animsition">







        <!-- ================================================
        ================= Search Container ==================
        ================================================= -->

        <div id="search-container" class="search-box-wrapper">
            <div class="container">
                <i class="fa fa-search"></i>
                <div class="search-box">
                    <form action="http://example.com/" class="search-form" role="search" >
                        <input type="search" name="s" value="" title="Press Enter to submit your search" placeholder="Search…" class="search-field">
                        <input type="submit" value="Search" class="search-submit">
                    </form>
                </div>
            </div>
        </div><!--/ #search-container -->








        <!-- ==================================================
        ================= Additional Navbar ===================
        =================================================== -->

       <nav id="add-navbar">

            <div class="container clearfix">

                <ul class="pull-right">
					<?PHP
						if((isset($_SESSION['IDUSUARIO']) && $_SESSION['IDUSUARIO'] != '') && (isset($_SESSION['rol']) && intval($_SESSION['rol']) == 2)){
					?>
					<li><a href="#">Administrar</a>
						<ul>
							<li><a href="administrarUsuarios.php">Usuarios</a></li>
							<li><a href="administrarProductos.php">Productos</a></li>
						</ul>
					</li>
					<?PHP
						}
						if((isset($_SESSION['IDUSUARIO']) && $_SESSION['IDUSUARIO'] != '') && (isset($_SESSION['rol']) && intval($_SESSION['rol']) == 2)){
					?>
					<?PHP
						}
						if(!isset($_SESSION['IDUSUARIO'])){
					?>
                    <li><a href="login.php">Login</a></li>
					<?PHP
						}else{
					?>
                    <li><a href="disconnect.php">Logout</a></li>
					<?PHP
						}
					?>
                </ul>

                <ul class="divided">
                    <li><i class="fa fa-phone mr-5"></i> <span>+34 654 742 783</span></li>                    <li><i class="fa fa-user mr-5"></i> <span><?= $_SESSION['IDUSUARIO'] ?></span></li>
                </ul>

            </div>

        </nav><!-- #add-navbar end -->








        <!-- ============================================
        ==================== Header =====================
        ============================================= -->

        <header id="header" class="dark"><!-- class .sticky-mobile makes header sticky on small devices -->

            <div id="header-wrap">

                <div class="container clearfix">

                    <div id="main-navbar-toggle"><i class="fa fa-bars"></i></div>







                    <!-- ============================================
                    =================== Branding ====================
                    ============================================= -->

                    <div id="branding">
                        <a href="index.php" class="brand-normal"><img src="assets/images/logo-dark.png" alt="Minovate"></a>
                        <a href="index.php" class="brand-retina"><img src="assets/images/logo@2x-dark.png" alt="Minovate"></a>
                    </div><!-- #branding end -->










                    <!-- ============================================
                    ================= Main Navbar ===================
                    ============================================= -->
					<nav id="main-navbar">

                       <ul>
                            <li><a href="index.php">Inicio</a></li>
                            <li><a href="#">Hombre</a>
                                <ul>
                                    <li><a href="product-list.php?p=0&s=0">Sudaderas</a></li>
                                    <li><a href="product-list.php?p=1&s=0">Chandals</a></li>
                                    <li><a href="#">Zapatos deportivos</a>
										<ul>
											<li><a href="product-list.php?p=2&s=0&e=0">Botas de fútbol</a></li>
											<li><a href="product-list.php?p=3&s=0&e=0">Botines</a></li>
										</ul>
									</li>
                                    <li><a href="product-list.php?p=4&s=0&e=0">Mochilas y carteras</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Mujer</a>
                                <ul>
                                    <li><a href="product-list.php?p=0&s=1">Sudaderas</a></li>
                                    <li><a href="product-list.php?p=1&s=1&e=0">Chandals</a></li>
                                    <li><a href="#">Zapatos deportivos</a>
										<ul>
											<li><a href="product-list.php?p=2&s=1&e=0">Botas de fútbol</a></li>
											<li><a href="product-list.php?p=3&s=1&e=0">Botines</a></li>
										</ul>
									</li>
                                    <li><a href="product-list.php?p=4&s=1&e=0">Mochilas y carteras</a></li>
                                </ul>
                            </li>
                            </li>
                            <li><a href="#">Niño</a>
                                <ul>
                                    <li><a href="product-list.php?p=0&s=0&e=1">Sudaderas</a></li>
                                    <li><a href="product-list.php?p=1&s=0&e=1">Chandals</a></li>
                                    <li><a href="product-list.php?p=2&s=0&e=1">Zapatos deportivos</a></li>
                                    <li><a href="product-list.php?p=4&s=0&e=1">Mochilas y carteras</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Niña</a>
                                <ul>
                                    <li><a href="product-list.php?p=0&s=1&e=1">Sudaderas</a></li>
                                    <li><a href="product-list.php?p=1&s=1&e=1">Chandals</a></li>
                                    <li><a href="product-list.php?p=2&s=1&e=1">Zapatos deportivos</a></li>
                                    <li><a href="product-list.php?p=4&s=1&e=1">Mochilas y carteras</a></li>
                                </ul>
                            </li>
                            <li><a href="contact.php">Contacto</a>
                            </li>
                        </ul>







                        <!-- ==============================================
                        ================= Shopping Cart ===================
                        =============================================== -->
                       <div id="shopping-cart">
                            <a href="#" id="shopping-cart-trigger"><i class="fa fa-shopping-cart"></i><?PHP if(isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0){ ?><span class="badge"><?PHP $total_productos = 0; foreach($_SESSION['carrito'] as $producto_carrito){$total_productos+=$producto_carrito['CANTIDAD'];} echo $total_productos; ?></span><?PHP } ?></a>
                            <?PHP if(isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0){ ?>
							<div class="cart-content">
                                <div class="cart-title">
                                    <h4>Carrito</h4>
                                </div>
                                <ul class="cart-items">
                                <?PHP
									foreach($_SESSION['carrito'] as $id => $producto_carrito){
								?>
									<li class="media">
                                        <div class="media-left">
                                            <a href="product-detail.php">
                                                <img class="media-object thumb-w" alt="" src="./imagenes/<?PHP echo $producto_carrito['FOTO']; ?>">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <p class="media-heading"><a href="product-detail.php?i=<?PHP echo $id; ?>"><?PHP echo $producto_carrito['NOMBRE']; ?></a> <span class="quantity">x <?PHP echo $producto_carrito['CANTIDAD']; ?></span></p>
                                            <p class="price"><?PHP echo $producto_carrito['PRECIO']; ?>€</p>
                                        </div>
                                    </li>
								<?PHP
									}
								?>
                                </ul>
                                <div class="cart-actions clearfix">
									<?PHP $total = 0; foreach($_SESSION['carrito'] as $producto_carrito){ $total+=($producto_carrito['PRECIO']*$producto_carrito['CANTIDAD']);} ?>
                                    <span class="price pull-left"><?PHP echo $total; ?>€</span>
                                    <a href="shopping-cart.php" class="myBtn myBtn-3d myBtn-sm pull-right">Ver carrito</a>
                                </div>
                            </div>
							<?PHP
							}
							?>
                        </div><!-- #shopping-cart end -->









                        <!-- ==============================================
                        ================= Search Toggle ===================
                        =============================================== -->

                        <div id="search-toggle"> <span class="divider">|</span></div>







                    </nav><!-- #main-navbar end -->

                </div>

            </div>

        </header><!-- #header end -->










        <!-- ============================================
        =================== Breadcrumbs =================
        ============================================= -->
        <section id="breadcrumbs" class="breadcrumbs">

        </section><!-- #breadcrumbs end -->











        <!-- ============================================
        =================== Content =====================
        ============================================= -->

        <section id="content">

            <div class="content-wrap">

                <div class="container clearfix">
                    <div class="row">

                       <section id="content">

            <div class="content-wrap">

                <div class="container clearfix">
                    <div class="row">

                        <!-- SHOP SIDEBAR -->
                        <div class="col-md-3 col-sm-4 sidebar">

                            <ul class="sidebar-navigation" id="sidebar-menu">
                                <li <?PHP if($sexo==1 && $edad==0){echo 'class="active open"';} ?>><a href="./product-list.php?p=0&s=1">Mujer</a>
                                    <ul>
                                        <li <?PHP if($categoria == 0){echo 'class="active"';} ?>><a href="./product-list.php?p=0&s=1">Sudaderas</a></li>
                                        <li <?PHP if($categoria == 1){echo 'class="active"';} ?>><a href="./product-list.php?p=1&s=1">Chandals</a></li>
                                        <li <?PHP if($categoria == 2 || $categoria == 3){echo 'class="active open"';} ?>><a href="product-list.php?p=2&s=1">Zapatos deportivos</a>
                                            <ul>
                                                <li <?PHP if($categoria == 2){echo 'class="active"';} ?>><a href="./product-list.php?p=2&s=1">Botas de futbol</a></li>
                                                <li <?PHP if($categoria == 3){echo 'class="active"';} ?>><a href="./product-list.php?p=3&s=1">Botines</a></li>
                                                
                                            </ul>
                                        </li>
                                        <li <?PHP if($categoria == 4){echo 'class="active"';} ?>><a href="./product-list.php?p=4&s=1">Mochilas y carteras</a></li>
                                    </ul>
                                </li>
                                <li <?PHP if($sexo==0 && $edad==0){echo 'class="active open"';} ?>><a href="./product-list.php?p=0&s=0">Hombre</a>
                                    <ul>
                                        <li <?PHP if($categoria == 0){echo 'class="active"';} ?>><a href="./product-list.php?p=0&s=1">Sudaderas</a></li>
                                        <li <?PHP if($categoria == 1){echo 'class="active"';} ?>><a href="./product-list.php?p=1&s=1">Chandals</a></li>
                                        <li <?PHP if($categoria == 2 || $categoria == 3){echo 'class="active open"';} ?>><a href="./product-list.php?p=2&s=1">Zapatos deportivos</a>
                                            <ul>
                                                <li <?PHP if($categoria == 2){echo 'class="active"';} ?>><a href="./product-list.php?p=2&s=1">Botas de futbol</a></li>
                                                <li <?PHP if($categoria == 3){echo 'class="active"';} ?>><a href="./product-list.php?p=3&s=1">Botines</a></li>
                                                
                                            </ul>
                                        </li>
                                        <li <?PHP if($categoria == 4){echo 'class="active"';} ?>><a href="./product-list.php?p=4&s=1">Mochilas y carteras</a></li>
                                    </ul>
                                </li>
                                <li <?PHP if($sexo==0 && $edad==1){echo 'class="active open"';} ?>><a href="product-list.php?p=0&s=0&e=1">Niño</a>
                                    <ul>
                                        <li <?PHP if($categoria == 0){echo 'class="active"';} ?>><a href="product-list.php?p=0&s=0&e=1">Sudaderas</a></li>
                                        <li <?PHP if($categoria == 1){echo 'class="active"';} ?>><a href="product-list.php?p=1&s=0&e=1">Chandals</a></li>
                                        <li <?PHP if($categoria == 2){echo 'class="active"';} ?>><a href="product-list.php?p=2&s=0&e=1">Zapatos deportivos</a></li>
                                        <li <?PHP if($categoria == 4){echo 'class="active"';} ?>><a href="product-list.php?p=4&s=0&e=1">Mochilas y carteras</a></li>
                                    </ul>
                                </li>
								<li <?PHP if($sexo==1 && $edad==1){echo 'class="active open"';} ?>><a href="product-list.php?p=0&s=1&e=1">Niña</a>
                                    <ul>
                                        <li <?PHP if($categoria == 0){echo 'class="active"';} ?>><a href="product-list.php?p=0&s=1&e=1">Sudaderas</a></li>
                                        <li <?PHP if($categoria == 1){echo 'class="active"';} ?>><a href="product-list.php?p=1&s=1&e=1">Chandals</a></li>
                                        <li <?PHP if($categoria == 2){echo 'class="active"';} ?>><a href="product-list.php?p=2&s=1&e=1">Zapatos deportivos</a></li>
                                        <li <?PHP if($categoria == 4){echo 'class="active"';} ?>><a href="product-list.php?p=4&s=1&e=1">Mochilas y carteras</a></li>
                                    </ul>
								</li>
                                
                            </ul>

                        </div>
                        <!-- END SHOP SIDEBAR -->


                        <!-- PRODUCT LIST -->
                        <div class="col-md-9 col-sm-8">

                            <div class="row product-list">

							<?PHP
							if(isset($productos) && count($productos) > 0){
								foreach($productos as $producto){
							?>
									<div class="col-md-4 col-sm-6">
										<article class="product-card">
											<div class="product-image two-sided">
												<img src="./imagenes/<?PHP echo $producto['FOTO']; ?>" alt=""> <!-- Lado 1 de la imagen -->
												<img src="./imagenes/<?PHP echo $producto['FOTO']; ?>" alt=""> <!-- Lado 2 de la imagen -->
												<div class="image-overlay" data-lightbox="gallery">
													<a href="./imagenes/<?PHP echo $producto['FOTO']; ?>" data-lightbox="gallery-item"><i class="fa fa-search-plus"></i></a>
													<a href="./imagenes/<?PHP echo $producto['FOTO']; ?>" class="hidden" data-lightbox="gallery-item"></a>
													<a href="product-detail.php<?PHP echo '?p='.$categoria.'&s='.$sexo.'&e='.$edad.'&i='.$producto['IDPRODUCTO']; ?>"><i class="fa fa-ellipsis-h"></i></a>
												</div>
											</div>
												
												
												<form action="addCarrito.php" method="POST">

													<div class="product-detail">
														<h4><a href="product-detail.php<?PHP echo '?p='.$categoria.'&s='.$sexo.'&e='.$edad.'&i='.$producto['ID']; ?>"></a></h4>
														<span class="price"><?PHP echo $producto['PRECIO']; ?>€</span>
														<div class="add-to-cart">
															<input type="hidden" name="IDPRODUCTO" value="<?PHP echo $producto['IDPRODUCTO']; ?>">
															<input type="hidden" name="FOTO" value="<?PHP echo $producto['FOTO']; ?>">
															<input type="hidden" name="NOMBRE" value="<?PHP echo $producto['NOMBRE']; ?>">
															<input type="hidden" name="PRECIO" value="<?PHP echo $producto['PRECIO']; ?>">
															<button class="add-to-cart"><i class="fa fa-angle-right"></i> Añadir al carrito</button>
														</div>
													</div>
												
												</form>
										</article>
									</div>
							<?PHP
								}
							}
							?>
                            </div>

                        </div>
                        <!-- END PRODUCT LIST -->

                    </div>
                    <!-- /row -->


                </div>
                <!-- /container -->
            </div>
        </section><!-- #content end -->










        <!-- ============================================
        ==================== Footer =====================
        ============================================= -->

       <footer id="footer">

            <div class="footer-main">
                <div class="container">
                    <div class="row">

                        <div class="col-md-3 col-md-offset-1">

                            <div class="widget widget-menu mb-0">

                                <h4><strong>Informacion</strong></h4>
                                <ul class="list-unstyled">
                                    <li><a href="#"><i class="fa fa-angle-right"></i> Terminos y condiciones</a></li>
                                    <li><a href="#"><i class="fa fa-angle-right"></i> Pago</a></li>
                                    <li><a href="#"><i class="fa fa-angle-right"></i> Envio</a></li>
                                    <li><a href="#"><i class="fa fa-angle-right"></i> Devoluciones</a></li>
                                    <li><a href="#"><i class="fa fa-angle-right"></i> Tarjeta Regalo</a></li>
                                </ul>

                            </div>

                        </div>

                        <div class="col-md-4">
                            <div class="widget widget-contact mt-20-md">
                                <h4><strong>Contactenos</h4>
                                <address>
                                     <strong>Sevilla</strong><br>
                                    Avenida de la constitucion s/n<br>
                                    España<br/><br/>
                                    <strong>Telefono:</strong> +34 654 742 783<br>
                                    <strong>Email:</strong> <a href="noeliacarrasco@hotmail.com">noeliacarrasco@hotmail.com</a><br>
                                    <strong>Skype:</strong> <a href="#">noelia</a>
                                </address>
                            </div>
                        </div>

                    </div>

                    <div class="line"></div>

                    <!-- row -->
                    <div class="row">


                    </div>
                    <!-- /row -->

                </div>
            </div>

        </footer><!-- #footer end -->

    </div><!-- #wrapper end -->











    <!-- ============================================
    =================== Go to Top ===================
    ============================================= -->

    <div id="gotoTop" class="fa fa-angle-up hidden-md"></div>










    <!-- ============================================
    ============== Vendor JavaScripts ===============
    ============================================= -->

    <script type="text/javascript" src="assets/js/vendor/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/vendor/superfish/js/superfish.min.js"></script>
    <script type="text/javascript" src="assets/js/vendor/jRespond/jRespond.min.js"></script>
    <script type="text/javascript" src="assets/js/vendor/smoothscroll/SmoothScroll.js"></script>
    <script type="text/javascript" src="assets/js/vendor/appear/jquery.appear.js"></script>
    <script type="text/javascript" src="assets/js/vendor/stellar/jquery.stellar.min.js"></script>
    <script type="text/javascript" src="assets/js/vendor/flexslider/jquery.flexslider-min.js"></script>
    <script type="text/javascript" src="assets/js/vendor/magnific/jquery.magnific-popup.min.js"></script>
    <script type="text/javascript" src="assets/js/vendor/owl/owl.carousel.min.js"></script>
    <script type="text/javascript" src="assets/js/vendor/jflickrfeed/jflickrfeed.min.js"></script>
    <script type="text/javascript" src="assets/js/vendor/tweet-js/jquery.tweet.min.js"></script>
    <script type="text/javascript" src="assets/js/vendor/countTo/jquery.countTo.js"></script>
    <script type="text/javascript" src="assets/js/vendor/bootstrap-select/js/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="assets/js/vendor/range-slider/js/plugin.js"></script>

    <!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
    <script type="text/javascript" src="assets/js/vendor/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
    <script type="text/javascript" src="assets/js/vendor/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>

    <!-- animsition js -->
    <script src="assets/js/vendor/animsition/js/jquery.animsition.min.js"></script>







    <!-- ============================================
    ============== Custom JavaScripts ===============
    ============================================= -->


    <script type="text/javascript" src="assets/js/global.js"></script>


</body>
</html>