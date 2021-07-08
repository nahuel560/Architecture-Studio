<?php

if ( ! function_exists( 'intoria_body_classes' ) ) {
	function intoria_body_classes( $classes ) {
		global $post;
		$show_footer_mobile = intoria_get_config('show_footer_mobile', true);

		if ( is_page() && is_object($post) ) {
			$class = get_post_meta( $post->ID, 'apus_page_extra_class', true );
			if ( !empty($class) ) {
				$classes[] = trim($class);
			}
			if ( get_post_meta( $post->ID, 'apus_page_header_transparent',true) && get_post_meta( $post->ID, 'apus_page_header_transparent',true) == 'yes' ) {
				$classes[] = 'header_transparent';
			}
		} elseif ( is_singular('post') ) {
			$version = intoria_get_config('blog_single_version', '');
			if ( $version == 'v1' ) {
				$classes[] = 'header_transparent';
			}
		} elseif ( is_singular('apartment') ) {
			$classes[] = 'header_transparent';
		}

		if ( is_singular('post') || is_category() || is_home() || is_search() ) {
			$show = intoria_get_config('show_blog_breadcrumbs', false);
			if ( $show && !is_front_page() ) {
				$classes[] = 'header_transparent';
			}
		} elseif ( is_post_type_archive('apartment') ) {
			$show = intoria_get_config('apartments_breadcrumbs', false);
			if ( $show ) {
				$classes[] = 'header_transparent';
			}
			$apartments_style = intoria_get_config('apartments_style', '');
			if ( $apartments_style ) {
				$classes[] = 'apartment-'. $apartments_style;
			}
		} elseif( is_404() ) {
			$classes[] = 'header_transparent';
		}

		if ( intoria_get_config('preload', true) ) {
			$classes[] = 'apus-body-loading';
		}
		if ( intoria_get_config('image_lazy_loading') ) {
			$classes[] = 'image-lazy-loading';
		}
		if ( $show_footer_mobile ) {
			$classes[] = 'body-footer-mobile';
		}

		if ( intoria_get_config('keep_header') ) {
			$classes[] = 'has-header-sticky';
		}
		
		return $classes;
	}
	add_filter( 'body_class', 'intoria_body_classes' );
}

if ( ! function_exists( 'intoria_get_shortcode_regex' ) ) {
	function intoria_get_shortcode_regex( $tagregexp = '' ) {
		// WARNING! Do not change this regex without changing do_shortcode_tag() and strip_shortcode_tag()
		// Also, see shortcode_unautop() and shortcode.js.
		return
			'\\['                                // Opening bracket
			. '(\\[?)'                           // 1: Optional second opening bracket for escaping shortcodes: [[tag]]
			. "($tagregexp)"                     // 2: Shortcode name
			. '(?![\\w-])'                       // Not followed by word character or hyphen
			. '('                                // 3: Unroll the loop: Inside the opening shortcode tag
			. '[^\\]\\/]*'                   // Not a closing bracket or forward slash
			. '(?:'
			. '\\/(?!\\])'               // A forward slash not followed by a closing bracket
			. '[^\\]\\/]*'               // Not a closing bracket or forward slash
			. ')*?'
			. ')'
			. '(?:'
			. '(\\/)'                        // 4: Self closing tag ...
			. '\\]'                          // ... and closing bracket
			. '|'
			. '\\]'                          // Closing bracket
			. '(?:'
			. '('                        // 5: Unroll the loop: Optionally, anything between the opening and closing shortcode tags
			. '[^\\[]*+'             // Not an opening bracket
			. '(?:'
			. '\\[(?!\\/\\2\\])' // An opening bracket not followed by the closing shortcode tag
			. '[^\\[]*+'         // Not an opening bracket
			. ')*+'
			. ')'
			. '\\[\\/\\2\\]'             // Closing shortcode tag
			. ')?'
			. ')'
			. '(\\]?)';                          // 6: Optional second closing brocket for escaping shortcodes: [[tag]]
	}
}

if ( ! function_exists( 'intoria_tagregexp' ) ) {
	function intoria_tagregexp() {
		return apply_filters( 'intoria_custom_tagregexp', 'video|audio|playlist|video-playlist|embed|intoria_media' );
	}
}

if ( !function_exists('intoria_get_header_layouts') ) {
	function intoria_get_header_layouts() {
		$headers = array();
		$args = array(
			'posts_per_page'   => -1,
			'offset'           => 0,
			'orderby'          => 'date',
			'order'            => 'DESC',
			'post_type'        => 'apus_header',
			'post_status'      => 'publish',
			'suppress_filters' => true 
		);
		$posts = get_posts( $args );
		foreach ( $posts as $post ) {
			$headers[$post->post_name] = $post->post_title;
		}
		return $headers;
	}
}

if ( !function_exists('intoria_get_header_layout') ) {
	function intoria_get_header_layout() {
		global $post;
		if ( is_page() && is_object($post) && isset($post->ID) ) {
			global $post;
			$header = get_post_meta( $post->ID, 'apus_page_header_type', true );
			if ( empty($header) || $header == 'global' ) {
				return intoria_get_config('header_type');
			}
			return $header;
		}
		return intoria_get_config('header_type');
	}
	add_filter( 'intoria_get_header_layout', 'intoria_get_header_layout' );
}

function intoria_display_header_builder($header_slug) {
	$args = array(
		'name'        => $header_slug,
		'post_type'   => 'apus_header',
		'post_status' => 'publish',
		'numberposts' => 1
	);
	$posts = get_posts($args);
	foreach ( $posts as $post ) {
		$classes = array('apus-header hidden-xs hidden-md hidden-sm');
		$classes[] = $post->post_name.'-'.$post->ID;

		echo '<div id="apus-header" class="'.esc_attr(implode(' ', $classes)).'">';
		if ( intoria_get_config('keep_header') ) {
			echo '<div class="main-sticky-header-wrapper">';
	        echo '<div class="main-sticky-header">';
	    }
			echo apply_filters( 'intoria_generate_post_builder', do_shortcode( $post->post_content ), $post, $post->ID);
		if ( intoria_get_config('keep_header') ) {
			echo '</div>';
	        echo '</div>';
	    }
	    get_template_part('template-parts/searchform');
		echo '</div>';
	}
}

if ( !function_exists('intoria_get_footer_layouts') ) {
	function intoria_get_footer_layouts() {
		$footers = array();
		$args = array(
			'posts_per_page'   => -1,
			'offset'           => 0,
			'orderby'          => 'date',
			'order'            => 'DESC',
			'post_type'        => 'apus_footer',
			'post_status'      => 'publish',
			'suppress_filters' => true 
		);
		$posts = get_posts( $args );
		foreach ( $posts as $post ) {
			$footers[$post->post_name] = $post->post_title;
		}
		return $footers;
	}
}

if ( !function_exists('intoria_get_footer_layout') ) {
	function intoria_get_footer_layout() {
		if ( is_page() ) {
			global $post;
			$footer = '';
			if ( is_object($post) && isset($post->ID) ) {
				$footer = get_post_meta( $post->ID, 'apus_page_footer_type', true );
				if ( empty($footer) || $footer == 'global' ) {
					return intoria_get_config('footer_type', '');
				}
			}
			return $footer;
		}
		return intoria_get_config('footer_type', '');
	}
	add_filter('intoria_get_footer_layout', 'intoria_get_footer_layout');
}

function intoria_display_footer_builder($footer_slug) {
	$args = array(
		'name'        => $footer_slug,
		'post_type'   => 'apus_footer',
		'post_status' => 'publish',
		'numberposts' => 1
	);
	$posts = get_posts($args);
	foreach ( $posts as $post ) {
		$classes = array('apus-footer footer-builder-wrapper');
		$classes[] = $post->post_name;
		
		echo '<div id="apus-footer" class="'.esc_attr(implode(' ', $classes)).'">';
		echo '<div class="apus-footer-inner">';
		echo apply_filters( 'intoria_generate_post_builder', do_shortcode( $post->post_content ), $post, $post->ID);
		echo '</div>';
		echo '</div>';
	}
}

if ( !function_exists('intoria_blog_content_class') ) {
	function intoria_blog_content_class( $class ) {
		$page = 'archive';
		if ( is_singular( 'post' ) ) {
            $page = 'single';
        }
		if ( intoria_get_config('blog_'.$page.'_fullwidth') ) {
			return 'container-fluid';
		}
		return $class;
	}
}
add_filter( 'intoria_blog_content_class', 'intoria_blog_content_class', 1 , 1  );


if ( !function_exists('intoria_get_blog_layout_configs') ) {
	function intoria_get_blog_layout_configs() {
		$page = 'archive';
		if ( is_singular( 'post' ) ) {
            $page = 'single';
        }
		$left = intoria_get_config('blog_'.$page.'_left_sidebar');
		$right = intoria_get_config('blog_'.$page.'_right_sidebar');

		switch ( intoria_get_config('blog_'.$page.'_layout') ) {
		 	case 'left-main':
			 	if ( is_active_sidebar( $left ) ) {
			 		$configs['left'] = array( 'sidebar' => $left, 'class' => 'col-md-4 col-sm-12 col-xs-12'  );
			 		$configs['main'] = array( 'class' => 'col-md-8 col-sm-12 col-xs-12 pull-right' );
			 	}
		 		break;
		 	case 'main-right':
		 		if ( is_active_sidebar( $right ) ) {
			 		$configs['right'] = array( 'sidebar' => $right,  'class' => 'col-md-4 col-sm-12 col-xs-12 pull-right' ); 
			 		$configs['main'] = array( 'class' => 'col-md-8 col-sm-12 col-xs-12' );
			 	}
		 		break;
	 		case 'main':
	 			$configs['main'] = array( 'class' => 'col-md-12 col-sm-12 col-xs-12' );
	 			break;
		 	default:
		 		if ( is_active_sidebar( 'sidebar-default' ) ) {
			 		$configs['right'] = array( 'sidebar' => 'sidebar-default',  'class' => 'col-md-4 col-xs-12' ); 
			 		$configs['main'] = array( 'class' => 'col-md-8 col-xs-12' );
			 	} else {
			 		$configs['main'] = array( 'class' => 'col-md-12 col-sm-12 col-xs-12' );
			 	}
		 		break;
		}
		if ( empty($configs) ) {
			if ( is_active_sidebar( 'sidebar-default' ) ) {
		 		$configs['right'] = array( 'sidebar' => 'sidebar-default',  'class' => 'col-md-4 col-xs-12' ); 
		 		$configs['main'] = array( 'class' => 'col-md-8 col-xs-12' );
		 	} else {
		 		$configs['main'] = array( 'class' => 'col-md-12 col-sm-12 col-xs-12' );
		 	}
		}
		return $configs; 
	}
}

if ( !function_exists('intoria_page_content_class') ) {
	function intoria_page_content_class( $class ) {
		global $post;
		if (is_object($post)) {
			$fullwidth = get_post_meta( $post->ID, 'apus_page_fullwidth', true );
			if ( !$fullwidth || $fullwidth == 'no' ) {
				return $class;
			}
		}
		return 'container-fluid';
	}
}
add_filter( 'intoria_page_content_class', 'intoria_page_content_class', 1 , 1  );

if ( !function_exists('intoria_get_page_layout_configs') ) {
	function intoria_get_page_layout_configs() {
		global $post;
		if ( is_object($post) ) {
			$left = get_post_meta( $post->ID, 'apus_page_left_sidebar', true );
			$right = get_post_meta( $post->ID, 'apus_page_right_sidebar', true );

			switch ( get_post_meta( $post->ID, 'apus_page_layout', true ) ) {
			 	case 'left-main':
			 		if ( is_active_sidebar( $left ) ) {
				 		$configs['left'] = array( 'sidebar' => $left, 'class' => 'col-md-4 col-sm-12 col-xs-12'  );
				 		$configs['main'] = array( 'class' => 'col-md-8 col-sm-12 col-xs-12' );
				 	}
			 		break;
			 	case 'main-right':
			 		if ( is_active_sidebar( $right ) ) {
				 		$configs['right'] = array( 'sidebar' => $right,  'class' => 'col-md-4 col-sm-12 col-xs-12' ); 
				 		$configs['main'] = array( 'class' => 'col-md-8 col-sm-12 col-xs-12' );
				 	}
			 		break;
		 		case 'main':
		 			$configs['main'] = array( 'class' => 'col-xs-12 clearfix' );
		 			break;
			 	default:
			 		if ( is_active_sidebar( 'sidebar-default' ) ) {
				 		$configs['right'] = array( 'sidebar' => 'sidebar-default',  'class' => 'col-md-4 col-sm-12 col-xs-12' ); 
				 		$configs['main'] = array( 'class' => 'col-md-8 col-sm-12 col-xs-12' );
				 	} else {
				 		$configs['main'] = array( 'class' => 'col-xs-12 clearfix' );
				 	}
			 		break;
			}

			if ( empty($configs) ) {
				if ( is_active_sidebar( 'sidebar-default' ) ) {
			 		$configs['right'] = array( 'sidebar' => 'sidebar-default',  'class' => 'col-md-4 col-sm-12 col-xs-12' ); 
			 		$configs['main'] = array( 'class' => 'col-md-8 col-sm-12 col-xs-12' );
			 	} else {
			 		$configs['main'] = array( 'class' => 'col-xs-12 clearfix' );
			 	}
			}
		} else {
			$configs['main'] = array( 'class' => 'col-xs-12' );
		}
		return $configs; 
	}
}


if ( ! function_exists( 'intoria_get_first_url_from_string' ) ) {
	function intoria_get_first_url_from_string( $string ) {
		$pattern = "/^\b(?:(?:https?|ftp):\/\/)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i";
		preg_match( $pattern, $string, $link );

		$link_return = ( ! empty( $link[0] ) ) ? $link[0] : false;
		$content = str_replace($link_return, "", $string);
        $content = apply_filters( 'the_content', $content);
        return array( 'link' => $link_return, 'content' => $content );
	}
}

if ( !function_exists( 'intoria_get_link_attributes' ) ) {
	function intoria_get_link_attributes( $string ) {
		preg_match( '/<a href="(.*?)">/i', $string, $atts );

		return ( ! empty( $atts[1] ) ) ? $atts[1] : '';
	}
}

if ( !function_exists( 'intoria_post_media' ) ) {
	function intoria_post_media( $content ) {
		$is_video = ( get_post_format() == 'video' ) ? true : false;
		$media = intoria_get_first_url_from_string( $content );
		$media = $media['link'];
		if ( ! empty( $media ) ) {
			global $wp_embed;
			$content = do_shortcode( $wp_embed->run_shortcode( '[embed]' . $media . '[/embed]' ) );
		} else {
			$pattern = intoria_get_shortcode_regex( intoria_tagregexp() );
			preg_match( '/' . $pattern . '/s', $content, $media );
			if ( ! empty( $media[2] ) ) {
				if ( $media[2] == 'embed' ) {
					global $wp_embed;
					$content = do_shortcode( $wp_embed->run_shortcode( $media[0] ) );
				} else {
					$content = do_shortcode( $media[0] );
				}
			}
		}
		if ( ! empty( $media ) ) {
			$output = '<div class="entry-media">';
			$output .= ( $is_video ) ? '<div class="pro-fluid"><div class="pro-fluid-inner">' : '';
			$output .= $content;
			$output .= ( $is_video ) ? '</div></div>' : '';
			$output .= '</div>';

			return $output;
		}

		return false;
	}
}

if ( !function_exists( 'intoria_post_gallery' ) ) {
	function intoria_post_gallery( $content, $args = array() ) {
		$output = '';
		$defaults = array( 'size' => 'large' );
		$args = wp_parse_args( $args, $defaults );
	    $gallery_filter = intoria_gallery_from_content( $content );
	    if (count($gallery_filter['ids']) > 0) {
        	$output .= '<div class="slick-carousel" data-carousel="slick" data-items="1" data-smallmedium="1" data-extrasmall="1" data-pagination="false" data-nav="true">';
                foreach($gallery_filter['ids'] as $attach_id) {
                    $output .= '<div class="gallery-item">';
                    $output .= wp_get_attachment_image($attach_id, $args['size'] );
                    $output .= '</div>';
                }
            $output .= '</div>';
        }
        return $output;
	}
}

if (!function_exists('intoria_gallery_from_content')) {
    function intoria_gallery_from_content($content) {

        $result = array(
            'ids' => array(),
            'filtered_content' => ''
        );

        preg_match('/\[gallery.*ids=.(.*).\]/', $content, $ids);
        if(!empty($ids)) {
            $result['ids'] = explode(",", $ids[1]);
            $content =  str_replace($ids[0], "", $content);
            $result['filtered_content'] = apply_filters( 'the_content', $content);
        }

        return $result;

    }
}

if ( !function_exists( 'intoria_random_key' ) ) {
    function intoria_random_key($length = 5) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $return = '';
        for ($i = 0; $i < $length; $i++) {
            $return .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $return;
    }
}

if ( !function_exists('intoria_substring') ) {
    function intoria_substring($string, $limit, $afterlimit = '[...]') {
        if ( empty($string) ) {
        	return $string;
        }
       	$string = explode(' ', strip_tags( $string ), $limit);

        if (count($string) >= $limit) {
            array_pop($string);
            $string = implode(" ", $string) .' '. $afterlimit;
        } else {
            $string = implode(" ", $string);
        }
        $string = preg_replace('`[[^]]*]`','',$string);
        return strip_shortcodes( $string );
    }
}

function intoria_is_apus_framework_activated() {
	return defined('APUS_FRAMEWORK_VERSION') ? true : false;
}

function intoria_is_cmb2_activated() {
	return defined('CMB2_LOADED') ? true : false;
}

function intoria_is_woocommerce_activated() {
	return class_exists( 'woocommerce' ) ? true : false;
}

function intoria_is_revslider_activated() {
	return class_exists( 'RevSlider' ) ? true : false;
}

function intoria_is_mailchimp_activated() {
	return class_exists( 'MC4WP_Form_Manager' ) ? true : false;
}

function intoria_is_apus_intoria_activated() {
	return class_exists( 'Apus_Intoria' ) ? true : false;
}


function intoria_kses_allowed_html($tags, $context) {
	switch($context) {
	    case 'intoria-html': 
	      	$tags = array(
	      		'article'    => array(
	      			'id'     => true,
					'class'     => true,
					'align'    => true,
					'dir'      => true,
					'lang'     => true,
					'xml:lang' => true,
				),
				'aside'      => array(
					'id'     => true,
					'class'     => true,
					'align'    => true,
					'dir'      => true,
					'lang'     => true,
					'xml:lang' => true,
				),
				'audio'      => array(
					'id'     => true,
					'class'     => true,
					'autoplay' => true,
					'controls' => true,
					'loop'     => true,
					'muted'    => true,
					'preload'  => true,
					'src'      => true,
				),
		        'a'          => array(
					'id'     => true,
					'class'     => true,
					'href'     => true,
					'rel'      => true,
					'target'   => true,
				),
		        'b' => array(
		        	'class' => true,
		        ),
		        'br'         => array(),
		        'div'        => array(
					'class'    => true,
					'id'    => true,
				),
				'h1'         => array(
					'id'    => true,
					'class' => true,
				),
				'h2'         => array(
					'id'    => true,
					'class' => true,
				),
				'h3'         => array(
					'id'    => true,
					'class' => true,
				),
				'h4'         => array(
					'id'    => true,
					'class' => true,
				),
				'h5'         => array(
					'id'    => true,
					'class' => true,
				),
				'h6'         => array(
					'id'    => true,
					'class' => true,
				),
				'hr'         => array(
					'align'   => true,
					'noshade' => true,
					'size'    => true,
					'width'   => true,
					'class'   => true,
				),
				'i'          => array(
					'class' => true,
				),
				'img'        => array(
					'alt'      => true,
					'align'    => true,
					'border'   => true,
					'height'   => true,
					'hspace'   => true,
					'longdesc' => true,
					'vspace'   => true,
					'src'      => true,
					'usemap'   => true,
					'width'    => true,
					'class'   => true,
					'srcset'   => true,
					'sizes'   => true,
					'data-src'   => true,
					'data-srcset'   => true,
					'data-sizes'   => true,
				),
				'label'      => array(
					'for' => true,
					'class'   => true,
				),
				'li'         => array(
					'align' => true,
					'value' => true,
					'class'   => true,
				),
				'p'          => array(
					'align'    => true,
					'dir'      => true,
					'lang'     => true,
					'xml:lang' => true,
					'class'   => true,
				),
				'span'       => array(
					'dir'      => true,
					'align'    => true,
					'lang'     => true,
					'xml:lang' => true,
					'class'   => true,
				),
				'small'      => array(
					'class' => true,
				),
				'strong'     => array(
					'class' => true,
				),
				'ul'         => array(
					'type' => true,
					'class'   => true,
				),
				'ol'         => array(
					'start'    => true,
					'type'     => true,
					'reversed' => true,
					'class'   => true,
				),
				'del'        => array(
					'datetime' => true,
					'class'   => true,
				),
				'fieldset'   => array(),
				'figure'     => array(
					'align'    => true,
					'dir'      => true,
					'lang'     => true,
					'xml:lang' => true,
				),
	      	);
	      	return $tags;
	    default: 
	      	return $tags;
	}
}
add_filter( 'wp_kses_allowed_html', 'intoria_kses_allowed_html', 10, 2);