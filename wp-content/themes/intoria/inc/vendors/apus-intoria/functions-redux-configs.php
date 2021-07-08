<?php

// Project Archive settings
function intoria_project_redux_config($sections, $sidebars, $columns) {
    
    $sections[] = array(
        'icon' => 'el el-website',
        'title' => esc_html__('Project Settings', 'intoria'),
        'fields' => array(
            array(
                'id' => 'projects_breadcrumb_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('Breadcrumbs Setting', 'intoria').'</h3>',
            ),
            array(
                'id' => 'projects_breadcrumbs',
                'type' => 'switch',
                'title' => esc_html__('Breadcrumbs', 'intoria'),
                'default' => 1
            ),
            array(
                'title' => esc_html__('Breadcrumbs Background Color', 'intoria'),
                'subtitle' => '<em>'.esc_html__('The breadcrumbs background color of the site.', 'intoria').'</em>',
                'id' => 'projects_breadcrumb_color',
                'type' => 'color',
                'transparent' => false,
            ),
            array(
                'id' => 'projects_breadcrumb_image',
                'type' => 'media',
                'title' => esc_html__('Breadcrumbs Background', 'intoria'),
                'subtitle' => esc_html__('Upload a .jpg or .png image that will be your breadcrumbs.', 'intoria'),
            ),
        )
    );
    // Archive settings
    $sections[] = array(
        'title' => esc_html__('Projects Archives', 'intoria'),
        'subsection' => true,
        'fields' => array(
            array(
                'id' => 'projects_general_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('General Setting', 'intoria').'</h3>',
            ),
            array(
                'id' => 'projects_style',
                'type' => 'select',
                'title' => esc_html__('Project Style', 'intoria'),
                'options' => array(
                    '' => esc_html__('Default', 'intoria'),
                    'style1' => esc_html__('Style 1', 'intoria'),
                    'style2' => esc_html__('Style 2', 'intoria'),
                ),
                'default' => ''
            ),
            array(
                'id' => 'projects_columns',
                'type' => 'select',
                'title' => esc_html__('Project Columns', 'intoria'),
                'options' => $columns,
                'default' => 3,
            ),
            array(
                'id' => 'number_projects_per_page',
                'type' => 'text',
                'title' => esc_html__('Number of Projects Per Page', 'intoria'),
                'default' => 12,
                'min' => '1',
                'step' => '1',
                'max' => '100',
                'type' => 'slider'
            ),
            array(
                'id' => 'projects_sidebar_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('Sidebar Setting', 'intoria').'</h3>',
            ),
            array(
                'id' => 'projects_fullwidth',
                'type' => 'switch',
                'title' => esc_html__('Is Full Width?', 'intoria'),
                'default' => false
            ),
            array(
                'id' => 'projects_layout',
                'type' => 'image_select',
                'compiler' => true,
                'title' => esc_html__('Archive Project Layout', 'intoria'),
                'subtitle' => esc_html__('Select the layout you want to apply on your archive project page.', 'intoria'),
                'options' => array(
                    'main' => array(
                        'title' => esc_html__('Main Content', 'intoria'),
                        'alt' => esc_html__('Main Content', 'intoria'),
                        'img' => get_template_directory_uri() . '/inc/assets/images/screen1.png'
                    ),
                    'left-main' => array(
                        'title' => esc_html__('Left Sidebar - Main Content', 'intoria'),
                        'alt' => esc_html__('Left Sidebar - Main Content', 'intoria'),
                        'img' => get_template_directory_uri() . '/inc/assets/images/screen2.png'
                    ),
                    'main-right' => array(
                        'title' => esc_html__('Main Content - Right Sidebar', 'intoria'),
                        'alt' => esc_html__('Main Content - Right Sidebar', 'intoria'),
                        'img' => get_template_directory_uri() . '/inc/assets/images/screen3.png'
                    ),
                ),
                'default' => 'main-right'
            ),
            array(
                'id' => 'projects_left_sidebar',
                'type' => 'select',
                'title' => esc_html__('Archive Left Sidebar', 'intoria'),
                'subtitle' => esc_html__('Choose a sidebar for left sidebar.', 'intoria'),
                'options' => $sidebars
            ),
            array(
                'id' => 'projects_right_sidebar',
                'type' => 'select',
                'title' => esc_html__('Archive Right Sidebar', 'intoria'),
                'subtitle' => esc_html__('Choose a sidebar for right sidebar.', 'intoria'),
                'options' => $sidebars
            ),
        )
    );
    
    
    // Project Page
    $sections[] = array(
        'title' => esc_html__('Project Single', 'intoria'),
        'subsection' => true,
        'fields' => array(
            array(
                'id' => 'project_general_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('General Setting', 'intoria').'</h3>',
            ),
            array(
                'id' => 'project_fullwidth',
                'type' => 'switch',
                'title' => esc_html__('Is Full Width?', 'intoria'),
                'default' => false
            ),
            array(
                'id' => 'show_project_recent',
                'type' => 'switch',
                'title' => esc_html__('Show Recent Projects', 'intoria'),
                'default' => 1
            ),
            array(
                'id' => 'number_project_recent',
                'type' => 'text',
                'title' => esc_html__('Number of related posts to show', 'intoria'),
                'required' => array('show_project_recent', '=', '1'),
                'default' => 3,
                'min' => '1',
                'step' => '1',
                'max' => '20',
                'type' => 'slider'
            ),
            array(
                'id' => 'recent_project_columns',
                'type' => 'select',
                'title' => esc_html__('Recent Projects Columns', 'intoria'),
                'required' => array('show_project_recent', '=', '1'),
                'options' => $columns,
                'default' => 3
            ),
            array(
                'id' => 'project_sidebar_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('Sidebar Setting', 'intoria').'</h3>',
            ),
            array(
                'id' => 'project_layout',
                'type' => 'image_select',
                'compiler' => true,
                'title' => esc_html__('Single Project Sidebar Layout', 'intoria'),
                'subtitle' => esc_html__('Select the layout you want to apply on your Single Project Page.', 'intoria'),
                'options' => array(
                	'main' => array(
                        'title' => esc_html__('Main Content', 'intoria'),
                        'alt' => esc_html__('Main Content', 'intoria'),
                        'img' => get_template_directory_uri() . '/inc/assets/images/screen1.png'
                    ),
                    'left-main' => array(
                        'title' => esc_html__('Left - Main Sidebar', 'intoria'),
                        'alt' => esc_html__('Left - Main Sidebar', 'intoria'),
                        'img' => get_template_directory_uri() . '/inc/assets/images/screen2.png'
                    ),
                    'main-right' => array(
                        'title' => esc_html__('Main - Right Sidebar', 'intoria'),
                        'alt' => esc_html__('Main - Right Sidebar', 'intoria'),
                        'img' => get_template_directory_uri() . '/inc/assets/images/screen3.png'
                    ),
                ),
                'default' => 'main-right'
            ),
            array(
                'id' => 'project_left_sidebar',
                'type' => 'select',
                'title' => esc_html__('Archive Left Sidebar', 'intoria'),
                'subtitle' => esc_html__('Choose a sidebar for left sidebar.', 'intoria'),
                'options' => $sidebars
            ),
            array(
                'id' => 'project_right_sidebar',
                'type' => 'select',
                'title' => esc_html__('Archive Right Sidebar', 'intoria'),
                'subtitle' => esc_html__('Choose a sidebar for right sidebar.', 'intoria'),
                'options' => $sidebars
            ),

        )
    );

    return $sections;
}
add_filter( 'intoria_redux_framwork_configs', 'intoria_project_redux_config', 30, 3 );