<?php
/**
 * Recent Widget
 *
 * @package chives
 */

if ( ! class_exists( 'Chives_Recent_Widget' ) ) :

     
    class Chives_Recent_Widget extends WP_Widget {
        /**
         * Sets up the widgets name etc
         */
        public function __construct() {
            $st_widget_recent = array(
                'classname'   => 'recent_widget',
                'description' => esc_html__( 'Compatible Area: Homepage', 'chives' ),
            );
            parent::__construct( 'chives_recent_widget', esc_html__( 'ST: Recent Widget', 'chives' ), $st_widget_recent );
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

            $query_args = array(
            'post_type'         => 'post',
            'posts_per_page'    => 3,
            'ignore_sticky_posts' => true,
            ); 
            $query = new WP_Query( $query_args );

            echo $args['before_widget'];
            ?>

                <div id="popular-posts" class="page-section relative">
                    <div class="wrapper">
                        <?php if ( ! empty( $title ) ) : ?>
                            <div class="section-header align-center add-separator">
                                <?php echo $args['before_title'] . esc_html( $title ) . $args['after_title']; ?>
                            </div><!-- .section-header -->
                        <?php endif; ?>

                        <div class="section-content column-3">
                            <?php if ( $query -> have_posts() ) : 
                                while ( $query -> have_posts() ) : $query -> the_post(); ?>
                                    <article class="hentry">
                                        <div class="post-wrapper">
                                            <?php if ( has_post_thumbnail() ) : ?>
                                                <div class="featured-image">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
                                                    </a>
                                                </div><!-- .recent-image -->
                                            <?php endif; ?>

                                            <div class="entry-container">
                                                <header class="entry-header">
                                                    <?php chives_posted_on(); ?>

                                                    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                                </header>

                                                <div class="entry-content">
                                                    <p><?php echo esc_html( chives_trim_content( 25 ) ); ?></p>
                                                </div><!-- .entry-content -->

                                                <div class="entry-meta">
                                                    <?php chives_entry_footer(); ?>
                                                </div><!-- .entry-meta -->
                                            </div><!-- .entry-container -->
                                        </div><!-- .post-wrapper -->
                                    </article>
                                <?php endwhile; 
                            endif;
                            wp_reset_postdata(); ?>
                        </div><!-- .section-content -->
                    </div><!-- .wrapper -->
                </div><!-- #popular-posts -->

            <?php
            echo $args['after_widget'];
        }

        /**
         * Outputs the options form on admin
         *
         * @param array $instance The widget options
         */
        public function form( $instance ) {
            $title      = isset( $instance['title'] ) ? ( $instance['title'] ) : esc_html__( 'Recent Posts', 'chives' );

            ?>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'chives' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
                <p><?php esc_html_e( 'Note: Recent three posts will be shown in three column layout.', 'chives' ); ?></p>
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
           
            return $instance;
        }
    }
endif;
