<?php
/**
 * The main template file.
 *
 * @package WordPress
 * @subpackage Bellevue Towers
 * @since Bellevue Towers 1.0
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
get_header(); 
get_header('blog');

include 'top-nav.php';
?>

  <div class="panel group active">

    <div class="panel-container group">
      <div class="panel-content group">
      
        <div class="banner-container">
          <div class="banner-content">
      	    <h1>Downtown<br />dispatches</h1>
          </div>
        </div>

        <?php include 'sidebar-nav.php' ?>

        <div class="content-container opaque">
      
          <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
          
        		<div class="content-main">
              <?php 
                if(function_exists('mygengo_translations_viewer')) { 
                  echo mygengo_post_translations($post->ID, 'post', 'element_id');
                } 

                echo "<div id='" . $post->post_name ."_en' class='translation en'>";
            		  echo "<h3>";
            		    the_title();
            		  echo "</h3>";
                  the_content();
                echo "</div>";
              ?>
		        </div>
		        
          <?php
            endwhile; endif;
          ?>

        </div>
          
        <?php include 'sidebar.php' ?>
        <?php include 'social-media.php' ?>

      </div>
    </div>
  </div>
        
<?php get_footer(); ?>
