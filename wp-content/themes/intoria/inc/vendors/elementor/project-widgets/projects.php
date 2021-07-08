<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Intoria_Elementor_Projects extends Elementor\Widget_Base {

	public function get_name() {
        return 'apus_element_projects';
    }

	public function get_title() {
        return esc_html__( 'Apus Projects', 'intoria' );
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
                'name' => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => [],
                'separator' => 'none',
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
            ?>
            <div class="widget-projects <?php echo esc_attr($layout_type); ?> <?php echo esc_attr($el_class); ?>">
                <div class="widget-content">

                    <?php if ( $layout_type == 'carousel' ):
                        $lg_comlumns = $sm_comlumns = $columns;
                        if ( $columns >= 3 ) {
                            $lg_comlumns = 3;
                            $sm_comlumns = 2;
                        }
                    ?>
                        <div class="slick-carousel <?php echo esc_attr($columns < $loop->post_count ? '':'hidden-dots'); ?>" data-items="<?php echo esc_attr($columns); ?>" data-large="<?php echo esc_attr($lg_comlumns); ?>" data-smallmedium="<?php echo esc_attr($sm_comlumns); ?>"
                            data-extrasmall="1" data-pagination="true" data-nav="true" data-infinite="true" data-slidesToScroll="1">
                            <?php while ( $loop->have_posts() ): $loop->the_post(); ?>
                                <div class="item">
                                    <?php get_template_part( 'template-project/content-project'); ?>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php else: ?>
                        <?php $bcol = 12/$columns; ?>
                        <div class="layout-project style-grid">
                            <div class="row">
                                <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                                    <div class="col-md-<?php echo esc_attr($bcol); ?> col-sm-6 col-xs-12">
                                        <?php get_template_part( 'template-project/content-project' ); ?>
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

Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Intoria_Elementor_Projects );