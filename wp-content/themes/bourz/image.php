<?php get_header(); ?>

        <div class="clearfix main-container<?php echo bourz_applyLayout(); ?>">            
            <div class="clearfix site-content<?php echo bourz_applyLayout(); ?>">
    
            <?php 
            if ( have_posts() ) :
                while ( have_posts() ) : the_post(); ?>
                
                <div <?php post_class(); ?>>
                
                    <article class="post post-attachment">
                        <div class="article-inner clearfix table-cell-middle">                        
                            <?php echo wp_get_attachment_image( $post->ID ); ?>    
                        </div>
                    </article>
                
                </div>
                
                <?php endwhile;
                
                else :
                
                get_template_part( 'nothing-found' );
                
                endif; ?>
        
            </div><!-- /site-content -->
        </div><!-- /main-container -->
                    
    </div><!-- /article-wrapper-outer -->

</div><!-- /site-mid -->
	
<?php get_footer(); ?>