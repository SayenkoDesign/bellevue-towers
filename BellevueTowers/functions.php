<?php 

/**
 * Bellevue Towers functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, towers_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Bellevue Towers
 * @since Bellevue Towers 1.0
 */

/** Tell WordPress to run towers_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'towers_setup' );

if ( ! function_exists( 'towers_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override towers_setup() in a child theme, add your own towers_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses add_editor_style() To style the visual editor.
 * @uses add_post_type_support() To use page excerpts.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since towers 1.0
 */
function towers_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();
	
	// This theme adds support for page excerpts
	add_post_type_support( 'page', 'excerpt' );

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Add support for wp_nav_menu() 
	register_nav_menus( array(
		'secondary' => __( 'Sidebar Navigation', 'towers' ),
	) );

	// Can set specified sizes for thumbnails
	add_image_size( 'page-feature', 558, 197, true );           // Page Feature Img
	add_image_size( 'page-feature-wide', 740, 197, true );      // Page Feature Img - Wide
	
  global $en;
  global $ru;
  global $zh;
  global $ko;

  include('locale/en.php');
  include('locale/ru.php');
  include('locale/zh.php');
  include('locale/ko.php');
}
endif;




/**
 * Builds the header navigation
 *
 * @since towers 1.0
 */

function towers_build_header_nav( $post, $ancestor_slug, $en, $ru, $zh, $ko ) {


  $mainPages = array('virtual-tour', 'brokers', 'news', 'contact-us', /* 'register-here', */  /* 'blog', */  /* 'downloads', */ /* 'lanai' */);

	// NEED TO ADD MENU ITEM TO LOCALE FOLDER FILES FOR IT TO SHOW UP
  $slug = $post->post_name;

  if (in_category('blog') || is_archive() || is_home() || is_single()) {
    $navToHighlight = "blog";
  }
  
  echo "<ul>";

  for($i = 0; $i < count($mainPages); $i++) {
  	$pageTitle = get_name_by_slug( $mainPages[$i] );

    if (($slug == $mainPages[$i]) || ($navToHighlight == $mainPages[$i]) || ($ancestor_slug == $mainPages[$i])) {
      echo "<li class=\"current_page_item\"><a href=\"/$mainPages[$i]\"  title=\"$pageTitle\">";

        echo "<div class='translation en current'>";
          echo $en[$pageTitle];
        echo "</div>";
        echo "<div class='translation ru'>";
          echo $ru[$pageTitle];
        echo "</div>";
        echo "<div class='translation zh'>";
          echo $zh[$pageTitle];
        echo "</div>";
        echo "<div class='translation ko'>";
          echo $ko[$pageTitle];
        echo "</div>";

      echo "</a></li>"; 
    } else {
      echo "<li><a href=\"/$mainPages[$i]\" title=\"$pageTitle\">";
      
        echo "<div class='translation en current'>";
          echo $en[$pageTitle];
        echo "</div>";
        echo "<div class='translation ru'>";
          echo $ru[$pageTitle];
        echo "</div>";
        echo "<div class='translation zh'>";
          echo $zh[$pageTitle];
        echo "</div>";
        echo "<div class='translation ko'>";
          echo $ko[$pageTitle];
        echo "</div>";
      
      echo "</a></li>"; 
    }
  } 

  echo "</ul>";

 /*
 echo "<ul>";  
  echo "<li id='en'>english</li>";
  echo "<li id='ru'>РУССКИЙ</li>";
  echo "<li id='ko'>한국어</li>";
  echo "<li id='zh'>中文</li>";
  echo "</ul>";
*/
}




/**
 * Function to display captions assigned to feature images
 */
if(!function_exists('the_post_thumbnail_caption'))
{
    function the_post_thumbnail_caption()
    {
        global $post;

        $thumbnail_id = get_post_thumbnail_id($post->ID);
        $thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

        if ($thumbnail_image && isset($thumbnail_image[0])) {
            echo "<div class=\"image_caption\">" . $thumbnail_image[0]->post_excerpt . "</div>";
        }
    }
}




/**
 * Function to return captions assigned to feature images
 */

if(!function_exists('the_post_thumbnail_caption'))
{
    function get_the_post_thumbnail_caption() {
      global $post;

      $thumbnail_id    = get_post_thumbnail_id($post->ID);
      $thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

      if ($thumbnail_image && isset($thumbnail_image[0])) {
        return "<div class=\"image_caption\">" . $thumbnail_image[0]->post_excerpt . "</div>";
      }
    }
}




/**
 * Function to return captions on images
 *
 * @param array $attr Attributes attributed to the shortcode.
 * @param string $content Optional. Shortcode content.
 * @return string
 */
function towers_caption($attr, $content = null) {

	// Allow plugins/themes to override the default caption template.
	$output = apply_filters('img_caption_shortcode', '', $attr, $content);
	if ( $output != '' )
		return $output;

	extract(shortcode_atts(array(
		'id'	=> '',
		'width'	=> '',
		'caption' => ''
	), $attr));

	if ( 1 > (int) $width || empty($caption) )
		return $content;

	if ( $id ) $id = 'id="' . esc_attr($id) . '" ';

	return '<div ' . $id . 'class="wp-caption group">'
	. do_shortcode( $content ) . '<p class="wp-caption-text">' . $caption . '</p></div>';
}


function towers_my_caption($output, $attr, $content) {
  return $output;
}

add_shortcode('wp_caption','towers_caption');
add_shortcode('caption','towers_caption');




/**
 * Helper function to get page names using slugs
 *
 * @since towers 1.0
 */

function get_name_by_slug($page_slug) {
    $page = get_page_by_path($page_slug);
    if ($page) {
        return $page->post_title;
    } else {
        return null;
    }
}




/**
 * Helper function to get id of topmost page ancestor to help in 
 * building page-level side navigation
 *
 * @since towers 1.0
 */

function get_top_ancestor_id($post_id) {
	$current = get_post($post_id);
	
	if($current->post_parent == 0) {
		return $current->ID;
	} 
	else {
		return get_top_ancestor_id($current->post_parent);
	}
};




/**
 * Helper function to get topmost page ancestor to help in 
 * building header navigation and determining which parent
 * ancestor is active
 *
 * @since towers 1.0
 */

function get_top_ancestor_slug($post_id) {
	$current = get_post($post_id);
	
	if($current->post_parent == 0) {
		return strtolower(basename(get_permalink($current->ID)));
	} 
	else {
		return get_top_ancestor_slug($current->post_parent);
	}
};




/**
 * Helper function to get page ID from slug
 *
 * @since towers 1.0
 */

function get_ID_by_slug($page_slug) {
    $page = get_page_by_path($page_slug);
    if ($page) {
        return $page->ID;
    } else {
        return null;
    }
}




/**
 * Function to allow WordPress to accept query vars for home page pagination
 */


function parameter_queryvars( $qvars ) {
  $qvars[] = 'unit';
  return $qvars;
}

add_filter('query_vars', 'parameter_queryvars' );




function getUrlStringValue($urlStringName, $returnIfNotSet) {
  if(isset($_GET[$urlStringName]) && $_GET[$urlStringName] != "")
    return $_GET[$urlStringName];
  else
    return $returnIfNotSet;
}




/*
 *
 *  Adds a filter to append the a stylesheet to the Tiny MCE editor.
 *
 */
if ( ! function_exists('tdav_css') ) {
	function tdav_css($wp) {
		$wp .= ',' . get_bloginfo('stylesheet_directory') . 'editor-style.css';
		return $wp;
	}
}
add_filter( 'mce_css', 'tdav_css' );




/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since towers 1.0
 * @return int
 */
function towers_excerpt_length( $length ) {
	return 100;
}
add_filter( 'excerpt_length', 'towers_excerpt_length' );




/**
 * Removes jump links from more
 *
 * @since towers 1.0
 */

function remove_more_jump_link($link) {
	$offset = strpos($link, '#more-');
	if ($offset) {
		$end = strpos($link, '"',$offset);
	}
	if ($end) {
		$link = substr_replace($link, '', $offset, $end-$offset);
	}
	return $link;
}

add_filter('the_content_more_link', 'remove_more_jump_link');




/**
 * Returns a "More >>" link for excerpts
 *
 * @since towers 1.0
 * @return string "Continue Reading" link
 */
function towers_continue_reading_link() {
	return ' <a class="more_link" href="'. get_permalink() . '">' . __( 'Continue Reading &#187;', 'towers' ) . '</a>';
}




/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and towers_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since towers 1.0
 * @return string An ellipsis
 */
function towers_auto_excerpt_more( $more ) {
	return ' &hellip;' . towers_continue_reading_link();
}
add_filter( 'excerpt_more', 'towers_auto_excerpt_more' );




/**
 * Adds a pretty "More >>" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since towers 1.0
 * @return string Excerpt with a pretty "More >>" link
 */
function towers_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= towers_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'towers_custom_excerpt_more' );




/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in towers's style.css.
 *
 * @since towers 1.0
 * @return string The gallery style filter, with the styles themselves removed.
 */
function towers_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'towers_remove_gallery_css' );
