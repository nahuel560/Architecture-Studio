<?php 
    $thumbsize = !isset($thumbsize) ? intoria_get_config( 'blog_item_thumbsize', 'full' ) : $thumbsize;
    $thumb = intoria_display_post_thumb($thumbsize);
?>
<article <?php post_class('post post-grid post-grid-style-2'); ?>>
    <?php
        if ( !empty($thumb) ) {
            ?>
            <div class="image p-relative">
                <?php echo wp_kses($thumb, 'intoria-html'); ?>
            </div>
            <?php
        }
    ?>

    <div class="entry-body-post">
        <div class="entry-content-left">            
            <div class="entry-date">
                <span class="day"><?php the_time( 'd' ); ?> </span>
                <span class="month"><?php the_time( 'M' ); ?> </span>                     
            </div>
        </div>
        <div class="entry-content-block">
            <?php if (get_the_title()) { ?>
                <h4 class="entry-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h4>
            <?php } ?>

            <?php if(has_excerpt()){?>
                <div class="description"><?php echo intoria_substring( get_the_excerpt(),22, '...' ); ?></div>
            <?php } ?>        
        </div>
    </div>

    <div class="entry-footer-post flex-middle">
        <ul class="entry-post-info list-unstyled flex-top margin-bottom-0">        
            <li class="entry-author"><?php echo esc_html__('By ','intoria') ?><?php the_author_posts_link(); ?></li>
        </ul>         
        <div class="entry-meta-right">
            <div class="entry-comments">
                <?php comments_number( esc_html__('0 Comments', 'intoria'), esc_html__('1 Comment', 'intoria'), esc_html__('% Comments', 'intoria') ); ?>
            </div>      
        </div>
    </div>   
</article>