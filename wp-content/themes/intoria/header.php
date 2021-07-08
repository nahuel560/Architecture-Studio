<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Intoria
 * @since Intoria 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>

	<?php if( is_singular( 'project' ) ){ ?>

	<link rel='stylesheet' href='https://oma-arquitectos.com.ar/wp-content/plugins/elementor/assets/lib/font-awesome/css/v4-shims.min.css?ver=3.0.15' type='text/css' media='all' />	
	<link rel='stylesheet' href='https://oma-arquitectos.com.ar/wp-content/plugins/elementor/assets/css/frontend.min.css?ver=3.0.16' type='text/css' media='all' />	
	<link rel='stylesheet' href='https://oma-arquitectos.com.ar/wp-content/plugins/elementor/assets/css/frontend-legacy.min.css?ver=3.0.16' type='text/css' media='all' />	

	<style>
	
	.elementor-column-gap-extended>.elementor-row>.elementor-element-6ec6d04>.elementor-element-populated {
		padding: 0 !important;
	}	
	
	</style>

	<?php } ?>
	
	
	<script>
	
	jQuery( document ).ready(function() {
		jQuery('#menu-main-menu li a').on('click', function (event) {
		
			este = jQuery(this);
			refa = este.attr("href").substr(0,1);
			
		//	if (refa == "#") {
				
				setTimeout(function(){ 
					jQuery('#apus-mobile-menu').removeClass('active');
					jQuery('.over-dark').removeClass('active');
				 }, 300);
			// }
		});

	});	
	
	
	</script>
	
	<!-- Global site tag (gtag.js) - Google Ads: 452985233 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-452985233"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-452985233');
</script>
	
</head>
<body <?php body_class(); ?>>
<?php if ( intoria_get_config('preload', true) ) {
	$preload_icon = intoria_get_config('media-preload-icon');
	$preload_icon_image_img = '';
	if ( !empty($preload_icon['url']) ) {
        if (is_ssl()) {
            $preload_icon_image_img = str_replace("http://", "https://", $preload_icon['url']);		
        } else {
            $preload_icon_image_img = $preload_icon['url'];
        }
    }
?>
	<div class="apus-page-loading">
        <div class="apus-loader-inner" style="<?php echo esc_attr($preload_icon_image_img ? 'background-image: url(\''.$preload_icon_image_img.'\')' : ''); ?>"></div>
    </div>
<?php } ?>
<div id="wrapper-container" class="wrapper-container">
	
	<?php get_template_part( 'headers/mobile/offcanvas-menu' ); ?>
	<?php get_template_part( 'headers/mobile/header-mobile' ); ?>

	<?php
		$header = apply_filters( 'intoria_get_header_layout', intoria_get_config('header_type') );
		if ( !empty($header) ) {
			intoria_display_header_builder($header);
		} else {
			get_template_part( 'headers/default' );
		}
	?>
	<div id="apus-main-content">