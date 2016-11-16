<?php
ob_start();
if (!isset($_SESSION)) {
	session_start();
}
/* add_post_shortcode */
add_shortcode('add_post', 'add_post_shortcode');
function add_post_shortcode($atts, $content = null) {
	global $posted;
	$out = '';
	$add_post_no_register = vpanel_options("add_post_no_register");
	if (is_user_logged_in()) {
		$user_get_current_user_id = get_current_user_id();
		$user_is_login = get_userdata($user_get_current_user_id);
	}
	
	if (!is_user_logged_in() && $add_post_no_register != 'on') {
		$out .= '<div class="form-style form-style-2"><div class="note_error"><strong>'.__("You must login to add post .","vbegy").'</strong></div>'.do_shortcode("[logger_login]").'</div>';
	}else {
		$tags_post = vpanel_options("tags_post");
		$attachment_post = vpanel_options("attachment_post");
		if ($_POST) {
			$post_edit = (isset($_POST["post_edit"]) && $_POST["post_edit"] != ""?$_POST["post_edit"]:"");
		}else {
			$post_edit = "";
		}
		
		if ($post_edit != "post_edit") {
			$out .= '<div class="add-post"><div class="form-style form-style-3 post-submit">
				<div class="add_post">
					<div '.(!is_user_logged_in()?"class='if_no_login'":"").'>';
						$rand_p = rand(1,1000);
						$out .= '
						<form class="new-post-form" method="post" enctype="multipart/form-data">
							<div class="note_error display"></div>
							<div class="form-inputs clearfix">';
								if (!is_user_logged_in() && $add_post_no_register == 'on') {
									$out .= '<p>
										<label for="post-username-'.$rand_p.'" class="required">'.__("Username","vbegy").'<span>*</span></label>
										<input name="username" id="post-username-'.$rand_p.'" class="post-username" type="text" value="'.(isset($posted['username'])?$posted['title']:'').'">
										<span class="form-description">'.__("Please type your username .","vbegy").'</span>
									</p>
									
									<p>
										<label for="post-email-'.$rand_p.'" class="required">'.__("E-Mail","vbegy").'<span>*</span></label>
										<input name="email" id="post-email-'.$rand_p.'" class="post-email" type="text" value="'.(isset($posted['email'])?$posted['title']:'').'">
										<span class="form-description">'.__("Please type your E-Mail .","vbegy").'</span>
									</p>';
								}
								$out .= '<p>
									<label for="post-title-'.$rand_p.'" class="required">'.__("Post Title","vbegy").'<span>*</span></label>
									<input name="title" id="post-title-'.$rand_p.'" type="text" value="'.(isset($posted['title'])?$posted['title']:'').'">
									<span class="form-description">'.__("Please choose an appropriate title for the post to answer it even easier .","vbegy").'</span>
								</p>';
								
								if ($tags_post == 'on') {
									$out .= '<p>
										<label for="post_tag-'.$rand_p.'">'.__("Tags","vbegy").'</label>
										<input type="text" class="input post_tag" name="post_tag" id="post_tag-'.$rand_p.'" value="'.(isset($posted['post_tag'])?$posted['post_tag']:'').'" data-seperator=",">
										<span class="form-description">'.__("Please choose  suitable Keywords Ex : ","vbegy").'<span class="color">'.__("post , video","vbegy").'</span> .</span>
									</p>';
								}
								
								$out .= '<p>
									<label for="category-'.$rand_p.'" class="required">'.__("Category","vbegy").'<span>*</span></label>
									<span class="styled-select">'.
										wp_dropdown_categories(array("echo" => "0","show_option_none" => __("Select a Category","vbegy"),'taxonomy' => 'category', 'hide_empty' => 0,'depth' => 0,'id' => 'category-'.$rand_p.'','name' => 'category',  'hierarchical' => true,'selected' => (int)$posted['category']))
									.'</span>
									<span class="form-description">'.__("Please choose the appropriate section so easily search for your post .","vbegy").'</span>
								</p>';
								
								if ($attachment_post == 'on') {
									$out .= '<label for="attachment-'.$rand_p.'">'.__("Attachment","vbegy").'</label>
									<div class="fileinputs">
										<input type="file" class="file" name="attachment" id="attachment-'.$rand_p.'">
										<div class="fakefile">
											<button type="button" class="button-default small margin_0">'.__("Select file","vbegy").'</button>
											<span><i class="icon-arrow-up"></i>'.__("Browse","vbegy").'</span>
										</div>
									</div>';
								}
								
							$out .= '
							</div>
							<div>
								<p>
									<label for="post-details-'.$rand_p.'" '.(vpanel_options("content_post") == 'on'?'class="required"':'').'>'.__("Details","vbegy").(vpanel_options("content_post") == 'on'?'<span>*</span>':'').'</label>
									<textarea name="comment" id="post-details-'.$rand_p.'" class="post-textarea" aria-required="true" cols="58" rows="8">'.(isset($posted['comment'])?$posted['comment']:"").'</textarea>
									<span class="form-description">'.__("Type the description thoroughly and in details .","vbegy").'</span>
								</p>
							</div>
							
							<div class="form-inputs clearfix">';
								
							$the_captcha = vpanel_options("the_captcha");
							$captcha_style = vpanel_options("captcha_style");
							$captcha_question = vpanel_options("captcha_question");
							$captcha_answer = vpanel_options("captcha_answer");
							$show_captcha_answer = vpanel_options("show_captcha_answer");
							if ($the_captcha == 'on') {
								if ($captcha_style == "question_answer") {
									$out .= "
									<p class='ask_captcha_p'>
										<label for='ask_captcha-'.$rand_p.'' class='required'>".__("Captcha","vbegy")."<span>*</span></label>
										<input size='10' id='ask_captcha-'.$rand_p.'' name='ask_captcha' class='ask_captcha' value='' type='text'>
										<span class='ask_captcha_span'>".$captcha_question.($show_captcha_answer == 'on'?" ( ".$captcha_answer." )":"")."</span>
									</p>";
								}else {
									$out .= "
									<p class='ask_captcha_p'>
										<label for='ask_captcha_".$rand_p."' class='required'>".__("Captcha","vbegy")."<span>*</span></label>
										<input size='10' id='ask_captcha_".$rand_p."' name='ask_captcha' class='ask_captcha' value='' type='text'><img class='ask_captcha_img' src='".get_template_directory_uri()."/captcha/create_image.php' alt='".__("Captcha","vbegy")."' title='".__("Click here to update the captcha","vbegy")."' onclick=";$out .='"javascript:ask_get_captcha';$out .="('".get_template_directory_uri()."/captcha/create_image.php', 'ask_captcha_img_".$rand_p."');";$out .='"';$out .=" id='ask_captcha_img_".$rand_p."'>
										<span class='ask_captcha_span'>".__("Click on image to update the captcha .","vbegy")."</span>
									</p>";
								}
							}
							
							$out .= '</div>
							
							<p class="form-submit margin_0">
								<input type="hidden" name="post_add" value="post_add">
								<input type="submit" value="'.__("Publish Your Post","vbegy").'" class="button-default color small submit add_qu publish-post">
							</p>
						
						</form>
					</div>
				</div>
			</div></div>';
		}
	}
	return $out;
}
/* vpanel_edit_post_shortcode */
add_shortcode('vpanel_edit_post', 'vpanel_edit_post_shortcode');
function vpanel_edit_post_shortcode($atts, $content = null) {
	global $posted;
	$tags_post = vpanel_options("tags_post");
	$attachment_post = vpanel_options("attachment_post");
	$out = '';
	if (!is_user_logged_in()) {
		$out .= '<div class="form-style form-style-3"><div class="note_error"><strong>'.__("You must login to add post .","vbegy").'</strong></div>'.do_shortcode("[logger_login]").'<ul class="login-links login-links-r"><li><a href="#">'.__("Register","vbegy").'</a></li></ul></div>';
	}else {
		$get_post = (int)$_GET["edit_post"];
		$get_post_q = get_post($get_post);
		
		$q_tag = "";
		if ($terms = wp_get_object_terms( $get_post, 'post_tag' )) :
			$terms_array = array();
			foreach ($terms as $term) :
				$terms_array[] = $term->name;
				$q_tag = implode(' , ', $terms_array);
			endforeach;
		endif;
		
		$category = wp_get_post_terms($get_post,'category',array("fields" => "ids"));
		if (isset($category) && is_array($category)) {
			$category = $category[0];
		}
		
		$out .= '<div class="add-post"><div class="form-style form-style-3 post-submit">
			<div class="add_post">
				<div '.(!is_user_logged_in()?"class='if_no_login'":"").'>';
					$rand_e = rand(1,1000);
					$out .= '
					<form class="new-post-form" method="post" enctype="multipart/form-data">
						<div class="note_error display"></div>
						<div class="form-inputs clearfix">
							<p>
								<label for="post-title-'.$rand_e.'" class="required">'.__("post Title","vbegy").'<span>*</span></label>
								<input name="title" id="post-title-'.$rand_e.'" type="text" value="'.(isset($posted['title'])?$posted['title']:$get_post_q->post_title).'">
								<span class="form-description">'.__("Please choose an appropriate title for the post to answer it even easier .","vbegy").'</span>
							</p>';
							
							if ($tags_post == 'on') {
								$out .= '<p>
									<label for="post_tag-'.$rand_e.'">'.__("Tags","vbegy").'</label>
									<input type="text" class="input post_tag" name="post_tag" id="post_tag-'.$rand_e.'" value="'.(isset($posted['post_tag'])?$posted['post_tag']:$q_tag).'" data-seperator=",">
									<span class="form-description">'.__("Please choose  suitable Keywords Ex : ","vbegy").'<span class="color">'.__("post , video","vbegy").'</span> .</span>
								</p>';
							}
							
							$out .= '<p>
								<label for="category-'.$rand_e.'" class="required">'.__("Category","vbegy").'<span>*</span></label>
								<span class="styled-select">'.
									wp_dropdown_categories(array("echo" => "0","show_option_none" => __("Select a Category","vbegy"),'taxonomy' => 'category', 'hide_empty' => 0,'depth' => 0,'id' => 'category-'.$rand_e,'name' => 'category',  'hierarchical' => true,'selected' => (isset($posted['category'])?(int)$posted['category']:$category)))
								.'</span>
								<span class="form-description">'.__("Please choose the appropriate section so easily search for your post .","vbegy").'</span>
							</p>';
							
						$out .= '</div>
						<div>
							<p>
								<label for="post-details-'.$rand_e.'" '.(vpanel_options("content_post") == 'on'?'class="required"':'').'>'.__("Details","vbegy").(vpanel_options("content_post") == 'on'?'<span>*</span>':'').'</label>
								<textarea name="comment" id="post-details-'.$rand_e.'" class="post-textarea" aria-required="true" cols="58" rows="8">'.(isset($posted['comment'])?$posted['comment']:$get_post_q->post_content).'</textarea>
								<span class="form-description">'.__("Type the description thoroughly and in details .","vbegy").'</span>
							</p>
						</div>';
						
						if ($attachment_post == 'on') {
							$out .= '<label for="attachment-'.$rand_e.'">'.__("Attachment","vbegy").'</label>
							<div class="fileinputs">
								<input type="file" class="file" name="attachment" id="attachment-'.$rand_e.'">
								<div class="fakefile">
									<button type="button" class="button-default small margin_0">'.__("Select file","vbegy").'</button>
									<span><i class="icon-arrow-up"></i>'.__("Browse","vbegy").'</span>
								</div>
							</div>';
						}
						
						$out .= '<div class="form-inputs clearfix">
						
						</div>
						<p class="form-submit margin_0">
							<input type="hidden" name="ID" value="'.$get_post.'">
							<input type="hidden" name="post_edit" value="post_edit">
							<input type="submit" value="'.__("Edit Your post","vbegy").'" class="button-default color small submit add_qu publish-post">
						</p>
					
					</form>
				</div>
			</div>
		</div></div>';
	}
	return $out;
}
/* is_user_logged_in_data */
function is_user_logged_in_data () {
	$out = '';
	if (is_user_logged_in()) {
		$user_login = get_userdata(get_current_user_id());
		$you_avatar = get_the_author_meta('you_avatar',$user_login->ID);
		$url = get_the_author_meta('url',$user_login->ID);
		$country = get_the_author_meta('country',$user_login->ID);
		$twitter = get_the_author_meta('twitter',$user_login->ID);
		$facebook = get_the_author_meta('facebook',$user_login->ID);
		$google = get_the_author_meta('google',$user_login->ID);
		$linkedin = get_the_author_meta('linkedin',$user_login->ID);
		$follow_email = get_the_author_meta('follow_email',$user_login->ID);
		$out .= '
		<div class="is-login-left user-profile-img">
			<a original-title="'.$user_login->display_name.'" class="tooltip-n" href="'.get_author_posts_url($user_login->ID).'">';
				if ($you_avatar) {
					$you_avatar_img = get_aq_resize_url(esc_attr($you_avatar),"full",79,79);
					$out .= "<img alt='".$user_login->display_name."' src='".$you_avatar_img."'>";
				}else {
					$out .= get_avatar(get_the_author_meta('user_email',$user_login->ID),'65','');
				}
			$out .= '</a>
		</div>
		<div class="is-login-right">
			<h2>'.__("Welcome","vbegy").' '.$user_login->display_name.'</h2>
			<p>'.$user_login->description.'</p>
			<ul class="user_quick_links">
				<li><a href="'.get_author_posts_url($user_login->ID).'"><i class="fa fa-home"></i>'.__("Profile page","vbegy").'</a></li>
				<li><a href="'.get_page_link(vpanel_options('user_edit_profile_page')).'"><i class="fa fa-pencil"></i>'.__("Edit profile","vbegy").'</a></li>
				<li><a href="'.wp_logout_url(home_url()).'"><i class="fa fa-sign-out"></i>'.__("Logout","vbegy").'</a></li>
			</ul>';
			if ($facebook || $twitter || $linkedin || $google || $follow_email) {
				if ($facebook) {
				$out .= '<a href="'.$facebook.'" original-title="'.__("Facebook","vbegy").'" class="tooltip-n">
					<span class="icon_i">
						<span class="icon_square" icon_size="30" span_bg="#3b5997">
							<i class="fa fa-facebook"></i>
						</span>
					</span>
				</a>';
				}
				if ($twitter) {
				$out .= '<a href="'.$twitter.'" original-title="'.__("Twitter","vbegy").'" class="tooltip-n">
					<span class="icon_i">
						<span class="icon_square" icon_size="30" span_bg="#00baf0">
							<i class="fa fa-twitter"></i>
						</span>
					</span>
				</a>';
				}
				if ($linkedin) {
				$out .= '<a href="'.$linkedin.'" original-title="'.__("Linkedin","vbegy").'" class="tooltip-n">
					<span class="icon_i">
						<span class="icon_square" icon_size="30" span_bg="#006599">
							<i class="fa fa-linkedin"></i>
						</span>
					</span>
				</a>';
				}
				if ($google) {
				$out .= '<a href="'.$google.'" original-title="'.__("Google plus","vbegy").'" class="tooltip-n">
					<span class="icon_i">
						<span class="icon_square" icon_size="30" span_bg="#c43c2c">
							<i class="fa fa-google-plus"></i>
						</span>
					</span>
				</a>';
				}
				if ($follow_email) {
				$out .= '<a href="'.$follow_email.'" original-title="'.__("Email","vbegy").'" class="tooltip-n">
					<span class="icon_i">
						<span class="icon_square" icon_size="30" span_bg="#000">
							<i class="fa fa-envelope"></i>
						</span>
					</span>
				</a>';
				}
			}
		$out .= '</div>';
	}else {
		$out .= '<div class="form-style form-style-3">
			'.do_shortcode("[logger_login]").'
		</div>';
	}
	return $out;
}
/* Login shortcode */
function logger_login ($atts, $content = null) {
	global $user_identity,$user_ID;
	$a = shortcode_atts( array(
	    'forget' => 'asd',
	), $atts );
	$out = '';
	if (is_user_logged_in()) :
		$user_login = get_userdata(get_current_user_id());
		$out .= is_user_logged_in_data();
	else:
	$out .= '<div class="logger_form inputs">
			
			
		<form class="login-form logger_login" action="'.home_url('/').'" method="post">
			<div class="logger_error"></div>
			
			<div class="form-inputs clearfix">
				<input class="required-item" type="text" value="'.__("Username","vbegy").'" onfocus="if (this.value == \''.__("Username","vbegy").'\') {this.value = \'\';}" onblur="if (this.value == \'\') {this.value = \''.__("Username","vbegy").'\';}" name="log">
				<input class="required-item" type="password" value="'.__("Password","vbegy").'" onfocus="if (this.value == \''.__("Password","vbegy").'\') {this.value = \'\';}" onblur="if (this.value == \'\') {this.value = \''.__("Password","vbegy").'\';}" name="pwd">
				
			</div>
			<p class="rememberme"><label><input type="checkbox"input name="rememberme" checked="checked"> '.__("Remember Me","vbegy").'</label></p>
			<div class="loader_2"></div><input type="submit" value="'.__("Login","vbegy").'" class="button-default login-submit submit sidebar_submit">
			
			<input type="hidden" name="redirect_to" value="'.strip_tags( 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']).'">
			<input type="hidden" name="login_nonce" value="'.wp_create_nonce("logger-login-action").'">
			<input type="hidden" name="ajax_url" value="'.admin_url('admin-ajax.php').'">
			<div class="errorlogin"></div>
		</form>
	</div>';
	//'.(isset($a["forget"]) && $a["forget"] == "false"?'':'<a href="#">'.__("Forget","vbegy").'</a>').'
	endif;
	return $out;
}
function logger_login_shortcode() {
	add_shortcode("logger_login","logger_login");
}
add_action("init","logger_login_shortcode");
add_filter("the_content","do_shortcode");
add_filter("widget_text","do_shortcode");
function logger_login_jquery() {
	if ( isset( $_REQUEST['redirect_to'] ) ) $redirect_to = $_REQUEST['redirect_to']; else $redirect_to = admin_url();
	if ( is_ssl() && force_ssl_login() && !force_ssl_admin() && ( 0 !== strpos($redirect_to, 'https') ) && ( 0 === strpos($redirect_to, 'http') ) )$secure_cookie = false; else $secure_cookie = '';
	$user = wp_signon('', $secure_cookie);
	// Check the username
	if ( !$_POST['log'] ) :
		$user = new WP_Error();
		$user->add('empty_username', __('<strong>Error :&nbsp;</strong>please insert your name .','vbegy'));
	elseif ( !$_POST['pwd'] ) :
		$user = new WP_Error();
		$user->add('empty_username', __('<strong>Error :&nbsp;</strong>please insert your password .','vbegy'));
	endif;
	if (logger_is_ajax()) :
		// Result
		$result = array();
		if ( !is_wp_error($user) ) :
			$result['success'] = 1;
			$result['redirect'] = $redirect_to;
		else :
			$result['success'] = 0;
			foreach ($user->errors as $error) {
				$result['error'] = $error[0];
				break;
			}
		endif;
		echo json_encode($result);
		die();
	else :
		if ( !is_wp_error($user) ) :
			wp_redirect($redirect_to);
			exit;
		endif;
	endif;
	return $user;
}
if (!function_exists('logger_is_ajax')) {
	function logger_is_ajax() {
		if (defined('DOING_AJAX')) return true;
		if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') return true;
		return false;
	}
}
function logger_login_process() {
	global $logger_login_errors;
	if (isset($_POST['login-form']) && $_POST['login-form']) :
		$logger_login_errors = logger_login_jquery();
	endif;
}
add_action('init','logger_login_process');
function logger_ajax_login_process() {
	check_ajax_referer( 'logger-login-action', 'security' );
	logger_login_jquery();
	die();
}
add_action('wp_ajax_logger_ajax_login_process','logger_ajax_login_process');
add_action('wp_ajax_nopriv_logger_ajax_login_process','logger_ajax_login_process');
/* Signup shortcode */
add_shortcode('logger_signup', 'logger_signup_shortcode');
function logger_signup_shortcode($atts, $content = null) {
	global $user_identity,$posted;
	$a = shortcode_atts( array(
	    'dark_button' => '',
	), $atts );
	$out = '';
	if (is_user_logged_in()) {
		$user_login = get_userdata(get_current_user_id());
		$out .= '<div class="page-404">
			<h3>'.__("You are already registered !","vbegy").'</h3><a class="button-default" href="'.esc_url(home_url('/')).'">'.__("Back To Homepage","vbegy").'</a>
		</div>
		<div class="clearfix"></div>';
	}else {
		if (!is_user_logged_in()) {
		$rand_w = rand(1,1000);
		$out .= '
		<form method="post" class="signup_form logger_form" enctype="multipart/form-data">';
			do_action('logger_signup');
			$out .= '<div class="logger_error"></div>
				<div class="form-inputs clearfix">
					<p>
						<label for="user_name_'.$rand_w.'" class="required">'.__("Username","vbegy").'<span>*</span></label>
						<input type="text" class="required-item" name="user_name" id="user_name_'.$rand_w.'" value="'.(isset($posted["user_name"])?$posted["user_name"]:"").'">
					</p>
					<p>
						<label for="email_'.$rand_w.'" class="required">'.__("E-Mail","vbegy").'<span>*</span></label>
						<input type="email" class="required-item" name="email" id="email_'.$rand_w.'" value="'.(isset($posted["email"])?$posted["email"]:"").'">
					</p>
					<p>
						<label for="pass1_'.$rand_w.'" class="required">'.__("Password","vbegy").'<span>*</span></label>
						<input type="password" class="required-item" name="pass1" id="pass1_'.$rand_w.'" autocomplete="off">
					</p>
					<p>
						<label for="pass2_'.$rand_w.'" class="required">'.__("Confirm Password","vbegy").'<span>*</span></label>
						<input type="password" class="required-item" name="pass2" id="pass2_'.$rand_w.'" autocomplete="off">
					</p>';
					$profile_picture = vpanel_options("profile_picture");
					$profile_picture_required = vpanel_options("profile_picture_required");
					if ($profile_picture == "on") {
						$out .= '<label '.($profile_picture_required == "on"?'class="required"':'').' for="attachment_'.$rand_w.'">'.__('Profile Picture','vbegy').($profile_picture_required == "on"?'<span>*</span>':'').'</label>
						<div class="fileinputs">
							<input type="file" name="you_avatar" id="attachment_'.$rand_w.'">
							<div class="fakefile">
								<button type="button" class="small margin_0">'.__('Select file','vbegy').'</button>
								<span><i class="fa fa-arrow-up"></i>'.__('Browse','vbegy').'</span>
							</div>
						</div>';
					}
					$the_captcha = vpanel_options("the_captcha_register");
					$captcha_style = vpanel_options("captcha_style");
					$captcha_question = vpanel_options("captcha_question");
					$captcha_answer = vpanel_options("captcha_answer");
					$show_captcha_answer = vpanel_options("show_captcha_answer");
					if ($the_captcha == "on") {
						if ($captcha_style == "question_answer") {
							$out .= "
							<p class='logger_captcha_p'>
								<label for='logger_captcha' class='required'>".__("Captcha","vbegy")."<span>*</span></label>
								<input size='10' id='logger_captcha' name='logger_captcha' class='logger_captcha' value='' type='text'>
								<span class='form_desc logger_captcha_span'>".$captcha_question.($show_captcha_answer == "on"?" ( ".$captcha_answer." )":"")."</span>
							</p>";
						}else {
							$rand = rand(0000,9999);
							$out .= "
							<p class='logger_captcha_p'>
								<label for='logger_captcha_".$rand."' class='required'>".__("Captcha","vbegy")."<span>*</span></label>
								<input size='10' id='logger_captcha_".$rand."' name='logger_captcha' class='logger_captcha' value='' type='text'><img class='logger_captcha_img' src='".get_template_directory_uri()."/captcha/create_image.php' alt='".__("Captcha","vbegy")."' title='".__("Click here to update the captcha","vbegy")."' onclick=";$out .='"javascript:logger_get_captcha';$out .="('".get_template_directory_uri()."/captcha/create_image.php', 'logger_captcha_img_".$rand."');";$out .='"';$out .=" id='logger_captcha_img_".$rand."'>
								<span class='form_desc logger_captcha_span'>".__("Click on image to update the captcha .","vbegy")."</span>
							</p>";
						}
					}
				$out .= '</div>
				<p class="form-submit">
					<input type="hidden" name="redirect_to" value="'.strip_tags( 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']).'">
					<input type="submit" name="register" value="'.__("Signup","vbegy").'" class="button-default color '.(isset($a["dark_button"]) && $a["dark_button"] == "dark_button"?"dark_button":"").' small submit">
				</p>
		</form>';
		}
	}
	return $out;
}
function logger_signup_process() {
	global $posted;
	$errors = new WP_Error();
	if (isset($_POST['register']) && $_POST['register']) :
		// Process signup form
		$posted = array(
			'user_name'      => esc_html($_POST['user_name']),
			'email'          => esc_html($_POST['email']),
			'pass1'          => esc_html($_POST['pass1']),
			'pass2'          => esc_html($_POST['pass2']),
			'redirect_to' => esc_html($_POST['redirect_to']),
			'logger_captcha' => (isset($_POST['logger_captcha']) && $_POST['logger_captcha'] != ""?esc_html($_POST['logger_captcha']):""),
		);
		$posted = array_map('stripslashes', $posted);
		$posted['username'] = sanitize_user((isset($posted['username'])?$posted['username']:""));
		// Validation
		if ( empty($posted['user_name']) ) $errors->add('required-user_name',__("Please enter your name.","vbegy"));
		if ( empty($posted['email']) ) $errors->add('required-email',__("Please enter your email.","vbegy"));
		if ( empty($posted['pass1']) ) $errors->add('required-pass1',__("Please enter your password.","vbegy"));
		if ( empty($posted['pass2']) ) $errors->add('required-pass2',__("Please rewrite password.","vbegy"));
		if ( $posted['pass1']!==$posted['pass2'] ) $errors->add('required-pass1',__("Password does not match.","vbegy"));
		$the_captcha = vpanel_options("the_captcha_register");
		$captcha_style = vpanel_options("captcha_style");
		$captcha_question = vpanel_options("captcha_question");
		$captcha_answer = vpanel_options("captcha_answer");
		$show_captcha_answer = vpanel_options("show_captcha_answer");
		if ($the_captcha == "on") {
			if (empty($posted["logger_captcha"])) {
				$errors->add('required-captcha', __("There are required fields ( captcha ).","vbegy"));
			}
			if ($captcha_style == "question_answer") {
				if ($captcha_answer != $posted["logger_captcha"]) {
					$errors->add('required-captcha-error', __('The captcha is incorrect, please try again.','vbegy'));
				}
			}else {
				if ($_SESSION["security_code"] != $posted["logger_captcha"]) {
					$errors->add('required-captcha-error', __('The captcha is incorrect, please try again.','vbegy'));
				}
			}
		}
		$profile_picture = vpanel_options("profile_picture");
		$profile_picture_required = vpanel_options("profile_picture_required");
		if(isset($_FILES['you_avatar']) && !empty($_FILES['you_avatar']['name'])) :
			require_once(ABSPATH . "wp-admin" . '/includes/file.php');					
			require_once(ABSPATH . "wp-admin" . '/includes/image.php');
			$you_avatar = wp_handle_upload($_FILES['you_avatar'], array('test_form'=>false), current_time('mysql'));
			if ( isset($you_avatar['error']) ) :
				$errors->add('upload-error',  __('Error in upload the image : ','vbegy') . $you_avatar['error'] );
				return $errors;
			endif;
		else:
			if ($profile_picture_required == "on") {
				$errors->add('required-captcha', __("There are required fields ( Profile Picture ).","vbegy"));
			}
		endif;
		// Check the username
		if ( !validate_username( $posted['user_name'] ) || strtolower($posted['user_name'])=='admin' ) :
			$errors->add('required-user_name',__("Wrong name.","vbegy"));
		elseif ( username_exists( $posted['user_name'] ) ) :
			$errors->add('required-user_name',__("This account is already registered.","vbegy"));
		endif;
		// Check the e-mail address
		if ( !is_email( $posted['email'] ) ) :
			$errors->add('required-email',__("Please write correctly email.","vbegy"));
		elseif ( email_exists( $posted['email'] ) ) :
			$errors->add('required-email',__("This account is already registered.","vbegy"));
		endif;
		if ( $errors->get_error_code() ) return $errors;
		if ( !$errors->get_error_code() ) :
			do_action('register_post', $posted['user_name'], $posted['email'], $errors);
			$errors = apply_filters( 'registration_errors', $errors, $posted['user_name'], $posted['email'] );
			// if there are no errors, let's create the user account
			if ( !$errors->get_error_code() ) :
				$user_id = wp_create_user( $posted['user_name'], $posted['pass1'], $posted['email'] );
				if ( !$user_id ) :
					$errors->add('error', sprintf(__('<strong>Error</strong>: Sorry can not register please contact the webmaster ','vbegy'), get_option('admin_email')));
				else :
					if ($you_avatar) :
						update_user_meta($user_id,"you_avatar",$you_avatar["url"]);
					endif;
					$confirm_email = vpanel_options("confirm_email");
					if ($confirm_email == "on") {
						$activation = get_role("activation");
						if (!isset($activation)) {
							add_role("activation","activation",array('read' => false));
						}
						wp_update_user( array ('ID' => $user_id, 'role' => 'activation') ) ;
						$rand_a = rand(1,1000000000000);
						update_user_meta($user_id,"activation",$rand_a);
						$user_data = get_user_by("id",$user_id);
						$post_mail = "
						".__("Hi there","vbegy")."<br />
						
						".__("This is the link to activate your membership","vbegy")."<br />
						
						<a href=".add_query_arg(array("u" => $user_id,"activate" => $rand_a),esc_url(home_url('/'))).">".__("Activate","vbegy")."</a><br />
						
						";
						sendEmail(get_bloginfo("admin_email"),get_bloginfo('name'),esc_html($user_data->user_email),esc_html($user_data->display_name),__("Hi there","vbegy"),$post_mail);
					}else {
						wp_update_user( array ('ID' => $user_id, 'role' => 'subscriber') ) ;
					}
					wp_new_user_notification( $user_id, $posted['pass1'] );
					$secure_cookie = is_ssl() ? true : false;
					wp_set_auth_cookie($user_id, true, $secure_cookie);
					wp_safe_redirect((isset($posted['redirect_to']) && $posted['redirect_to'] != ""?$posted['redirect_to']:get_bloginfo(url)));
					exit;
				endif;
			endif;
		endif;
	endif;
	return;
}
function logger_signup() {
	if ($_POST) :
		$return = logger_signup_process();
		if (is_wp_error($return) ) :
			echo '<div class="logger_error"><strong><p>'.__("Error","vbegy").' :&nbsp;</strong>'.wptexturize(str_replace('<strong>'.__("Error","vbegy").'</strong>: ', '', $return->get_error_message())).'</p></div>';
   		endif;
	endif;
}
add_action('logger_signup', 'logger_signup');
/* Lostpassword shortcode */
add_shortcode('logger_lost_pass', 'logger_lost_pass');
function logger_lost_pass($atts, $content = null) {
	global $user_identity;
	$a = shortcode_atts( array(
	    'dark_button' => '',
	), $atts );
	$out = '';
	if (is_user_logged_in()) :
		$user_login = get_userdata(get_current_user_id());
		$out .= is_user_logged_in_data();
	else:
		do_action('logger_lost_password');
		$rand_w = rand(1,1000);
		$out .= '
		<form method="post" class="logger-lost-password logger_form" action="">
			<div class="logger_error"></div>
			<div class="form-inputs clearfix">
				<p>
					<label for="user_name_'.$rand_w.'" class="required">'.__("Username","vbegy").'<span>*</span></label>
					<input type="text" class="required-item" name="user_name" id="user_name_'.$rand_w.'">
				</p>
				<p>
					<label for="user_mail_'.$rand_w.'" class="required">'.__("E-Mail","vbegy").'<span>*</span></label>
					<input type="email" class="required-item" name="user_mail" id="user_mail_'.$rand_w.'">
				</p>
			</div>
			<p class="form-submit">
				<input type="submit" value="'.__("Reset","vbegy").'" class="button-default color '.(isset($a["dark_button"]) && $a["dark_button"] == "dark_button"?"dark_button":"").' small submit">
			</p>
		</form>';
	endif;
	return $out;
}
function logger_process_lost_pass() {
	global $posted, $wpdb;
	$errors = new WP_Error();
	$posted = array(
		'user_name' => esc_html($_POST['user_name']),
		'user_mail' => esc_html($_POST['user_mail']),
	);
	$posted = array_map('stripslashes', $posted);
	if ( empty($posted['user_name']) ) $errors->add('required-user_name',__("Please enter your name.","vbegy"));
	if ( empty($posted['user_mail']) ) $errors->add('required-user_mail',__("Please enter your email.","vbegy"));
	if (!username_exists($posted['user_name']) && !email_exists($posted['user_mail'])) {
		$errors->add('required-two',__("Name or Email is not correct.","vbegy"));
	}
	$get_user_by_mail = get_user_by('email',$posted['user_mail']);
	$get_user_by_name = get_user_by('login',$posted['user_name']);
	if ($get_user_by_name->ID != $get_user_by_mail->ID) {
		$errors->add('required-two',__("Name or Email is not correct.","vbegy"));
	}
	if ( $errors->get_error_code() ) return $errors;
	$pw 	= logger_generate_random();
	$pwdb	= md5(trim($pw));
	$query = $wpdb->prepare("UPDATE ".$wpdb->users." SET user_pass = '".$pwdb."' WHERE ID = %s",(int)$get_user_by_name->ID);
	$wpdb->get_results($query);
	$headers = 'From: '.get_bloginfo("name").' <'.get_bloginfo("admin_email").'>' . "\r\n";
	$send_text = '';
	$send_text .= "\r\n ".__("You are :","vbegy")." ".$posted['user_name'];
	$send_text .= "\r\n ".__("The New Password :")." ".$pw;
	wp_mail($posted['user_mail'],__("Your password","vbegy"),$send_text,$headers);
	return;
}
function logger_lost_pass_word() {
	if ($_POST) :
		$return = logger_process_lost_pass();
		if ( is_wp_error($return) ) :
   			echo '<div class="logger_error"><strong>'.__("Error","vbegy").' :&nbsp;'.$return->get_error_message().'</strong></div>';
   		else :
   			echo '<div class="logger_done"><strong>'.__("A reset password will be sent to this email address","vbegy").'</strong></div>';
   		endif;
	endif;
}
add_action('logger_lost_password', 'logger_lost_pass_word');
/* Generate random code */
function logger_generate_random($length = 6, $letters = '1234567890qwertyuiopasdfghjklzxcvbnm') {
	$s = '';
	$lettersLength = strlen($letters)-1;
	for($i = 0 ; $i < $length ; $i++) {
		$s .= $letters[rand(0,$lettersLength)];
	}
	return $s;
}
/* hex2rgb */
function hex2rgb ($hex) {
   $hex = str_replace("#","",$hex);
   if (strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   }else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return $rgb;
}
/* logger_edit_profile_shortcode */
add_shortcode('logger_edit_profile', 'logger_edit_profile_shortcode');
function logger_edit_profile_shortcode($atts, $content = null) {
	global $user_identity,$posted,$public_display;
	$out = '';
	if (!is_user_logged_in()) {
		$out .= '<div class="note_error"><strong>'.__("Please login to edit profile .","vbegy").'</strong></div>
		<div class="form-style form-style-3">
			'.do_shortcode("[logger_login]").'
		</div>';
	}else {
		do_action('logger_edit_profile_form');
		$out .= '<form class="edit-profile-form vpanel_form" method="post" enctype="multipart/form-data">';
		
			$user_info = get_userdata(get_current_user_id());
			$you_avatar = get_the_author_meta('you_avatar',$user_info->ID);
			$url = get_the_author_meta('url',$user_info->ID);
			$country = get_the_author_meta('country',$user_info->ID);
			$twitter = get_the_author_meta('twitter',$user_info->ID);
			$facebook = get_the_author_meta('facebook',$user_info->ID);
			$google = get_the_author_meta('google',$user_info->ID);
			$linkedin = get_the_author_meta('linkedin',$user_info->ID);
			$follow_email = get_the_author_meta('follow_email',$user_info->ID);
			
			$out .= '
			
			<div class="form-inputs clearfix">
				<p>
					<label>'.__("First Name","vbegy").'</label>
					<input name="first_name" id="first_name" type="text" value="'.$user_info->first_name.'">
				</p>
				<p>
					<label>'.__("Last Name","vbegy").'</label>
					<input name="last_name" id="last_name" type="text" value="'.$user_info->last_name.'">
				</p>
				<p>
					<label for="email" class="required">'.__("E-Mail","vbegy").'<span>*</span></label>
					<input name="email" id="email" type="email" value="'.$user_info->user_email.'">
				</p>
				<p>
					<label>'.__("Website","vbegy").'</label>
					<input name="url" id="url" type="text" value="'.$url.'">
				</p>
				<p>
					<label for="newpassword" class="required">'.__("Password","vbegy").'<span>*</span></label>
					<input name="pass1" id="newpassword" type="password" value="">
				</p>
				<p>
					<label for="newpassword2" class="required">'.__("Confirm Password","vbegy").'<span>*</span></label>
					<input name="pass2" id="newpassword2" type="password" value="">
				</p>
				<p>
					<label for="country">'.__("Country","vbegy").'</label>
					<input name="country" id="country" type="text" value="'.$country.'">
				</p>
				<p>
					<label for="follow_email">'.__("Follow-up email","vbegy").'</label>
					<input name="follow_email" id="follow_email" type="text" value="'.$follow_email.'">
				</p>
			</div>
			<div class="form-style form-style-2">';
				if ($you_avatar) {
					$you_avatar_img = get_aq_resize_url(esc_attr($you_avatar),"full",79,79);
					$out .= "<div class='user-profile-img'><img alt='".$user_info->display_name."' src='".$you_avatar_img."'></div>";
				}
				$out .= '
					<label for="you_avatar">'.__("Profile Picture","vbegy").'</label>
					<div class="fileinputs">
						<input type="file" name="you_avatar" id="you_avatar" value="'.$you_avatar.'">
						<div class="fakefile">
							<button type="button" class="small margin_0">Select file</button>
							<span><i class="fa fa-arrow-up"></i>Browse</span>
						</div>
					</div>
				<div class="clearfix"></div>
				<p></p>
				
				<p>
					<label for="description">'.__("About Yourself","vbegy").'</label>
					<textarea name="description" id="description" cols="58" rows="8">'.$user_info->description.'</textarea>
				</p>
			</div>
			<div class="form-inputs clearfix">
				<p>
					<label for="facebook">'.__("Facebook","vbegy").'</label>
					<input type="text" name="facebook" id="facebook" value="'.$facebook.'">
				</p>
				<p>
					<label for="twitter">'.__("Twitter","vbegy").'</label>
					<input type="text" name="twitter" id="twitter" value="'.$twitter.'">
				</p>
				<p>
					<label for="linkedin">'.__("Linkedin","vbegy").'</label>
					<input type="text" name="linkedin" id="linkedin" value="'.$linkedin.'">
				</p>
				<p>
					<label for="google">'.__("Google plus","vbegy").'</label>
					<input type="text" name="google" id="google" value="'.$google.'">
				</p>
			</div>
			
			<p class="form-submit">
				<input type="hidden" name="action" value="update">
				<input type="hidden" name="admin_bar_front" value="1">
				<input type="hidden" name="user_id" id="user_id" value="'.$user_info->ID.'">
				<input type="hidden" name="user_login" id="user_login" value="'.$user_info->user_login.'">
				<input type="submit" value="'.__("Edit","vbegy").'" class="button-default color small login-submit submit">
			</p>
		
		</form>';
	}
	return $out;
}
/* aau_sanitize_user */
function aau_sanitize_user($username, $raw_username, $strict) {
	$username = wp_strip_all_tags( $raw_username );
	$username = remove_accents( $username );
	$username = preg_replace( '|%([a-fA-F0-9][a-fA-F0-9])|', '', $username );
	$username = preg_replace( '/&.+?;/', '', $username ); // Kill entities

	if ( $strict )
		$username = preg_replace( '|[^a-z\p{Arabic}0-9 _.\-@]|iu', '', $username );

	$username = trim( $username );
	$username = preg_replace( '|\s+|', ' ', $username );

	return $username;
}
add_filter('sanitize_user', 'aau_sanitize_user', 10, 3);
/* lenient_username */
add_filter('sanitize_user', 'lenient_username', 1, 3);
function lenient_username($username, $raw_username, $strict) {
	$username = $raw_username;
	$username = wp_strip_all_tags( $username );
	$username = remove_accents( $username );
	$username = preg_replace('|[^a-z0-9 _.\-@ضصثقفغعهخحجدذشسيبلاتنمك طئءؤـرلاىةوزظًٌَُّلإإألأٍِ~ْلآآ]|i', '', $username); 
	$username = preg_replace( '/&.+?;/', '', $username );
	$username = preg_replace( '|\s+|', ' ', $username );
	return $username;
}
?>