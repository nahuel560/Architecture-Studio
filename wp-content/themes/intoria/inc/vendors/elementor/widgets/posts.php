<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Intoria_Elementor_Posts extends Elementor\Widget_Base {

	public function get_name() {
        return 'apus_element_posts';
    }

	public function get_title() {
        return esc_html__( 'Apus Posts', 'intoria' );
    }
    
	public function get_categories() {
        return [ 'intoria-elements' ];
    }

	protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Posts', 'intoria' ),
                'tab' => Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'number',
            [
                'label' => esc_html__( 'Number', 'intoria' ),
                'type' => Elementor\Controls_Manager::NUMBER,
                'input_type' => 'number',
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
                'input_type' => 'number',
                'default' => 4,
                'condition' => [
                    'layout_type' => [ 'grid', 'carousel' ],
                ],
            ]
        );

        $this->add_control(
            'layout_type',
            [
                'label' => esc_html__( 'Layout', 'intoria' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'grid' => esc_html__('Grid', 'intoria'),                    
                    'carousel' => esc_html__('Carousel', 'intoria')
                ),
                'default' => 'grid'
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
                'default' => 'large',
                'separator' => 'none',
                'condition' => [
                    'layout_type' => [ 'grid', 'carousel' ],
                ],
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

        $this->start_controls_section(
            'section_title_style',
            [
                'label' => esc_html__( 'Tyles', 'intoria' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'link_color',
            [
                'label' => esc_html__( 'Link Color', 'intoria' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .widget-blogs a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'link_hover_color',
            [
                'label' => esc_html__( 'Link Hover Color', 'intoria' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .widget-blogs a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .widget-blogs a:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

	protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        $args = array(
            'post_type' => 'post',
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
            ?>
            <div class="widget-blogs  <?php echo esc_attr($layout_type); ?> <?php echo esc_attr($el_class); ?>">
                <div class="widget-content">

                    <?php if ( $layout_type == 'carousel' ): ?>
                        <div class="slick-carousel <?php echo esc_attr($columns < $loop->post_count ? '':'hidden-dots'); ?>" data-items="<?php echo esc_attr($columns); ?>" data-smallmedium="2" data-extrasmall="1" data-pagination="true" data-nav="true">
                            <?php while ( $loop->have_posts() ): $loop->the_post(); ?>
                                <div class="item">
                                    <?php get_template_part( 'template-posts/loop/inner-grid-2'); ?>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php else: ?>
                        <?php $bcol = 12/$columns; ?>
                        <div class="layout-blog style-grid">
                            <div class="row">
                                <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                                    <div class="col-md-<?php echo esc_attr($bcol); ?> col-sm-6 col-xs-12">
                                        <?php get_template_part( 'template-posts/loop/inner-grid-2' ); ?>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>                    
                    <?php endif; ?>
                    <?php wp_reset_postdata(); ?>
                </div>
            </div>
            <?php
        }
    }
}

Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Intoria_Elementor_Posts );