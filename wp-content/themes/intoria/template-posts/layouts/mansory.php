<?php
	$columns = intoria_get_config('blog_columns', 1);
    $bcol = floor( 12 / $columns );
    $classes = 'col-md-'.$bcol;
        
    set_query_var( 'thumbsize', 'intoria-blog-mansory' );
    wp_enqueue_script( 'isotope-pkgd', get_template_directory_uri().'/js/isotope.pkgd.min.js', array( 'jquery', 'imagesloaded' ) );
?>

<div class="isotope-items blog-mansory-wrapper row" data-isotope-duration="400" data-columnwidth=".<?php echo esc_attr($classes); ?>">
    <?php while ( have_posts() ) : the_post(); ?>
        <div class="isotope-item col-sm-6 <?php echo esc_attr($classes); ?> col-xs-12">
            <?php get_template_part( 'template-posts/loop/inner-grid' ); ?>
        </div>
    <?php endwhile; ?>
</div>