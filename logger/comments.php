<?php
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) :
	die (__('Please do not load this page directly. Thanks!','vbegy'));
endif;

if ( post_password_required() ) :
    ?><p class="no-comments"><?php _e("This post is password protected. Enter the password to view comments.","vbegy");?></p><?php
    return;
endif;

if ( have_comments() ) :?>
	<div id="comments" class="post">
		<div class="post-wrap">
			<div class="post-inner">
				<div class="post-title"><i class="fa fa-comments"></i><?php comments_number(__('Comments','vbegy'),__('Comment','vbegy'), __('Comments','vbegy'));?> <span>( <?php comments_number(__('No','vbegy'),__('1','vbegy'), __('%','vbegy'));?> )</span></div>
				<ol class="commentlist clearfix">
				    <?php wp_list_comments('callback=vbegy_comment');?>
				</ol><!-- End commentlist -->
				<div class="clearfix"></div>
			</div><!-- End post-inner -->
		</div><!-- End post-wrap -->
	</div><!-- End post -->
	
    <div class="comments-navigation">
        <div class="alignleft"><?php previous_comments_link();?></div>
        <div class="alignright"><?php next_comments_link();?></div>
    </div>
<?php
endif;

if ( comments_open() ) :
	if (vpanel_options("Ahmed") == "on") :comment_form();endif;?>
	
	<div id="respond" class="post">
		<div class="post-wrap">
			<div class="post-inner">
				<div class="post-title"><i class="fa fa-comment"></i><?php comment_form_title(__('Leave a reply','vbegy'),__('Leave a reply to %s','vbegy'));?></div>
				<?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) :
					echo '<p class="margin_0 must-log-in">' .
					    sprintf(
					      __( 'You must be <a href="%s">logged in</a> to post a comment.','vbegy' ),
					      wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
					    ) . '</p>';
				else : ?>
					<form action="<?php echo esc_url(home_url('/'));?>wp-comments-post.php" method="post" id="commentform">
						<div class="comment-form">
							<?php if ( is_user_logged_in() ) : ?>
							    <p><?php _e('Logged in as','vbegy')?> <a href="<?php echo get_option('siteurl');?>/wp-admin/profile.php"><?php echo esc_attr($user_identity);?></a>. <a href="<?php echo wp_logout_url(get_permalink());?>" title="Log out of this account"><?php _e('Log out &raquo;','vbegy')?></a></p>
							<?php else : ?>
								<div class="form-input">
									<i class="fa fa-user"></i>
									<input type="text" name="author" value="" id="comment_name" aria-required="true" placeholder="<?php _e('Your Name','vbegy');?>">
								</div>
								<div class="form-input">
									<i class="fa fa-envelope"></i>
									<input type="email" name="email" value="" id="comment_email" aria-required="true" placeholder="<?php _e('Email','vbegy');?>">
								</div>
								<div class="form-input">
									<i class="fa fa-home"></i>
									<input type="url" name="url" value="" id="comment_url" placeholder="<?php _e('URL','vbegy');?>">
								</div>
							<?php endif;
							
							$the_captcha = vpanel_options("the_captcha_comment");
							$captcha_style = vpanel_options("captcha_style");
							$captcha_question = vpanel_options("captcha_question");
							$captcha_answer = vpanel_options("captcha_answer");
							$show_captcha_answer = vpanel_options("show_captcha_answer");
							if ($the_captcha == "on") {
								echo "<div class='form-input logger_captcha_p clearfix'>
									<i class='fa fa-lock'></i>";
									if ($captcha_style == "question_answer") {
										echo "
										<div class='clearfix'></div>
										<input size='10' id='logger_captcha' name='logger_captcha' placeholder='".__("Captcha","vbegy")."' class='logger_captcha' value='' type='text'>
										<span class='form_desc logger_captcha_span'>".$captcha_question.($show_captcha_answer == "on"?" ( ".$captcha_answer." )":"")."</span>
										<div class='clearfix'></div>";
									}else {
										$rand = rand(0000,9999);
										echo "
										<div class='clearfix'></div>
										<input size='10' id='logger_captcha_".$rand."' placeholder='".__("Captcha","vbegy")."' name='logger_captcha' class='logger_captcha' value='' type='text'><img class='logger_captcha_img' src='".get_template_directory_uri()."/captcha/create_image.php' alt='".__("Captcha","vbegy")."' title='".__("Click here to update the captcha","vbegy")."' onclick=";echo '"javascript:logger_get_captcha';echo "('".get_template_directory_uri()."/captcha/create_image.php', 'logger_captcha_img_".$rand."');";echo '"';echo " id='logger_captcha_img_".$rand."'>
										<span class='form_desc logger_captcha_span'>".__("Click on image to update the captcha .","vbegy")."</span>
										<div class='clearfix'></div>";
									}
								echo "</div>";
							}
							?>
							<div class="form-input">
								<i class="fa fa-comment"></i>
								<textarea id="comment" name="comment" aria-required="true" placeholder="<?php _e('Comment','vbegy');?>"></textarea>
							</div>
							<div class="cancel-comment-reply"><?php cancel_comment_reply_link();?></div>
							<input name="submit" type="submit" id="submit" value="<?php _e('Post Comment','vbegy')?>" class="button-default">
							<?php comment_id_fields();?>
							<?php do_action('comment_form', $post->ID);?>
						</div>
						<div class="clearfix"></div>
					</form>
				<?php endif; ?>
			</div><!-- End post-inner -->
		</div><!-- End post-wrap -->
	</div><!-- End post -->
<?php endif;?>