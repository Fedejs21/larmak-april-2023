<?php
/**
 * The template for displaying comments.
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @package Energia
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
}
$post_comments_form_on = energia_get_opt( 'post_comments_form_on', true );

if($post_comments_form_on) : ?>

    <div id="comments" class="comments-area">

        <?php
        // You can start editing here -- including this comment!
        if ( have_comments() ) : ?>
            <div class="comment-list-wrap">
                <h2 class="comments-title">
                    <?php
                        $comment_count = get_comments_number();
                        if ( 1 === intval($comment_count) ) {
                            echo esc_html__( '1 Comment', 'energia' );
                        } else {
                            echo esc_attr( $comment_count ).' '.esc_html__('Comments', 'energia');
                        }
                    ?>
                </h2><!-- .comments-title -->
                <?php the_comments_navigation(); ?>

                <ul class="comment-list">
                    <?php
                        wp_list_comments( array(
                            'style'      => 'ul',
                            'short_ping' => true,
                            'callback'   => 'energia_comment_list'
                        ) );
                    ?>
                </ul><!-- .comment-list -->

                <?php the_comments_navigation(); ?>
            </div>
            <?php if ( ! comments_open() ) : ?>
                <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'energia' ); ?></p>
            <?php
            endif;

        endif; // Check for have_comments().

    $args = array(
            'id_form'           => 'commentform',
            'id_submit'         => 'submit',
            'title_reply'       => esc_attr__( 'Leave A Reply', 'energia'),
            'title_reply_to'    => esc_attr__( 'Leave A Reply To ', 'energia') . '%s',
            'cancel_reply_link' => esc_attr__( 'Cancel Reply', 'energia'),
            'label_submit'      => esc_attr__( 'Post Comment', 'energia'),
            'comment_notes_before' => '',
            'fields' => apply_filters( 'comment_form_default_fields', array(

                    'author' =>
                    '<div class="row"><div class="comment-form-author col-lg-4 col-md-4 col-sm-12">'.
                    '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
                    '" size="30" placeholder="'.esc_attr__('Name', 'energia').'"/></div>',

                    'email' =>
                    '<div class="comment-form-email col-lg-4 col-md-4 col-sm-12">'.
                    '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
                    '" size="30" placeholder="'.esc_attr__('Email', 'energia').'"/></div>',

                    'website' =>
                    '<div class="comment-form-website col-lg-4 col-md-4 col-sm-12">'.
                    '<input id="website" name="website" type="text" value="" size="30" placeholder="'.esc_attr__('Website', 'energia').'"/></div></div>',
            )
            ),
            'comment_field' =>
                '<div class="comment-form-comment">'.
                '<textarea id="comment" name="comment" cols="45" rows="8" placeholder="'.esc_attr__('Your Comment', 'energia').'" aria-required="true">' .
                '</textarea></div>',
            'submit_field'         => '<div class="form-submit">%1$s %2$s</div>',
            'submit_button' => '<span class="cms-submit-wrap"><input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" /></span>',
    );
    comment_form($args);
    ?>

    </div><!-- #comments -->

<?php endif; ?>