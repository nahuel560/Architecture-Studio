<?php 
global $post;
$thumbsize = !isset($thumbsize) ? intoria_get_config( 'blog_item_thumbsize', 'full' ) : $thumbsize;
$thumb = intoria_display_post_thumb($thumbsize);
?>
<article <?php post_class('post post-list-item'); ?>>
    <div class="list-inner">
        <?php
            if ( !empty($thumb) ) {
                ?>
                <div class="image">
                    <?php echo wp_kses($thumb, 'intoria-html'); ?>
                    <div class="entry-date-time">
                        <div class="entry-date-wrap">
                            <?php get_the_date(); ?>
                            <span class="day"><?php the_time( 'd' ); ?> </span>
                            <span class="month"><?php the_time( 'M' ); ?> </span> 
                        </div>
                    </div>
                </div>
                <?php
            }
        ?>
        <div class="bottom-inner">            
            <div class="top-info-post-detail">  
                <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="entry-author">
                    <?php echo get_the_author(); ?>
                </a>
                
                <?php intoria_post_categories_first($post); ?>     

                <span class="comments"><?php comments_number( esc_html__('0 Comments', 'intoria'), esc_html__('1 Comment', 'intoria'), esc_html__('% Comments', 'intoria') ); ?></span>                
            </div>
            <?php if (get_the_title()) { ?>
                <h4 class="entry-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h4>
            <?php } ?>
            <div class="description"><?php echo intoria_substring( get_the_excerpt(), 44, '...' ); ?></div>                        
        </div>
    </div>
</article>