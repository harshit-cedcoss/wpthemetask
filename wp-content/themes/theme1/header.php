<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Theme1
 * @since Theme1 1.0
 */

?><!DOCTYPE html>
<html lang="en">

	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Blog Home - Start Bootstrap Template</title>

	<?php wp_head(); ?>
</head>

<body class="custom-background">

	<!-- Navigation -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
	<div class="container">
		<a class="navbar-brand" href="#">Start Bootstrap</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item active">
					<a class="nav-link" href="#">Home
						<span class="sr-only">(current)</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">About</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Services</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Contact</a>
				</li>
			</ul>
		</div>
	</div>
</nav>
<nav>
	<div class="container"> 
		<?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
	</div>
</nav>

