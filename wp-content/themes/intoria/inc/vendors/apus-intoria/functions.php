<?php

function intoria_project_theme_folder($folder) {
    return "template-project";
}
add_filter( 'apus-intoria-theme-folder-name', 'intoria_project_theme_folder', 10 );

if ( !function_exists('intoria_project_content_class') ) {
    function intoria_project_content_class( $class ) {
        $prefix = 'projects';
        if ( is_singular( 'project' ) ) {
            $prefix = 'project';
        }
        if ( intoria_get_config($prefix.'_fullwidth') ) {
            return 'container-fluid';
        }
        return $class;
    }
}
add_filter( 'intoria_project_content_class', 'intoria_project_content_class', 1 , 1  );


if ( !function_exists('intoria_get_project_layout_configs') ) {
    function intoria_get_project_layout_configs() {
        $prefix = 'projects';
        if ( is_singular( 'project' ) ) {
            $prefix = 'project';
        }
        $left = intoria_get_config($prefix.'_left_sidebar');
        $right = intoria_get_config($prefix.'_right_sidebar');

        switch ( intoria_get_config($prefix.'_layout') ) {
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
                $configs['right'] = array( 'sidebar' => 'sidebar-default',  'class' => 'col-md-3 col-xs-12' ); 
                $configs['main'] = array( 'class' => 'col-md-9 col-xs-12' );
                break;
        }
        if ( empty($configs) ) {
            $configs['right'] = array( 'sidebar' => 'sidebar-default',  'class' => 'col-md-3 col-xs-12' ); 
            $configs['main'] = array( 'class' => 'col-md-9 col-xs-12' );
        }
        return $configs; 
    }
}

add_action( 'pre_get_posts', 'intoria_project_archive' );
function intoria_project_archive($query) {
    $suppress_filters = ! empty( $query->query_vars['suppress_filters'] ) ? $query->query_vars['suppress_filters'] : '';

    if ( ! is_post_type_archive( 'project' ) || ! $query->is_main_query() || is_admin() || $query->query_vars['post_type'] != 'project' || $suppress_filters ) {
        return;
    }

    $limit = intoria_get_config('number_projects_per_page', 10);
    $query_vars = &$query->query_vars;
    $query_vars['posts_per_page'] = $limit;
    $query->query_vars = $query_vars;
    
    return $query;
}
