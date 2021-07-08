<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Intoria_Elementor_Team extends Widget_Base {

	public function get_name() {
        return 'apus_element_team';
    }

	public function get_title() {
        return esc_html__( 'Apus Teams', 'intoria' );
    }

    public function get_icon() {
        return 'fas fa-users';
    }

	public function get_categories() {
        return [ 'intoria-elements' ];
    }

	protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Team', 'intoria' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $this->add_control(
            'name', [
                'label' => esc_html__( 'Member Name', 'intoria' ),
                'type' => Controls_Manager::TEXT,                
                'placeholder' => esc_html__( 'Member Name' , 'intoria' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'job', [
                'label' => esc_html__( 'Member Job', 'intoria' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Job titles' , 'intoria' ),
                'label_block' => true,
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

        $this->add_control(
            'style',
            [
                'label' => esc_html__( 'Style', 'intoria' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'style1' => esc_html__('Default', 'intoria'),
                    'style2' => esc_html__('Style 2', 'intoria'),
                ),
                'default' => 'style1'
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

        ?>
        <div class="widget-team <?php echo esc_attr($el_class).' '.$style; ?>">
            
            <?php
                if ( !empty($settings['img_src']['id']) ) {
            ?>
                <div class="team-image">
                    <?php echo intoria_get_attachment_thumbnail($settings['img_src']['id'], 'full'); ?>
                </div>
            <?php } ?>
            <div class="content">
                <?php if ( !empty($name) ) { ?>
                    <h3 class="name-team">
                        <?php echo wp_kses($name, 'intoria-html'); ?>
                    </h3>
                <?php } ?>

                <?php if ( !empty($job) ) { ?>
                    <div class="team-job">                            
                        <span><?php echo wp_kses($job, 'intoria-html'); ?></span>
                    </div>
                <?php } ?>    

                <div class="social-info">                    
                    <ul class="social">
                        <?php foreach ($socials as $social) { ?>
                            <?php if ( !empty($social['link']) && !empty($social['icon']) ) { ?>
                                <li>
                                    <a href="<?php echo esc_url($social['link']);?>" <?php echo (!empty($social['title']) ? 'title="'.$social['title'].'"' : ''); ?>>
                                        <i class="<?php echo esc_attr($social['icon']); ?>"></i>
                                    </a>
                                </li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Intoria_Elementor_Team );