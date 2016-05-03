<?php
/**
 * Navigation header
 *
 * @package WordPress
 * @subpackage Bellevue Towers
 * @since Bellevue Towers 1.0
 */
?>

		<?php 
			global $ancestor_slug;
		    $ancestor_slug = get_top_ancestor_slug( $post ); 
		?>

	  <div class="header-container">
	    <div class="header-content group">
	      <div class="logo-content">
		      <a href="/"><img src="<?php bloginfo('template_url'); ?>/images/logo.jpg" alt="Bellevue Towers" title="Bellevue Towers" /></a>
		    </div>
		    <div class="nav-primary group">
		      <?php towers_build_header_nav($post, $ancestor_slug, $en, $ru, $zh, $ko); ?>
		    </div>
    	  <!--<div class="nav-primary logos group">
    	    <ul>
    	      <li><a href="http://www.realtytrustcity.com/" target="_blank">Realty Trust City</a></li>
    	      <li class="logo"><a href="http://portal.hud.gov/hudportal/HUD?src=/program_offices/fair_housing_equal_opp" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/logo_fair-housing.png" alt="" title="" width="18" height="15" /></a></li>
    	    </ul>
    	  </div> -->
    	</div>
  	</div>
