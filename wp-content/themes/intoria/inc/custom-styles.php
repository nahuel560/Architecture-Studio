<?php
if ( !function_exists ('intoria_custom_styles') ) {
	function intoria_custom_styles() {
		global $post;	
		
		ob_start();	
		?>
		
			<?php
				$main_font = intoria_get_config('main_font');
				$main_font = isset($main_font['font-family']) ? $main_font['font-family'] : false;
			?>
			<?php if ( $main_font ): ?>
				/* Main Font */
				body
				{
					font-family: 
					<?php echo '\'' . $main_font . '\','; ?> 
					sans-serif;
				}
			<?php endif; ?>
			
			<?php
				$heading_font = intoria_get_config('heading_font');
				$heading_font = isset($heading_font['font-family']) ? $heading_font['font-family'] : false;
			?>
			<?php if ( $heading_font ): ?>
				/* Heading Font */
				h1, h2, h3, h4, h5, h6, .widget-title,.widgettitle
				{
					font-family:  <?php echo '\'' . $heading_font . '\','; ?> sans-serif;
				}			
			<?php endif; ?>


			<?php if ( intoria_get_config('main_color') != "" ) : ?>
				/* seting background main */			
				.btn,
				.btn:hover,
				.btn:focus,
				.btn:active,
				.bg-theme,
				.apus-heading .sub:before, 
				.apus-heading .sub:after,
				.apus-heading .sub .sub-title-inside:before, 
				.apus-heading .sub .sub-title-inside:after,
				.widget-nav-menu.inline .menu li a:after,
				.widget-projects .btn-project:after,
				.play-now i,
				.read-more-btn:after,
				.post-grid.post-grid-style-2 .entry-date:after,
				.widget-tabs .widget-sub-title:before,
				.widget-tabs .widget-sub-title:after,
				.widget-team.style2:before,
				.widget-team.style1 .team-job > *,
				.post-navigation .nav-links a:after,
				.post-navigation .nav-links > .nav-next a:before,
				.detail-post .entry-tags-list a:before,
				.apus-pagination > span.current, .apus-pagination > a.current,
				.apus-pagination > span:hover, .apus-pagination > a:hover,
				.apus-pagination > span:focus, .apus-pagination > a:focus,
				.apus-pagination > span:active, .apus-pagination > a:active,				
				.button, button, input[type="button"], input[type="reset"], input[type="submit"],
				.button:active, button:active, input[type="button"]:active, input[type="reset"]:active, input[type="submit"]:active,
				.button:focus, button:focus, input[type="button"]:focus, input[type="reset"]:focus, input[type="submit"]:focus
				.button:focus, button:focus, input[type="button"]:focus, input[type="reset"]:focus, input[type="submit"]:focus,
				.button:hover, button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover,				
				.widget-social .social > li > a > .social-inner:nth-of-type(1):before, .widget-social .social > li > a > .social-inner:nth-of-type(1):after, .widget-social .social > li > a > .social-inner:nth-of-type(2):before, .widget-social .social > li > a > .social-inner:nth-of-type(2):after, .widget-social .social > li > a > .social-inner:nth-of-type(3):before, .widget-social .social > li > a > .social-inner:nth-of-type(3):after,
				.widget-social .social > li > a:nth-of-type(1):before, .widget-social .social > li > a:nth-of-type(1):after, .widget-social .social > li > a:nth-of-type(2):before, .widget-social .social > li > a:nth-of-type(2):after, .widget-social .social > li > a:nth-of-type(3):before, .widget-social .social > li > a:nth-of-type(3):after,
				.post-navigation .nav-links .nav-previous a:before,
				.layout-project .project .project-content-box .entry-address,
				.recent-project .widget-content .project-button .btn-project,
				.recent-project .widget-content .project-button .btn-project:hover,
				.recent-project .widget-content .project-button .btn-project:focus,
				.recent-project .widget-content .project-button .btn-project:active,
				.page-404 .btn-to-back,
				.page-404 .btn-to-back:hover,
				.page-404 .btn-to-back:focus,
				.page-404 .btn-to-back:active,
				.widget-team.style2 .social li a:hover,
				.widget-team.style2 .social li a:focus,
				.widget-team.style2 .social li a:active
				{				
					background-color: <?php echo esc_html( intoria_get_config('main_color') ) ?>;					
				}

				.widget-nav-menu.inline .menu li a,
				.widget-projects .btn-project,
				.read-more-btn
				{				
					background-image: linear-gradient(to right, <?php echo esc_html( intoria_get_config('main_color') ) ?>, <?php echo esc_html( intoria_get_config('main_color') ) ?> 50%, #1f3334 50%);
				}
				/* setting color*/
				a:hover, 
				a:focus,
				.btn-link,
				.text-theme,
				.apus-heading .sub,
				.megamenu > li.active > a,
				.megamenu > li:hover > a,
				.megamenu > li:focus > a,
				.megamenu > li:active > a,
				.megamenu > li > a:focus,
				.megamenu > li > a:hover,
				.megamenu > li > a:active,				
				.megamenu li .dropdown-menu li > a:hover,
				.megamenu li .dropdown-menu li > a:focus,				
				.megamenu li .dropdown-menu li > a:active,	
				.widget-social .social > li > a,				
				.apus-footer a:hover, 
				.apus-footer a:focus, 
				.apus-footer a:active,
				.custom-copyright a,
				.widget-features-box .features-box-image.icon,
				.slick-carousel .slick-arrow:hover,
				.slick-carousel .slick-arrow:focus,
				.slick-carousel .slick-arrow:active,
				.widget-video .video-title,
				.entry-author,
				.entry-author a,
				.entry-comments,
				.comment-list .comment-reply-link,
				.widget-video .video-section-content > div .play-video-text,
				.widget-nav-menu .menu li a:hover, .widget-nav-menu .menu li a:focus, .widget-nav-menu .menu li a:active,
				.widget-features-box .features-box-content a:hover .title,
				.post-grid.post-grid-style-2 .entry-date,
				.widget-projects .isotope-filter li a.active,
				.add-fix-top:before,
				.page-404 .title-big,
				.megamenu > li.active > a .caret,
				.megamenu li .dropdown-menu li.active > a,
				.widget-tabs .widget-sub-title,
				.widget-wedo-box .features-box-icon,
				.posts-list .top-info a:hover,
				.posts-list .top-info a:focus,
				.posts-list .top-info a:active,
				.post-navigation .nav-links a:hover,
				.post-navigation .nav-links a:focus,
				.post-navigation .nav-links a:active,
				.contact-sidebar-wrapper .contact_close,
				.widget-blogs.carousel .slick-carousel .slick-arrow:hover,
				.widget-blogs.carousel .slick-carousel .slick-arrow:focus,
				.widget-blogs.carousel .slick-carousel .slick-arrow:active,
				.apus-breadscrumb.has_bg .breadcrumb a:hover,
				.apus-breadscrumb.has_bg .breadcrumb a:focus,
				.apus-breadscrumb.has_bg .breadcrumb a:active,
				.header_transparent:not(.has-header-sticky):not(.error404) .apus-header .megamenu > li:hover > a, .header_transparent .main-sticky-header:not(.sticky-header) .megamenu > li:hover > a,
				.header_transparent:not(.has-header-sticky):not(.error404) .apus-header .megamenu > li:active > a, .header_transparent .main-sticky-header:not(.sticky-header) .megamenu > li:active > a,
				.header_transparent:not(.has-header-sticky):not(.error404) .apus-header .megamenu > li:focus > a, .header_transparent .main-sticky-header:not(.sticky-header) .megamenu > li:focus > a,
				.header_transparent:not(.has-header-sticky):not(.error404) .apus-header .megamenu > li.active > a, .header_transparent .main-sticky-header:not(.sticky-header) .megamenu > li.active > a,
				.header_transparent:not(.has-header-sticky):not(.error404) .apus-header .megamenu > li.active > a .caret, .header_transparent .main-sticky-header:not(.sticky-header) .megamenu > li.active > a .caret,
				.widget_meta ul li.current-cat-parent:hover, .widget_meta ul li.current-cat:hover, .widget_meta ul li a:hover, .widget_archive ul li.current-cat-parent:hover, .widget_archive ul li.current-cat:hover, .widget_archive ul li a:hover, .widget_recent_entries ul li.current-cat-parent:hover, .widget_recent_entries ul li.current-cat:hover, .widget_recent_entries ul li a:hover, .widget_categories ul li.current-cat-parent:hover, .widget_categories ul li.current-cat:hover, .widget_categories ul li a:hover, .widget_pages ul li.current-cat-parent:hover, .widget_pages ul li.current-cat:hover, .widget_pages ul li a:hover, .widget_nav_menu ul li.current-cat-parent:hover, .widget_nav_menu ul li.current-cat:hover, .widget_nav_menu ul li a:hover,
				.widget_meta ul li.current-cat-parent:focus, .widget_meta ul li.current-cat:focus, .widget_meta ul li a:focus, .widget_archive ul li.current-cat-parent:focus, .widget_archive ul li.current-cat:focus, .widget_archive ul li a:focus, .widget_recent_entries ul li.current-cat-parent:focus, .widget_recent_entries ul li.current-cat:focus, .widget_recent_entries ul li a:focus, .widget_categories ul li.current-cat-parent:focus, .widget_categories ul li.current-cat:focus, .widget_categories ul li a:focus, .widget_pages ul li.current-cat-parent:focus, .widget_pages ul li.current-cat:focus, .widget_pages ul li a:focus, .widget_nav_menu ul li.current-cat-parent:focus, .widget_nav_menu ul li.current-cat:focus, .widget_nav_menu ul li a:focus,
				.widget_meta ul li.current-cat-parent:active, .widget_meta ul li.current-cat:active, .widget_meta ul li a:active, .widget_archive ul li.current-cat-parent:active, .widget_archive ul li.current-cat:active, .widget_archive ul li a:active, .widget_recent_entries ul li.current-cat-parent:active, .widget_recent_entries ul li.current-cat:active, .widget_recent_entries ul li a:active, .widget_categories ul li.current-cat-parent:active, .widget_categories ul li.current-cat:active, .widget_categories ul li a:active, .widget_pages ul li.current-cat-parent:active, .widget_pages ul li.current-cat:active, .widget_pages ul li a:active, .widget_nav_menu ul li.current-cat-parent:active, .widget_nav_menu ul li.current-cat:active, .widget_nav_menu ul li a:active
				{
					color: <?php echo esc_html( intoria_get_config('main_color') ) ?>;
				}

				.text-theme
				{
					color: <?php echo esc_html( intoria_get_config('main_color') ) ?> !important;
				}

				/* setting border color*/											
				.btn,
				.border-theme,
				.comment-list .the-comment,
				.page-404 .btn-to-back,
				.page-404 .btn-to-back:hover,
				.page-404 .btn-to-back:focus,
				.page-404 .btn-to-back:active,
				.page-404 .btn-to-back:before,
				.page-404 .btn-to-back:after,				
				.recent-project .widget-content .project-button .btn-project,
				.entry-link .btn:before, .entry-link .viewmore-products-btn:before,				
				.entry-link .btn:after, .entry-link .viewmore-products-btn:after,
				.apus-pagination > span.current, .apus-pagination > a.current,
				.apus-pagination > span:hover, .apus-pagination > a:hover,
				.apus-pagination > span:active, .apus-pagination > a:active,
				.apus-pagination > span:focus, .apus-pagination > a:focus,
				.recent-project .widget-content .project-button .btn-project:before,
				.recent-project .widget-content .project-button .btn-project:after,
				.button, button, input[type="button"], input[type="reset"], input[type="submit"],
				.comment-form-cookies-consent [type="checkbox"]:checked ~ label:before,	
				.sidebar .widget-search .form-control:hover, .apus-sidebar .widget-search .form-control:hover,
				.sidebar .widget-search .form-control:focus, .apus-sidebar .widget-search .form-control:focus,
				.sidebar .widget-search .form-control:active, .apus-sidebar .widget-search .form-control:active,			
				.apus-contact-form-2 .wpcf7-form input[type="text"]:focus, .apus-contact-form-2 .wpcf7-form input[type="email"]:focus, .apus-contact-form-2 .wpcf7-form input[type="url"]:focus, .apus-contact-form-2 .wpcf7-form input[type="password"]:focus, .apus-contact-form-2 .wpcf7-form input[type="search"]:focus, .apus-contact-form-2 .wpcf7-form input[type="number"]:focus, .apus-contact-form-2 .wpcf7-form input[type="tel"]:focus, .apus-contact-form-2 .wpcf7-form input[type="range"]:focus, .apus-contact-form-2 .wpcf7-form input[type="date"]:focus, .apus-contact-form-2 .wpcf7-form input[type="month"]:focus, .apus-contact-form-2 .wpcf7-form input[type="week"]:focus, .apus-contact-form-2 .wpcf7-form input[type="time"]:focus, .apus-contact-form-2 .wpcf7-form input[type="datetime"]:focus, .apus-contact-form-2 .wpcf7-form input[type="datetime-local"]:focus, .apus-contact-form-2 .wpcf7-form input[type="color"]:focus, .apus-contact-form-2 .wpcf7-form textarea:focus
				.apus-contact-form-2 .wpcf7-form input[type="text"]:hover, .apus-contact-form-2 .wpcf7-form input[type="email"]:hover, .apus-contact-form-2 .wpcf7-form input[type="url"]:hover, .apus-contact-form-2 .wpcf7-form input[type="password"]:hover, .apus-contact-form-2 .wpcf7-form input[type="search"]:hover, .apus-contact-form-2 .wpcf7-form input[type="number"]:hover, .apus-contact-form-2 .wpcf7-form input[type="tel"]:hover, .apus-contact-form-2 .wpcf7-form input[type="range"]:hover, .apus-contact-form-2 .wpcf7-form input[type="date"]:hover, .apus-contact-form-2 .wpcf7-form input[type="month"]:hover, .apus-contact-form-2 .wpcf7-form input[type="week"]:hover, .apus-contact-form-2 .wpcf7-form input[type="time"]:hover, .apus-contact-form-2 .wpcf7-form input[type="datetime"]:hover, .apus-contact-form-2 .wpcf7-form input[type="datetime-local"]:hover, .apus-contact-form-2 .wpcf7-form input[type="color"]:hover, .apus-contact-form-2 .wpcf7-form textarea:hover,
				.apus-contact-form-2 .wpcf7-form input[type="text"]:active, .apus-contact-form-2 .wpcf7-form input[type="email"]:active, .apus-contact-form-2 .wpcf7-form input[type="url"]:active, .apus-contact-form-2 .wpcf7-form input[type="password"]:active, .apus-contact-form-2 .wpcf7-form input[type="search"]:active, .apus-contact-form-2 .wpcf7-form input[type="number"]:active, .apus-contact-form-2 .wpcf7-form input[type="tel"]:active, .apus-contact-form-2 .wpcf7-form input[type="range"]:active, .apus-contact-form-2 .wpcf7-form input[type="date"]:active, .apus-contact-form-2 .wpcf7-form input[type="month"]:active, .apus-contact-form-2 .wpcf7-form input[type="week"]:active, .apus-contact-form-2 .wpcf7-form input[type="time"]:active, .apus-contact-form-2 .wpcf7-form input[type="datetime"]:active, .apus-contact-form-2 .wpcf7-form input[type="datetime-local"]:active, .apus-contact-form-2 .wpcf7-form input[type="color"]:active, .apus-contact-form-2 .wpcf7-form textarea:active,
				.apus-contact-form-2 .wpcf7-form input[type="text"]:focus, .apus-contact-form-2 .wpcf7-form input[type="email"]:focus, .apus-contact-form-2 .wpcf7-form input[type="url"]:focus, .apus-contact-form-2 .wpcf7-form input[type="password"]:focus, .apus-contact-form-2 .wpcf7-form input[type="search"]:focus, .apus-contact-form-2 .wpcf7-form input[type="number"]:focus, .apus-contact-form-2 .wpcf7-form input[type="tel"]:focus, .apus-contact-form-2 .wpcf7-form input[type="range"]:focus, .apus-contact-form-2 .wpcf7-form input[type="date"]:focus, .apus-contact-form-2 .wpcf7-form input[type="month"]:focus, .apus-contact-form-2 .wpcf7-form input[type="week"]:focus, .apus-contact-form-2 .wpcf7-form input[type="time"]:focus, .apus-contact-form-2 .wpcf7-form input[type="datetime"]:focus, .apus-contact-form-2 .wpcf7-form input[type="datetime-local"]:focus, .apus-contact-form-2 .wpcf7-form input[type="color"]:focus, .apus-contact-form-2 .wpcf7-form textarea:focus,
				.apus-contact-form-2 .wpcf7-form input[type="text"]:focus-within, .apus-contact-form-2 .wpcf7-form input[type="email"]:focus-within, .apus-contact-form-2 .wpcf7-form input[type="url"]:focus-within, .apus-contact-form-2 .wpcf7-form input[type="password"]:focus-within, .apus-contact-form-2 .wpcf7-form input[type="search"]:focus-within, .apus-contact-form-2 .wpcf7-form input[type="number"]:focus-within, .apus-contact-form-2 .wpcf7-form input[type="tel"]:focus-within, .apus-contact-form-2 .wpcf7-form input[type="range"]:focus-within, .apus-contact-form-2 .wpcf7-form input[type="date"]:focus-within, .apus-contact-form-2 .wpcf7-form input[type="month"]:focus-within, .apus-contact-form-2 .wpcf7-form input[type="week"]:focus-within, .apus-contact-form-2 .wpcf7-form input[type="time"]:focus-within, .apus-contact-form-2 .wpcf7-form input[type="datetime"]:focus-within, .apus-contact-form-2 .wpcf7-form input[type="datetime-local"]:focus-within, .apus-contact-form-2 .wpcf7-form input[type="color"]:focus-within, .apus-contact-form-2 .wpcf7-form textarea:focus-within,
				.contact-sidebar-wrapper form input[type="text"]:hover, .contact-sidebar-wrapper form input[type="email"]:hover, .contact-sidebar-wrapper form input[type="url"]:hover, .contact-sidebar-wrapper form input[type="password"]:hover, .contact-sidebar-wrapper form input[type="search"]:hover, .contact-sidebar-wrapper form input[type="number"]:hover, .contact-sidebar-wrapper form input[type="tel"]:hover, .contact-sidebar-wrapper form input[type="range"]:hover, .contact-sidebar-wrapper form input[type="date"]:hover, .contact-sidebar-wrapper form input[type="month"]:hover, .contact-sidebar-wrapper form input[type="week"]:hover, .contact-sidebar-wrapper form input[type="time"]:hover, .contact-sidebar-wrapper form input[type="datetime"]:hover, .contact-sidebar-wrapper form input[type="datetime-local"]:hover, .contact-sidebar-wrapper form input[type="color"]:hover, .contact-sidebar-wrapper form textarea:hover,
				.contact-sidebar-wrapper form input[type="text"]:focus, .contact-sidebar-wrapper form input[type="email"]:focus, .contact-sidebar-wrapper form input[type="url"]:focus, .contact-sidebar-wrapper form input[type="password"]:focus, .contact-sidebar-wrapper form input[type="search"]:focus, .contact-sidebar-wrapper form input[type="number"]:focus, .contact-sidebar-wrapper form input[type="tel"]:focus, .contact-sidebar-wrapper form input[type="range"]:focus, .contact-sidebar-wrapper form input[type="date"]:focus, .contact-sidebar-wrapper form input[type="month"]:focus, .contact-sidebar-wrapper form input[type="week"]:focus, .contact-sidebar-wrapper form input[type="time"]:focus, .contact-sidebar-wrapper form input[type="datetime"]:focus, .contact-sidebar-wrapper form input[type="datetime-local"]:focus, .contact-sidebar-wrapper form input[type="color"]:focus, .contact-sidebar-wrapper form textarea:focus,
				.contact-sidebar-wrapper form input[type="text"]:active, .contact-sidebar-wrapper form input[type="email"]:active, .contact-sidebar-wrapper form input[type="url"]:active, .contact-sidebar-wrapper form input[type="password"]:active, .contact-sidebar-wrapper form input[type="search"]:active, .contact-sidebar-wrapper form input[type="number"]:active, .contact-sidebar-wrapper form input[type="tel"]:active, .contact-sidebar-wrapper form input[type="range"]:active, .contact-sidebar-wrapper form input[type="date"]:active, .contact-sidebar-wrapper form input[type="month"]:active, .contact-sidebar-wrapper form input[type="week"]:active, .contact-sidebar-wrapper form input[type="time"]:active, .contact-sidebar-wrapper form input[type="datetime"]:active, .contact-sidebar-wrapper form input[type="datetime-local"]:active, .contact-sidebar-wrapper form input[type="color"]:active, .contact-sidebar-wrapper form textarea:active,
				input[type="text"]:focus, input[type="email"]:focus, input[type="url"]:focus, input[type="password"]:focus, input[type="search"]:focus, input[type="number"]:focus, input[type="tel"]:focus, input[type="range"]:focus, input[type="date"]:focus, input[type="month"]:focus, input[type="week"]:focus, input[type="time"]:focus, input[type="datetime"]:focus, input[type="datetime-local"]:focus, input[type="color"]:focus, textarea:focus,
				input[type="text"]:hover, input[type="email"]:hover, input[type="url"]:hover, input[type="password"]:hover, input[type="search"]:hover, input[type="number"]:hover, input[type="tel"]:hover, input[type="range"]:hover, input[type="date"]:hover, input[type="month"]:hover, input[type="week"]:hover, input[type="time"]:hover, input[type="datetime"]:hover, input[type="datetime-local"]:hover, input[type="color"]:hover, textarea:hover,
				input[type="text"]:active, input[type="email"]:active, input[type="url"]:active, input[type="password"]:active, input[type="search"]:active, input[type="number"]:active, input[type="tel"]:active, input[type="range"]:active, input[type="date"]:active, input[type="month"]:active, input[type="week"]:active, input[type="time"]:active, input[type="datetime"]:active, input[type="datetime-local"]:active, input[type="color"]:active, textarea:active,
				input[type="text"]:focus-within, input[type="email"]:focus-within, input[type="url"]:focus-within, input[type="password"]:focus-within, input[type="search"]:focus-within, input[type="number"]:focus-within, input[type="tel"]:focus-within, input[type="range"]:focus-within, input[type="date"]:focus-within, input[type="month"]:focus-within, input[type="week"]:focus-within, input[type="time"]:focus-within, input[type="datetime"]:focus-within, input[type="datetime-local"]:focus-within, input[type="color"]:focus-within, textarea:focus-within
				{
					border-color: <?php echo esc_html( intoria_get_config('main_color') ) ?> !important;
				}

			<?php endif; ?>

			<?php if ( intoria_get_config('button_color') != "" ) : ?>
				/* seting background main */
				.btn-theme
				{
					background-color: <?php echo esc_html( intoria_get_config('button_color') ) ?> ;
					border-color: <?php echo esc_html( intoria_get_config('button_color') ) ?> ;
				}			
			<?php endif; ?>
			<?php if ( intoria_get_config('button_hover_color') != "" ) : ?>
				/* seting background main */
				.btn-theme.btn-outline:focus{
					border-color: <?php echo esc_html( intoria_get_config('button_hover_color') ) ?> ;
					background-color: <?php echo esc_html( intoria_get_config('button_hover_color') ) ?> ;
				}
			<?php endif; ?>
	<?php
		$content = ob_get_clean();
		$content = str_replace(array("\r\n", "\r"), "\n", $content);
		$lines = explode("\n", $content);
		$new_lines = array();
		foreach ($lines as $i => $line) {
			if (!empty($line)) {
				$new_lines[] = trim($line);
			}
		}		
		return implode($new_lines);
	}
}