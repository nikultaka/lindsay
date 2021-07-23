<div class="home-cat-tag-page brnhmbx-font-1 fs12">
	<?php
    $brnhmbx_bourz_categories = get_the_category();
    $brnhmbx_bourz_separator = ', ';
    $brnhmbx_bourz_output = '';

    if ( $brnhmbx_bourz_categories ) {

        foreach( $brnhmbx_bourz_categories as $brnhmbx_bourz_category ) {

            $brnhmbx_bourz_output .= '<a href="' . get_category_link( $brnhmbx_bourz_category->term_id ) . '">' . esc_attr( $brnhmbx_bourz_category->cat_name ) . '</a>' . esc_html( $brnhmbx_bourz_separator );

        }

        echo trim( $brnhmbx_bourz_output, $brnhmbx_bourz_separator );

    }
    ?>
</div>
