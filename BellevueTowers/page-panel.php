<?php
/**
 * Template Name: Sliding Panel
 *
 * The template for displaying all pages in the sliding panel display.
 * (Home, Residences, Floor Plans, Building, Neighborhood, Stories, Gallery)
 *
 * @package WordPress
 * @subpackage Bellevue Towers
 * @since Bellevue Towers 1.0
 *
 * v2.0 - Mike Cleek 2016.05.19 Greatly simplified page to include only availability page
 *        Fixed a few bugs and removed some inline styles.
 */

get_header();
?>

<body id="panels">
	<a id="top"></a>

  <?php include 'top-nav.php'; ?>

  <?php
  query_posts('pagename=floor-plans');

  if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

      <div id="floor-plans" class="panel loading group active" style="background:#282b30;">

        <div class="panel-container group">
          <div class="panel-content">

            <div class="banner-container show-for-medium">
              <div class="banner-content">
          	    <h1>
                  <?php
                    $title = get_post_meta($post->ID, 'headline', true);
                  ?>
    	            <div class="translation en">
                    <?php echo $en[$title]; ?>
                  </div>
    	            <div class="translation ru">
                    <?php echo $ru[$title]; ?>
                  </div>
    	            <div class="translation zh">
                    <?php echo $zh[$title]; ?>
                  </div>
    	            <div class="translation ko">
                    <?php echo $ko[$title]; ?>
                  </div>
          	    </h1>
              </div>
            </div><!-- .banner-container -->

            <?php include 'sidebar-nav.php' ?>

            <div class="content-container">

          		<div class="content-main opaque">

  		          <div id="slider-floorplan" class="slider">
<div class="idx-list">
                  <iframe src="http://bellevuetowers.idxbroker.com/idx/results/listings?start=1&amp;idxID=a045&amp;a_streetNumber%5B%5D=500&amp;a_streetNumber%5B%5D=10700&amp;aw_streetName%5B%5D=106th&amp;aw_streetName%5B%5D=4th&amp;per=25" style="border:none; height:100%; min-height:600px; width:calc(100% - 45px);" allowTransparency="true" scrolling="auto" frameBorder="0"></iframe>
</div>

            		</div><!-- slider-floorplan -->

    		      </div><!-- #slider-floorplan .slider -->

            </div><!-- .content-container -->

            <?php include 'social-media.php' ?>

          </div><!-- .panel-content -->
        </div><!-- .panel-container .group -->
      </div><!-- .panel .loading .group .active -->


  <?php
    endwhile; endif;
    wp_reset_query();
  ?>

<?php get_footer(); ?>
