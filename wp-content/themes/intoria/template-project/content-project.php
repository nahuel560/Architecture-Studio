<?php
$thumbsize = !isset($thumbsize) ? 'intoria-project-large' : $thumbsize;
?>
<article <?php post_class(); ?>>	
	<?php if ( has_post_thumbnail() ) { ?>
		<div class="project-thumb">
			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
				<?php the_post_thumbnail( $thumbsize, array( 'alt' => get_the_title() ) ); ?>
			</a>
		</div>
	<?php } ?>
	<div class="project-content-box">
		<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
		<?php if ( has_excerpt() ) { ?>
			<div class="description"><?php echo intoria_substring( get_the_excerpt(), 30, '...' ); ?></div>
		<?php } ?>	

    	<!-- address -->
    	<?php
    		$address = get_post_meta( $post->ID, APUS_INTORIA_PREFIX.'address', true );
    	if ( $address ) {
    		?>
    			<div class="entry-address"><?php echo wp_kses($address, 'intoria-html'); ?></div>
    		<?php
	    	}
    	?>

		<div class="project-button">
			<a class="btn-project" href="<?php the_permalink(); ?>" aria-hidden="true">
				<?php esc_html_e('Ver Proyecto', 'intoria'); ?>
			</a>
		</div>
	</div>
</article>
