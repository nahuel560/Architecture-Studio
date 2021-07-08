<?php
    $number = intoria_get_config('number_project_recent', 3);
    $columns = intoria_get_config('recent_project_columns', 3);
    
    $args = array(
        'post_type' => 'project',
        'posts_per_page' => $number,
        'post__not_in' => array( get_the_ID() ),
        'orderby' => 'date',
        'order' => 'DESC',
    );
    $loop = new WP_Query( $args );
    if( $loop->have_posts() ):
?>
<div class="recent-project">
    <h4 class="title asdasdasd">
        <span><?php esc_html_e( 'Proyectos Relacionados', 'intoria' ); ?></span>
    </h4>
    <div class="recent-project-content  widget-content">
        <div class="slick-carousel" data-carousel="slick" data-smallmedium="2" data-extrasmall="1" data-items="<?php echo esc_attr($columns); ?>" data-pagination="false" data-nav="true">
            <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                <div class="item">
                    <?php get_template_part( 'template-project/content-project' ); ?>
                </div>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    </div>
</div>
<?php endif; ?>