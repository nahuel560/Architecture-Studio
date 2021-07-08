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
                </div>
                <?php
            }
        ?>
        <div class="bottom-inner">   
            <?php if (get_the_title()) { ?>
                <h4 class="entry-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h4>
            <?php } ?>

            <ul class="entry-post-info list-unstyled flex-top">
                <li class="entry-date"><?php the_time( get_option('date_format', 'M d, Y') ); ?></li>
                <li class="entry-author"><?php echo esc_html__('By ','intoria') ?><?php the_author_posts_link(); ?></li>
            </ul>

            <div class="description"><?php echo intoria_substring( get_the_excerpt(), 44, '...' ); ?></div>    

            <p class="entry-link">
                <a class="btn" href="<?php the_permalink(); ?>"><?php esc_html_e('Read More', 'intoria'); ?></a>
            </p>

            <ul class="entry-footer-post list-unstyled flex-top">
                <li><?php intoria_post_categories_first($post); ?></li>
                <li class="entry-comments"><span class="comments"><?php comments_number( esc_html__('0 Comments', 'intoria'), esc_html__('1 Comment', 'intoria'), esc_html__('% Comments', 'intoria') ); ?></span></li>
            </ul>
        </div>
    </div>
</article>