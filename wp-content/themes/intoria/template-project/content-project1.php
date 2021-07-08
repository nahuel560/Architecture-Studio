<?php
global $post;
$thumbsize = !empty($thumbsize) ? $thumbsize : 'intoria-blog-grid';
?>
<article <?php post_class(); ?>>	
	<?php if ( has_post_thumbnail() ) { ?>
		<div class="project-thumb">
			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
				<?php the_post_thumbnail( $thumbsize ); ?>
			</a>
		</div>
	<?php } ?>
	<div class="project-content-box">
		<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
		<?php
		$address = get_post_meta($post->ID, APUS_INTORIA_PREFIX.'address', true);
		if ( $address ) {
		?>
			<div class="address"><?php echo wp_kses($address, 'intoria-html'); ?></div>
		<?php } ?>
	</div>
</article>