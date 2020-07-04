<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package poca
 */

get_header();
// die("ksj");
?>


<main id="primary" class="site-main">
	<!-- ***** Breadcrumb Area Start ***** -->
	<div class="breadcumb-area bg-img bg-overlay" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/bg-img/2.jpg);">
		<div class="container h-100">
		<div class="row h-100 align-items-center">
			<div class="col-12">
			<h2 class="title mt-70">Blog Single</h2>
			</div>
		</div>
		</div>
	</div>
	<div class="breadcumb--con">
		<div class="container">
		<div class="row">
			<div class="col-12">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Blog</li>
				</ol>
			</nav>
			</div>
		</div>
		</div>
	</div>
  	<!-- ***** Breadcrumb Area End ***** -->
	<!-- ***** Blog Details Area Start ***** -->
	<section class="blog-details-area">
		<div class="container">
			<div class="row">
				<div class="col-12 col-lg-8">
				<?php if(have_posts()){ ?>
					<?php while(have_posts()){ ?>
						<?php the_post(); ?>
					<div class="podcast-details-content d-flex mt-5 mb-80">

						<!-- Post Share -->
						<div class="post-share">
							<p>Share</p>
							<div class="social-info">
								<a href="#" class="facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
								<a href="#" class="twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
								<a href="#" class="google-plus"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
								<a href="#" class="pinterest"><i class="fa fa-instagram" aria-hidden="true"></i></a>
								<a href="#" class="thumb-tack"><i class="fa fa-thumb-tack" aria-hidden="true"></i></a>
							</div>
						</div>

						<!-- Post Details Text -->
						<div class="post-details-text">
							<?php the_post_thumbnail(); ?>

							<div class="post-content">
								<a href="#" class="post-date"><?php the_date(); ?></a>
								<h2><?php the_title(); ?></h2>
								<div class="post-meta">
								<a href="#" class="post-author"><?php the_author(); ?></a> |
								<a href="#" class="post-catagory"><?php the_category(', '); ?></a>
								</div>
							</div>

							<p><?php the_content(); ?></p>

							<!-- Post Catagories -->
							<div class="post-catagories d-flex align-items-center">
								<h6>Categories:</h6>
								<?php the_category('<b> , </b>'); ?>
								>
							</div>

							<!-- Pagination -->
							<div class="poca-pager d-flex mb-30">
								<?php previous_post_link($format = '%link', $link = 'Previous Post'); ?>
								<?php next_post_link($format = '%link', $link = 'Next Post'); ?>
							</div>

							<!-- Comments Area -->
							<div class="comment_area mb-50 clearfix">
								<?php
									$postid = get_the_ID();
									$args = array(
 											   'post_id' => $postid,   // Use post_id, not post_ID
    										    'count'   => true // Return only the count
												);
									$comments_count = get_comments( $args );
								?>
								<h5 class="title"><?php echo $comments_count. 'Comments'; ?></h5>
								<?php
									// If comments are open or we have at least one comment, load up the comment template.
									if ( comments_open() || get_comments_number() ) :
										comments_template();
									endif;
								?>								
							</div>
							<div class="contact-form">
								<?php
								$comment_author = 'Name';
								$comment_email = 'Email';
								$comment_body = 'Comments';
								$fields = array(
									//Author field
									'author' => '<div class="col-lg-6"><input class="form-control mb-30" id="author" name="author" aria-required="true" placeholder="' . $comment_author .'"></input></div>',
									//Email Field
									'email' => '<div class="col-lg-6"><input class="form-control mb-30" id="email" name="email" placeholder="' . $comment_email .'"></input></div>',
									//'cookies' => '',
								);
								$args = array(
									'class_submit' => 'btn poca-btn mt-30',
									'label_submit' => __( 'Post Comment' ),
									
									'comment_field' => '<div class="col-12"><textarea id="comment" name="comment" class="form-control mb-30" aria-required="true" placeholder="' . $comment_body .'"></textarea></div>',
									'title_reply' => '<h5 class="mb-30">Leave A Comment</h5>',
									'fields'       => apply_filters( 'comment_form_default_fields', $fields ),
								);
								comment_form( $args );
								?>
							</div>
						</div>
					</div>
					<?php } ?>
				<?php } ?>
				</div>

				<div class="col-12 col-lg-4">
					<div class="sidebar-area mt-5">

						<?php get_sidebar(); ?>
						
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- ***** Blog Details Area End ***** -->

    <!-- ***** Newsletter Area Start ***** -->
	<section class="poca-newsletter-area bg-img bg-overlay pt-50 jarallax" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/bg-img/15.jpg);">
		<div class="container">
		<div class="row align-items-center">
			<!-- Newsletter Content -->
			<div class="col-12 col-lg-6">
			<div class="newsletter-content mb-50">
				<h2>Sign Up To Newsletter</h2>
				<h6>Subscribe to receive info on our latest news and episodes</h6>
			</div>
			</div>
			<!-- Newsletter Form -->
			<div class="col-12 col-lg-6">
			<div class="newsletter-form mb-50">
				<form action="#" method="post">
				<input type="email" name="nl-email" class="form-control" placeholder="Your Email">
				<button type="submit" class="btn">Subscribe</button>
				</form>
			</div>
			</div>
		</div>
		</div>
  	</section>
  	<!-- ***** Newsletter Area End ***** -->
		
</main><!-- #main -->
<!-- ***** Footer Area Start ***** -->
<?php
//get_sidebar();
get_footer();
