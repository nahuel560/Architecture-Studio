<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Intoria_Elementor_Banner extends Widget_Base {

	public function get_name() {
        return 'apus_element_banner';
    }

	public function get_title() {
        return esc_html__( 'Apus Banner', 'intoria' );
    }
    
	public function get_categories() {
        return [ 'intoria-elements' ];
    }

	protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Banner', 'intoria' ),
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
            'link',
            [
                'label' => esc_html__( 'URL', 'intoria' ),
                'type' => Controls_Manager::TEXT,
                'input_type' => 'url',
                'placeholder' => esc_html__( 'Enter your Button Link here', 'intoria' ),
            ]
        );
        $this->add_control(
            'btn_text',
            [
                'label' => esc_html__( 'Button Text', 'intoria' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter your button text here', 'intoria' ),
            ]
        );

        $this->add_control(
            'btn_style',
            [
                'label' => esc_html__( 'Button Style', 'intoria' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'btn-theme' => esc_html__('Theme Color', 'intoria'),
                    'btn-theme btn-outline' => esc_html__('Theme Outline Color', 'intoria'),
                    'btn-default' => esc_html__('Default ', 'intoria'),
                    'btn-primary' => esc_html__('Primary ', 'intoria'),
                    'btn-success' => esc_html__('Success ', 'intoria'),
                    'btn-info' => esc_html__('Info ', 'intoria'),
                    'btn-warning' => esc_html__('Warning ', 'intoria'),
                    'btn-danger' => esc_html__('Danger ', 'intoria'),
                    'btn-pink' => esc_html__('Pink ', 'intoria'),
                    'btn-white' => esc_html__('White ', 'intoria'),
                ),
                'default' => 'btn-default'
            ]
        );
        $this->add_control(
            'img_src',
            [
                'name' => 'image',
                'label' => esc_html__( 'Image', 'intoria' ),
                'type' => Controls_Manager::MEDIA,
                'placeholder'   => esc_html__( 'Upload Image Here', 'intoria' ),
            ]
        );
        $this->add_responsive_control(
            'content_align',
            [
                'label' => esc_html__( 'Content Alignment', 'intoria' ),
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
                    '{{WRAPPER}} .inner' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => esc_html__( 'Style', 'intoria' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'style1' => esc_html__('Style 1', 'intoria'),
                ),
                'default' => 'style1'
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

        $img_bg_src = ( isset( $img_bg_src['id'] ) && $img_bg_src['id'] != 0 ) ? wp_get_attachment_url( $img_bg_src['id'] ) : '';
        $style_bg = '';
        if ( !empty($img_bg_src) ) {
            $style_bg = 'style="background-image:url('.esc_url($img_bg_src).')"';
        }
        ?>
        <div class="widget-banner <?php echo esc_attr($el_class.' '.$style); ?>">
            <?php
            if ( !empty($img_src['id']) ) {
            ?>
                <div class="banner-image">
                    <?php echo intoria_get_attachment_thumbnail($img_src['id'], 'full'); ?>
                </div>
            <?php } ?>
            <div class="inner <?php echo esc_attr( (!empty($img_src['id']))?'p-ab':'' ); ?>">
                <?php if( !empty($title) ) { ?>
                    <h2 class="title" >
                       <?php echo wp_kses( $title, 'intoria-html' ); ?>
                    </h2>
                <?php } ?>
                <div class="banner-content">
                    <?php if ( !empty($content) ) { ?>
                        <?php echo wp_kses($content, 'intoria-html'); ?>
                    <?php } ?>
                </div>
                <?php if ( !empty($btn_text) ) { ?>
                    <a class="btn <?php echo esc_attr(!empty($btn_style) ? $btn_style : ''); ?>" href="<?php echo esc_url($link); ?>" ><?php echo wp_kses($btn_text, 'intoria-html'); ?></a>
                <?php } ?>
            </div>
        </div>
        <?php

    }

}

Plugin::instance()->widgets_manager->register_widget_type( new Intoria_Elementor_Banner );