<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Bellevue Towers
 * @since Bellevue Towers 1.0
 */

get_header(); ?>

  <div class="content-page group">

	  <h1>Results for: "<span class="query"><?php echo get_search_query(); ?></span>"</h1>
		
	  <form class="group" role="search" method="get" id="searchagain" action="/">
		  <input class="alignleft" type="text" name="s" id="s" value="<?php echo get_search_query(); ?>" onfocus="clearField(this, '<?php echo get_search_query(); ?>');" onblur="setField(this, '<?php echo get_search_query(); ?>');" />
		  <input type="submit" value="Search" />
	  </form>
				
	  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
										
		  <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		  <?php the_excerpt(); ?>
						
	  <?php						
		  endwhile; 
		  endif;
	  ?>
				
  </div>

<?php get_footer(); ?>
