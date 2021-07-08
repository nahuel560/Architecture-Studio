<?php

if ( ! function_exists( 'intoria_category' ) ) {
	function intoria_category( $post ) {
		// format
		$post_format = get_post_format();
		$header_class = $post_format ? '' : 'border-left';
		echo '<span class="category "> ';
		$cat = wp_get_post_categories( $post->ID );
		$k   = count( $cat );
		foreach ( $cat as $c ) {
			$categories = get_category( $c );
			$k -= 1;
			if ( $k == 0 ) {
				echo '<a href="' . get_category_link( $categories->term_id ) . '" class="categories-name">' . $categories->name . '</a>';
			} else {
				echo '<a href="' . get_category_link( $categories->term_id ) . '" class="categories-name">' . $categories->name . '</a>';
			}
		}
		echo '</span>';
	}
}

if ( ! function_exists( 'intoria_center_meta' ) ) {
	function intoria_center_meta( $post ) {
		// format
		$post_format = get_post_format();
		$id = get_the_author_meta( 'ID' );
		echo '<div class="entry-meta">';
		if(!is_single()){
			the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );
		} else {
			the_title( '<h4 class="entry-title">', '</h4>' );
		}
			echo "<div class='entry-create'>";
			echo "<span class='entry-date'>". get_the_date( 'M jS, Y' ).'</span>';
			echo "<span class='author'>".esc_html__( ' / By: ', 'intoria' ).'<a href='.esc_url(get_author_posts_url( $id )).'>'.get_the_author().'</a>' .'</span>';
			echo '</div>';
		echo '</div>';
	}
}



if ( ! function_exists( 'intoria_full_top_meta' ) ) {
	function intoria_full_top_meta( $post ) {
		// format
		$post_format = get_post_format();
		$header_class = $post_format ? '' : 'border-left';
		echo '<header class="entry-create ' . $header_class . '">';
		if(!is_single()){
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}
		// details
		$id = get_the_author_meta( 'ID' );
		echo '<span class="entry-date">' . esc_html( get_the_date( 'M jS, Y' ) ) . '</span><span class="entry-profile">			
			<span class="entry-author-link">
				' . esc_html__( 'by:', 'intoria' ) . '
				<span class="author vcard">
				<a class="url fn n" href="' . esc_url(get_author_posts_url( $id )) . '" rel="author">' . get_the_author() . '</a>
				</span>
			</span>
			
		</span>';
		// comments
		echo '<span class="entry-categories">in: ';
		$cat = wp_get_post_categories( $post->ID );
		$k   = count( $cat );
		foreach ( $cat as $c ) {
			$categories = get_category( $c );
			$k -= 1;
			if ( $k == 0 ) {
				echo '<a href="' . get_category_link( $categories->term_id ) . '" class="categories-name">' . $categories->name . '</a>';
			} else {
				echo '<a href="' . get_category_link( $categories->term_id ) . '" class="categories-name">' . $categories->name . ', </a>';
			}
		}
		echo '</span>';

		if ( ! is_search() ) {
			if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
				echo '<span class="entry-comments-link">';
				comments_popup_link( esc_html__( '0 comments', 'intoria' ), esc_html__( '1 comment' , 'intoria' ), esc_html__( '% comments', 'intoria' ) );
				echo '</span>';
			}
		}
		echo '</header>';
	}
}

if ( ! function_exists( 'intoria_post_tags' ) ) {
	function intoria_post_tags() {
		$posttags = get_the_tags();
		if ( $posttags ) {
			echo '<span class="entry-tags-list"><strong>'.esc_html__( 'Tags: ' , 'intoria' ).'</strong> ';
			$i = 1;
			$size = count( $posttags );
			foreach ( $posttags as $tag ) {
				echo '<a href="' . get_tag_link( $tag->term_id ) . '">';
				echo esc_attr($tag->name);
				echo '</a>';
				$i ++;
			}
			echo '</span>';
		}
	}
}

if ( ! function_exists( 'intoria_post_format_link_helper' ) ) {
	function intoria_post_format_link_helper( $content = null, $title = null, $post = null ) {
		if ( ! $content ) {
			$post = get_post( $post );
			$title = $post->post_title;
			$content = $post->post_content;
		}
		$link = intoria_get_first_url_from_string( $content );
		if ( ! empty( $link ) ) {
			$title = '<a href="' . esc_url( $link ) . '" rel="bookmark">' . $title . '</a>';
			$content = str_replace( $link, '', $content );
		} else {
			$pattern = '/^\<a[^>](.*?)>(.*?)<\/a>/i';
			preg_match( $pattern, $content, $link );
			if ( ! empty( $link[0] ) && ! empty( $link[2] ) ) {
				$title = $link[0];
				$content = str_replace( $link[0], '', $content );
			} elseif ( ! empty( $link[0] ) && ! empty( $link[1] ) ) {
				$atts = shortcode_parse_atts( $link[1] );
				$target = ( ! empty( $atts['target'] ) ) ? $atts['target'] : '_self';
				$title = ( ! empty( $atts['title'] ) ) ? $atts['title'] : $title;
				$title = '<a href="' . esc_url( $atts['href'] ) . '" rel="bookmark" target="' . $target . '">' . $title . '</a>';
				$content = str_replace( $link[0], '', $content );
			} else {
				$title = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $title . '</a>';
			}
		}
		$out['title'] = '<h2 class="entry-title">' . $title . '</h2>';
		$out['content'] = $content;

		return $out;
	}
}

if ( !function_exists('intoria_get_page_title') ) {
	function intoria_get_page_title() {
		$title = '';
		if ( !is_front_page() || is_paged() ) {
			global $post;
			$homeLink = esc_url( home_url() );

			if ( is_home() ) {
				$title = esc_html__( 'The Blogs', 'intoria' );
			} elseif (is_category()) {
				$title = esc_html__( 'The Blogs', 'intoria' );
			} elseif (is_day()) {
				$title = get_the_time('d');
			} elseif (is_month()) {
				$title = get_the_time('F');
			} elseif (is_year()) {
				$title = get_the_time('Y');
			} elseif (is_single() && !is_attachment()) {
				if ( get_post_type() != 'post' ) {
					if ( get_post_type() == 'give_forms' ) {
						$title = esc_html__( 'Cause Detail', 'intoria' );
					}  else {
						$title = get_the_title();
					}
				} else {
					$title = esc_html__( 'Blog', 'intoria' );
				}
			} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() && !is_author() && !is_search() ) {
				$post_type = get_post_type_object(get_post_type());
				if ( get_post_type() == 'give_forms' ) {
					$title = esc_html__( 'Causes', 'intoria' );
				} elseif ( get_post_type() == 'simple_event' ) {
					$title = esc_html__( 'Events', 'intoria' );
				} elseif (is_object($post_type)) {
					$title = $post_type->labels->singular_name;
				}
			} elseif (is_404()) {
				$title = esc_html__('Page not found', 'intoria');
			} elseif (is_attachment()) {
				$title = get_the_title();
			} elseif ( is_page() && !$post->post_parent ) {
				$title = get_the_title();
			} elseif ( is_page() && $post->post_parent ) {
				$title = get_the_title();
			} elseif ( is_search() ) {
				$title = sprintf(esc_html__('Search results for "%s"','intoria'), get_search_query() );
			} elseif ( is_tag() ) {
				$title = sprintf(esc_html__('Posts tagged "%s"', 'intoria'), single_tag_title('', false));
			} elseif ( is_author() ) {
				global $author;
				$userdata = get_userdata($author);
				$title = $userdata->display_name;
			} 
		}else{
			$title = get_the_title();
		}
		return $title;
	}
}

if ( ! function_exists( 'intoria_breadcrumbs' ) ) {
	function intoria_breadcrumbs() {

		$delimiter = ' ';
		$home = esc_html__('Home', 'intoria');
		$before = '<li><span class="active">';
		$after = '</span></li>';
		if ( !is_front_page() || is_paged()) {
			global $post;
			$homeLink = esc_url( home_url() );
			
			echo '<div class="breadscrumb-inner">';
			echo '<ol class="breadcrumb">';

			echo '<li><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . '</li> ';

			if (is_category()) {
				global $wp_query;
				$cat_obj = $wp_query->get_queried_object();
				$thisCat = $cat_obj->term_id;
				$thisCat = get_category($thisCat);
				$parentCat = get_category($thisCat->parent);
				echo '<li>';
				if ($thisCat->parent != 0)
					echo get_category_parents($parentCat, TRUE, '</li><li>');
				echo '<span class="active">'.single_cat_title('', false) . $after;
			} elseif (is_day()) {
				echo '<li><a href="' . esc_url( get_year_link(get_the_time('Y')) ) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
				echo '<li><a href="' . esc_url( get_month_link(get_the_time('Y'),get_the_time('m')) ) . '">' . get_the_time('F') . '</a></li> ' . $delimiter . ' ';
				echo wp_kses($before, 'intoria-html') . get_the_time('d') . $after;
			} elseif (is_month()) {
				echo '<a href="' . esc_url( get_year_link(get_the_time('Y')) ) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
				echo wp_kses($before, 'intoria-html') . get_the_time('F') . $after;
			} elseif (is_year()) {
				echo wp_kses($before, 'intoria-html') . get_the_time('Y') . $after;
			} elseif (is_single() && !is_attachment()) {
				if ( get_post_type() != 'post' ) {
					$post_type = get_post_type_object(get_post_type());
					$slug = $post_type->rewrite;
					
					echo '<li><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></li> ' . $delimiter . ' ';
					
					echo wp_kses($before, 'intoria-html') . get_the_title() . $after;
				} else {
					$cat = get_the_category(); $cat = $cat[0];
					echo '<li>'.get_category_parents($cat, TRUE, '</li><li>');
					echo '<span class="active">'.get_the_title() . $after;
				}
			} elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404() && !is_author() && !is_search()) {
				$post_type = get_post_type_object(get_post_type());
				if (is_object($post_type)) {
					echo wp_kses($before, 'intoria-html') . $post_type->labels->singular_name . $after;
				}
			} elseif (is_404()) {
				echo wp_kses($before, 'intoria-html') .esc_html__('404', 'intoria') . $after;
			} elseif (is_attachment()) {
				$parent = get_post($post->post_parent);
				$cat = get_the_category($parent->ID);
				echo '<li>';
				if ( !empty($cat) ) {
					$cat = $cat[0];
					echo get_category_parents($cat, TRUE, '</li><li>');
				}
				if ( !empty($parent) ) {
					echo '<a href="' . esc_url( get_permalink($parent) ) . '">' . $parent->post_title . '</a></li><li>';
				}
				echo '<span class="active">'.get_the_title() . $after;
			} elseif ( is_page() && !$post->post_parent ) {
				echo wp_kses($before, 'intoria-html') . get_the_title() . $after;
			} elseif ( is_page() && $post->post_parent ) {
				$parent_id  = $post->post_parent;
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					$breadcrumbs[] = '<li><a href="' . esc_url( get_permalink($page->ID) ) . '">' . get_the_title($page->ID) . '</a></li>';
					$parent_id  = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				foreach ($breadcrumbs as $crumb) {
					echo wp_kses($crumb, 'intoria-html') . ' ' . $delimiter . ' ';
				}
				echo wp_kses($before, 'intoria-html') . get_the_title() . $after;
			} elseif ( is_search() ) {
				echo wp_kses($before, 'intoria-html') . sprintf(__('Search results for "%s"','intoria'), get_search_query()) . $after;
			} elseif ( is_tag() ) {
				echo wp_kses($before, 'intoria-html') . sprintf(__('Posts tagged "%s"', 'intoria'), single_tag_title('', false)) . $after;
			} elseif ( is_author() ) {
				global $author;
				$userdata = get_userdata($author);
				echo wp_kses($before, 'intoria-html') . esc_html__('Articles posted by ', 'intoria') . $userdata->display_name . $after;
			} elseif ( is_home() ) {
				echo wp_kses($before, 'intoria-html') . esc_html__('The Blogs', 'intoria') . $after;
			}

			echo '</ol>';
			echo '</div>';			
		}
	}
}

if ( ! function_exists( 'intoria_render_breadcrumbs' ) ) {
	function intoria_render_breadcrumbs() {
		global $post;
		$style = $classes = array();
		$full_width = 'container';
		if ( is_page() && is_object($post) ) {
			$show = get_post_meta( $post->ID, 'apus_page_show_breadcrumb', true );
			if ( $show == 'no' ) {
				return ''; 
			}
			$bgimage = get_post_meta( $post->ID, 'apus_page_breadcrumb_image', true );
			$bgcolor = get_post_meta( $post->ID, 'apus_page_breadcrumb_color', true );
			$style = array();
			if ( $bgcolor ) {
				$style[] = 'background-color:'.$bgcolor;
			}
			if ( $bgimage ) { 
				$style[] = 'background-image:url(\''.esc_url($bgimage).'\')';
				$classes[] = 'has_bg';
			}
			$full_width = apply_filters('intoria_page_content_class', 'container');
		} elseif ( is_singular('post') || is_category() || is_home() || is_search() ) {
			$show = intoria_get_config('show_blog_breadcrumbs', true);
			if ( !$show || is_front_page() ) {
				return ''; 
			}
			$breadcrumb_img = intoria_get_config('blog_breadcrumb_image');
	        $breadcrumb_color = intoria_get_config('blog_breadcrumb_color');
	        $style = array();
	        if ( $breadcrumb_color ) {
	            $style[] = 'background-color:'.$breadcrumb_color;
	        }
	        if ( isset($breadcrumb_img['url']) && !empty($breadcrumb_img['url']) ) {
	            $style[] = 'background-image:url(\''.esc_url($breadcrumb_img['url']).'\')';
	            $classes[] = 'has_bg';
	        }
	        $full_width = apply_filters('intoria_blog_content_class', 'container');
		} elseif ( is_post_type_archive('project') ) {
			$show = intoria_get_config('show_projects_breadcrumbs', true);
			if ( !$show ) {
				return ''; 
			}
			$breadcrumb_img = intoria_get_config('projects_breadcrumb_image');
	        $breadcrumb_color = intoria_get_config('projects_breadcrumb_color');
	        $style = array();
	        if ( $breadcrumb_color ) {
	            $style[] = 'background-color:'.$breadcrumb_color;
	        }
	        if ( isset($breadcrumb_img['url']) && !empty($breadcrumb_img['url']) ) {
	            $style[] = 'background-image:url(\''.esc_url($breadcrumb_img['url']).'\')';
	            $classes[] = 'has_bg';
	        }
	        $full_width = apply_filters('intoria_projects_content_class', 'container');
		} elseif ( is_404() ) {
			$show = intoria_get_config('show_404_breadcrumbs', true);
			if ( !$show ) {
				return ''; 
			}
			$breadcrumb_img = intoria_get_config('404_breadcrumb_image');
	        $breadcrumb_color = intoria_get_config('404_breadcrumb_color');
	        $style = array();
	        if ( $breadcrumb_color ) {
	            $style[] = 'background-color:'.$breadcrumb_color;
	        }
	        if ( isset($breadcrumb_img['url']) && !empty($breadcrumb_img['url']) ) {
	            $style[] = 'background-image:url(\''.esc_url($breadcrumb_img['url']).'\')';
	            $classes[] = 'has_bg';
	        }
	        $full_width = apply_filters('intoria_404_content_class', 'container');
		}

		$estyle = !empty($style)? ' style="'.implode(";", $style).'"':"";

		$title = intoria_get_page_title();

		echo '<section id="apus-breadscrumb" class="breadcrumb-page apus-breadscrumb '.implode(' ', $classes).'"'.$estyle.'><div class="'.$full_width.'"><div class="wrapper-breads"><div class="wrapper-breads-inner">';
			if ( $title ) {
				echo '<h1 class="bread-title">'.$title.'</h1>';
			}
			
			intoria_breadcrumbs();

		echo '</div></div></div></section>';
	}
}

if ( ! function_exists( 'intoria_paging_nav' ) ) {
	function intoria_paging_nav() {
		global $wp_query, $wp_rewrite;

		if ( $wp_query->max_num_pages < 2 ) {
			return;
		}

		$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$query_args   = array();
		$url_parts    = explode( '?', $pagenum_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

		$format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

		// Set up paginated links.
		$links = paginate_links( array(
			'base'     => $pagenum_link,
			'format'   => $format,
			'total'    => $wp_query->max_num_pages,
			'current'  => $paged,
			'mid_size' => 1,
			'add_args' => array_map( 'urlencode', $query_args ),
			'prev_text' => esc_html__( 'Prev', 'intoria' ),
			'next_text' => esc_html__( 'Next', 'intoria' ),
		) );

		if ( $links ) :

		?>
		<nav class="navigation paging-navigation" role="navigation">
			<h1 class="screen-reader-text hidden"><?php esc_html_e( 'Posts navigation', 'intoria' ); ?></h1>
			<div class="apus-pagination">
				<?php echo wp_kses($links, 'intoria-html'); ?>
			</div><!-- .pagination -->
		</nav><!-- .navigation -->
		<?php
		endif;
	}
}

if ( ! function_exists( 'intoria_post_nav' ) ) {
	function intoria_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}

		?>
		<nav class="navigation post-navigation" role="navigation">
			<h3 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'intoria' ); ?></h3>
			<div class="nav-links clearfix">
				<?php
				if ( is_attachment() ) :
					previous_post_link( '%link','<div class="col-lg-6"><span class="meta-nav">'. esc_html__('Published In', 'intoria').'</span></div>');
				else :
					previous_post_link( '%link','<div class="pull-left"><span class="meta-nav">'. esc_html__('Previous Post', 'intoria').'</span></div>' );
					next_post_link( '%link', '<div class="pull-right"><span class="meta-nav">' . esc_html__('Next Post', 'intoria').'</span><span></span></div>');
				endif;
				?>
			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}
}

if ( !function_exists('intoria_pagination') ) {
    function intoria_pagination($per_page, $total, $max_num_pages = '') {
    	global $wp_query, $wp_rewrite;
        ?>
        <div class="apus-pagination">
        	<?php
        	$prev = esc_html__('< Prev','intoria');
        	$next = esc_html__('Next >','intoria');
        	$pages = $max_num_pages;
        	$args = array('class'=>'');

        	$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
	        if ( empty($pages) ) {
	            global $wp_query;
	            $pages = $wp_query->max_num_pages;
	            if ( !$pages ) {
	                $pages = 1;
	            }
	        }
	        $pagination = array(
	            'base' => @add_query_arg('paged','%#%'),
	            'format' => '',
	            'total' => $pages,
	            'current' => $current,
	            'prev_text' => $prev,
	            'next_text' => $next,
	            'type' => 'array'
	        );

	        if( $wp_rewrite->using_permalinks() ) {
	            $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
	        }
	        
	        if ( isset($_GET['s']) ) {
	            $cq = $_GET['s'];
	            $sq = str_replace(" ", "+", $cq);
	        }
	        
	        if ( !empty($wp_query->query_vars['s']) ) {
	            $pagination['add_args'] = array( 's' => $sq);
	        }
	        $paginations = paginate_links( $pagination );
	        if ( !empty($paginations) ) {
	            echo '<ul class="pagination '.esc_attr( $args["class"] ).'">';
	                foreach ($paginations as $key => $pg) {
	                    echo '<li>'. $pg .'</li>';
	                }
	            echo '</ul>';
	        }
        	?>
            
        </div>
    <?php
    }
}

if ( !function_exists('intoria_comment_form') ) {
	function intoria_comment_form($arg, $class = 'btn-gradient-theme') {
		global $post;
		if ('open' == $post->comment_status) {
			ob_start();
	      	comment_form($arg);
	      	$form = ob_get_clean();
	      	?>
	      	<div class="commentform reset-button-default">
		    	<div class="clearfix">
			    	<?php
			      	echo str_replace('id="submit"','id="submit" class="btn '.$class.'"', $form);
			      	?>
		      	</div>
	      	</div>
	      	<?php
	      }
	}
}

if (!function_exists('intoria_list_comment') ) {
	function intoria_list_comment($comment, $args, $depth) {
		if ( is_file(get_template_directory().'/list-comments.php') ) {
	        require get_template_directory().'/list-comments.php';
      	}
	}
}

function intoria_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}
add_filter( 'comment_form_fields', 'intoria_comment_field_to_bottom' );


/*
 * create placeholder
 * var size: array( width, height )
 */
function intoria_create_placeholder($size) {
	return "data:image/svg+xml;charset=utf-8,%3Csvg xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg' viewBox%3D'0 0 ".$size[0]." ".$size[1]."'%2F%3E";
}


function intoria_display_sidebar_left( $sidebar_configs ) {
	if ( isset($sidebar_configs['left']) ) : ?>
		<div class="<?php echo esc_attr($sidebar_configs['left']['class']) ;?>">
		  	<aside class="sidebar sidebar-left" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
		  		<div class="close-sidebar-btn hidden-lg hidden-md"> <i class="fas fa-times"></i> <span><?php esc_html_e('Close', 'intoria'); ?></span></div>
		   		<?php if ( is_active_sidebar( $sidebar_configs['left']['sidebar'] ) ): ?>
		   			<?php dynamic_sidebar( $sidebar_configs['left']['sidebar'] ); ?>
		   		<?php endif; ?>
		  	</aside>
		</div>
	<?php endif;
}

function intoria_display_sidebar_right( $sidebar_configs ) {
	if ( isset($sidebar_configs['right']) ) : ?>
		<div class="<?php echo esc_attr($sidebar_configs['right']['class']) ;?>">
		  	<aside class="sidebar sidebar-right" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
		  		<div class="close-sidebar-btn hidden-lg hidden-md"><i class="fas fa-times"></i> <span><?php esc_html_e('Close', 'intoria'); ?></span></div>
		   		<?php if ( is_active_sidebar( $sidebar_configs['right']['sidebar'] ) ): ?>
			   		<?php dynamic_sidebar( $sidebar_configs['right']['sidebar'] ); ?>
			   	<?php endif; ?>
		  	</aside>
		</div>
	<?php endif;
}

function intoria_before_content( $sidebar_configs ) {
	if ( isset($sidebar_configs['left']) || isset($sidebar_configs['right']) ) : ?>
		<a href="javascript:void(0)" class="mobile-sidebar-btn hidden-lg hidden-md"> <i class="fas fa-bars"></i> <?php echo esc_html__('Show Sidebar', 'intoria'); ?></a>
		<div class="mobile-sidebar-panel-overlay"></div>
	<?php endif;
}
