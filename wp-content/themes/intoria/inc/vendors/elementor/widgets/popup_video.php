<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Intoria_Elementor_Popup_Video extends Widget_Base {

	public function get_name() {
        return 'apus_element_popup_video';
    }

	public function get_title() {
        return esc_html__( 'Apus Popup Video', 'intoria' );
    }

	public function get_icon() {
        return 'eicon-youtube';
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

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'intoria' ),
                'type' => Controls_Manager::TEXT,
                'input_type' => 'text',
                'placeholder' => esc_html__( 'Enter your title here', 'intoria' ),
            ]
        );

        $this->add_control(
            'content',
            [
                'label' => esc_html__( 'Content', 'intoria' ),
                'type' => Controls_Manager::WYSIWYG,
                'placeholder' => esc_html__( 'Enter your content here', 'intoria' ),
            ]
        );

        $this->add_control(
            'video_link',
            [
                'label' => esc_html__( 'Youtube Video Link', 'intoria' ),
                'type' => Controls_Manager::TEXT,
                'input_type' => 'url',
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => esc_html__( 'Style', 'intoria' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    '' => esc_html__('Default', 'intoria'),
                    'style1' => esc_html__('Style 1', 'intoria'),
                    'style2' => esc_html__('Style 2', 'intoria'),
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
                'label' => esc_html__( 'Style', 'intoria' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'bg_icon_color',
            [
                'label' => esc_html__( 'Background Color Icon', 'intoria' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .popup-video' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

	protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        ?>
        <div class="widget-video <?php echo esc_attr($el_class.' '.$style);?>">
            <?php if( !empty($title) ) { ?>
                <h2 class="video-title" >
                   <?php echo wp_kses( $title, 'intoria-html' ); ?>
                </h2>
            <?php } ?>
            <div class="video-content">
                <?php if ( !empty($content) ) { ?>
                    <?php echo wp_kses($content, 'intoria-html'); ?>
                <?php } ?>
            </div>
            <div class="video-wrapper-inner">                
                <div class="video-section-content">
                    <div class="video-section-left">                        
                        <a class="popup-video play-now" href="<?php echo esc_url($video_link); ?>">
                            <i class="icon fa fa-play"></i>
                            <span class="ripple"></span>
                        </a>  
                    </div>
                    <div class="video-secion-right">
                        <a href="<?php echo esc_url($video_link); ?>" class="popup-video play-video-text"><?php esc_html_e( 'Play Video', 'intoria' ); ?></a>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Intoria_Elementor_Popup_Video );