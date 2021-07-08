<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if( ! class_exists( 'Intoria_Elementor_Extensions' ) ) {
    final class Intoria_Elementor_Extensions {

        private static $_instance = null;

        
        public function __construct() {
            add_action( 'elementor/elements/categories_registered', array( $this, 'add_widget_categories' ) );
            add_action( 'init', array( $this, 'elementor_widgets' ),  100 );
            add_filter( 'intoria_generate_post_builder', array( $this, 'render_post_builder' ), 10, 2 );
            add_action( 'elementor/controls/controls_registered', array( $this, 'modify_controls' ), 10, 1 );
            add_action('elementor/editor/before_enqueue_styles', array( $this, 'style' ) );
            add_filter( 'elementor/controls/animations/additional_animations', array( $this, 'additional_animations' ), 10 );
        }

        public static function instance () {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }
        
        public function add_widget_categories( $elements_manager ) {
            $elements_manager->add_category(
                'intoria-elements',
                [
                    'title' => esc_html__( 'Intoria Elements', 'intoria' ),
                    'icon' => 'fas fa-shopping-bag',
                ]
            );

            $elements_manager->add_category(
                'intoria-header-elements',
                [
                    'title' => esc_html__( 'Intoria Header Elements', 'intoria' ),
                    'icon' => 'fas fa-shopping-bag',
                ]
            );

        }

        public function elementor_widgets() {
            // general elements
            get_template_part( 'inc/vendors/elementor/widgets/heading' );
            get_template_part( 'inc/vendors/elementor/widgets/posts' );
            get_template_part( 'inc/vendors/elementor/widgets/call_to_action' );
            get_template_part( 'inc/vendors/elementor/widgets/features_box' );
            get_template_part( 'inc/vendors/elementor/widgets/social_links' );
            get_template_part( 'inc/vendors/elementor/widgets/testimonials' );
            get_template_part( 'inc/vendors/elementor/widgets/brands' );
            get_template_part( 'inc/vendors/elementor/widgets/popup_video' );
            get_template_part( 'inc/vendors/elementor/widgets/banner' );
            get_template_part( 'inc/vendors/elementor/widgets/countdown' );
            get_template_part( 'inc/vendors/elementor/widgets/nav_menu' );
            get_template_part( 'inc/vendors/elementor/widgets/team' );

            get_template_part( 'inc/vendors/elementor/widgets/tabs' );
            get_template_part( 'inc/vendors/elementor/widgets/gallery' );
            get_template_part( 'inc/vendors/elementor/widgets/features-info' );
            get_template_part( 'inc/vendors/elementor/widgets/what_we_do' );

            // header elements
            get_template_part( 'inc/vendors/elementor/header-widgets/logo' );
            get_template_part( 'inc/vendors/elementor/header-widgets/primary_menu' );
            get_template_part( 'inc/vendors/elementor/header-widgets/search_form' );
            get_template_part( 'inc/vendors/elementor/header-widgets/contact-sidebar-btn' );

            if ( intoria_is_mailchimp_activated() ) {
                get_template_part( 'inc/vendors/elementor/widgets/mailchimp' );
            }
            
            if ( intoria_is_revslider_activated() ) {
                get_template_part( 'inc/vendors/elementor/widgets/revslider' );
            }

            if ( intoria_is_apus_intoria_activated() ) {
                get_template_part( 'inc/vendors/elementor/project-widgets/projects' );
                get_template_part( 'inc/vendors/elementor/project-widgets/our-works' );
            }
        }

        public function style() {
            wp_enqueue_style('intoria-flaticon',  get_template_directory_uri() . '/css/flaticon.min.css');
        }

        public function modify_controls( $controls_registry ) {
            // Get existing icons
            $icons = $controls_registry->get_control( 'icon' )->get_settings( 'options' );
            // Append new icons
            $new_icons = array_merge(
                array(
                    'flaticon-smartphone' => 'flaticon-smartphone', 
                    'flaticon-email' => 'flaticon-email', 
                    'flaticon-placeholder' => 'flaticon-placeholder', 
                    'flaticon-fax' => 'flaticon-fax', 
                    'flaticon-lamp' => 'flaticon-lamp', 
                    'flaticon-ceiling-lamp' => 'flaticon-ceiling-lamp', 
                    'flaticon-fan' => 'flaticon-fan', 
                    'flaticon-bathtub' => 'flaticon-bathtub', 
                    'flaticon-shower' => 'flaticon-shower',
                    'flaticon-handrail' => 'flaticon-handrail',                     
                    'flaticon-window' => 'flaticon-window', 
                    'flaticon-window-1' => 'flaticon-window-1', 
                    'flaticon-window-2' => 'flaticon-window-2', 
                    'flaticon-window-3' => 'flaticon-window-3', 
                    'flaticon-window-4' => 'flaticon-window-4', 
                    'flaticon-window-5' => 'flaticon-window-5', 
                    'flaticon-carpet' => 'flaticon-carpet', 
                    'flaticon-vacuum-cleaner' => 'flaticon-vacuum-cleaner', 
                    'flaticon-floor-lamp' => 'flaticon-floor-lamp', 
                    'flaticon-chair' => 'flaticon-chair', 
                    'flaticon-tv' => 'flaticon-tv', 
                    'flaticon-sofa' => 'flaticon-sofa', 
                    'flaticon-sketch' => 'flaticon-sketch', 
                    'flaticon-plant' => 'flaticon-plant',                    
                    'flaticon-review' => 'flaticon-review', 
                    'flaticon-back' => 'flaticon-back', 
                    'flaticon-next' => 'flaticon-next'
                ),
                $icons                
            );
            // Then we set a new list of icons as the options of the icon control
            $controls_registry->get_control( 'icon' )->set_settings( 'options', $new_icons );
        }
        
        public function additional_animations($animations = array()) {
            $additional_animations = array(
                'ApusTheme' => [
                    'moveInDown' => esc_html__('Move In Down', 'intoria'),
                    'moveInLeft' => esc_html__('Move In Left', 'intoria'),
                    'moveInRight' => esc_html__('Move In Right', 'intoria'),
                    'moveInUp' => esc_html__('Move In Up', 'intoria'),
                    'moveOutDown' => esc_html__('Move Out Down', 'intoria'),
                    'moveOutLeft' => esc_html__('Move Out Left', 'intoria'),
                    'moveOutRight' => esc_html__('Move Out Right', 'intoria'),
                    'moveOutUp' => esc_html__('Move Out Up', 'intoria'),
                ],
            );
            return array_merge( $animations, $additional_animations );
        }

        public function render_page_content($post_id) {
            if ( class_exists( 'Elementor\Core\Files\CSS\Post' ) ) {
                $css_file = new Elementor\Core\Files\CSS\Post( $post_id );
                $css_file->enqueue();
            }

            return Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $post_id );
        }

        public function render_post_builder($html, $post) {
            if ( !empty($post) && !empty($post->ID) ) {
                return $this->render_page_content($post->ID);
            }
            return $html;
        }
    }
}

if ( did_action( 'elementor/loaded' ) ) {
    // Finally initialize code
    Intoria_Elementor_Extensions::instance();
}