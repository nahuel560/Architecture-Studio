<?php
/**
 *
 * If no content, include the "No posts found" template.
 * @since 1.0
 * @version 1.0.0
 *
 */
?>
<article id="post-0" class="post no-results not-found">
	<div class="entry-content e-entry-content">
		<h2 class="entry-title">
			<span><?php esc_html_e( 'Oops!', 'intoria' ) ?></span> <?php esc_html_e( 'Sorry, but your search returned no results!', 'intoria' ) ?>
		</h2>
		<p><?php esc_html_e( 'Try again please, use the search form below.', 'intoria' ); ?></p>
		<div class="searchform-not-found">
			<?php get_search_form(); ?>
		</div>
	</div>
	<!-- entry-content -->
</article><!-- /article -->