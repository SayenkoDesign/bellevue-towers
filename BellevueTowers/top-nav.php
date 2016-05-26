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
		      <ul>
		      	<li><a href="http://www.bellevuetowers.com/virtual-tour" title="Virtual Tour">
		      	<div class='translation en current'>Virtual Tour</div></a></li>
		      	<li><a href="http://www.bellevuetowers.com/brokers" title="Brokers">
		      	<div class='translation en current'>brokers</div></a></li>
		      	<li><a href="http://www.bellevuetowers.com/news" title="News">
		      	<div class='translation en current'>news</div></a></li>
		      	<li><a href="http://www.bellevuetowers.com/contact-us" title="Contact Us">
		      	<div class='translation en current'>contact us</div></a></li>
		      </ul>
		    </div>
    	</div>
  	</div>
