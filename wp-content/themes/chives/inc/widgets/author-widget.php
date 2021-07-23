<?php
/**
 * Author Widget
 *
 * @package chives
 */

if ( ! class_exists( 'Chives_Author_Widget' ) ) :

     
    class Chives_Author_Widget extends WP_Widget {
        /**
         * Sets up the widgets name etc
         */
        public function __construct() {
            $st_widget_author = array(
                'classname'   => 'author_widget',
                'description' => esc_html__( 'Compatible Area: Homepage, Sidebar, Footer', 'chives' ),
            );
            parent::__construct( 'chives_author_widget', esc_html__( 'ST: Author Widget', 'chives' ), $st_widget_author );
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
            $page_id  = isset( $instance['page_id'] ) ? $instance['page_id'] : '';
            $query_args = array(
                'post_type' => 'page',
                'page_id' => absint( $page_id ),
                'posts_per_page' => 1,
            );

            $query = new WP_Query( $query_args );

            echo $args['before_widget'];

            if ( $query -> have_posts() ) : while ( $query -> have_posts() ) : $query -> the_post(); ?>
                <div id="message-from-author" class="page-section relative">
                    <div class="wrapper">
                        <div class="section-content">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="author-thumbnail">
                                    <?php the_post_thumbnail( 'thumbnail', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
                                </div><!-- .author-thumbnail -->
                            <?php endif; 

                            if ( ! empty( $title ) ) :
                                echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
                            endif; ?>

                            <div class="entry-content">
                                <?php the_content(); ?>
                            </div><!-- .entry-content -->
                            
                            <header class="entry-header">
                                <h2 class="entry-title"><?php the_title(); ?></h2>
                            </header>
                        </div><!-- .section-content -->
                    </div><!-- .wrapper -->
                </div><!-- #message-from-author -->
            <?php endwhile; endif;
            wp_reset_postdata();

            echo $args['after_widget'];
        }

        /**
         * Outputs the options form on admin
         *
         * @param array $instance The widget options
         */
        public function form( $instance ) {
            $title       = isset( $instance['title'] ) ? ( $instance['title'] ) : esc_html__( 'Author', 'chives' );
            $page_id        = isset( $instance['page_id'] ) ? $instance['page_id'] : '';

            $page_options = chives_page_choices();
            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'chives' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'page_id' ) ); ?>"><?php esc_html_e( 'Select Page', 'chives' ); ?></label>
                <select class="chives-widget-chosen-select widfat" id="<?php echo esc_attr( $this->get_field_id( 'page_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'page_id' ) ); ?>">
                    <?php foreach ( $page_options as $page_option => $value ) : ?>
                        <option value="<?php echo absint( $page_option ); ?>" <?php selected( $page_id, $page_option, $echo = true ) ?> ><?php echo esc_html( $value ); ?></option>
                    <?php endforeach; ?>
                </select>
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
            $instance['page_id']        = chives_sanitize_page_post( $new_instance['page_id'] );

            return $instance;
        }
    }
endif;
