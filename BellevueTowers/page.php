<?php
/**
 * The default template for displaying pages NOT in the sliding display.
 * (Brokers, Contact Us, Press, Downloads)
 *
 * This is the template that displays all pages by default.
 *
 * @package WordPress
 * @subpackage Bellevue Towers
 * @since Bellevue Towers 1.0
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
get_header(); 
get_header('page');

include 'top-nav.php';
?>

  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div class="panel group active">

      <div class="panel-container group">
        <div class="panel-content">
        
          <div class="banner-container">
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
          </div>

          <?php include 'sidebar-nav.php' ?>

          <div class="content-container opaque">
        		<div class="content-main">
              <?php 
                if(function_exists('mygengo_translations_viewer')) { 
                  echo mygengo_translations($post->ID, 'page', 'element_id');
                } 

                echo "<div id='" . $post->post_name ."_en' class='translation en'>";
                the_content();
                echo "</div>";
              ?>
  		      </div>
          </div>

          <?php include 'social-media.php' ?>
          <div class="realty-trust">
			<!-- <img src="#"> -->
		  </div>
        </div>
      </div>
    </div>
        
  <?php
    endwhile; endif;
  ?>
    
<?php get_footer(); ?>
