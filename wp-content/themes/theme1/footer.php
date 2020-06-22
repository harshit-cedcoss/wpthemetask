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
			<a href="<?php echo esc_html( $option['wporg_field_facebook_link'] ); ?>"><img src="" alt="facebook.com"></a>
			<a href="<?php echo esc_html( $option['wporg_field_twitter_link'] ); ?>"><img src="" alt="twitter.com"></a>

			<p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
			</div>
		<!-- /.container -->
		</footer>

	<!-- Bootstrap core JavaScript -->

	<?php wp_footer(); ?>
	</body>
</html>
