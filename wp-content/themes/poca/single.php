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

							<!-- Blockquote -->
							<!-- <blockquote class="poca-blockquote d-flex">
								<div class="icon">
								<i class="fa fa-quote-left" aria-hidden="true"></i>
								</div>
								<div class="text">
								<h5>That’s not to say you’ll have the exact same thing if you stop by: the restaurant’s menus change constantly, based on seasonal ingredients.</h5>
								<h6>Jacob Austin</h6>
								</div>
							</blockquote>

							<h2>This is definitely my favorite podcast</h2>
							<p>Delightful unreserved impossible few estimating men favourable see entreaties. She propriety immediate was improving. He or entrance humoured likewise moderate. Much nor game son say feel. Fat make met can must form into gate. Me we
								offending prevailed discovery.</p>
							<p>Quick six blind smart out burst. Perfectly on furniture dejection determine my depending an to. Add short water court fat. Her bachelor honoured perceive securing but desirous ham required. Questions deficient acuteness to engrossed
								as. Entirely led ten humoured greatest and yourself. Besides ye country on observe. She continue appetite endeavor she judgment interest the met. For she surrounded motionless fat resolution may.</p>
							<p>He share of first to worse. Weddings and any opinions suitable smallest nay. My he houses or months settle remove ladies appear. Engrossed suffering supposing he recommend do eagerness. Commanded no of depending extremity recommend
								attention tolerably. Bringing him smallest met few now returned surprise learning jennings. Objection delivered eagerness he exquisite at do in. Warmly up</p> -->

							<!-- Post Catagories -->
							<div class="post-catagories d-flex align-items-center">
								<h6>Categories:</h6>
								<!-- <ul class="d-flex flex-wrap align-items-center"> -->
								<?php the_category('<b> , </b>'); ?>
								<!-- <li><a href="#">Tutorials,</a></li>
								<li><a href="#">Business,</a></li>
								<li><a href="#">Tech</a></li>-->
								<!-- </ul>  -->
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

							<!-- Leave A Reply -->
							<div class="contact-form">
								<h5 class="mb-30">Leave A Comment</h5>

								<!-- Form -->
								<form action="#" method="post">
								<div class="row">
									<div class="col-lg-6">
									<input type="text" name="message-name" class="form-control mb-30" placeholder="Name">
									</div>
									<div class="col-lg-6">
									<input type="email" name="message-email" class="form-control mb-30" placeholder="Email">
									</div>
									<div class="col-12">
									<textarea name="message" class="form-control mb-30" placeholder="Comment"></textarea>
									</div>
									<div class="col-12">
									<button type="submit" class="btn poca-btn mt-30">Post Comment</button>
									</div>
								</div>
								</form>

							</div>
						</div>
					</div>
					<?php } ?>
				<?php } ?>
				</div>

				<div class="col-12 col-lg-4">
					<div class="sidebar-area mt-5">
					    <?php get_sidebar(); ?>
						<!-- Single Widget Area -->
						<!-- <div class="single-widget-area search-widget-area mb-80">
							<form action="#" method="post">
								<input type="search" name="search" class="form-control" placeholder="Search ...">
								<button type="submit"><i class="fa fa-search"></i></button>
							</form>
						</div> -->

						<!-- Single Widget Area -->
						<!-- <div class="single-widget-area catagories-widget mb-80">
							<h5 class="widget-title">Categories</h5> -->

							<!-- catagories list -->
							<!-- <ul class="catagories-list">
								<li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Entrepreneurship</a></li>
								<li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Media</a></li>
								<li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Tech</a></li>
								<li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Tutorials</a></li>
								<li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Business</a></li>
								<li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Entertainment</a></li>
							</ul>
						</div> -->

						<!-- Single Widget Area -->
						<!-- <div class="single-widget-area news-widget mb-80">
						<h5 class="widget-title">Recent Posts</h5> -->

						<!-- Single News Area -->
						<!-- <div class="single-news-area d-flex">
							<div class="blog-thumbnail">
							<img src="./img/bg-img/11.jpg" alt="">
							</div>
							<div class="blog-content">
							<a href="#" class="post-title">Episode 10: Season Finale</a>
							<span class="post-date">December 9, 2018</span>
							</div>
						</div> -->

						<!-- Single News Area -->
						<!-- <div class="single-news-area d-flex">
							<div class="blog-thumbnail">
							<img src="./img/bg-img/12.jpg" alt="">
							</div>
							<div class="blog-content">
							<a href="#" class="post-title">Episode 6: SoundCloud Example</a>
							<span class="post-date">December 9, 2018</span>
							</div>
						</div> -->

						<!-- Single News Area -->
						<!-- <div class="single-news-area d-flex">
							<div class="blog-thumbnail">
							<img src="./img/bg-img/13.jpg" alt="">
							</div>
							<div class="blog-content">
							<a href="#" class="post-title">Episode 7: Best Mics for Podcasting</a>
							<span class="post-date">December 9, 2018</span>
							</div>
						</div> -->

						<!-- Single News Area -->
						<!-- <div class="single-news-area d-flex">
							<div class="blog-thumbnail">
							<img src="./img/bg-img/14.jpg" alt="">
							</div>
							<div class="blog-content">
							<a href="#" class="post-title">Episode 6 – Defining Your Style</a>
							<span class="post-date">December 9, 2018</span>
							</div>
						</div> -->

					</div>

						<!-- Single Widget Area -->
						<!-- <div class="single-widget-area adds-widget mb-80">
						<a href="#"><img class="w-100" src="./img/bg-img/banner.png" alt=""></a>
						</div> -->

						<!-- Single Widget Area -->
						<!-- <div class="single-widget-area tags-widget mb-80">
						<h5 class="widget-title">Popular Tags</h5> -->

						<!-- <ul class="tags-list">
							<li><a href="#">Creative</a></li>
							<li><a href="#">Unique</a></li>
							<li><a href="#">audio</a></li>
							<li><a href="#">Episodes</a></li>
							<li><a href="#">ideas</a></li>
							<li><a href="#">Podcasts</a></li>
							<li><a href="#">Wordpress Template</a></li>
							<li><a href="#">startup</a></li>
							<li><a href="#">video</a></li>
						</ul>
						</div> -->

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
