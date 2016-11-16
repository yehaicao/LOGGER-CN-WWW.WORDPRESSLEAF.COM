<?php
ob_start();
function logger_members_only() {
	if (!is_user_logged_in()) logger_redirect_login();
}
/* logger_redirect_login */
function logger_redirect_login() {
	if (vpanel_options("login_page") != "") {
		wp_redirect(get_permalink(vpanel_options("login_page")));
	}else {
		wp_redirect(wp_login_url(home_url()));
	}
	exit;
}
/* logger_get_filesize */
if (!function_exists('logger_get_filesize')) {
	function logger_get_filesize( $file ) { 
		$bytes = filesize($file);
		$s = array('b', 'Kb', 'Mb', 'Gb');
		$e = floor(log($bytes)/log(1024));
		return sprintf('%.2f '.$s[$e], ($bytes/pow(1024, floor($e))));
	}
}
/* logger_human_time_diff */
if (!function_exists('logger_human_time_diff')) {
	function logger_human_time_diff( $date ) { 
		
		if (strtotime($date)<strtotime('NOW -7 day')) return date('jS F Y', strtotime($date));
		else return human_time_diff(strtotime($date), current_time('timestamp')) . __(' ago ','vbegy');
	}
}
/* sendEmail */
function sendEmail($fromEmail,$fromEmailName,$toEmail,$toEmailName,$subject,$message,$extra='') {
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
	$headers .= 'To: '.$toEmailName.' <'.$toEmail.'>' . "\r\n";
	$headers .= 'From: '.$fromEmailName.' <'.$fromEmail.'>' . "\r\n";
	if(wp_mail( $toEmail, $subject, $message, $headers )) {
		
	}else {
		@mail($toEmail, $subject, $message, $headers);
	}
}
/* logger_comment_before */
add_filter ('preprocess_comment', 'logger_comment_before');
function logger_comment_before($commentdata) {
	if (!is_admin() && get_post_type($commentdata->comment_post_ID) != "product") {
		$the_captcha = vpanel_options("the_captcha_comment");
		$captcha_style = vpanel_options("captcha_style");
		$captcha_question = vpanel_options("captcha_question");
		$captcha_answer = vpanel_options("captcha_answer");
		$show_captcha_answer = vpanel_options("show_captcha_answer");
		if ($the_captcha == "on") {
			if (empty($_POST["logger_captcha"])) {
				wp_die(__("There are required fields ( captcha ).","vbegy"));
			}
			if ($captcha_style == "question_answer") {
				if ($captcha_answer != $_POST["logger_captcha"]) {
					wp_die(__('The captcha is incorrect, please try again.','vbegy'));
				}
			}else {
				if ($_SESSION["security_code"] != $_POST["logger_captcha"]) {
					wp_die(__('The captcha is incorrect, please try again.','vbegy'));
				}
			}
		}
	}
	return $commentdata;
}
/* vbegy_session */
function vbegy_session ($message = ""){
	$post_publish = vpanel_options("post_publish");
	if ($post_publish == "draft") {
		if(!session_id())
			session_start();
		if ($message) {
			$_SESSION['vbegy_session'] = $message;
		}else {
			if (isset($_SESSION['vbegy_session'])) {
				$last_message = $_SESSION['vbegy_session'];
				unset($_SESSION['vbegy_session']);
				echo $last_message;
			}
		}
	}
}
/* new_post */
function new_post() {
	global $vpanel_emails,$vpanel_emails_2,$vpanel_emails_3;
	if ($_POST) :
		$return = process_new_posts();
		if ( is_wp_error($return) ) :
   			echo '<div class="logger_error"><span><p>'.$return->get_error_message().'</p></span></div>';
   		else :
   			$post_publish = vpanel_options("post_publish");
   			if ($post_publish == "draft") {
				if(!session_id()) session_start();
				$_SESSION['vbegy_session'] = '<div class="alert-message success"><i class="fa fa-check"></i><p><span>'.__("Added been successfully","vbegy").'</span><br>'.__("Has been added successfully, the post under review .","vbegy").'</p></div>';
				wp_redirect(get_bloginfo('url'));
			}else {
				$get_post = get_post($return);
				wp_redirect(get_permalink($return));
			}
			exit;
   		endif;
	endif;
}
add_action('new_post', 'new_post');
/* process_new_posts */
function process_new_posts() {
	global $posted;
	set_time_limit(0);
	$errors = new WP_Error();
	$posted = array();
	$add_post_no_register = vpanel_options("add_post_no_register");
	
	$fields = array(
		'title','comment','category','post_tag','attachment','ask_captcha','username','email'
	);
	
	foreach ($fields as $field) :
		if (isset($_POST[$field])) $posted[$field] = trim(stripslashes(htmlspecialchars($_POST[$field]))); else $posted[$field] = '';
	endforeach;
	
	if (!is_user_logged_in() && $add_post_no_register == "on") {
		if (empty($posted['username'])) $errors->add('required-field', '<strong>'.__("Error","vbegy").' :&nbsp;</strong> '.__("There are required fields ( username ).","vbegy"));
		if (empty($posted['email'])) $errors->add('required-field', '<strong>'.__("Error","vbegy").' :&nbsp;</strong> '.__("There are required fields ( email ).","vbegy"));
	}
	
	/* Validate Required Fields */
	if (empty($posted['title'])) $errors->add('required-field', '<strong>'.__("Error","vbegy").' :&nbsp;</strong> '.__("There are required fields ( title ).","vbegy"));
	if (empty($posted['category']) || $posted['category'] == '-1') $errors->add('required-field', '<strong>'.__("Error","vbegy").' :&nbsp;</strong> '.__("There are required fields ( category ).","vbegy"));
	if (vpanel_options("content_post") == "on") {
		if (empty($posted['comment'])) $errors->add('required-field', '<strong>'.__("Error","vbegy").' :&nbsp;</strong> '.__("There are required fields ( comment ).","vbegy"));
	}
	
	$the_captcha = vpanel_options("the_captcha");
	$captcha_style = vpanel_options("captcha_style");
	$captcha_question = vpanel_options("captcha_question");
	$captcha_answer = vpanel_options("captcha_answer");
	$show_captcha_answer = vpanel_options("show_captcha_answer");
	if ($the_captcha == "on") {
		if (empty($posted["ask_captcha"])) {
			$errors->add('required-captcha', __("There are required fields ( captcha ).","vbegy"));
		}
		if ($captcha_style == "question_answer") {
			if ($captcha_answer != $posted["ask_captcha"]) {
				$errors->add('required-captcha-error', __('The captcha is incorrect, please try again.','vbegy'));
			}
		}else {
			if (isset($_SESSION["security_code"]) && $_SESSION["security_code"] != $posted["ask_captcha"]) {
				$errors->add('required-captcha-error', __('The captcha is incorrect, please try again.','vbegy'));
			}
		}
	}
	
	$attachment = '';

	require_once(ABSPATH . "wp-admin" . '/includes/image.php');
	require_once(ABSPATH . "wp-admin" . '/includes/file.php');
		
	if(isset($_FILES['attachment']) && !empty($_FILES['attachment']['name'])) :
			
		$attachment = wp_handle_upload($_FILES['attachment'], array('test_form'=>false), current_time('mysql'));
					
		if ( isset($attachment['error']) ) :
			$errors->add('upload-error', __("Attachment Error: ","vbegy") . $attachment['error'] );
			
			return $errors;
		endif;
		
	endif;
	
	if (sizeof($errors->errors)>0) return $errors;
	
	/* Create post */
	$post_publish = vpanel_options("post_publish");
	$data = array(
		'post_content' => esc_attr($posted['comment']),
		'post_title' => esc_attr($posted['title']),
		'post_status' => ($post_publish == "draft"?"draft":"publish"),
		'post_author' => (!is_user_logged_in() && $add_post_no_register == "on"?0:get_current_user_id()),
		'post_type' => 'post',
	);
		
	$post_id = wp_insert_post($data);
		
	if ($post_id==0 || is_wp_error($post_id)) wp_die(__("Error in post.","vbegy"));
	
	$terms = array();
	if ($posted['category']) $terms[] = get_term_by( 'id', $posted['category'], 'category')->slug;
	if (sizeof($terms)>0) wp_set_object_terms($post_id, $terms, 'category');
	
	if ($attachment) :
		$attachment_data = array(
			'post_mime_type' => $attachment['type'],
			'post_title' => preg_replace('/\.[^.]+$/', '', basename($attachment['file'])),
			'post_content' => '',
			'post_status' => 'inherit',
			'post_author' => (!is_user_logged_in() && $add_post_no_register == "on"?0:get_current_user_id())
		);
		$attachment_id = wp_insert_attachment( $attachment_data, $attachment['file'], $post_id );
		$attachment_metadata = wp_generate_attachment_metadata( $attachment_id, $attachment['file'] );
		wp_update_attachment_metadata( $attachment_id,  $attachment_metadata );
		set_post_thumbnail( $post_id, $attachment_id );
	endif;
	
	/* Tags */
	
	if (isset($posted['post_tag']) && $posted['post_tag']) :
				
		$tags = explode(',', trim(stripslashes($posted['post_tag'])));
		$tags = array_map('strtolower', $tags);
		$tags = array_map('trim', $tags);

		if (sizeof($tags)>0) :
			wp_set_object_terms($post_id, $tags, 'post_tag');
		endif;
		
	endif;
	
	if (!is_user_logged_in() && $add_post_no_register == "on" && get_current_user_id() == 0) {
		$post_username = esc_attr($posted['username']);
		$post_email = esc_attr($posted['email']);
		update_post_meta($post_id, 'post_username', $post_username);
		update_post_meta($post_id, 'post_email', $post_email);
	}
	
	/* The default meta */
	update_post_meta($post_id, "vbegy_layout", "default");
	update_post_meta($post_id, "vbegy_home_template", "default");
	update_post_meta($post_id, "vbegy_site_skin_l", "default");
	update_post_meta($post_id, "vbegy_skin", "default_color");
	update_post_meta($post_id, "vbegy_sidebar", "default");

	do_action('new_posts', $post_id);
	
	/* Successful */
	return $post_id;
}
/* run_on_update_post */
function run_on_update_post($post_ID) {
    $post_username = get_post_meta($post_ID, 'post_username', true);
    $post_email = get_post_meta($post_ID, 'post_email', true);
    if (isset($post_username) && $post_username != "" && isset($post_email) && $post_email != "") {
        $data = array(
        	'ID' => $post_ID,
        	'post_author' => "No_user",
        );
		remove_action( 'save_post', 'run_on_update_post');
		add_filter('wp_insert_post_data', 'update_post_slug');
		wp_update_post($data);
		remove_filter('wp_insert_post_data', array(&$this, 'update_post_slug'));
		add_action('save_post', 'run_on_update_post');
    }
}
add_action('save_post', 'run_on_update_post');
/* vpanel_edit_post */
function vpanel_edit_post() {
	if ($_POST) :
		$return = process_vpanel_edit_posts();
		if ( is_wp_error($return) ) :
   			echo '<div class="logger_error"><span><p>'.$return->get_error_message().'</p></span></div>';
   		else :
   			if(!session_id()) session_start();
   			$_SESSION['vbegy_session_e'] = '<div class="alert-message success"><i class="fa fa-check"></i><p><span>'.__("Edited been successfully","vbegy").'</span><br>'.__("Has been edited successfully .","vbegy").'</p></div>';
			wp_redirect(get_permalink($return));
			exit;
   		endif;
	endif;
}
add_action('vpanel_edit_post', 'vpanel_edit_post');
/* process_vpanel_edit_posts */
function process_vpanel_edit_posts() {
	global $posted;
	set_time_limit(0);
	$errors = new WP_Error();
	$posted = array();
	
	$fields = array(
		'ID','title','comment','category','attachment','post_tag'
	);
	
	foreach ($fields as $field) :
		if (isset($_POST[$field])) $posted[$field] = trim(stripslashes(htmlspecialchars($_POST[$field]))); else $posted[$field] = '';
	endforeach;
	/* Validate Required Fields */
	
	$get_post = (isset($posted['ID'])?(int)$posted['ID']:0);
	$get_post_q = get_post($get_post);
	if (isset($get_post) && $get_post != 0 && $get_post_q && get_post_type($get_post) == "post") {
		$user_login_id_l = get_user_by("id",$get_post_q->post_author);
		if ($user_login_id_l->ID != get_current_user_id()) {
			$errors->add('required-field', '<strong>'.__("Error","vbegy").' :&nbsp;</strong> '.__("Sorry you can't edit this post .","vbegy"));
		}
	}else {
		$errors->add('required-field', '<strong>'.__("Error","vbegy").' :&nbsp;</strong> '.__("Sorry no post select or not found .","vbegy"));
	}
	if (empty($posted['title'])) $errors->add('required-field', '<strong>'.__("Error","vbegy").' :&nbsp;</strong> '.__("There are required fields ( title ).","vbegy"));
	if (empty($posted['category']) || $posted['category'] == '-1') $errors->add('required-field', '<strong>'.__("Error","vbegy").' :&nbsp;</strong> '.__("There are required fields ( category ).","vbegy"));
	
	if (vpanel_options("content_post") == "on") {
		if (empty($posted['comment'])) $errors->add('required-field', '<strong>'.__("Error","vbegy").' :&nbsp;</strong> '.__("There are required fields ( comment ).","vbegy"));
	}
	if (sizeof($errors->errors)>0) return $errors;
	
	$post_id = $get_post;
	
	/* Edit post */
	$data = array(
		'ID' => esc_attr($post_id),
		'post_content' => esc_attr($posted['comment']),
		'post_title' => esc_attr($posted['title']),
		'post_name' => esc_attr($posted['title']),
	);
	
	wp_update_post($data);
	
	$terms = array();
	if ($posted['category']) $terms[] = get_term_by( 'id', $posted['category'], 'category')->slug;
	if (sizeof($terms)>0) wp_set_object_terms($post_id, $terms, 'category');
	
	$attachment = '';

	require_once(ABSPATH . "wp-admin" . '/includes/image.php');
	require_once(ABSPATH . "wp-admin" . '/includes/file.php');
		
	if(isset($_FILES['attachment']) && !empty($_FILES['attachment']['name'])) :
			
		$attachment = wp_handle_upload($_FILES['attachment'], array('test_form'=>false), current_time('mysql'));
					
		if ( isset($attachment['error']) ) :
			$errors->add('upload-error', __("Attachment Error: ","vbegy") . $attachment['error'] );
			
			return $errors;
		endif;
		
	endif;
	if ($attachment) :
		$attachment_data = array(
			'post_mime_type' => $attachment['type'],
			'post_title' => preg_replace('/\.[^.]+$/', '', basename($attachment['file'])),
			'post_content' => '',
			'post_status' => 'inherit',
			'post_author' => (!is_user_logged_in() && $add_post_no_register == "on"?0:get_current_user_id())
		);
		$attachment_id = wp_insert_attachment( $attachment_data, $attachment['file'], $post_id );
		$attachment_metadata = wp_generate_attachment_metadata( $attachment_id, $attachment['file'] );
		wp_update_attachment_metadata( $attachment_id,  $attachment_metadata );
		set_post_thumbnail( $post_id, $attachment_id );
	endif;
	
	/* Tags */
	
	if (isset($posted['post_tag']) && $posted['post_tag']) :
				
		$tags = explode(',', trim(stripslashes($posted['post_tag'])));
		$tags = array_map('strtolower', $tags);
		$tags = array_map('trim', $tags);

		if (sizeof($tags)>0) :
			wp_set_object_terms($post_id, $tags, 'post_tag');
		endif;
		
	endif;

	do_action('vpanel_edit_posts', $post_id);
	
	/* Successful */
	return $post_id;
}
/* vbegy_session_edit */
function vbegy_session_edit ($message = ""){
	if(!session_id())
		session_start();
	if ($message) {
		$_SESSION['vbegy_session_e'] = $message;
	}else {
		if (isset($_SESSION['vbegy_session_e'])) {
			$last_message = $_SESSION['vbegy_session_e'];
			unset($_SESSION['vbegy_session_e']);
			echo $last_message;
		}
	}
}
/* vbegy_session_activate */
function vbegy_session_activate ($message = ""){
	if(!session_id())
		session_start();
	if ($message) {
		$_SESSION['vbegy_session_a'] = $message;
	}else {
		if (isset($_SESSION['vbegy_session_a'])) {
			$last_message = $_SESSION['vbegy_session_a'];
			unset($_SESSION['vbegy_session_a']);
			echo $last_message;
		}
	}
}
/* logger_process_edit_profile_form */
function logger_process_edit_profile_form() {
	global $posted;
	require_once(ABSPATH . 'wp-admin/includes/user.php');
	require_once(ABSPATH . "wp-admin" . '/includes/image.php');
	require_once( ABSPATH . 'wp-admin/includes/file.php' );
	$errors = new WP_Error();
	$posted = array(
		'email' => esc_html($_POST['email']),
		'pass1' => esc_html($_POST['pass1']),
		'pass2' => esc_html($_POST['pass2']),
	);
	
	if (empty($posted['email'])) $errors->add('required-field', '<strong>'.__("Error","vbegy").' :&nbsp;</strong> '.__("There are required fields.","vbegy"));
	if ($posted['pass1'] !== $posted['pass2']) $errors->add('required-field', '<strong>'.__("Error","vbegy").' :&nbsp;</strong> '.__("Password does not match.","vbegy"));
	
	if (sizeof($errors->errors)>0) return $errors;
	
	$current_user = wp_get_current_user();
	isset($_POST['admin_bar_front'] ) ? 'true' : 'false';
	$get_you_avatar = get_user_meta(get_current_user_id(),"you_avatar",true);
	$errors = edit_user(get_current_user_id());
	if ( is_wp_error( $errors ) ) return $errors;
	do_action('personal_options_update', get_current_user_id());
	
	if(isset($_FILES['you_avatar']) && !empty($_FILES['you_avatar']['name'])) :
		$you_avatar = wp_handle_upload($_FILES['you_avatar'], array('test_form'=>false), current_time('mysql'));
		if ($you_avatar) :
			update_user_meta(get_current_user_id(),"you_avatar",$you_avatar["url"]);
		endif;
		if ( isset($you_avatar['error']) ) :
			$errors->add('upload-error',  __('Error in upload the image : ','vbegy') . $you_avatar['error'] );
			return $errors;
		endif;
	else:
		update_user_meta(get_current_user_id(),"you_avatar",$get_you_avatar);
	endif;
	
	return;
}
/* logger_edit_profile_form */
function logger_edit_profile_form() {
	if ($_POST) :
		$return = logger_process_edit_profile_form();
		if ( is_wp_error($return) ) :
   			echo '<div class="logger_error"><span><p>'.$return->get_error_message().'</p></span></div>';
   		else :
   			echo '<div class="logger_done"><span><p>'.__("Profile has been updated","vbegy").'</p></span></div>';
   		endif;
	endif;
}
add_action('logger_edit_profile_form', 'logger_edit_profile_form');
/* remove_item_by_value */
function remove_item_by_value($array, $val = '', $preserve_keys = true) {
	if (empty($array) || !is_array($array)) return false;
	if (!in_array($val, $array)) return $array;
	
	foreach($array as $key => $value) {
		if ($value == $val) unset($array[$key]);
	}
	
	return ($preserve_keys === true) ? $array : array_values($array);
}
/* excerpt_row */
function excerpt_row($excerpt_length,$content) {
	global $post;
	$words = explode(' ', $content, $excerpt_length + 1);
	if(count($words) > $excerpt_length) :
		array_pop($words);
		array_push($words, '...');
		$content = implode(' ', $words);
	endif;
		$content = strip_tags($content);
	echo esc_attr($content);
}
/* excerpt_title_row */
function excerpt_title_row($excerpt_length,$title) {
	global $post;
	$words = explode(' ', $title, $excerpt_length + 1);
	if(count($words) > $excerpt_length) :
		array_pop($words);
		array_push($words, '');
		$title = implode(' ', $words);
	endif;
		$title = strip_tags($title);
	echo esc_attr($title);
}