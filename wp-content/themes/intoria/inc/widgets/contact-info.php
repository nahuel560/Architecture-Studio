<?php

class Intoria_Widget_Contact_Info extends Apus_Widget {
    public function __construct() {
        parent::__construct(
            'apus_contact_info',
            esc_html__('Apus Contact Info Widget', 'intoria'),
            array( 'description' => esc_html__( 'Show Contact Info', 'intoria' ), )
        );
        $this->widgetName = 'contact_info';
        add_action('admin_enqueue_scripts', array($this, 'scripts'));
    }
    
    public function scripts() {
        wp_enqueue_script( 'intoria-upload', APUS_FRAMEWORK_URL . 'assets/upload.js', array( 'jquery', 'wp-pointer' ), '1.0.0', true );
    }

    public function getTemplate() {
        $this->template = 'contact_info.php';
    }

    public function widget( $args, $instance ) {
        $this->display($args, $instance);
    }
    
    public function form( $instance ) {
        $defaults = array(
            'title' => '',
            'address_icon' => '',
            'address_title' => '',
            'address_content' => '',
            'phone_icon' => '',
            'phone_title' => '',
            'phone_content' => '',
            'email_icon' => '',
            'email_title' => '',
            'email_content' => '',
        );
        $instance = wp_parse_args( (array) $instance, $defaults );
        // Widget admin form
        ?>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'intoria' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
        </p>

        <div class="phone-wrapper">
            <h3><?php echo esc_attr('Phone Contact Info'); ?></h3>
            
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'phone_icon' )); ?>"><strong><?php esc_html_e('Phone Icon:', 'intoria');?></strong></label>
                <input id="<?php echo esc_attr($this->get_field_id( 'phone_icon' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'phone_icon' )); ?>" class="widefat" value="<?php echo esc_attr( $instance['phone_icon'] ) ; ?>">
            </p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'phone_title' )); ?>"><strong><?php esc_html_e('Phone Title:', 'intoria');?></strong></label>
                <input id="<?php echo esc_attr($this->get_field_id( 'phone_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'phone_title' )); ?>" class="widefat" value="<?php echo esc_attr( $instance['phone_title'] ) ; ?>">
            </p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'phone_content' )); ?>"><strong><?php esc_html_e('Phone Content:', 'intoria');?></strong></label>
                <textarea id="<?php echo esc_attr($this->get_field_id( 'phone_content' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'phone_content' )); ?>" class="widefat"><?php echo esc_attr( $instance['phone_content'] ) ; ?></textarea>
            </p>
        </div>

        <div class="email-wrapper">
            <h3><?php echo esc_attr('Email Contact Info'); ?></h3>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'email_icon' )); ?>"><strong><?php esc_html_e('Email Icon:', 'intoria');?></strong></label>
                <input id="<?php echo esc_attr($this->get_field_id( 'email_icon' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'email_icon' )); ?>" class="widefat" value="<?php echo esc_attr( $instance['email_icon'] ) ; ?>">
            </p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'email_title' )); ?>"><strong><?php esc_html_e('Email Title:', 'intoria');?></strong></label>
                <input id="<?php echo esc_attr($this->get_field_id( 'email_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'email_title' )); ?>" class="widefat" value="<?php echo esc_attr( $instance['email_title'] ) ; ?>">
            </p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'email_content' )); ?>"><strong><?php esc_html_e('Email Content:', 'intoria');?></strong></label>
                <textarea id="<?php echo esc_attr($this->get_field_id( 'email_content' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'email_content' )); ?>" class="widefat"><?php echo esc_attr( $instance['email_content'] ) ; ?></textarea>
            </p>
        </div>

        <div class="address-wrapper">
            <h3><?php echo esc_attr('Address Contact Info'); ?></h3>
            
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'address_icon' )); ?>"><strong><?php esc_html_e('Address Icon:', 'intoria');?></strong></label>
                <input id="<?php echo esc_attr($this->get_field_id( 'address_icon' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'address_icon' )); ?>" class="widefat" value="<?php echo esc_attr( $instance['address_icon'] ) ; ?>">
            </p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'address_title' )); ?>"><strong><?php esc_html_e('Address Title:', 'intoria');?></strong></label>
                <input id="<?php echo esc_attr($this->get_field_id( 'address_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'address_title' )); ?>" class="widefat" value="<?php echo esc_attr( $instance['address_title'] ) ; ?>">
            </p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'address_content' )); ?>"><strong><?php esc_html_e('Address Content:', 'intoria');?></strong></label>
                <textarea id="<?php echo esc_attr($this->get_field_id( 'address_content' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'address_content' )); ?>" class="widefat"><?php echo esc_attr( $instance['address_content'] ) ; ?></textarea>
            </p>
        </div>
<?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? $new_instance['title'] : '';
        $instance['phone_icon'] = ( ! empty( $new_instance['phone_icon'] ) ) ? $new_instance['phone_icon'] : '';
        $instance['phone_title'] = ( ! empty( $new_instance['phone_title'] ) ) ? $new_instance['phone_title'] : '';
        $instance['phone_content'] = ( ! empty( $new_instance['phone_content'] ) ) ? $new_instance['phone_content'] : '';

        $instance['address_icon'] = ( ! empty( $new_instance['address_icon'] ) ) ? $new_instance['address_icon'] : '';
        $instance['address_title'] = ( ! empty( $new_instance['address_title'] ) ) ? $new_instance['address_title'] : '';
        $instance['address_content'] = ( ! empty( $new_instance['address_content'] ) ) ? $new_instance['address_content'] : '';

        $instance['email_icon'] = ( ! empty( $new_instance['email_icon'] ) ) ? $new_instance['email_icon'] : '';
        $instance['email_title'] = ( ! empty( $new_instance['email_title'] ) ) ? $new_instance['email_title'] : '';
        $instance['email_content'] = ( ! empty( $new_instance['email_content'] ) ) ? $new_instance['email_content'] : '';

        return $instance;
    }
}
if ( function_exists('apus_framework_reg_widget') ) {
    apus_framework_reg_widget('Intoria_Widget_Contact_Info');
}