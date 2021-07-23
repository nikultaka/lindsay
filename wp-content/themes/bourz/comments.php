<?php

/* Translation */
$brnhmbx_bourz_tra_Comment = get_theme_mod( 'brnhmbx_bourz_tra_Comment', 'COMMENT' );
$brnhmbx_bourz_tra_Comments = get_theme_mod( 'brnhmbx_bourz_tra_Comments', 'COMMENTS' );
$brnhmbx_bourz_tra_Name = get_theme_mod( 'brnhmbx_bourz_tra_Name', 'NAME' );
$brnhmbx_bourz_tra_Email = get_theme_mod( 'brnhmbx_bourz_tra_Email', 'E-MAIL' );
$brnhmbx_bourz_tra_Website = get_theme_mod( 'brnhmbx_bourz_tra_Website', 'WEBSITE' );
$brnhmbx_bourz_tra_MustBeLogged = get_theme_mod( 'brnhmbx_bourz_tra_MustBeLogged', 'YOU MUST BE LOGGED IN TO POST A COMMENT' );
$brnhmbx_bourz_tra_Logged = get_theme_mod( 'brnhmbx_bourz_tra_Logged', 'LOGGED IN' );
$brnhmbx_bourz_tra_LogOut = get_theme_mod( 'brnhmbx_bourz_tra_LogOut', 'LOG OUT' );
$brnhmbx_bourz_tra_LeaveReply = get_theme_mod( 'brnhmbx_bourz_tra_LeaveReply', 'LEAVE A REPLY' );
$brnhmbx_bourz_tra_CancelReply = get_theme_mod( 'brnhmbx_bourz_tra_CancelReply', 'CANCEL REPLY' );
$brnhmbx_bourz_tra_PostComment = get_theme_mod( 'brnhmbx_bourz_tra_PostComment', 'Post Comment' );
/* */

if ( ( comments_open() || get_comments_number() ) && !post_password_required() ) { ?>

    <!-- comments-container -->
    <div class="comments-container zig-zag clearfix">
        <!-- comments-outer -->
        <div class="comments-outer<?php echo bourz_applyLayout(); ?>">
            <!-- comments -->
            <div id="comments" class="comments">

                <span class="fs24 fw700 brnhmbx-font-1 comments-hdr"><?php echo esc_attr( $brnhmbx_bourz_tra_Comments ); ?></span>
                <span class="fs12 brnhmbx-font-4 fw700 comments-num"><?php comments_number( '0', '1', '%' ); ?></span>

                <div class="comments-list">
                	<ul>

                    <?php

                        wp_list_comments( array(
                            'avatar_size' => 40,
                            'max_depth' => 3,
                            'style' => 'ul',
                            'callback' => 'brnhmbx_bourz_setCommentItem',
                            'type' => 'all'
                        ) );

                    ?>

                    </ul>
                </div>

                <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>

                <div class="comments-paging fs12 brnhmbx-font-4 fw700"><?php echo paginate_comments_links( array( 'prev_text' => '<i class="fa fa-chevron-left"></i>', 'next_text' => '<i class="fa fa-chevron-right"></i>' ) ); ?></div>

                <?php } ?>

                    <?php

                        $req = get_option( 'require_name_email' );
                        $aria_req = ( $req ? " aria-required=true" : '' );

                        $brnhmbx_bourz_tra_fields = array (
                            'author' => '<div class="comment-form-author fs12 brnhmbx-font-4 fw700 comment-input-hdr">' . '<label for="author">' . esc_attr( $brnhmbx_bourz_tra_Name ) . ( $req ? ' <span class="required"> *</span>' : '' ) . '</label></div> ' .
                                        '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . esc_attr( $aria_req ) . ' />',
                            'email' => '<div class="comment-form-email fs12 brnhmbx-font-4 fw700 comment-input-hdr"><label for="email">' . esc_attr( $brnhmbx_bourz_tra_Email ) . ( $req ? ' <span class="required"> *</span>' : '' ) . '</label></div> ' .
                                        '<input id="email" name="email" ' . 'type="text"' . ' value="' . esc_attr( $commenter['comment_author_email'] ) . '" aria-describedby="email-notes"' . esc_attr( $aria_req ) . ' />',
                            'url' => '<div class="comment-form-url fs12 brnhmbx-font-4 fw700 comment-input-hdr"><label for="url">' . esc_attr( $brnhmbx_bourz_tra_Website ) . '</label></div> ' .
                                        '<input id="url" name="url" ' . 'type="text"' . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" />',
                        );

                        $brnhmbx_bourz_tra_comment_field = '<div class="comment-form-comment fs12 brnhmbx-font-4 fw700 comment-input-hdr"><label for="comment">' . esc_attr( $brnhmbx_bourz_tra_Comment ) . '</label></div><textarea id="comment" name="comment" aria-describedby="form-allowed-tags" aria-required="true"></textarea>';

                        $brnhmbx_bourz_tra_must_log_in = '<div class="must-log-in fs12 brnhmbx-font-4 fw700">' . sprintf( '<a href="%s">' . esc_attr( $brnhmbx_bourz_tra_MustBeLogged ) . '.</a>', wp_login_url(apply_filters( 'the_permalink', get_permalink() ) ) ) . '</div>';

                        $brnhmbx_bourz_tra_logged_in_as = '<div class="logged-in-as fs12 brnhmbx-font-4 fw700">' . sprintf( esc_attr( $brnhmbx_bourz_tra_Logged ) . ': <a href="%1$s">%2$s</a> / <a href="%3$s">' . esc_attr( $brnhmbx_bourz_tra_LogOut ) . '</a>', get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '</div>';

                        comment_form( array(
                            'fields' => $brnhmbx_bourz_tra_fields,
                            'comment_field' => $brnhmbx_bourz_tra_comment_field,
                            'comment_notes_after' => '',
                            'logged_in_as' => '',
                            'comment_notes_before' => '',
                            'title_reply' => esc_attr( $brnhmbx_bourz_tra_LeaveReply ),
                            'title_reply_to' => esc_attr( $brnhmbx_bourz_tra_LeaveReply ),
                            'cancel_reply_link' => '<span class="brnhmbx-font-4 fw700 fs12 cancel-display-block">' . esc_attr( $brnhmbx_bourz_tra_CancelReply ) . '<i class="fa fa-close ml5"></i></span>',
                            'label_submit' => esc_attr( $brnhmbx_bourz_tra_PostComment ),
                            'must_log_in' => $brnhmbx_bourz_tra_must_log_in,
                            'logged_in_as' => $brnhmbx_bourz_tra_logged_in_as
                        ) );
                    ?>

            </div><!-- /comments -->
        </div><!-- /comments-outer -->
    </div><!-- /comments-container -->

<?php }

function brnhmbx_bourz_setCommentItem( $comment, $args, $depth ) {

	/* Translation */
	$brnhmbx_bourz_tra_At = get_theme_mod( 'brnhmbx_bourz_tra_At', 'at' );
	$brnhmbx_bourz_tra_Reply = get_theme_mod( 'brnhmbx_bourz_tra_Reply', 'REPLY' );
	$brnhmbx_bourz_tra_Edit = get_theme_mod( 'brnhmbx_bourz_tra_Edit', 'EDIT' );
	$brnhmbx_bourz_tra_Awaiting = get_theme_mod( 'brnhmbx_bourz_tra_Awaiting', 'COMMENT AWAITING APPROVAL' );
	/* */

	$GLOBALS['comment'] = $comment; ?>

	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">

        <div class="comment-item-outer">

            <div class="comment-item clearfix">

                <?php if ( get_avatar( $comment ) ) { ?><div class="comment-author-img"><?php echo get_avatar( $comment, $args['avatar_size'] ); ?></div><?php } ?>

                <div class="comment-content clearfix">

                	<div class="comment-info">

                        <div class="comment-info-inner">
                            <div class="table-cell-middle">
                                <div class="comment-date brnhmbx-font-4 fw700 fs12"><?php printf( '%1$s ' . esc_attr( $brnhmbx_bourz_tra_At ) . ' %2$s', get_comment_date(),  get_comment_time() ) ?></div>
                                <div class="comment-author-name brnhmbx-font-2 fw700 fst-italic fs14"><?php echo get_comment_author_link(); ?></div>
                            </div>
                        </div>

                    </div>

                    <div class="comment-reply-edit clearfix">

                    	<?php if ( $depth < 3 ) { ?>

                        <div class="btnReply fs14 brnhmbx-font-1 fw700">
                            <?php comment_reply_link( array_merge( $args, array( 'reply_text' => esc_attr( $brnhmbx_bourz_tra_Reply ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ), $comment->comment_ID); ?>
                        </div>

                        <?php } ?>

                        <?php if ( user_can( wp_get_current_user(), 'administrator' ) ) { ?>

                        <div class="btnEdit fs14 brnhmbx-font-1 fw700">
                            <?php edit_comment_link( esc_attr( $brnhmbx_bourz_tra_Edit ) ); ?>
                        </div>

                        <?php } ?>

                    </div>

                </div>

            </div>

            <div class="comment-text clearfix<?php if ( get_avatar( $comment ) ) { echo ' comment-text-w-a'; } ?>">

                <?php if ( $comment->comment_approved == '0' ) { ?>

                	<div class="comment-awaiting fs11 brnhmbx-font-1"><?php echo esc_attr( $brnhmbx_bourz_tra_Awaiting ); ?></div>

				<?php } ?>

				<div class="brnhmbx-font-3 fs14"><?php comment_text(); ?></div>

			</div>

        </div>

<?php } ?>
