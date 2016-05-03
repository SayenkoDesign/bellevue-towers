<div class="content-sidebar opaque">
  <h4>Categories</h4>
  <ul class="nav-blog">
    <?php 
	    wp_list_categories("title_li=&"); 
    ?>
  </ul>

  <h4>Archives</h4>
  <ul class="nav-blog">
    <?php wp_get_archives('type=monthly&category_name=blog'); ?>
  </ul>	
</div>
