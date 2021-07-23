<?php get_header();

		/* Translation */
		$brnhmbx_bourz_tra_404 = get_theme_mod( 'brnhmbx_bourz_tra_404', 'PAGE NOT FOUND' );
		/* */
		
		?>
		
		<!-- filter bar with 404 -->
		<div class="zig-zag clearfix">
			<div class="page-404">
				<div class="table-cell-middle">
					<div class="fs20 brnhmbx-font-3 fw700"><i class="fa fa-ban"></i><?php echo esc_attr( $brnhmbx_bourz_tra_404 ); ?></div>
				</div>
			</div>
		</div><!-- /filter bar with 404 -->
    
	</div><!-- /article-wrapper-outer -->
    
</div><!-- /site-mid -->

<?php get_footer(); ?>