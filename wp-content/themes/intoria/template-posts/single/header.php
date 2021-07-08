<?php
$post_format = get_post_format();
global $post;
$author_id = $post->post_author;

$style = '';
$thumbnail_url = get_the_post_thumbnail_url($post->ID, 'full');
if ( !empty($thumbnail_url) ) {
    $style = 'style="background-image:url('. $thumbnail_url .');"';
}
?>
<section class="top-info-detail-v1" <?php echo trim($style); ?>>

    <div class="container">
        
    <?php the_title('<h1 class="entry-title-detail">', '</h1>'); ?>

    <div class="top-info-post-detail">

        <div class="entry-p-date entry-item">
            <div class="entry-item-label"><?php esc_html_e('Posted :', 'intoria'); ?></div>
            <div class="entry-item-value"><?php the_time( get_option('date_format', 'd M, Y') ); ?></div>
        </div>

        <?php
        $categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'intoria' ) );
        if ( $categories_list ) {
            ?>
            <div class="entry-category entry-item">
                <div class="entry-item-label"><?php esc_html_e('Categories :', 'intoria'); ?></div>
                <div class="entry-item-value"><?php echo wp_kses($categories_list, 'intoria-html'); ?></div>
            </div>
            <?php
        }
        ?>

        <div class="entry-p-author entry-item">
            <div class="entry-item-label"><?php esc_html_e('Posted :', 'intoria'); ?></div>
            <div class="entry-item-value">
                <a href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>">
                    <?php the_author_meta( 'display_name', $author_id ); ?>
                </a>
            </div>
        </div>
        

        <?php if ( intoria_get_config('show_blog_social_share', false) ) { ?>
            <div class="entry-share entry-item">
                <div class="entry-item-label"><?php esc_html_e('Share :', 'intoria'); ?></div>
                <div class="entry-item-value">
                    <?php get_template_part( 'template-parts/sharebox' ); ?>
                </div>
            </div>
        <?php } ?>         
    </div>

    </div>

</section>
