<?php
/*
 * Created by Artureanec
*/

if (post_password_required()) {
    return;
}

function transx_comment_code($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;
    ?>

<div <?php comment_class('transx_comments__item'); ?> id="comment-<?php comment_ID() ?>">
    <div class="transx_comments__item-img">
        <?php echo get_avatar($comment->comment_author_email, $args['avatar_size']); ?>
    </div>

    <div class="transx_comments__item-description">
        <?php
        if ($comment->comment_approved == '0') {
            echo '<p>' . esc_html__('Your comment is awaiting moderation.', 'transx') . '</p>';
        }

        echo '
            <div class="transx_comment_meta">
                <div class="transx_comment_author_cont">
                    <span class="transx_comments__item-name">' . esc_html(get_comment_author()) . '</span>
                </div>
                ';
                ?>
                <div class="transx_comment_reply_cont">
                    <?php
                    $reply_button = '
                        <svg class="icon">
                            <svg viewBox="0 0 16 16" id="previous-' . mt_rand(0, 99999) . '" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 7.9L6 3v3h2c8 0 8 8 8 8s-1-4-7.8-4H6v2.9l-6-5z"></path>
                            </svg>
                        </svg>
                    ';

                    comment_reply_link(
                        array_merge(
                            $args, array(
                                'before' => ' <span class="transx_comments__item-action">',
                                'after' => '</span>',
                                'depth' => $depth,
                                'reply_text' => $reply_button,
                                'max_depth' => $args['max_depth']
                            )
                        )
                    );
                    edit_comment_link('<i class="fa fa-pencil"></i>');
                    ?>
                </div>
                <?php
                echo '
				<div class="clear"></div>
            </div>
        ';
        ?>

        <div class="transx_comments__item-text">
            <?php comment_text(); ?>
        </div>

        <div class="transx_comment_date">
            <span class="transx_comments__item-date"><?php echo esc_html(get_comment_date('F j, Y')); ?></span>
        </div>
    </div>
    <?php
}

if (have_comments() || comments_open()) {
    ?>

    <div id="comments" class="transx_comments_cont">
        <div class="transx_comments_wrapper">
            <?php
            if (have_comments()) {
                the_comments_navigation();
                ?>

                <h4 class="transx_blog-post__title"><?php echo esc_html__('Comments', 'transx'); ?></h4>

                <div class="transx_comments">
                    <?php
                    wp_list_comments(array(
                        'style' => 'div',
                        'max_depth' => '5',
                        'avatar_size' => 70,
                        'type' => 'all',
                        'callback' => 'transx_comment_code'
                    ));
                    ?>
                </div>

                <?php the_comments_navigation();
            }

            $transx_comments_field_req = get_option('require_name_email');

            comment_form(array(
                'title_reply_before' => '<h4 class="transx_blog-post__title">',
                'title_reply' => esc_html__('Post a Comment', 'transx'),
                'title_reply_after' => '</h4>',
                'fields' => array(
                    'author' => '<div class="row"><div class="col-6"><input class="form__field" placeholder="'.esc_attr__('Your Name', 'transx') . ($transx_comments_field_req ? ' *' : '').'" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30" /></div>',
                    'email' => '<div class="col-6"><input class="form__field" placeholder="'.esc_attr__('Your Email', 'transx') . ($transx_comments_field_req ? ' *' : '').'" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" /></div></div>',
                ),
                'comment_field' => '<div class="row"><div class="col-12"><textarea name="comment" cols="45" rows="5" placeholder="' . esc_attr__('Text', 'transx') . '" id="comment-message" class="form__field form__message"></textarea></div></div>',
                'label_submit' => esc_html__('Send Review', 'transx'),
            ));
            ?>
        </div>
    </div>

    <?php
}


