<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Bellevue Towers
 * @since Bellevue Towers 1.0
 */

get_header(); 
get_header('page');
?>

  <div class="panel group active">
    <div class="panel-container group">
      <div class="panel-content">
      
        <div class="banner-container">
          <div class="banner-content">
      	    <h1><?php echo get_post_meta($post->ID, 'headline', true); ?></h1>
          </div>
        </div>

        <?php include 'sidebar-nav.php' ?>
        <?php include 'social-media.php' ?>

        <div class="content-container opaque">
      		<div class="content-main">
            <h3>Sorry, but the page you are looking for could not be found.</h3>
            <p>It is possible that the address is incorrect, or the page doesn't exist any more.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php get_footer(); ?>
