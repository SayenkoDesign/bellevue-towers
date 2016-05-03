<?php
/**
 * The template for displaying Author Archive pages.
 *
 * @package WordPress
 * @subpackage Bellevue Towers
 * @since Bellevue Towers 1.0
 *
 *
 * NOTE: This is unaltered from twentyten and uses the loop.php that I don't use...
 */

get_header(); ?>

  <div class="content-page group">

    <?php
	    /* Queue the first post, that way we know who
	     * the author is when we try to get their name,
	     * URL, description, avatar, etc.
	     *
	     * We reset this later so we can run the loop
	     * properly with a call to rewind_posts().
	     */
	    if ( have_posts() )
		    the_post();
    ?>

		<h2><?php printf( __( 'Author Archives: %s', 'safeway' ), "<span class='vcard'><a class='url fn n' href='" . get_author_posts_url( get_the_author_meta( 'ID' ) ) . "' title='" . esc_attr( get_the_author() ) . "' rel='me'>" . get_the_author() . "</a></span>" ); ?></h2>

    <?php
      // If a user has filled out their description, show a bio on their entries.
      if ( get_the_author_meta( 'description' ) ) : ?>
	      <div id="entry-author-info">
		      <div id="author-avatar">
			      <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'safeway_author_bio_avatar_size', 60 ) ); ?>
		      </div>
		      <div id="author-description">
			      <h2><?php printf( __( 'About %s', 'safeway' ), get_the_author() ); ?></h2>
			      <?php the_author_meta( 'description' ); ?>
		      </div>
	      </div>
    <?php endif; ?>

    <?php
	    /* Since we called the_post() above, we need to
	     * rewind the loop back to the beginning that way
	     * we can run the loop properly, in full.
	     */
	    rewind_posts();

	    /* Run the loop for the author archive page to output the authors posts
	     * If you want to overload this in a child theme then include a file
	     * called loop-author.php and that will be used instead.
	     */
	     get_template_part( 'loop', 'author' );
    ?>

	</div>

<?php get_footer(); ?>
