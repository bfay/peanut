<?php
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if (!empty($post->post_password)):
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password): 
			?>

			<p class="nocomments">This post is password protected. Enter the password to view comments.</p>

			<?php
			return;
		endif;
	endif;

	/* This variable is for alternating comment background */
	$oddcomment = 'class="alt" ';
?>

<!-- You can start editing here. -->

	<?php $main_options = get_option('frugal_main_options');

	if ($comments) : ?>
	<b><?php comments_number(__('No Responses', 'frugal'), __('One Response', 'frugal'), __('% Responses', 'frugal') );?> <?php _e('to', 'frugal'); ?> &#8220;<?php the_title(); ?>&#8221;</b>

	<ol class="commentlist">

	<?php foreach ($comments as $comment) : ?>
	
	<?php $comment_type = get_comment_type(); ?>
	<?php if($comment_type == 'comment'): ?>

		<li <?php echo $oddcomment; ?>id="comment-<?php comment_ID() ?>">
			<?php echo get_avatar( $comment, 32 ); ?>
			<cite><?php comment_author_link() ?></cite> <?php _e('Says:', 'frugal'); ?>
			<?php if ($comment->comment_approved == '0') : ?>
			<em><?php _e('Your comment is awaiting moderation.', 'frugal'); ?></em>
			<?php endif; ?>
			<br />

			<small class="commentmetadata"><a href="#comment-<?php comment_ID() ?>" title=""><?php comment_date('F jS, Y') ?> <?php _e('at', 'frugal'); ?> <?php comment_time() ?></a> <?php edit_comment_link(__('edit', 'frugal'),'&nbsp;&nbsp;',''); ?></small>

			<?php comment_text() ?>

		</li>

	<?php
		/* Changes every other comment to a different class */
		$oddcomment = ( empty( $oddcomment ) ) ? 'class="alt" ' : '';
	?>
	
	<?php else: $trackback = true; endif; ?>

	<?php endforeach; /* end for each comment */ ?>

	</ol>
	
	<?php if ($trackback == true): ?><br />
	<h4><?php _e('Trackbacks', 'frugal'); ?></h4>
	<ol id="trackbacks">
	<?php foreach ($comments as $comment) : ?>
	<?php $comment_type = get_comment_type(); ?>
	<?php if($comment_type != 'comment'): ?>
	<li><?php comment_author_link() ?></li>
	<?php endif; ?>
	<?php endforeach; ?>
	</ol>
	<?php endif; ?>

	 <?php else : // this is displayed if there are no comments so far ?>

		<?php if ('open' == $post->comment_status) : ?>
			<!-- If comments are open, but there are no comments. -->

		 <?php else : // comments are closed ?>
			<!-- If comments are closed. -->
			<p class="nocomments"><?php _e('Comments are closed.', 'frugal'); ?></p>

		<?php endif; ?>
	<?php endif; ?>


	<?php if ('open' == $post->comment_status) : ?><br />

	<?php if (get_option('comment_registration') && !$user_ID): ?>
	<p><?php _e('You must be', 'frugal');?> <a href="/<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php _e('logged in', 'frugal'); ?></a> <?php _e('to post a comment.', 'frugal'); ?></p>
	
	<?php else : ?>

	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

	<?php if ( $user_ID ) : ?>

	<p><?php _e('Logged in as', 'frugal');?> <a href="/<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="../../<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account"><?php _e('Log out', 'frugal'); ?> &raquo;</a></p>

	<?php else : ?>

		<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
		<label for="author"><small><?php _e('Name *', 'frugal'); ?></small></label></p>
			
		<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
		<label for="email"><small><?php _e('E-mail *', 'frugal'); ?></small></label></p>

		<p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
		<label for="url"><small><?php _e('Website', 'frugal'); ?></small></label></p>

	<?php endif; ?>

	<!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->

	<p><textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea></p>

	<p><input name="submit" type="submit" id="submit" tabindex="5" value="<?php echo $main_options['fr_comment_sub_text']; ?>" />
	<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
	</p>
	
	<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; // If registration required and not logged in ?>

<?php endif; // if you delete this the sky will fall on your head ?>