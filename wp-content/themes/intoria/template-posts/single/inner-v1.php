<?php
$post_format = get_post_format();
global $post;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
	<div class="entry-content-detail">
        
    	<div class="single-info info-bottom">
            <div class="entry-description">
                <?php the_content(); ?>
            </div><!-- /entry-content -->
    		<?php
    		wp_link_pages( array(
    			'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'intoria' ) . '</span>',
    			'after'       => '</div>',
    			'link_before' => '<span>',
    			'link_after'  => '</span>',
    			'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'intoria' ) . ' </span>%',
    			'separator'   => '',
    		) );
    		?>
            <?php  
                $posttags = get_the_tags();
            ?>
            <?php if( !empty($posttags) || intoria_get_config('show_blog_social_share', false) ){ ?>
        		<div class="tag-social clearfix">
                    <?php intoria_post_tags(); ?>
        			<?php if( intoria_get_config('show_blog_social_share', false) ) {
        				get_template_part( 'template-parts/sharebox' );
        			} ?>
        		</div>
            <?php } ?>
            <?php
                //Previous/next post navigation.
                the_post_navigation( array(
                    'next_text' => '<span class="meta-nav" aria-hidden="true"><span class="navi">' . esc_html__( 'Next', 'intoria' ) . '</span> <i class="flaticon-back"></i></span> ' .
                        '<span class="inner">'.
                        '<span class="title-direct">%title</span></span>',
                    'prev_text' => '<span class="meta-nav" aria-hidden="true"><i class="flaticon-next"></i><span class="navi"> ' . esc_html__( 'Prev', 'intoria' ) . '</span></span> ' .
                        '<span class="inner">'.
                        '<span class="title-direct">%title</span></span>',
                ) );
            ?>
    	</div>
    </div>
</article>