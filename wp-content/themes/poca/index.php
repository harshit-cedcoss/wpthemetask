<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package poca
 */
get_header();
?>

<main id="primary" class="site-main">
	<!-- ***** Breadcrumb Area Start ***** -->
	<div class="breadcumb-area bg-img bg-overlay" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/bg-img/2.jpg);">
		<div class="container h-100">
		<div class="row h-100 align-items-center">
			<div class="col-12">
			<h2 class="title mt-70">Blog</h2>
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
	<!-- ***** Blog Area Start ***** -->
	<section class="blog-area">
		<div class="container">
			<div class="row">
				<div class="col-12 col-lg-8">

					<!-- Single Blog Area -->
					<?php 
					if( have_posts() ){
						while( have_posts() ){
							the_post(); ?>
					<div class="single-blog-area mt-50 mb-50">
						<a href="#" class="mb-30"><?php the_post_thumbnail(); ?></a>
						<!-- Content -->
						<div class="post-content">
						<a href="#" class="post-date"><?php the_date(); ?></a>
						<a href="<?php echo get_permalink(); ?>" class="post-title"><?php the_title(); ?></a>
						<div class="post-meta mb-15">
							<a href="#" class="post-author"><?php the_author(); ?></a>
							<a href="#" class="post-catagory"><?php the_category('<a href="#"></a>'); ?></a>
						</div>
						<p><?php the_excerpt(); ?></p>
						<a href="<?php echo get_permalink(); ?>" class="read-more-btn">Continue reading <i class="fa fa-angle-right" aria-hidden="true"></i></a>
						</div>
					</div>
							<?php } ?>
						<?php } ?>		
			          <!-- Pagination -->
					<!-- <div class="poca-pager d-flex mb-80">
						<a href="#">Previous Post <span>Episode 3 – Wardrobe For Busy People</span></a>
						<a href="#">Next Post <span>Episode 6 – Defining Your Style</span></a>
					</div> -->

				</div>
				<div class="col-12 col-lg-4">
					<div class="sidebar-area mt-5">

						<!-- Single Widget Area -->
						<div class="single-widget-area search-widget-area mb-80">
						<form action="#" method="post">
							<input type="search" name="search" class="form-control" placeholder="Search ...">
							<button type="submit"><i class="fa fa-search"></i></button>
						</form>
						</div>

						<!-- Single Widget Area -->
						<div class="single-widget-area catagories-widget mb-80">
						<h5 class="widget-title">Categories</h5>

						<!-- catagories list -->
						<ul class="catagories-list">
							<li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Entrepreneurship</a></li>
							<li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Media</a></li>
							<li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Tech</a></li>
							<li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Tutorials</a></li>
							<li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Business</a></li>
							<li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Entertainment</a></li>
						</ul>
						</div>

						<!-- Single Widget Area -->
						<div class="single-widget-area news-widget mb-80">
						<h5 class="widget-title">Recent Posts</h5>

						<!-- Single News Area -->
						<div class="single-news-area d-flex">
							<div class="blog-thumbnail">
							<img src="./img/bg-img/11.jpg" alt="">
							</div>
							<div class="blog-content">
							<a href="#" class="post-title">Episode 10: Season Finale</a>
							<span class="post-date">December 9, 2018</span>
							</div>
						</div>

						<!-- Single News Area -->
						<div class="single-news-area d-flex">
							<div class="blog-thumbnail">
							<img src="./img/bg-img/12.jpg" alt="">
							</div>
							<div class="blog-content">
							<a href="#" class="post-title">Episode 6: SoundCloud Example</a>
							<span class="post-date">December 9, 2018</span>
							</div>
						</div>

						<!-- Single News Area -->
						<div class="single-news-area d-flex">
							<div class="blog-thumbnail">
							<img src="./img/bg-img/13.jpg" alt="">
							</div>
							<div class="blog-content">
							<a href="#" class="post-title">Episode 7: Best Mics for Podcasting</a>
							<span class="post-date">December 9, 2018</span>
							</div>
						</div>

						<!-- Single News Area -->
						<div class="single-news-area d-flex">
							<div class="blog-thumbnail">
							<img src="./img/bg-img/14.jpg" alt="">
							</div>
							<div class="blog-content">
							<a href="#" class="post-title">Episode 6 – Defining Your Style</a>
							<span class="post-date">December 9, 2018</span>
							</div>
						</div>

						</div>

						<!-- Single Widget Area -->
						<div class="single-widget-area adds-widget mb-80">
						<a href="#"><img class="w-100" src="./img/bg-img/banner.png" alt=""></a>
						</div>

						<!-- Single Widget Area -->
						<div class="single-widget-area tags-widget mb-80">
						<h5 class="widget-title">Popular Tags</h5>

						<ul class="tags-list">
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
						</div>

					</div>
				</div>
			</div>
		</div>
	</section>
  	<!-- ***** Blog Area End ***** -->	

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
