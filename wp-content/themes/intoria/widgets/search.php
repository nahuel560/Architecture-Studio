<?php 

extract( $args );
extract( $instance );
$title = apply_filters('widget_title', $instance['title']);

if ( $title ) {
    echo wp_kses($before_title .$title . $after_title, 'intoria-html');
}

?>
<div class="widget-search">
    <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
		<input type="text" placeholder="<?php esc_attr_e( 'Search', 'intoria' ); ?>" name="s" class="apus-search form-control"/>
	  	<button type="submit" class="btn btn-sm btn-search"><i class="fas fa-search"></i></button>	  	
		<?php if ( isset($post_type) && $post_type ): ?>
			<input type="hidden" name="post_type" value="<?php echo esc_attr($post_type); ?>" class="post_type" />
		<?php endif; ?>
	</form>
</div>