<?php defined('_EXEC') or die; ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
	<head>
		<meta charset="UTF-8" />
		<meta content="text/html; charset=iso-8859-1" http-equiv="Content-Type" />
		{$dependencies.meta}

		<base href="{$vkye_base}">

		<title>{$vkye_title}</title>

		<!--Adaptive Responsive-->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
		<meta name="author" content="" />
		<meta name="description" content="" />

		<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
		<link href="{$path.css}bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="{$path.css}icons.css" rel="stylesheet" type="text/css">
        <link href="{$path.css}style.css?v=1.2" rel="stylesheet" type="text/css">

		{$dependencies.css}
	</head>
	<body>
		<!-- Loader -->
		<div id="preloader"><div id="status"><div class="spinner"></div></div></div>

		<!-- Navigation Bar-->
		<header id="topnav" class="d-print-none">
			<div class="topbar-main">
				<div class="container-fluid">
					<!-- Logo container-->
					<div class="logo">
						<!-- Image Logo -->
						<a href="index.php" class="logo">
							<img src="{$path.root_uploads}icontype-white.png" alt="" height="50" class="logo-small">
							<img src="{$path.root_uploads}icontype-white.png" alt="" height="50" class="logo-large">
						</a>
					</div>
					<!-- End Logo container-->
					<div class="menu-extras topbar-custom">
						<ul class="list-inline float-right mb-0">
							<!-- User-->
							<li class="list-inline-item dropdown notification-list">
								<a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
									<span style="width:10px;height:10px;background-color:#76ff03;display:inline-block;border-radius:50%;margin-right:5px;margin-left: 10px;"></span>
									<span style="color:#FFF;display:inline-block;margin-right: 10px;"><?= strtoupper(str_replace('_', ' ', Session::get_value('_vkye_user'))) ?></span>
								</a>
								<div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown ">
									<a class="dropdown-item" href="index.php?c=System&m=logout"><i class="mdi mdi-logout m-r-5 text-muted"></i> Cerrar sesion</a>
								</div>
							</li>
							<li class="menu-item list-inline-item">
								<!-- Mobile menu toggle-->
								<a class="navbar-toggle nav-link">
									<div class="lines"> <span></span>
										<span></span>
										<span></span>
									</div>
								</a>
								<!-- End mobile menu toggle-->
							</li>
						</ul>
					</div>
					<!-- end menu-extras -->
					<div class="clearfix"></div>
				</div>
				<!-- end container -->
			</div>
			<!-- end topbar-main -->
			<!-- MENU Start -->
			<div class="navbar-custom">
				<div class="container-fluid">
					<div id="navigation">
						<!-- Navigation Menu-->
						<ul class="navigation-menu">
							<li class="has-submenu">
								<a href="index.php"><i class="dripicons-home"></i>General</a>
							</li>
						</ul>
						<!-- End navigation menu -->
					</div>
					<!-- end #navigation -->
				</div>
				<!-- end container -->
			</div>
			<!-- end navbar-custom -->
		</header>
		<!-- End Navigation Bar-->
