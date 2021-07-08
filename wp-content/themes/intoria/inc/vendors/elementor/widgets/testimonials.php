<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Intoria_Elementor_Testimonials extends Widget_Base {

	public function get_name() {
        return 'apus_element_testimonials';
    }

	public function get_title() {
        return esc_html__( 'Apus Testimonials', 'intoria' );
    }

	public function get_icon() {
        return 'eicon-testimonial';
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
            'content', [
                'label' => esc_html__( 'Content', 'intoria' ),
                'type' => Controls_Manager::TEXTAREA
            ]
        );

        $repeater->add_control(
            'img_src',
            [
                'name' => 'image',
                'label' => esc_html__( 'Choose Image', 'intoria' ),
                'type' => Controls_Manager::MEDIA,
                'placeholder'   => esc_html__( 'Upload Brand Image', 'intoria' ),
            ]
        );
        $repeater->add_control(
            'name',
            [
                'label' => esc_html__( 'Name', 'intoria' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'John Doe',
            ]
        );

        $repeater->add_control(
            'job',
            [
                'label' => esc_html__( 'Job', 'intoria' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Designer',
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__( 'Link To', 'intoria' ),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__( 'Enter your social link here', 'intoria' ),
                'placeholder' => esc_html__( 'https://your-link.com', 'intoria' ),
            ]
        );

        $this->add_control(
            'testimonials',
            [
                'label' => esc_html__( 'Testimonials', 'intoria' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );


        $this->add_control(
            'columns',
            [
                'label' => esc_html__( 'Columns', 'intoria' ),
                'type' => Controls_Manager::NUMBER,
                'input_type' => 'number',
                'default' => 2
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => esc_html__( 'Style', 'intoria' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    '' => esc_html__('Default', 'intoria'),
                    'style1' => esc_html__('Style1', 'intoria'),
                    'style2' => esc_html__('Style2', 'intoria'),
                    'style3' => esc_html__('Style3', 'intoria'),
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
                'label' => esc_html__( 'Tyles', 'intoria' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'intoria' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .widget-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Title Typography', 'intoria' ),
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .widget-title',
            ]
        );

        $this->add_control(
            'test_title_color',
            [
                'label' => esc_html__( 'Testimonial Title Color', 'intoria' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .name-client a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Testimonial Title Typography', 'intoria' ),
                'name' => 'test_title_typography',
                'selector' => '{{WRAPPER}} .name-client a',
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label' => esc_html__( 'Content Color', 'intoria' ),
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
                'label' => esc_html__( 'Content Typography', 'intoria' ),
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .description',
            ]
        );

        $this->add_control(
            'job_color',
            [
                'label' => esc_html__( 'Job Color', 'intoria' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .job' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Job Typography', 'intoria' ),
                'name' => 'job_typography',
                'selector' => '{{WRAPPER}} .job',
            ]
        );

        $this->end_controls_section();
    }

	protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        if ( !empty($testimonials) ) {
            ?>
            <div class="widget-testimonials <?php echo esc_attr($el_class.' '.$style); ?>">
                <?php if($style == 'style2'): ?> 
                    <div class="slick-carousel testimonial-main" data-items="<?php echo esc_attr($columns); ?>" data-smallmedium="2" data-extrasmall="1" data-pagination="true" data-nav="true">
                        <?php foreach ($testimonials as $item) { ?>
                            <div class="testimonials-item">
                                <div class="testimonial-box">
                                    <div class="testimonials-top flex flex-middle">
                                        <div class="right-inner">
                                            <?php if ( !empty($item['name']) ) {
                                                $title = '<h3 class="name-client">'.$item['name'].'</h3>';
                                                if ( ! empty( $item['link']['url'] ) ) {
                                                    $title = sprintf( '<h3 class="name-client"><a href="'.esc_url($item['link']['url']).'" target="'.esc_attr($item['link']['is_external'] ? '_blank' : '_self').'" '.($item['link']['nofollow'] ? 'rel="nofollow"' : '').'>%1$s</a></h3>', $item['name'] );
                                                }
                                                echo wp_kses($title, 'intoria-html');
                                            ?>
                                            <?php } ?>
                                            <?php if ( !empty($item['job']) ) { ?>
                                                <span class="job"><?php echo wp_kses($item['job'], 'intoria-html'); ?></span>
                                            <?php } ?>
                                        </div>

                                        <?php
                                        $img_src = ( isset( $item['img_src']['id'] ) && $item['img_src']['id'] != 0 ) ? wp_get_attachment_url( $item['img_src']['id'] ) : '';
                                        if ( $img_src ) {
                                        ?>
                                            <div class="avarta">
                                                <img src="<?php echo esc_url($img_src); ?>" alt="<?php echo esc_attr(!empty($item['name']) ? $item['name'] : ''); ?>">
                                            </div>
                                        <?php } ?>                                      

                                    </div>  
                                    <?php if ( !empty($item['content']) ) { ?>
                                        <div class="description">
                                            <?php echo wp_kses($item['content'], 'intoria-html'); ?>

                                            <div class="quote-icon text-theme">                                                
                                                <i class="fas fa-quote-left"></i>
                                            </div>

                                        </div>
                                    <?php } ?>                                     
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php else: ?>
                    <div class="slick-carousel testimonial-main" data-items="<?php echo esc_attr($columns); ?>" data-smallmedium="2" data-extrasmall="1" data-pagination="true" data-nav="true">
                        <?php foreach ($testimonials as $item) { ?>
                            <div class="testimonials-item">

                                <div class="testimonial-box">
                                    <?php if ( !empty($item['content']) ) { ?>
                                        <div class="description">
                                            <?php echo wp_kses($item['content'], 'intoria-html'); ?>
                                            <div class="quote-icon text-theme">
                                                <i class="fas fa-quote-left"></i>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="testimonials-top flex flex-middle">
                                        <div class="right-inner">
                                            <?php if ( !empty($item['name']) ) {
                                                $title = '<h3 class="name-client">'.$item['name'].'</h3>';
                                                if ( ! empty( $item['link']['url'] ) ) {
                                                    $title = sprintf( '<h3 class="name-client"><a href="'.esc_url($item['link']['url']).'" target="'.esc_attr($item['link']['is_external'] ? '_blank' : '_self').'" '.($item['link']['nofollow'] ? 'rel="nofollow"' : '').'>%1$s</a></h3>', $item['name'] );
                                                }
                                                echo wp_kses($title, 'intoria-html');
                                            ?>
                                            <?php } ?>
                                            <?php if ( !empty($item['job']) ) { ?>
                                                <span class="job"><?php echo wp_kses($item['job'], 'intoria-html'); ?></span>
                                            <?php } ?>
                                        </div>

                                        <?php
                                        $img_src = ( isset( $item['img_src']['id'] ) && $item['img_src']['id'] != 0 ) ? wp_get_attachment_url( $item['img_src']['id'] ) : '';
                                        if ( $img_src ) {
                                        ?>
                                            <div class="avarta">
                                                <img src="<?php echo esc_url($img_src); ?>" alt="<?php echo esc_attr(!empty($item['name']) ? $item['name'] : ''); ?>">
                                            </div>
                                        <?php } ?>                                     

                                    </div>    
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php endif; ?>              
            </div>
            <?php
        }
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Intoria_Elementor_Testimonials );