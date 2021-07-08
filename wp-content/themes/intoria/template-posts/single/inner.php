<?php
$post_format = get_post_format();
global $post;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="top-info-detail">
        
        <div class="entry-thumb <?php echo  (!has_post_thumbnail() ? 'no-thumb' : ''); ?>">
            <?php
                $thumb = intoria_post_thumbnail();
                echo wp_kses($thumb, 'intoria-html');
            ?>
        </div>

    </div>
	<div class="entry-content-detail">
        <?php the_title('<h1 class="entry-title-detail">', '</h1>'); ?>
        <div class="top-info-post-detail">
            <a class="entry-author" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
                <span><?php esc_html_e('By', 'intoria'); ?></span><?php echo get_the_author(); ?>                
            </a>
            <div class="entry-date">
                <?php the_time( get_option('date_format', 'd M, Y') ); ?>
            </div>            
        </div>
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