<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Intoria_Elementor_Features_Info extends Widget_Base {

	public function get_name() {
        return 'apus_element_features_info';
    }

	public function get_title() {
        return esc_html__( 'Apus Features Info', 'intoria' );
    }

	public function get_icon() {
        return 'eicon-bullet-list';
    }

	public function get_categories() {
        return [ 'intoria-elements' ];
    }

	protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Features Info', 'intoria' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__( 'title', 'intoria' ),
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'features',
            [
                'label' => esc_html__( 'Features', 'intoria' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );
        
        $this->add_control(
            'columns',
            [
                'label' => esc_html__( 'Columns', 'intoria' ),
                'type' => Controls_Manager::TEXT,
                'input_type' => 'number',
                'default' => '3'
            ]
        );

   		$this->add_control(
            'el_class',
            [
                'label'         => esc_html__( 'Extra class name', 'intoria' ),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'intoria' ),
            ]
        );

        $this->end_controls_section();
    }

	protected function render() {
        $settings = $this->get_settings();

        extract( $settings );

        if ( !empty($features) ) {
            ?>
            <div class="widget-features-box <?php echo esc_attr($el_class); ?>">
                <ul class="features-info-list columns-<?php echo esc_attr($columns); ?>">
                    <?php foreach ($features as $item): ?>
                        <?php if ( $item['title'] ) { ?>
                            <li><?php echo wp_kses($item['title'], 'intoria-html'); ?></li>
                        <?php } ?>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php
        }
    }

}

Plugin::instance()->widgets_manager->register_widget_type( new Intoria_Elementor_Features_Info );