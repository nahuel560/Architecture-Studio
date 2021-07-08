<?php

//namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Intoria_Elementor_Search_Form extends Elementor\Widget_Base {

	public function get_name() {
        return 'apus_element_search_form';
    }

	public function get_title() {
        return esc_html__( 'Apus Header Search Form', 'intoria' );
    }
    
	public function get_categories() {
        return [ 'intoria-header-elements' ];
    }

	protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'intoria' ),
                'tab' => Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'ali',
            [
                'label' => esc_html__( 'Align Content Search', 'intoria' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'ali-left' => esc_html__('Left ', 'intoria'),
                    'ali-right' => esc_html__('Right ', 'intoria'),
                ),
                'default' => 'ali-left',
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
        ?>
        <div class="apus-search-form <?php echo esc_attr($el_class.' '.$ali); ?>">             
            <a href="javascript:void(0);" class="btn-search-icon">
                <i class="fa fa-search"></i>
            </a>
        </div>
        <?php
    }

}

Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Intoria_Elementor_Search_Form );