<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage intoria
 * @since intoria 1.0
 */
/*
*Template Name: 404 Page
*/
get_header();
intoria_render_breadcrumbs();

?>
<section class="page-404">
	<div id="main-container" class="inner">
		<div id="main-content" class="main-page">
			<section class="error-404 not-found clearfix text-center">
				<div class="container">
					<div class="row flex-middle-sm">
						<div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
							<div class="slogan">
								<?php
								$title = intoria_get_config('404_title', '404');
								if(!empty($title) ) {
								?>
									<h4 class="title-big"><?php echo wp_kses($title, 'intoria-html'); ?></h4>
								<?php } else { ?>
									<h4 class="title-big"><?php esc_html_e('404', 'intoria'); ?></h4>
								<?php } ?>
							</div>
							<div class="page-content">
								<div class="description">
									<?php
									$description = intoria_get_config('404_description');
									if ( !empty($description) ) {
										echo wp_kses($description, 'intoria-html');
									} else {
										esc_html_e('It looks like nothing was found at this location. Maybe try a search?', 'intoria');
									}
									?>
								</div>
								<?php get_search_form(); ?>								
								<div class="return">
									<a class="btn-to-back" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html__('Back To Homepage','intoria') ?></a>
								</div>
							</div><!-- .page-content -->
						</div>
					</div>
				</div>
			</section><!-- .error-404 -->
		</div><!-- .content-area -->
	</div>
</section>
<?php get_footer(); ?>