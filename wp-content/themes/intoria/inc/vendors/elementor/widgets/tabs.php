<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Intoria_Elementor_Tabs extends Widget_Base {

    public function get_name() {
        return 'apus_element_tabs';
    }

    public function get_title() {
        return esc_html__( 'Apus Tabs', 'intoria' );
    }

    public function get_icon() {
        return 'eicon-tabs';
    }

    public function get_categories() {
        return [ 'intoria-elements' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Tabs', 'intoria' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $tabs = new Repeater();

        $tabs->add_control(
            'title', [
                'label' => esc_html__( 'Title', 'intoria' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $ele_obj = \Elementor\Plugin::$instance;
        $templates = $ele_obj->templates_manager->get_source( 'local' )->get_items();

        if ( empty( $templates ) ) {

            $this->add_control(
                'no_templates',
                array(
                    'label' => false,
                    'type'  => Controls_Manager::RAW_HTML,
                    'raw'   => $this->no_template_content_message(),
                )
            );

            return;
        }

        $options = [
            '0' => '— ' . esc_html__( 'Select', 'intoria' ) . ' —',
        ];

        $types = [];

        foreach ( $templates as $template ) {
            $options[ $template['template_id'] ] = $template['title'] . ' (' . $template['type'] . ')';
            $types[ $template['template_id'] ] = $template['type'];
        }

        $tabs->add_control(
            'content_type',
            [
                'label'       => esc_html__( 'Content Type', 'intoria' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'template',
                'options'     => [
                    'template' => esc_html__( 'Template', 'intoria' ),
                    'editor'   => esc_html__( 'Editor', 'intoria' ),
                ],
                'label_block' => 'true',
            ]
        );

        $tabs->add_control(
            'item_template_id',
            [
                'label'       => esc_html__( 'Choose Template', 'intoria' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => '0',
                'options'     => $options,
                'types'       => $types,
                'label_block' => 'true',
                'condition'   => [
                    'content_type' => 'template',
                ]
            ]
        );

        $tabs->add_control(
            'content',
            [
                'label'      => esc_html__( 'Content', 'intoria' ),
                'type'       => Controls_Manager::WYSIWYG,
                'default'    => esc_html__( 'Tab Item Content', 'intoria' ),
                'dynamic' => [
                    'active' => true,
                ],
                'condition'   => [
                    'content_type' => 'editor',
                ]
            ]
        );


        $this->add_control(
            'title', [
                'label' => esc_html__( 'Heading Title', 'intoria' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Enter title here' , 'intoria' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' => esc_html__( 'Sub Title', 'intoria' ),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__( 'Enter Sub title', 'intoria' ),
                'default' => '',
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
            'tabs',
            [
                'label' => esc_html__( 'Tabs', 'intoria' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $tabs->get_controls(),
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => esc_html__( 'Style', 'intoria' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    '' => esc_html__('Default', 'intoria'),
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
    }

    protected function render() {
        $settings = $this->get_settings();

        extract( $settings );
        $_id = intoria_random_key();

        ?>
        <div class="widget-tabs <?php echo esc_attr($el_class.' '.$style); ?>">
            <?php if ( !empty($sub_title) ): ?>
                <div class="widget-sub-title">
                    <?php echo esc_attr( $sub_title ); ?>
                </div>
            <?php endif; ?>

            <?php if ( !empty($title) ): ?>
                <h2 class="widget-title">
                    <?php echo esc_attr( $title ); ?>
                </h2>
            <?php endif; ?>

            <?php if ( !empty($content) ) { ?>
                <div class="tab-description">
                    <?php echo wp_kses($content, 'intoria-html'); ?>
                </div>
            <?php } ?>            

            <div class="widget-content">
                <ul role="tablist" class="nav nav-tabs">
                    <?php $i = 0; foreach ($tabs as $tab) : ?>
                        <li class="<?php echo esc_attr($i == 0 ? 'active' : '');?>">
                            <a href="#tab-<?php echo esc_attr($_id);?>-<?php echo esc_attr($i); ?>" data-toggle="tab">
                                <?php if ( !empty($tab['title']) ) { ?>
                                    <?php echo esc_attr($tab['title']); ?>
                                <?php } ?>
                            </a>
                        </li>
                    <?php $i++; endforeach; ?>
                </ul>
                <div class="tab-content">

                    <?php $i = 0; foreach ($tabs as $tab) : ?>
                        <div id="tab-<?php echo esc_attr($_id);?>-<?php echo esc_attr($i); ?>" class="tab-pane fade <?php echo esc_attr($i == 0 ? 'in active' : ''); ?>">

                            <div class="tabs-inner">

                                <?php
                                $ele_obj = \Elementor\Plugin::$instance;
                                $content_html = '';
                                switch ( $tab[ 'content_type' ] ) {
                                    case 'template':

                                        if ( '0' !== $tab['item_template_id'] ) {

                                            $template_content = $ele_obj->frontend->get_builder_content_for_display( $tab['item_template_id'] );

                                            if ( ! empty( $template_content ) ) {
                                                $content_html .= $template_content;

                                                if ( Plugin::$instance->editor->is_edit_mode() ) {
                                                    $link = add_query_arg(
                                                        array(
                                                            'elementor' => '',
                                                        ),
                                                        get_permalink( $tab['item_template_id'] )
                                                    );

                                                    $content_html .= sprintf( '<div class="intoria__edit-cover" data-template-edit-link="%s"><i class="fas fa-pencil"></i><span>%s</span></div>', $link, esc_html__( 'Edit Template', 'intoria' ) );
                                                }
                                            } else {
                                                $content_html = $this->no_template_content_message();
                                            }
                                        } else {
                                            $content_html = $this->no_templates_message();
                                        }
                                    break;

                                    case 'editor':
                                        if ( !empty($tab['content']) ) {
                                            $content_html = $tab['content'];
                                        }
                                    break;
                                }
                                echo wp_kses($content_html, 'intoria-html');
                                ?>
                                
                            </div>
                        </div>
                    <?php $i++; endforeach; ?>
                </div>
            </div>
        </div>
        <?php
    }

    public function no_templates_message() {
        $message = '<span>' . esc_html__( 'Template is not defined. ', 'intoria' ) . '</span>';

        return sprintf(
            '<div class="no-template-message">%1$s</div>',
            $message
        );
    }

    public function no_template_content_message() {
        $message = '<span>' . esc_html__( 'The tabs are working. Please, note, that you have to add a template to the library in order to be able to display it inside the tabs.', 'intoria' ) . '</span>';

        return sprintf( '<div class="no-template-message">%1$s</div>', $message );
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Intoria_Elementor_Tabs );