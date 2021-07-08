<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
$sidebar_configs = intoria_get_project_layout_configs();

global $post;
$style = '';
$thumbnail_url = get_the_post_thumbnail_url($post->ID, 'full');
if ( !empty($thumbnail_url) ) {
    $style = 'style="background-image:url('. $thumbnail_url .');"';
}
?>

<!--div class="top-info-detail-v1 project-info-detail" <?php echo trim($style); ?>-->
	<div class="container">
		<div class="entry-title-detail-wrapper">
	    	<?php the_title('<h1 class="entry-title-detail heading-titleaaa">', '</h1>'); ?>
	    	<!-- address -->
	    	<?php
	    	$address = get_post_meta( $post->ID, APUS_INTORIA_PREFIX.'address', true );
	    	if ( $address ) {
	    		?>
	    		<div class="entry-address"><?php echo wp_kses($address, 'intoria-html'); ?></div>
	    		<?php
	    	}
	    	?>
	    </div>
		
	</div>
<!--/div-->
<section id="main-container" class="main-content  <?php echo apply_filters('intoria_project_content_class', 'container');?> inner">
	<?php intoria_before_content( $sidebar_configs ); ?>
	<div class="row">
		<?php intoria_display_sidebar_left( $sidebar_configs ); ?>

		<div id="main-content" class="col-sm-12 <?php echo esc_attr($sidebar_configs['main']['class']); ?>">
			<main id="main" class="site-main detail-project <?php echo esc_attr( (count($sidebar_configs)>1)?'has-sidebar':'' ); ?>" role="main">

			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();

					?>
					<div class="entry-description">
		                <?php the_content(); ?>
		            </div><!-- /entry-content -->
					<?php

					get_template_part( 'template-project/recent-project' );

				// End the loop.
				endwhile;
			?>

			</main><!-- .site-main -->
		</div><!-- .content-area -->
		
		<?php intoria_display_sidebar_right( $sidebar_configs ); ?>
		
	</div>
</section>
<?php get_footer(); ?>