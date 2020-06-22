<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Theme1
 * @since Theme1 1.0
 */

?>  
	<!-- Footer -->
		<footer class="py-5 bg-dark">
			<div class="container">
				<?php $option = get_option( 'wporg_options' ); ?>
			<a href="<?php echo esc_html( $option['wporg_field_facebook_link'] ); ?>"><span class="iconify" data-icon="dashicons:facebook" data-inline="false" style="color: blue;" data-width="30" data-height="30"></span></a>
			<a href="<?php echo esc_html( $option['wporg_field_twitter_link'] ); ?>"><span class="iconify" data-icon="dashicons:twitter" data-inline="false" style="color: blue;" data-width="35" data-height="30"></span></a>

			<p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
			</div>
		<!-- /.container -->
		</footer>

	<!-- Bootstrap core JavaScript -->

	<?php wp_footer(); ?>
	</body>
</html>
