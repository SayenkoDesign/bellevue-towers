<?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 * @subpackage Bellevue Towers
 * @since Bellevue Towers 1.0
 */
?>
		

    
    <script>document.write("<scr"+"ipt src='http://mpp.specificclick.net/?nwk=4&y=2&t=j&tp=1&clid=4261&pixid=99017652&rnd=<?php echo date('m-d-y_H:i:s'); ?>&u="+escape(parent.document.location)+"&r="+escape(parent.document.referrer)+"'></scri"+"pt>");</script>
    <noscript>
        <img src="http://mpp.specificclick.net/?nwk=4&y=2&t=i&tp=1&clid=4261&pixid=99017652&rnd=<?php echo date('m-d-y_H:i:s'); ?>" width="0" height="0" border="0" />
    </noscript>
    <?php wp_footer(); ?>
          	
    <!-- Analytics -->
	
	<?php if ( is_page ( array( 19 , 5 , 9) ) )

		{
			echo '
			<!-- HEARST TRACKING -->
			<script async src="http://i.simpli.fi/dpx.js?cid=3641&action=100&segment=bellevuetowers&m=1"></script>';
		}
	?>
  </body>
</html>
