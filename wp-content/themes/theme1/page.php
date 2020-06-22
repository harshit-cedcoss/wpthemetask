<?php
/**
 * The Page template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Theme1
 * @since Theme1 1.0
 */

?>
<?php get_header(); ?>
	<!-- Page Content -->

	<div class="container">

		<div class="row">
		<?php if ( get_theme_mod( 'basic-author-callout-display-options' ) === 'Yes' ) { ?>
				<!-- <div class="row-padding author"> -->
					<div class="col-3 author-image">
						<img src="<?php echo esc_html( wp_get_attachment_url( get_theme_mod( 'basic-author-callout-image' ) ) ); ?>" alt="Author Image">
					</div>
					<div class="col-9 author-content">
					<?php
						$author_text = get_theme_mod( 'basic-author-callout-text' );
					if ( '' !== $author_text ) {
						echo esc_html( sanitize_text_field( wpautop( $author_text ) ) );
					} else {
						echo 'Edit this by going to your Dashboard -> Appearance -> Customise -> Author Editor';
					}
					?>
					</div>
				<!-- </div>  -->
		<?php } ?>

			<!-- Blog Entries Column -->
			<div class="col-md-8">

				<h1 class="my-4">Page Heading
					<small>Secondary Text</small>
				</h1>
				<?php
				if ( have_posts() ) {
					while ( have_posts() ) {
							the_post();
						?>
					<!-- Blog Post -->
					<div class="card mb-4">
						<img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap">
						<div class="card-body">
							<h2 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<p class="card-text"><?php the_content(); ?></p>
							<a href="#" class="btn btn-primary">Read More &rarr;</a>
						</div>
						<div class="card-footer text-muted">
							Posted on <?php the_date(); ?> by
							<a href="#"><?php the_author(); ?></a>
						</div>
					</div>
							<?php
					} // end while
				} // end if
				?>

			<!-- Pagination -->
				<?php
				// Previous/next page navigation.
				the_posts_pagination(
					array(
						'prev_text'          => __( 'Old', 'theme1' ),
						'next_text'          => __( 'New', 'theme1' ),
						'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'theme1' ) . ' </span>',
					)
				);
				?>
				<ul class="pagination justify-content-center mb-4">
					<li class="page-item">
						<a class="page-link" href="#">&larr; Older</a>
					</li>
					<li class="page-item disabled">
						<a class="page-link" href="#">Newer &rarr;</a>
					</li>
				</ul>

			</div>

<?php // get_sidebar(); ?>

		</div>
		<!-- /.row -->
<?php
// If comments are open or we have at least one comment, load up the comment template.
if ( comments_open() || get_comments_number() ) :
	comments_template();
endif;
?>
<!-- <div class="pagination">
	<?php // paginate_comments_links(); ?>
</div> -->

	</div>
	<!-- /.container -->

<?php get_footer(); ?>
