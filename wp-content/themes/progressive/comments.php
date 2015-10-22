<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to progressive_comment() which is
 * located in the inc/template-tags.php file.
 *
 * @package progressive
 */
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required())
	return;
?>
<?php if (have_comments()) : ?>
	<div class="comments">
		<h3 class="comments-title title slim">
			<?php
			printf(_nx('1 Comment', '%1$s Comments', get_comments_number(), 'comments title', 'progressive'), number_format_i18n(get_comments_number()), '<span>' . get_the_title() . '</span>');
			?>
		</h3>

		<?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // are there comments to navigate through  ?>
			<nav id="comment-nav-above" class="comment-navigation" role="navigation">
				<h1 class="screen-reader-text"><?php _e('Comment navigation', 'progressive'); ?></h1>
				<div class="nav-previous"><?php previous_comments_link(__('&larr; Older Comments', 'progressive')); ?></div>
				<div class="nav-next"><?php next_comments_link(__('Newer Comments &rarr;', 'progressive')); ?></div>
			</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation  ?>

		<ul class="commentlist">
			<?php
			/* Loop through and list the comments. Tell wp_list_comments()
			 * to use progressive_comment() to format the comments.
			 * If you want to override this in a child theme, then you can
			 * define progressive_comment() and that will be used instead.
			 * See progressive_comment() in inc/template-tags.php for more.
			 */
			wp_list_comments(array('callback' => 'progressive_comment'));
			?>
		</ul><!-- .comment-list -->
	</div>

	<?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // are there comments to navigate through  ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e('Comment navigation', 'progressive'); ?></h1>
			<div class="nav-previous"><?php previous_comments_link(__('&larr; Older Comments', 'progressive')); ?></div>
			<div class="nav-next"><?php next_comments_link(__('Newer Comments &rarr;', 'progressive')); ?></div>
		</nav><!-- #comment-nav-below -->
	<?php endif; // check for comment navigation  ?>

<?php endif; // have_comments() ?>

<?php
// If comments are closed and there are comments, let's leave a little note, shall we?
if (!comments_open() && '0' != get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
	?>
	<p class="no-comments"><?php _e('Comments are closed.', 'progressive'); ?></p>
<?php endif; ?>
<?php
$fields = array(
	'title_reply' => __('leave a reply', 'progressive'),
	'comment_notes_before' => '',
	'comment_notes_after' => '',
	'label_submit' => __('Submit reply', 'progressive'),
	'fields' => apply_filters('comment_form_default_fields', array(
		'author' =>
		'<div class="row">
		    <div class="col-xs-12 col-sm-6 col-md-6">
			<label>Name: <span class="required">*</span></label>
		    <input class="form-control" type="text" placeholder="Name"  name="author" id="author" value="' . esc_attr($commenter['comment_author']) .
		'" size="60" required />
		    </div></div>',
		'email' =>
		'<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6">
			<label>Email Adress: <span class="required">*</span></label>
	        <input class="form-control" placeholder="Email" name="email" id="email" value="' . esc_attr($commenter['comment_author_email']) .
		'" size="30" placeholder="Email*" required />
	        </div></div>',
		'url' =>
		'<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
			<label>Website:</label>
	            <input class="form-control" placeholder="Website" name="url" id="url" value="' . esc_attr($commenter['comment_author_url']) .
		'" size="30" placeholder="Website" />
	            </div></div>',
	)),
	'comment_field' =>
	'<div class="clearfix"></div>
	    <div class="row">
	    <div class="col-lg-12 col-md-12 fields">
			<label>Comment: <span class="required">*</span></label>
	    	<textarea id="your-comment" class="form-control" name="comment" cols="45" rows="8" aria-required="true"></textarea>
	    </div>
	    </div>'
);
?>
<article class="post-comments">
<?php comment_form($fields); ?>
</article><!--//post comments-->





