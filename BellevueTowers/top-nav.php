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
	    <div class="header-content group show-for-medium">
	        <div class="logo-content">
		      <a href="/"><img src="<?php bloginfo('template_url'); ?>/images/logo.jpg" alt="Bellevue Towers" title="Bellevue Towers" /></a>
		  	</div>
		    <div class="nav-primary group">
		      <ul>
		      	<li><a href="http://www.bellevuetowers.com/virtual-tour" title="Virtual Tour">Virtual Tour</a></li>
		      	<li><a href="http://www.bellevuetowers.com/brokers" title="Brokers">brokers</a></li>
		      	<li><a href="http://www.bellevuetowers.com/news" title="News">news</a></li>
		      	<li><a href="http://www.bellevuetowers.com/contact-us" title="Contact Us">contact us</a></li>
		      </ul>
		    </div>
    	</div>
    	<div class="show-for-small-only">
			<div class="title-bar" data-responsive-toggle="mobile-menu" data-hide-for="medium">

			  <div class="row">
				  <div class="column small-6">
			        <div class="logo-content">
				      <a href="/"><img src="<?php bloginfo('template_url'); ?>/images/logo.jpg" alt="Bellevue Towers" title="Bellevue Towers" /></a>
				    </div>
				  </div>
			  	  <div class="column small-3">
			        <div class="mobile-phone">
				      <a href="tel:425-890-9909"><i class="fa fa-phone" aria-hidden="true"></i></a>
				    </div>
				  </div>
				  <div class="column small-3">
			  		<button class="menu-icon" type="button" data-toggle></button>
			      </div>
			    </div><!-- row -->
			</div>

			<div class="top-bar" id="mobile-menu">
			    <ul class="vertical menu" data-accordion-menu data-disable-hover="true" data-click-open="true" data-force-follow="true">
			      	<li><a href="http://www.bellevuetowers.com/#home" title="Home">Home</a></li>
			      	<li><a href="http://www.bellevuetowers.com/contact-us" title="Contact Us">contact</a></li>
			      	<li><a href="http://www.bellevuetowersavailability.com/" title="Availability">Availability</a></li>
			      	<li><a href="http://www.bellevuetowers.com/brokers" title="Brokers">brokers</a></li>
			      	<li><a href="http://www.bellevuetowers.com/#residence" title="Residence">Residence</a></li>
			      	<li><a href="http://www.bellevuetowers.com/#building" title="Building">Building</a></li>
			      	<li><a href="http://www.bellevuetowers.com/#neighborhood" title="Neighborhood">Neighborhood</a></li>
			      	<li><a href="http://www.bellevuetowers.com/#stories" title="Stories">Stories</a></li>
			      	<li><a href="http://www.bellevuetowers.com/virtual-tour" title="Virtual Tour">Virtual Tour</a></li>
			    </ul>
			</div>
		</div>
  	</div>
