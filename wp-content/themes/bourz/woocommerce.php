<?php get_header(); ?>

	<div class="clearfix main-container<?php echo bourz_applyLayout(); ?>">            
        <div class="clearfix site-content<?php echo bourz_applyLayout(); ?>">

			<article class="post post-page zig-zag clearfix">                
				<div class="article-outer<?php echo bourz_applyLayout(); ?>">
                	<div class="article-inner">
                    	<div class="article-container clearfix">                                                                                                       
                        	<div class="brnhmbx-wc-outer brnhmbx-font-3"><?php woocommerce_content(); ?></div>                                
                    	</div>
                	</div>
            	</div>
			</article>
                    
            </div><!-- /site-content -->
		</div><!-- /main-container -->
                
    </div><!-- /article-wrapper-outer -->
                
    <!-- sidebar -->
    
    <div class="sidebar clearfix brnhmbx-font-3 fs14"><?php dynamic_sidebar( 'brnhmbx_bourz_woo_widgets' ); ?></div>
    
    <!-- /sidebar -->
        
</div><!-- /site-mid -->

<?php get_footer(); ?>