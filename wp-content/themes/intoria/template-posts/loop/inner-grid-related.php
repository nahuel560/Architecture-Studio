<?php 
    $thumbsize = !isset($thumbsize) ? intoria_get_config( 'blog_item_thumbsize', 'medium' ) : $thumbsize;
    $thumb = intoria_display_post_thumb($thumbsize);
?>

<article <?php post_class('post post-grid post-grid-related'); ?>>
    <?php
        if ( !empty($thumb) ) {
            ?>
            <div class="image p-relative">
                <?php echo wp_kses($thumb, 'intoria-html'); ?>
            </div>
            <?php
        }
    ?>
    <?php if (get_the_title()) { ?>
        <h4 class="entry-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h4>
    <?php } ?>

    <ul class="entry-post-info list-unstyled flex-top">
        <li class="entry-date"><?php the_time( get_option('date_format', 'M d, Y') ); ?></li>
        <li class="entry-author"><?php echo esc_html__('By ','intoria') ?><?php the_author_posts_link(); ?></li>
    </ul>

    <?php if(has_excerpt()){?>
        <div class="description"><?php echo intoria_substring( get_the_excerpt(),22, '...' ); ?></div>
    <?php } ?>
    <p class="entry-link">
        <a class="btn" href="<?php the_permalink(); ?>"><?php esc_html_e('Read More', 'intoria'); ?></a>
    </p>
    <div class="entry-footer-post">
        <div class="entry-comments">
            <?php comments_number( esc_html__('0 Comments', 'intoria'), esc_html__('1 Comment', 'intoria'), esc_html__('% Comments', 'intoria') ); ?>
        </div>        
    </div>   
</article>    