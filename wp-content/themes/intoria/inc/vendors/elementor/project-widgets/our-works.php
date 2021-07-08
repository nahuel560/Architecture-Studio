<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Intoria_Elementor_Our_Works extends Elementor\Widget_Base {

    public function get_name() {
        return 'apus_element_our_works';
    }

    public function get_title() {
        return esc_html__( 'Apus Our Works', 'intoria' );
    }

    public function get_icon() {
        return 'eicon-tabs';
    }

    public function get_categories() {
        return [ 'intoria-elements' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Projects', 'intoria' ),
                'tab' => Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'intoria' ),
                'type' => Elementor\Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'desc',
            [
                'label' => esc_html__( 'Description', 'intoria' ),
                'type' => Elementor\Controls_Manager::TEXTAREA
            ]
        );

        $this->add_control(
            'number',
            [
                'label' => esc_html__( 'Number', 'intoria' ),
                'type' => Elementor\Controls_Manager::NUMBER,
                'description' => esc_html__( 'Number posts to display', 'intoria' ),
                'default' => 4
            ]
        );
        
        $this->add_control(
            'order_by',
            [
                'label' => esc_html__( 'Order by', 'intoria' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    '' => esc_html__('Default', 'intoria'),
                    'date' => esc_html__('Date', 'intoria'),
                    'ID' => esc_html__('ID', 'intoria'),
                    'author' => esc_html__('Author', 'intoria'),
                    'title' => esc_html__('Title', 'intoria'),
                    'modified' => esc_html__('Modified', 'intoria'),
                    'rand' => esc_html__('Random', 'intoria'),
                    'comment_count' => esc_html__('Comment count', 'intoria'),
                    'menu_order' => esc_html__('Menu order', 'intoria'),
                ),
                'default' => ''
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => esc_html__( 'Sort order', 'intoria' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    '' => esc_html__('Default', 'intoria'),
                    'ASC' => esc_html__('Ascending', 'intoria'),
                    'DESC' => esc_html__('Descending', 'intoria'),
                ),
                'default' => ''
            ]
        );

        $this->add_control(
            'columns',
            [
                'label' => esc_html__( 'Columns', 'intoria' ),
                'type' => Elementor\Controls_Manager::NUMBER,
                'default' => 4,
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
                'default' => 'large',
                'separator' => 'none',
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => esc_html__( 'Style', 'intoria' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'style1' => esc_html__('Style 1', 'intoria'),
                    'style2' => esc_html__('Style 2', 'intoria'),
                ),
                'default' => 'style1'
            ]
        );

        $this->add_control(
            'el_class',
            [
                'label'         => esc_html__( 'Extra class name', 'intoria' ),
                'type'          => Elementor\Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'intoria' ),
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        extract( $settings );

        $args = array(
            'post_type' => 'project',
            'post_status' => 'publish',
            'posts_per_page' => $number,
            'orderby' => $order_by,
            'order' => $order,
        );
        $loop = new WP_Query($args);
        if ( $loop->have_posts() ) {
            if ( $image_size == 'custom' ) {
                if ( $image_custom_dimension['width'] && $image_custom_dimension['height'] ) {
                    $thumbsize = $image_custom_dimension['width'].'x'.$image_custom_dimension['height'];
                } else {
                    $thumbsize = 'full';
                }
            } else {
                $thumbsize = $image_size;
            }
            set_query_var( 'thumbsize', $thumbsize );
            wp_enqueue_script( 'isotope-pkgd', get_template_directory_uri().'/js/isotope.pkgd.min.js', array( 'jquery', 'imagesloaded' ) );
            $_id = intoria_random_key();
            ?>            
            <div class="widget-projects <?php echo esc_attr($el_class.' '.$style); ?>">
                <div class="widget-content">                    
                    <?php $bcol = 12/$columns; ?>
                    <div id="our-works-<?php echo esc_attr($_id);?>"  class="isotope-items row" data-isotope-duration="400" data-columnwidth=".col-sm-<?php echo esc_attr($bcol); ?>">
                        <?php
                        $terms = get_terms(array(
                            'taxonomy' => 'project_category',
                            'hide_empty' => true,
                            'orderby' => 'name',
                            'order' => 'ASC',
                        ));
                        $terms_slug = array();
                        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                            foreach ($terms as $term) {
                                $terms_slug[] = $term->slug;
                            }
                        }
                        ?>
                        <div class="isotope-item col-sm-<?php echo esc_attr($bcol); ?> col-xs-12 all <?php echo esc_attr(implode(' ', $terms_slug)); ?>">
                            <div class="isotope-item-inner">
                                <?php if ( $title ) { ?>
                                    <h3 class="title"><?php echo wp_kses($title, 'intoria-html'); ?></h3>
                                <?php } ?>
                                <?php if ( $desc ) { ?>
                                    <div class="desc"><?php echo wp_kses($desc, 'intoria-html'); ?></div>
                                <?php } ?>
                                <ul class="isotope-filter" data-related-grid="our-works-<?php echo esc_attr($_id);?>">
                                    <li><a href="javascript:void(0);" data-filter=".all"><?php esc_html_e('All', 'intoria'); ?></a></li>
                                    <?php
                                    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                                        foreach ($terms as $term) {
                                            ?>
                                            <li><a href="javascript:void(0);" data-filter=".<?php echo esc_attr($term->slug); ?>"><?php echo wp_kses($term->name, 'intoria-html'); ?></a></li>
                                            <?php
                                        }
                                    }
                                    ?>
                                </ul>        
                            </div>
                        </div>

                        <?php while ( $loop->have_posts() ) : $loop->the_post();
                            global $post;
                            $post_terms = get_the_terms( $post, 'project_category' );
                            $terms_slug = array();
                            if ( $post_terms && ! is_wp_error( $post_terms ) ) {
                                foreach ($post_terms as $term) {
                                    $terms_slug[] = $term->slug;
                                }
                            }
                        ?>
                            <div class="isotope-item col-sm-<?php echo esc_attr($bcol); ?> col-xs-12 all <?php echo esc_attr(implode(' ', $terms_slug)); ?>">
                                <?php get_template_part( 'template-project/content-project1' ); ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <?php wp_reset_postdata(); ?>
                </div>
            </div>
            <?php
        }
    }
}

Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Intoria_Elementor_Our_Works );