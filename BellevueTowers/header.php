<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://opengraphprotocol.org/schema/" <?php language_attributes(); ?>>
 <head>
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />  	
    <!-- <title><?php wp_title(' | ', true, 'right'); ?><?php bloginfo('name'); ?></title> -->
<title>Bellevue Towers Availability Website</title>
		
		<link rel="icon" href="/favicon.ico" type="image/x-icon"/>
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"/>
		
    <!--[if lte IE 6]><link rel="stylesheet" href="http://universal-ie6-css.googlecode.com /files/ie6.0.3.css" media="screen, projection"> <![endif]-->
    <!--[if gte IE 6]>
        <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/ie.css" type="text/css" />
    <![endif]-->
    <!--[if lte IE 8]>
        <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/ie7+.css" type="text/css" />
    <![endif]-->

    <script type="text/javascript">
      var templateUrl = '<?= get_bloginfo("template_url"); ?>/';
    </script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/jquery-ui.min.js"></script>
	  <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.cookie.js"></script>
	  <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.superbgimage.min.js"></script>
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/shadowbox/shadowbox.js"></script>
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/easySlider1.7.js"></script>
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/base.js"></script>

		<script type="text/javascript">

		  var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-912495-1']);
		  _gaq.push(['_trackPageview']);
		
		  (function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();

		</script>

    <style type="text/css">
      .wf-loading {
        visibility: hidden;
      }
	.nothing{
		display:none;
	}
    </style>
    <script type="text/javascript">

		// SUPER BG IMAGE
		$(function()
		{ 
			// Options for SuperBGImage
			$.fn.superbgimage.options = {
				randomtransition: 0, // 0-none, 1-use random transition (0-7)
				slideshow: 0, // 0-none, 1-autostart slideshow
				slide_interval: 1000, // interval for the slideshow
				randomimage: 0, // 0-none, 1-random image,
				preload: 1,
        <?php
          if ($post->post_name == 'home') {
  				  echo "showimage: 1,";
  				}
          else if ($post->post_name == 'brokers') {
  				  echo "showimage: 2,";
  				}
          else if ($post->post_name == 'contact-us') {
  				  echo "showimage: 3,";
  				}
          else if (is_archive() || is_single() || is_home()) {
  				  echo "showimage: 4,";
  				}
          else if ($post->post_name == 'news') {
  				  echo "showimage: 5,";
  				}
          else if ($post->post_name == 'downloads') {
  				  echo "showimage: 6,";
  				}
        ?>				
				speed: 'slow' // animation speed
			};
		 
			// initialize SuperBGImage
			$('#backgrounds').superbgimage().hide();
		});
		
    Shadowbox.init({
      skipSetup: true,
      overlayOpacity: 0.7,
      onOpen: function() {
        $('#sb-title').after($('#sb-info'));
      }
    });
	
	</script>

	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	<?php wp_head(); ?>
		
	</head>
	<?php 
		global $ancestor_slug;
	  $ancestor_slug = get_top_ancestor_slug( $post ); 
	?>
