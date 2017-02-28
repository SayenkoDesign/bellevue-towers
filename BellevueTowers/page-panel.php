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
 */

get_header();
?>

<body id="panels">
	<a id="top"></a>

  <?php include 'top-nav.php'; ?>

  <?php
    $panelPages = array('home', 'floor-plans', 'residences', 'building', 'neighborhood', 'stories', 'gallery');

    for($i = 0; $i < count($panelPages); $i++) {
      query_posts('pagename=' . $panelPages[$i] . '');

      if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <?php if ($panelPages[$i] != 'gallery') { ?>
	        <div id="<?php echo $post->post_name; ?>" class="panel loading group active">

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

                <div class="content-container">

                  <?php
                    $childPages = get_pages('child_of='.$post->ID.'&sort_column=menu_order&sort_order=asc');

                    if ($childPages) {
                  		echo "<div class='content-slider opaque'>";

                      echo "<div id='slider-" . $panelPages[$i] . "' class='slider'>";
                      echo "<ul class='slider-content group'>";

                      foreach($childPages as $page) {
                        $content = $page->post_content;

                        if(!$content) // Check for empty page
	                        continue;

                          echo "<li>";
                            echo "<div class='left-column'>";

                              if ($panelPages[$i] == 'stories') {
                                echo "<div class='header'>";
                                echo "<div class='translation en'>";
                                  echo "<div class='title'>";
                                    echo $en['Praise from those who know<br />Bellevue Towers best&#8212;our residents'];
                                  echo "</div>";
                                  echo "<p>" . $en['Resident'] . ", " . $page->post_title . "</p>";
                                echo "</div>";
                                echo "<div class='translation ru'>";
                                  echo "<div class='title'>";
                                    echo $ru['Praise from those who know<br />Bellevue Towers best&#8212;our residents'];
                                  echo "</div>";
                                  echo "<p>" . $ru['Resident'] . ", " . $page->post_title . "</p>";
                                echo "</div>";
                                echo "<div class='translation zh'>";
                                  echo "<div class='title'>";
                                    echo $zh['Praise from those who know<br />Bellevue Towers best&#8212;our residents'];
                                  echo "</div>";
                                  echo "<p>" . $zh['Resident'] . ", " . $page->post_title . "</p>";
                                echo "</div>";
                                echo "<div class='translation ko'>";
                                  echo "<div class='title'>";
                                    echo $ko['Praise from those who know<br />Bellevue Towers best&#8212;our residents'];
                                  echo "</div>";
                                  echo "<p>" . $ko['Resident']. ", " . $page->post_title . "</p>";
                                echo "</div>";
                                echo "</div>";
                              }

                              if(function_exists('mygengo_translations_viewer')) {
                                echo mygengo_translations($page->ID, 'page', 'element_id');
                              }

                              echo "<div id='" . $page->post_name ."_en' class='translation en'>";
      		                    echo $content;
                              echo "</div>";

      		                  echo "</div>";
      		                  echo "<div class='right-column'>";
                              echo get_the_post_thumbnail($page->ID, 'fullsize');
                            echo "</div>";
                          echo "</li>";
                      }

                      echo "</ul>";
                      echo "</div>";
                      echo "</div>";
                    }
                    else {


/* start */
                      if ($panelPages[$i] === 'floor-plans') { ?>
                    		<div class="content-main opaque">

            		          <div id="slider-floorplan" class="slider" style="height: 640px;">

                            <iframe src="http://bellevuetowers.idxbroker.com/idx/results/listings?start=1&idxID=a045&a_streetNumber%5B%5D=500&a_streetNumber%5B%5D=10700&aw_streetName%5B%5D=106th&aw_streetName%5B%5D=4th&per=25" style="width: 715px; height: 600px; margin: 15px; border:none;" allowTransparency="true" frameBorder="0"></iframe>

                      		</div>

              		      </div>

              		    <?php } else { ?>

              		      <div class="content-main opaque">
                          <?php
                            if(function_exists('mygengo_translations_viewer')) {
                              echo mygengo_translations($post->ID, 'page', 'element_id');
                            }

                            echo "<div id='" . $post->post_name ."_en' class='translation en'>";
                            the_content();
                            echo "</div>";
                          ?>
              		      </div>

              		    <?php 
/* end */

                    }
                    }
                  ?>

                </div>

                <?php include 'social-media.php' ?>

              </div>
            </div>

            <?php if ($i > 0) { ?>
              <a class="nav-button prev scroll" href="#<?php echo $panelPages[$i - 1] ?>"></a>
            <?php } ?>

            <?php if (($i + 1) < count($panelPages)) { ?>
              <a class="nav-button next scroll" href="#<?php echo $panelPages[$i + 1] ?>"></a>
            <?php } ?>
          </div>


        <?php } else { ?>

          <div id="gallery" class="panel loading group active">
            <div class="panel-container group">
              <div class="panel-content">

                <div class="banner-container">
                  <div class="banner-content">
              	    <h1>
        	            <div class="translation en">
                        <?php echo $en['Enjoy<br />the views']; ?>
                      </div>
        	            <div class="translation ru">
                        <?php echo $ru['Enjoy<br />the views']; ?>
                      </div>
        	            <div class="translation zh">
                        <?php echo $zh['Enjoy<br />the views']; ?>
                      </div>
        	            <div class="translation ko">
                        <?php echo $ko['Enjoy<br />the views']; ?>
                      </div>
              	    </h1>
                  </div>
                </div>

                <?php include 'sidebar-nav.php' ?>
                <?php include 'social-media.php' ?>
              </div>
            </div>

            <?php
              // Let's do some browser detection for IE to make sure IE filters are used to stretch the gallery background images
              $isGtIE7 = false;

              $browser = $_SERVER['HTTP_USER_AGENT'];
              $browser = substr("$browser", 25, 8);
              $pos = strrpos($browser, "MSIE");

              if ($pos !== false) {
                $tmp = explode("MSIE", $browser);
                $version = explode(".0", $tmp[1]);

                if ($version[0] > 6) {
                  $isGtIE7 = true;
                }
              }

            ?>

            <div id="slider-gallery" class="slider">
              <ul class="slider-content group">
              </ul>
            </div>

            <a class="nav-button prev scroll" href="#stories"></a>
          </div>

        <?php } ?>

      <?php
        endwhile; endif;
        wp_reset_query();
      ?>

    <?php } ?>

<?php get_footer(); ?>
