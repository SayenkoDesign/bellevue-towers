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
    $panelPages = array('home', 'residences', 'floor-plans', 'building', 'neighborhood', 'stories', 'gallery');

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

                <div class="content-container opaque">

                  <?php
                    $childPages = get_pages('child_of='.$post->ID.'&sort_column=menu_order&sort_order=asc');
                    
                    if ($childPages) {
                  		echo "<div class='content-slider'>";

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
                    
                      if ($panelPages[$i] === 'floor-plans') { ?>
                    		<div class="content-main">

            		          <div id="slider-floorplan" class="slider">  
                            <ul class="slider-content group">
                              <li>

                    		        <div class="filter-container group">
                    		          <div class="instructions">
                    		            <div class="translation en">
                      		            <p><?php echo $en['Please click on a floor plan below or use our search feature to explore floor plans']; ?></p>
                      		          </div>
                    		            <div class="translation ru">
                      		            <p><?php echo $ru['Please click on a floor plan below or use our search feature to explore floor plans']; ?></p>
                      		          </div>
                    		            <div class="translation zh">
                      		            <p><?php echo $zh['Please click on a floor plan below or use our search feature to explore floor plans']; ?></p>
                      		          </div>
                    		            <div class="translation ko">
                      		            <p><?php echo $ko['Please click on a floor plan below or use our search feature to explore floor plans']; ?></p>
                      		          </div>
                    		          </div>
                    		          <div class="filters group">
                    		            
                    		            <form action="" method="post" class="group" id="search">
                      		            <p>
                        		            <div class="translation en">
                          		            <p><?php echo $en['show me']; ?></p>
                          		          </div>
                        		            <div class="translation ru">
                          		            <p><?php echo $ru['show me']; ?></p>
                          		          </div>
                        		            <div class="translation zh">
                          		            <p><?php echo $zh['show me']; ?></p>
                          		          </div>
                        		            <div class="translation ko">
                          		            <p><?php echo $ko['show me']; ?></p>
                          		          </div>
                      		            </p>
                      		            <select id="unit-type" name="unit-type">
                      		              <option>home types</option>
                      		              <option value="studio">Studio</option>
                      		              <option value="1-bedroom">1 Bedroom</option>
                      		              <option value="1-study">1 Bedroom/Study</option>
                      		              <option value="1-den">1 Bedroom/Den</option>
                      		              <option value="2-bedroom">2 Bedroom</option>
                      		              <option value="2-study">2 Bedroom/Study</option>
                      		              <option value="2-den">2 Bedroom/Den</option>
                      		              <option value="penthouse">Penthouse</option>
                      		            </select>

                      		            <p>
                        		            <div class="translation en">
                          		            <p><?php echo $en['price']; ?></p>
                          		          </div>
                        		            <div class="translation ru">
                          		            <p><?php echo $ru['price']; ?></p>
                          		          </div>
                        		            <div class="translation zh">
                          		            <p><?php echo $zh['price']; ?></p>
                          		          </div>
                        		            <div class="translation ko">
                          		            <p><?php echo $ko['price']; ?></p>
                          		          </div>
                      		            </p>
                      		            <select id="price-min" name="price-min">
                      		              <option>min</option>
                      		              <option value="200000">$200k</option>
                      		              <option value="400000">$400k</option>
                      		              <option value="600000">$600k</option>
                      		              <option value="800000">$800k</option>
                      		              <option value="1000000">$1 mil</option>
                      		              <option value="1200000">$1.2 mil</option>
                      		              <option value="1500000">$1.5 mil</option>
                      		            </select>
                      		            
                      		            <p>To</p>
                      		            <select id="price-max" name="price-max">
                      		              <option>max</option>
                      		              <option value="400000">$400k</option>
                      		              <option value="600000">$600k</option>
                      		              <option value="800000">$800k</option>
                      		              <option value="1000000">$1.0 mil</option>
                      		              <option value="1200000">$1.2 mil</option>
                      		              <option value="1500000">$1.5 mil</option>
                      		              <option value="2000000">$2.0 mil+</option>
                      		            </select>
                      		            
                      		            <div class="translation en">
                        		            <input type="submit" name="submit" value="<?php echo $en['search']; ?>" />
                        		          </div>
                      		            <div class="translation ru">
                        		            <input type="submit" name="submit" value="<?php echo $ru['search']; ?>" />
                        		          </div>
                      		            <div class="translation zh">
                        		            <input type="submit" name="submit" value="<?php echo $zh['search']; ?>" />
                        		          </div>
                      		            <div class="translation ko">
                        		            <input type="submit" name="submit" value="<?php echo $ko['search']; ?>" />
                        		          </div>
                    		            </form>
                    		            
                    		          </div>
                    		        </div>
                    		        
                    		        <div class="bottom-pane group">
                                  <div class="tower-indicators group">
                                    <p>-N-</p>
                                    <p>-S-</p>
                                  </div>
                      		        <div class="tower-container">
                        		        <div class="north-tower-floors"></div>
                        		        <div class="south-tower-floors"></div>

                      		          <div class="tower"></div>

                                    <div class="nav-arrows right">
                        		          <div class="floor-up"></div>
                        		          <div class="floor-down"></div>
                        		        </div>

                      		        </div>
                            		        
                      		        <div class="results-container"></div>
                      		      </div>

                                <div class="footer group">
                        		      <div class="legend group">
                        		        <div class="available">
                      		            <div class="translation en">
                              		      <?php echo $en['available']; ?>
                        		          </div>
                      		            <div class="translation ru">
                              		      <?php echo $ru['available']; ?>
                        		          </div>
                      		            <div class="translation zh">
                              		      <?php echo $zh['available']; ?>
                        		          </div>
                      		            <div class="translation ko">
                              		      <?php echo $ko['available']; ?>
                        		          </div>
                        		        </div>
                        		        <div class="selected">
                      		            <div class="translation en">
                              		      <?php echo $en['selected']; ?>
                        		          </div>
                      		            <div class="translation ru">
                              		      <?php echo $ru['selected']; ?>
                        		          </div>
                      		            <div class="translation zh">
                              		      <?php echo $zh['selected']; ?>
                        		          </div>
                      		            <div class="translation ko">
                              		      <?php echo $ko['selected']; ?>
                        		          </div>
                        		        </div>
                        		      </div>
                        		      
                  		            <div class="translation en">
                          		      <a href="/contact-us" class="call-to-action"><?php echo $en['Schedule a Tour']; ?></a>
                    		          </div>
                  		            <div class="translation ru">
                          		      <a href="/contact-us" class="call-to-action"><?php echo $ru['Schedule a Tour']; ?></a>
                    		          </div>
                  		            <div class="translation zh">
                          		      <a href="/contact-us" class="call-to-action"><?php echo $zh['Schedule a Tour']; ?></a>
                    		          </div>
                  		            <div class="translation ko">
                          		      <a href="/contact-us" class="call-to-action"><?php echo $ko['Schedule a Tour']; ?></a>
                    		          </div>

                        		    </div>
                      		      
                      		    </li>
                      		    <li class="unit-details">
                      		      <div class="unit-details-title"></div>
                      		      <div class="unit-details-plan"></div>

                                <div class="footer group">
                  		            <div class="translation en">
                          		      <a href="#" class="call-to-action" id="download"><?php echo $en['Download PDF']; ?></a>
                    		          </div>
                  		            <div class="translation ru">
                          		      <a href="#" class="call-to-action" id="download"><?php echo $ru['Download PDF']; ?></a>
                    		          </div>
                  		            <div class="translation zh">
                          		      <a href="#" class="call-to-action" id="download"><?php echo $zh['Download PDF']; ?></a>
                    		          </div>
                  		            <div class="translation ko">
                          		      <a href="#" class="call-to-action" id="download"><?php echo $ko['Download PDF']; ?></a>
                    		          </div>


                  		            <div class="translation en">
                          		      <a href="/contact-us" class="call-to-action"><?php echo $en['Schedule a Tour']; ?></a>
                    		          </div>
                  		            <div class="translation ru">
                          		      <a href="/contact-us" class="call-to-action"><?php echo $ru['Schedule a Tour']; ?></a>
                    		          </div>
                  		            <div class="translation zh">
                          		      <a href="/contact-us" class="call-to-action"><?php echo $zh['Schedule a Tour']; ?></a>
                    		          </div>
                  		            <div class="translation ko">
                          		      <a href="/contact-us" class="call-to-action"><?php echo $ko['Schedule a Tour']; ?></a>
                    		          </div>
                        		    </div>
                      		    </li>
                      		    <!--
                      		    <li class="unit-photos">
                      		      <div class="unit-details-title"></div>
                      		    </li>
                      		    -->
                      		  </ul>

                      		</div>

                                        		      
                		      
              		      </div>
              		      
              		    <?php } else { ?>
              		    
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
              		      
              		    <?php }
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
