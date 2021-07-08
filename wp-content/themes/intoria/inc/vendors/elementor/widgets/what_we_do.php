<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Intoria_Elementor_What_We_Do extends Widget_Base {

	public function get_name() {
        return 'apus_element_what_we_do';
    }

	public function get_title() {
        return esc_html__( 'Apus What We Do', 'intoria' );
    }

	public function get_icon() {
        return 'eicon-image-box';
    }

	public function get_categories() {
        return [ 'intoria-elements' ];
    }

	protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Features', 'intoria' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'icon',
            [
                'label' => esc_html__( 'Icon', 'intoria' ),
                'type' => Controls_Manager::ICON,
                'default' => 'fas fa-star',
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__( 'Choose Image', 'intoria' ),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'default' => 'full',
                'separator' => 'none',
                'condition' => [
                    'image_icon' => 'image',
                ],
            ]
        );

        $repeater->add_control(
            'title_text',
            [
                'label' => esc_html__( 'Title', 'intoria' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter your title', 'intoria' ),
            ]
        );

        $repeater->add_control(
            'description_text',
            [
                'label' => esc_html__( 'Content', 'intoria' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'intoria' ),
                'placeholder' => esc_html__( 'Enter your description', 'intoria' ),
                'separator' => 'none',
                'rows' => 10,
                'show_label' => false,
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__( 'Link to', 'intoria' ),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'intoria' ),
                'separator' => 'before',
            ]
        );


        $this->add_control(
            'features',
            [
                'label' => esc_html__( 'Items', 'intoria' ),
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
            'button_text',
            [
                'label' => esc_html__( 'Button Text', 'intoria' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter button text', 'intoria' ),
                'default' => 'Read More'
            ]
        );

        $this->add_responsive_control(
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
                    '{{WRAPPER}} .item-inner' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => esc_html__( 'Style', 'intoria' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'default' => esc_html__('Default', 'intoria'),
                    'style2' => esc_html__('Style2', 'intoria'),
                ),
                'default' => 'default'
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
            'bg_color',
            [
                'label' => esc_html__( 'Background Color', 'intoria' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .widget-wedo-box .item-inner' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'intoria' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .features-box-image.icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'intoria' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .title a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Title Typography', 'intoria' ),
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .title a, {{WRAPPER}} .title',
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'label' => esc_html__( 'Description Color', 'intoria' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Description Typography', 'intoria' ),
                'name' => 'desc_typography',
                'selector' => '{{WRAPPER}} .description',
            ]
        );

        $this->end_controls_section();

    }

	protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        if ( !empty($features) ) {
            ?>
            <div class="widget-wedo-box <?php echo esc_attr($el_class.' '.$alignment.' '.$style); ?>">

                    <div class="row">
                        <?php foreach ($features as $item): ?>
                            <div class="item col-xs-12 col-sm-6 col-md-<?php echo esc_attr(12/$columns);?> col-lg-<?php echo esc_attr(12/$columns);?>">
                                <div class="item-inner">

                                    <?php
                                    $has_content = ! empty( $item['title_text'] ) || ! empty( $item['description_text'] );
                                    $html = '';

                                    if ( ! empty( $item['image']['url'] ) ) {
                                        $this->add_render_attribute( 'image', 'src', $item['image']['url'] );
                                        $this->add_render_attribute( 'image', 'alt', Control_Media::get_image_alt( $item['image'] ) );
                                        $this->add_render_attribute( 'image', 'title', Control_Media::get_image_title( $item['image'] ) );


                                        $image_html = Group_Control_Image_Size::get_attachment_image_html( $item, 'thumbnail', 'image' );

                                        if ( ! empty( $item['link']['url'] ) ) {
                                            $image_html = '<a href="'.esc_url($item['link']['url']).'" target="'.esc_attr($item['link']['is_external'] ? '_blank' : '_self').'" '.($item['link']['nofollow'] ? 'rel="nofollow"' : '').'>' . $image_html . '</a>';
                                        }

                                        if ( !empty($item['icon'])) {
                                            $image_html .= '<div class="features-box-icon"><i class="'.$item['icon'].'"></i></div>';
                                        }

                                        $html .= '<div class="features-box-image img">' . $image_html . '</div>';
                                    }


                                    if ( $has_content ) {
                                        $html .= '<div class="features-box-content">';

                                        if ( ! empty( $item['title_text'] ) ) {
                                            
                                            $title_html = $item['title_text'];

                                            if ( ! empty( $item['link']['url'] ) ) {
                                                $html .= '<a href="'.esc_url($item['link']['url']).'" target="'.esc_attr($item['link']['is_external'] ? '_blank' : '_self').'" '.($item['link']['nofollow'] ? 'rel="nofollow"' : '').'><h3 class="title">'.$title_html.'</h3></a>';
                                            } else {
                                                $html .= sprintf( '<h3 class="title">%1$s</h3>', $title_html );
                                            }
                                        }

                                        if ( ! empty( $item['description_text'] ) ) {
                                            $html .= sprintf( '<div class="description">%1$s</div>', $item['description_text'] );
                                        }

                                        if ( ! empty( $item['link']['url'] ) && $button_text ) {
                                            $html .= '<a class="read-more-btn" href="'.esc_url($item['link']['url']).'" target="'.esc_attr($item['link']['is_external'] ? '_blank' : '_self').'" '.($item['link']['nofollow'] ? 'rel="nofollow"' : '').'>'.$button_text.'</a>';
                                        }

                                        $html .= '</div>';
                                    }

                                    

                                    echo wp_kses($html, 'intoria-html');
                                    ?>

                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

            </div>
            <?php
        }
    }

}

Plugin::instance()->widgets_manager->register_widget_type( new Intoria_Elementor_What_We_Do );