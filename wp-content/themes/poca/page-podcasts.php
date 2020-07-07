<?php
/**
 * The podcast custom post type listing template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package poca
 */
get_header();
?>
 <!-- ***** Breadcrumb Area Start ***** -->
 <div class="breadcumb-area bg-img bg-overlay" style="background-image: url(<?php echo get_template_directory_uri().'/img/bg-img/2.jpg'?>);">
    <div class="container h-100">
      <div class="row h-100 align-items-center">
        <div class="col-12">
          <h2 class="title mt-70">Podcasts</h2>
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
              <li class="breadcrumb-item active" aria-current="page">Podcasts</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <!-- ***** Breadcrumb Area End ***** -->

  <!-- ***** Featured Music Area Start ***** -->
  <div class="poca-featured-music-area mt-50">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="poca-music-area box-shadow d-flex align-items-center flex-wrap border" data-animation="fadeInUp" data-delay="900ms">
            <div class="poca-music-thumbnail">
              <img src="<?php echo get_template_directory_uri().'/img/bg-img/4.jpg'?>" alt="">
            </div>
            <div class="poca-music-content">
              <span class="music-published-date">December 9, 2018</span>
              <h2>Episode 203 - The Last Blockbuster</h2>
              <div class="music-meta-data">
                <p>By <a href="#" class="music-author">Admin</a> | <a href="#" class="music-catagory">Tutorials</a> | <a href="#" class="music-duration">00:02:56</a></p>
              </div>
              <!-- Music Player -->
              <div class="poca-music-player">
                <audio preload="auto" controls>
                  <source src="<?php echo get_template_directory_uri().'/audio/dummy-audio.mp3'?>">
                </audio>
              </div>
              <!-- Likes, Share & Download -->
              <div class="likes-share-download d-flex align-items-center justify-content-between">
                <a href="#"><i class="fa fa-heart" aria-hidden="true"></i> Like (29)</a>
                <div>
                  <a href="#" class="mr-4"><i class="fa fa-share-alt" aria-hidden="true"></i> Share(04)</a>
                  <a href="#"><i class="fa fa-download" aria-hidden="true"></i> Download (12)</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ***** Featured Music Area End ***** -->

  <!-- ***** Latest Episodes Area Start ***** -->
  <section class="poca-latest-epiosodes section-padding-80">
    <div class="container">
      <div class="row">
        <!-- Section Heading -->
        <div class="col-12">
          <div class="section-heading text-center">
            <h2>Latest Episodes</h2>
            <div class="line"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Projects Menu -->
    <div class="container">
      <div class="poca-projects-menu mb-30 wow fadeInUp" data-wow-delay="0.3s">
        <div class="text-center portfolio-menu">
          <button class="btn active" data-filter="*">All</button>
          <button class="btn" data-filter=".entre">Entrepreneurship</button>
          <button class="btn" data-filter=".media">Media</button>
          <button class="btn" data-filter=".tech">Tech</button>
          <button class="btn" data-filter=".tutor">Tutorials</button>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row poca-portfolio">
    <?php
      $args = array( 
        'numberposts'		=> -1, // -1 is for all
        'post_type'		=> 'poca_podcast', // or 'post', 'page'
        'orderby' 		=> 'title', // or 'date', 'rand'
        'order' 		=> 'ASC', // or 'DESC'
        //'category' 		=> $category_id,
        //'exclude'		=> get_the_ID()
        // ...
        // http://codex.wordpress.org/Template_Tags/get_posts#Usage
        );

    // Get the posts
    $podcast_posts = get_posts($args);

    // If there are posts
    if($podcast_posts){
        // Loop the posts
        foreach ($podcast_posts as $podcast_post){
        ?>
        <!-- Single gallery Item -->
        <div class="col-12 col-md-6 single_gallery_item entre wow fadeInUp" data-wow-delay="0.2s">
          <!-- Welcome Music Area -->
          <div class="poca-music-area style-2 d-flex align-items-center flex-wrap">
            <div class="poca-music-thumbnail">
              <!-- <img src="./img/bg-img/5.jpg" alt=""> -->
              <?php echo get_the_post_thumbnail($podcast_post->ID); ?>
            </div>
            <div class="poca-music-content text-center">
              <span class="music-published-date mb-2"><?php echo get_the_date('F j, Y', $podcast_post->ID); ?></span>
              <h2><?php echo get_the_title($podcast_post->ID); ?></h2>
              <div class="music-meta-data">
                <p>By <a href="#" class="music-author">Admin</a> | <a href="#" class="music-catagory"><?php echo get_the_category($podcast_post->ID); ?></a> | <a href="#" class="music-duration"><?php echo get_the_time( '', $podcast_post->ID ); ?></a></p>
              </div>
              <!-- Music Player -->
              <div class="poca-music-player">
                <audio preload="auto" controls>
                  <source src="<?php echo get_template_directory_uri().'/audio/dummy-audio.mp3'?>">
                </audio>
              </div>
              <!-- Likes, Share & Download -->
              <div class="likes-share-download d-flex align-items-center justify-content-between">
                <a href="#"><i class="fa fa-heart" aria-hidden="true"></i> Like (29)</a>
                <div>
                  <a href="#" class="mr-4"><i class="fa fa-share-alt" aria-hidden="true"></i> Share(04)</a>
                  <a href="#"><i class="fa fa-download" aria-hidden="true"></i> Download (12)</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
    <?php } ?>

      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-12 text-center">
          <a href="#" class="btn poca-btn mt-70">Load More</a>
        </div>
      </div>
    </div>
  </section>
  <!-- ***** Latest Episodes Area End ***** -->
<?php
//get_sidebar();
get_footer();
