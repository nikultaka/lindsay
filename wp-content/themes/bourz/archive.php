<?php get_header();

			/* Translation */
			$brnhmbx_bourz_tra_SearchResults = get_theme_mod( 'brnhmbx_bourz_tra_SearchResults', 'Search Results' );
			$brnhmbx_bourz_tra_Category = get_theme_mod( 'brnhmbx_bourz_tra_Category', 'Category' );
			$brnhmbx_bourz_tra_Tag = get_theme_mod( 'brnhmbx_bourz_tra_Tag', 'Tag' );
			$brnhmbx_bourz_tra_Author = get_theme_mod( 'brnhmbx_bourz_tra_Author', 'Author' );
			$brnhmbx_bourz_tra_Archives = get_theme_mod( 'brnhmbx_bourz_tra_Archives', 'Archives' );
			/* */
			
			/* Radio Default Values */
			$brnhmbx_bourz_opt_Layout = get_theme_mod( 'brnhmbx_bourz_opt_Layout_Archive', '2col_sidebar' );
			/* */
			
			$brnhmbx_bourz_pageHeader = '';
			
			if ( is_search() ) {
			
				$brnhmbx_bourz_pageHeader = $brnhmbx_bourz_tra_SearchResults . ' / ' . esc_html( get_search_query( false ) );
				
			} else if ( is_category() ) {
				
				$brnhmbx_bourz_pageHeader = single_cat_title( $brnhmbx_bourz_tra_Category . ' / ', false );
				
			} else if ( is_tag() ) {
				
				$brnhmbx_bourz_pageHeader = single_tag_title( $brnhmbx_bourz_tra_Tag . ' / ', false );
				
			} else if ( is_author() ) {
				
				the_post();
				$brnhmbx_bourz_pageHeader =  $brnhmbx_bourz_tra_Author . ' / ' . get_the_author();
				rewind_posts();
				
			} else if ( is_day() ) {
				
				$brnhmbx_bourz_pageHeader =  $brnhmbx_bourz_tra_Archives . ' / ' . get_the_date();
				
			} else if ( is_month() ) {
				
				$brnhmbx_bourz_pageHeader =  $brnhmbx_bourz_tra_Archives . ' / ' . get_the_date( 'F Y' );
				
			} else if ( is_year() ) {
				
				$brnhmbx_bourz_pageHeader =  $brnhmbx_bourz_tra_Archives . ' / ' . get_the_date( 'Y' );
				
			} else {
				
				$brnhmbx_bourz_pageHeader =  $brnhmbx_bourz_tra_Archives;
			
			}
			
			?>
			            
            <div class="clearfix main-container<?php echo bourz_applyLayout(); ?>">            
                <div class="clearfix site-content<?php echo bourz_applyLayout(); ?>">
                
                <?php if ( get_theme_mod( 'brnhmbx_bourz_sh_FilterBar', 1 ) ) { ?>
                    <!-- filter bar -->
                    <div class="zig-zag clearfix mb20">
                        <div class="filter-bar">
                            <div class="table-cell-middle">
                                <div class="fs20 brnhmbx-font-3 fw700"><?php echo esc_attr( $brnhmbx_bourz_pageHeader ); ?></div>
                            </div>
                        </div>
                    </div><!-- /filter bar -->
                <?php } ?>
                
                <!-- wrapper -->
                <div class="wrapper clearfix">
            
                <?php
        
                $brnhmbx_bourz_counter = 0;
        
                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();
                    
                    if ( $brnhmbx_bourz_opt_Layout == '2col' || $brnhmbx_bourz_opt_Layout == '2col_sidebar' ) {
                            
                            // Open & close row in every 2 entries for 2 columns layout
                                
                            if ( $brnhmbx_bourz_counter % 2 == 0 ) { ?>
                            
                                <!-- row -->
                                <div class="row-1-2 clearfix">
                            
                        <?php }
                                    
                            get_template_part( 'content', get_post_format() );
                            $brnhmbx_bourz_counter += 1;
                                    
                            if ( $brnhmbx_bourz_counter % 2 == 0 || $brnhmbx_bourz_counter == $wp_query->post_count ) { ?>
                            
                                </div><!-- /row -->
                                            
                        <?php }
                        
                    } else if ( $brnhmbx_bourz_opt_Layout == '1_2col_sidebar' ) {
                        
                        // Open & close row for the first entry and then in every 2 entries for 1 + 2 columns layout
						
						if ( $brnhmbx_bourz_counter == 0 ) { ?>
                        
                        	<!-- row -->
                            <div class="row-1-1-2 clearfix">
                            
                     	<?php } else {
                            
							if ( $brnhmbx_bourz_counter % 2 == 1 ) { ?>
							
								<!-- row -->
								<div class="row-1-2 clearfix">
							
						<?php }
					
						}
                                
                        get_template_part( 'content', get_post_format() );
                        $brnhmbx_bourz_counter += 1;
                                
                        if ( $brnhmbx_bourz_counter == 1 || $brnhmbx_bourz_counter % 2 == 1 || $brnhmbx_bourz_counter == $wp_query->post_count ) { ?>
                        
                            </div><!-- /row -->
                                        
                    <?php }
                    
                    } else if ( $brnhmbx_bourz_opt_Layout == '3col' ) {
                            
                            // Open & close row in every 3 entries for 3 columns layout
                                
                            if ( $brnhmbx_bourz_counter % 3 == 0 ) { ?>
                            
                                <!-- row -->
                                <div class="row-1-3 clearfix">
                            
                        <?php }
                                    
                            get_template_part( 'content', get_post_format() );
                            $brnhmbx_bourz_counter += 1;
                                    
                            if ( $brnhmbx_bourz_counter % 3 == 0 || $brnhmbx_bourz_counter == $wp_query->post_count ) { ?>
                            
                                </div><!-- /row -->
                                            
                        <?php }
                        
                    } else if ( $brnhmbx_bourz_opt_Layout == '2_3col' ) {
                        
                        // Open & close row for the first 2 entries and then in every 3 entries for 3 columns layout
						
						if ( $brnhmbx_bourz_counter == 0 ) { ?>
                        
                        	<!-- row -->
                            <div class="row-2-3 clearfix">
                            
                     	<?php } else {
                            
                        if ( $brnhmbx_bourz_counter % 3 == 2 ) { ?>
                        
                            <!-- row -->
                            <div class="row-1-3 clearfix">
                        
                    <?php }
					
						}
                                
                        get_template_part( 'content', get_post_format() );
                        $brnhmbx_bourz_counter += 1;
                                
                        if ( $brnhmbx_bourz_counter == 2 || $brnhmbx_bourz_counter % 3 == 2 || $brnhmbx_bourz_counter == $wp_query->post_count ) { ?>
                        
                            </div><!-- /row -->
                                        
                    <?php }
                    
                    } else {
                            
                            get_template_part( 'content', get_post_format() );
                            $brnhmbx_bourz_counter += 1;
                            
                        }
                                        
                        endwhile;
                        
                    else :
                        
                    get_template_part( 'nothing-found' );
                        
                    endif;
                    
                    wp_reset_postdata();
                        
                    ?>
                                                    
                </div><!-- /wrapper -->
                
                <?php bourz_Pagination(); ?>
            
            </div><!-- /site-content -->
		</div><!-- /main-container -->
                
    </div><!-- /article-wrapper-outer -->
		
    <!-- sidebar -->
    
    <?php
                
        if ( $brnhmbx_bourz_opt_Layout == '1col_sidebar' || $brnhmbx_bourz_opt_Layout == '2col_sidebar' || $brnhmbx_bourz_opt_Layout == '1_2col_sidebar' ) {

            if ( get_theme_mod( 'brnhmbx_bourz_ExtraSidebar_Archive' ) ) {
                    
                echo '<div class="sidebar clearfix">';    
                    dynamic_sidebar( 'brnhmbx_bourz_sidebar_archive' );                        
                echo '</div>';
                    
            } else {

                get_sidebar();
                
            }
                    
        }
            
    ?>
    
    <!-- /sidebar -->
	
</div><!-- /site-mid -->
            
<?php get_footer(); ?>