<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Intoria_Elementor_Social_Links extends Widget_Base {

	public function get_name() {
        return 'apus_element_social_links';
    }

	public function get_title() {
        return esc_html__( 'Apus Social Links', 'intoria' );
    }

    public function get_icon() {
        return 'fas fa-share-square-o';
    }

	public function get_categories() {
        return [ 'intoria-elements' ];
    }

	protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'intoria' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'title', [
                'label' => esc_html__( 'Social Title', 'intoria' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Social Title' , 'intoria' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__( 'Social Link', 'intoria' ),
                'type' => Controls_Manager::TEXT,
                'input_type' => 'url',
                'placeholder' => esc_html__( 'Enter your social link here', 'intoria' ),
            ]
        );

        $repeater->add_control(
            'icon',
            [
                'label' => esc_html__( 'Social Icon', 'intoria' ),
                'type' => Controls_Manager::ICON,
            ]
        );

        $this->add_control(
            'socials',
            [
                'label' => esc_html__( 'Socials', 'intoria' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );
        
        $this->add_control(
            'alignment',
            [
                'label' => esc_html__( 'Alignment', 'intoria' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'intoria' ),
                        'icon' => 'fas fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'intoria' ),
                        'icon' => 'fas fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'intoria' ),
                        'icon' => 'fas fa-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__( 'Justified', 'intoria' ),
                        'icon' => 'fas fa-align-justify',
                    ],
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .widget-social' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => esc_html__( 'Style', 'intoria' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    '' => esc_html__('In Line', 'intoria'),
                    'st_vertical' => esc_html__('Vertical', 'intoria'),
                ),
                'default' => ''
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


        $this->start_controls_section(
            'section_title_style',
            [
                'label' => esc_html__( 'Color', 'intoria' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color',
            [
                'label' => esc_html__( 'Color', 'intoria' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .social a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'color_hover',
            [
                'label' => esc_html__( 'Hover Color', 'intoria' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .social a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

	protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        if ( !empty($socials) ) {

            ?>
            <div class="widget-social <?php echo esc_attr($el_class.' '.$style); ?>">
                <ul class="social">
                    <?php foreach ($socials as $social) { ?>
                        <?php if ( !empty($social['link']) && !empty($social['icon']) ) { ?>
                            <li>
                                <a href="<?php echo esc_url($social['link']);?>" <?php echo (!empty($social['title']) ? 'title="'.$social['title'].'"' : ''); ?>>
                                    <div class="social-inner">
                                        <i class="<?php echo esc_attr($social['icon']); ?>"></i>
                                    </div>
                                </a>
                            </li>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </div>
            <?php
        }
    }

}

Plugin::instance()->widgets_manager->register_widget_type( new Intoria_Elementor_Social_Links );