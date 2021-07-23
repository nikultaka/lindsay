<?php
/**
 * Contact Widget
 *
 * @package chives
 */

if ( ! class_exists( 'Chives_Contact_Widget' ) ) :

     
    class Chives_Contact_Widget extends WP_Widget {
        /**
         * Sets up the widgets name etc
         */
        public function __construct() {
            $st_widget_contact = array(
                'classname'   => 'contact_widget',
                'description' => esc_html__( 'Enter the url only the icon will be displayed as per the links. Compatible Area: Sidebar, Footer', 'chives' ),
            );
            parent::__construct( 'chives_contact_widget', esc_html__( 'ST: Contact Widget', 'chives' ), $st_widget_contact );
        }

        /**
         * Outputs the content of the widget
         *
         * @param array $args
         * @param array $instance
         */
        public function widget( $args, $instance ) {
            // outputs the content of the widget
            if ( ! isset( $args['widget_id'] ) ) {
                $args['widget_id'] = $this->id;
            }

            $title   = ( ! empty( $instance['title'] ) ) ? ( $instance['title'] ) : '';
            $title   = apply_filters( 'widget_title', $title, $instance, $this->id_base );
            $address = isset( $instance['address'] ) ? $instance['address'] : '';
            $phone   = isset( $instance['phone'] ) ? $instance['phone'] : '';
            $email   = isset( $instance['email'] ) ? $instance['email'] : '';

            echo $args['before_widget'];

            if ( ! empty( $title ) ) {
                echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
            } ?>

            <div class="contact-details">
                <?php if ( ! empty( $address ) ) : ?>
                    <div class="contact-address">
                        <?php 
                        echo chives_get_svg( array( 'icon' => 'location-o' ) ); 
                        echo esc_html( $address ); 
                        ?>
                    </div>
                <?php endif; 

                if ( ! empty( $phone ) ) : ?>
                    <div class="contact-phone">
                        <?php echo chives_get_svg( array( 'icon' => 'phone-o' ) ); ?>
                            <a href="tel:<?php echo esc_attr( $phone ); ?>"><?php echo esc_html( $phone ); ?></a>
                    </div>
                <?php endif; 

                if ( ! empty( $email ) ) : ?>
                    <div class="contact-email">
                        <?php echo chives_get_svg( array( 'icon' => 'envelope-o' ) ); ?>
                            <a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a>
                    </div>
                <?php endif; ?>
            </div>

            <?php
            echo $args['after_widget'];
        }

        /**
         * Outputs the options form on admin
         *
         * @param array $instance The widget options
         */
        public function form( $instance ) {
            $title    = isset( $instance['title'] ) ? ( $instance['title'] ) : esc_html__( 'Contact', 'chives' );
            $address  = isset( $instance['address'] ) ? $instance['address'] : '';
            $phone    = isset( $instance['phone'] ) ? $instance['phone'] : '';
            $email    = isset( $instance['email'] ) ? $instance['email'] : '';
            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'chives' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>"><?php esc_html_e( 'Full Address:', 'chives' ); ?></label>
                <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id('address') ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'address' ) ); ?>"><?php echo esc_html( $address ); ?></textarea>
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>"><?php esc_html_e( 'Phone:', 'chives' ); ?></label>
                <input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id('phone') ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'phone' ) ); ?>" value="<?php echo esc_attr( $phone ); ?>" />
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>"><?php esc_html_e( 'Email:', 'chives' ); ?></label>
                <input class="widefat" type="email" id="<?php echo esc_attr( $this->get_field_id('email') ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'email' ) ); ?>" value="<?php echo esc_attr( $email ); ?>" />
            </p>

        <?php }

        /**
        * Processing widget options on save
        *
        * @param array $new_instance The new options
        * @param array $old_instance The previous options
        */
        public function update( $new_instance, $old_instance ) {
            // processes widget options to be saved
            $instance                   = $old_instance;
            $instance['title']          = sanitize_text_field( $new_instance['title'] );
            $instance['address']        = sanitize_text_field( $new_instance['address'] );
            $instance['phone']          = sanitize_text_field( $new_instance['phone'] );
            $instance['email']          = sanitize_email( $new_instance['email'] );

            return $instance;
        }
    }
endif;
