<?php
/* excerpt */
function excerpt ($excerpt_length) {
	global $post;
	$content = $post->post_content;
	$content = apply_filters('the_content', strip_shortcodes($content));
	$excerpt_type = vpanel_options("excerpt_type");
	if ($excerpt_type == "characters") {
		$content = mb_substr($content,0,$excerpt_length,"UTF-8");
	}else {
		$words = explode(' ',$content,$excerpt_length + 1);
		if (count($words) > $excerpt_length) :
			array_pop($words);
			array_push($words,'');
			$content = implode(' ',$words);
		endif;
	}
	$content = strip_tags($content);
	echo esc_attr($content).'...';
}
/* excerpt_title */
function excerpt_title ($excerpt_length) {
	global $post;
	$title = $post->post_title;
	$excerpt_type = vpanel_options("excerpt_type");
	if ($excerpt_type == "characters") {
		$title = mb_substr($title,0,$excerpt_length,"UTF-8");
	}else {
		$words = explode(' ',$title,$excerpt_length + 1);
		if (count($words) > $excerpt_length) :
			array_pop($words);
			array_push($words,'');
			$title = implode(' ',$words);
		endif;
	}
	$title = strip_tags($title);
	echo esc_attr($title);
}
/* excerpt_any */
function excerpt_any($excerpt_length,$title) {
	$words = explode(' ',$title,$excerpt_length + 1);
	if (count($words) > $excerpt_length) :
		array_pop($words);
		array_push($words,'');
		$title = implode(' ',$words);
	endif;
		$title = strip_tags($title);
	return $title;
}
/* add post-thumbnails */
add_theme_support('post-thumbnails');
/* get_aq_resize_img */
function get_aq_resize_img($thumbnail_size,$img_width_f,$img_height_f,$img_lightbox="") {
	$thumb = get_post_thumbnail_id();
	if ($thumb != "") {
		$img_url = wp_get_attachment_url($thumb,$thumbnail_size);
		$img_width = $img_width_f;
		$img_height = $img_height_f;
		$image = aq_resize($img_url,$img_width,$img_height,true);
		if ($image) {
			$last_image = $image;
		}else {
			$last_image = "http://placehold.it/".$img_width_f."x".$img_height_f;
		}
		return ($img_lightbox == "lightbox"?"<a href='".$img_url."'>":"")."<img alt='".get_the_title()."' width='".$img_width."' height='".$img_height."' src='".$last_image."'>".($img_lightbox == "lightbox"?"</a>":"");
	}else {
		return ($img_lightbox == "lightbox"?"<a href='".$img_url."'>":"")."<img alt='".get_the_title()."' src='".vpanel_image()."'>".($img_lightbox == "lightbox"?"</a>":"");
	}
}
/* get_aq_resize_img_url */
function get_aq_resize_img_url($url,$thumbnail_size,$img_width_f,$img_height_f) {
	$thumb = $url;
	if ($thumb != "") {
		$img_url = $thumb;
		$img_width = $img_width_f;
		$img_height = $img_height_f;
		$image = aq_resize($img_url,$img_width,$img_height,true);
		if ($image) {
			$last_image = $image;
		}else {
			$last_image = "http://placehold.it/".$img_width_f."x".$img_height_f;
		}
		return "<img alt='".get_the_title()."' width='".$img_width."' height='".$img_height."' src='".$last_image."'>";
	}else {
		return "<img alt='".get_the_title()."' src='".vpanel_image()."'>";
	}
}
/* get_aq_resize_url */
function get_aq_resize_url($url,$thumbnail_size,$img_width_f,$img_height_f) {
	$img_url = $url;
	$img_width = $img_width_f;
	$img_height = $img_height_f;
	$image = aq_resize($img_url,$img_width,$img_height,true);
	if ($image) {
		$last_image = $image;
	}else {
		$last_image = "http://placehold.it/".$img_width_f."x".$img_height_f;
	}
	return $last_image;
}
/* get_aq_resize_img_full */
function get_aq_resize_img_full($thumbnail_size) {
	$thumb = get_post_thumbnail_id();
	if ($thumb != "") {
		$img_url = wp_get_attachment_url($thumb,$thumbnail_size);
		$image = $img_url;
		return "<img alt='".get_the_title()."' src='".$image."'>";
	}else {
		return "<img alt='".get_the_title()."' src='".vpanel_image()."'>";
	}
}
/* vpanel_image */
function vpanel_image() {
	global $post;
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i',$post->post_content,$matches);
	if (isset($matches[1][0])) {
		return $matches[1][0];
	}else {
		return false;
	}
}
/* vpanel_wp_title */
function vpanel_wp_title ($title, $sep) {
    global $paged,$page;
    if (is_feed())
        return $title;

    $title .= get_bloginfo('name','display');

    $site_description = get_bloginfo('description','display');
    if ($site_description && ( is_home() || is_front_page()))
        $title = "$title $sep $site_description";

    if ($paged >= 2 || $page >= 2)
        $title = "$title $sep ".sprintf(__('Page %s','vbegy'),max($paged,$page));

    return $title;
}
add_filter( 'wp_title', 'vpanel_wp_title', 10, 2 );
/* formatMoney */
function formatMoney($number,$fractional=false) {
    if ($fractional) {
        $number = sprintf('%.2f',$number);
    }
    while (true) {
        $replaced = preg_replace('/(-?\d+)(\d\d\d)/','$1,$2',$number);
        if ($replaced != $number) {
            $number = $replaced;
        }else {
            break;
        }
    }
    return $number;
}
/* vpanel_google_fonts */
function vpanel_google_fonts () {
	$path = get_template_directory().'/admin/includes/webfonts.json';
	$data = file_get_contents($path);
	$json_a = json_decode($data,  true);
	$items = $json_a['items'];
	$i = 0;
	$faces = array();
	if (is_array($items)) {
		foreach ($items as $item) {
			$i++;
			$str = $item['family'];
			
			$variants = $item['variants'];
			$variants = '';
			$variantCount = 0;
			foreach ($item['variants'] as $variant) {
				$variantCount++;
				if ($variantCount>1) { $variants .= '|'; }
				$variants .= $variant;
			}
			$faces[ $str . ':' . $variants ] = $str;
		}
	}
	$safe_fonts = array(
		'default' =>'Default font',
		'georgia' =>'Georgia',
		'Microsoft YaHei' =>'Microsoft YaHei',
		'arial'=>'Arial',
		'verdana'=>'Verdana, Geneva',
		'trebuchet'=>'Trebuchet',
		'times'=>'Times New Roman',
		'tahoma'=>'Tahoma, Geneva',
		'palatino'=>'Palatino',
		'helvetica'=>'Helvetica',
		'museo_slab' => 'Museo Slab'
	);
	return $safe_fonts + $faces;
}
/* vpanel_font_extract */
function vpanel_font_extract($main_font) {
	if (isset($main_font["face"])) {
        $font_explode = explode(":", $main_font["face"]);
        $font_name = str_replace (" ","+", $font_explode[0] );
        if ($font_name != "georgia" && $font_name != "arial" && $font_name != "verdana" && $font_name != "trebuchet" && $font_name != "times" && $font_name != "tahoma" && $font_name != "palatino" && $font_name != "helvetica" && $font_name != "museo_slab") {
	        $font_css = str_replace (" ","-", $font_explode[0] );
	        $font_variants = "";
	        if (isset($font_explode[1])) {
	        	$font_variants = str_replace ("|",",", $font_explode[1] );
	        }
	        $protocol = is_ssl() ? 'https' : 'http';
	        if (isset($font_name) && $font_name != "default") {
	        	if ($font_variants == "earlyaccess") {
	        		$font_name = strtolower(str_replace (" ","", $font_explode[0] ));
	        		wp_enqueue_style( $font_name , $protocol.'://fonts.googleapis.com/earlyaccess/'.$font_name );
	        	}else {
	        		wp_enqueue_style( strtolower($font_css) , $protocol.'://fonts.googleapis.com/css?family='.$font_name . ':' . $font_variants );
	        	}
	        }
        }
	}
}
/* get_twitter_count */
function get_twitter_count($twitter_username) {
	$count = get_transient('vpanel_twitter_followers');
	$consumer_key 			= vpanel_options('twitter_consumer_key');
	$consumer_secret		= vpanel_options('twitter_consumer_secret');
	$access_token 			= vpanel_options('twitter_access_token');
	$access_token_secret 	= vpanel_options('twitter_access_token_secret');
	if ($count !== false) return $count;
	$count = 0;
	if ($twitter_username != "" && $consumer_key != "" && $consumer_secret != "" && $access_token != "" && $access_token_secret != "") {
		try {
			$twitterConnection = new TwitterOAuth( $consumer_key , $consumer_secret , $access_token , $access_token_secret	);
			$twitterData = $twitterConnection->get('users/show', array('screen_name' => $twitter_username));
			$twitter['page_url'] = 'http://www.twitter.com/'.$twitter_username;
			$twitter['followers_count'] = $twitterData->followers_count;;
		}catch (Exception $e) {
			$twitter['page_url'] = 'http://www.twitter.com/'.$twitter_username;
			$twitter['followers_count'] = 0;
		}
		$count = $twitter['followers_count'];
		set_transient('vpanel_twitter_followers', $count, 60*60*24);
		return $count;
	}
}
/* vpanel_counter_facebook */
function vpanel_counter_facebook ($page_id, $return = 'count') {
	$count = get_transient('vpanel_facebook_followers');
	$link = get_transient('vpanel_facebook_page_url');
	if ($return == 'link') {
		if ($link !== false) return $link;
	}else {
		if ($count !== false) return $count;
	}
	$count = 0;
	$link = '';
	$access_token = vpanel_options('facebook_access_token');
	$data = wp_remote_get('https://graph.facebook.com/' . $page_id.'?fields=about,likes,link,is_published,username,category&access_token=' . $access_token);
	if (!is_wp_error($data)) {
		$json = json_decode( $data['body'], true );
		$count = intval($json['likes']);
		$link = $json['link'];
		set_transient('vpanel_facebook_followers', $count, 60*60*24);
		set_transient('vpanel_facebook_page_url', $link, 60*60*24);
	}
	if ($return == 'link') {
		return $link;
	}else {
		return $count;
	}
}
/* vpanel_counter_googleplus */
function vpanel_counter_googleplus ($page_id, $return = 'count') {
	$count = get_transient('vpanel_googleplus_followers');
	$link = get_transient('vpanel_googleplus_page_url');
	if ($return == 'link') {
		if ($link !== false) return $link;
	}else {
		if ($count !== false) return $count;
	}
	$count = 0;
	$link = '';
	$api_key = vpanel_options('google_api');
	$data = wp_remote_get('https://www.googleapis.com/plus/v1/people/'.$page_id.'?key='.$api_key);
	if (!is_wp_error($data)) {
		$json = json_decode( $data['body'], true );
		$count = isset($json['circledByCount']) ? intval($json['circledByCount']) : intval($json['plusOneCount']);
		$link = $json['url'];
		set_transient('vpanel_googleplus_followers', $count, 60*60*24);
		set_transient('vpanel_googleplus_page_url', $link, 60*60*24);
	}
	if ($return == 'link') {
		return $link;
	}else {
		return $count;
	}
}
/* vpanel_counter_dribbble */
function vpanel_counter_dribbble ($dribbble, $return = 'count') {
	$count = get_transient('vpanel_dribbble_followers');
	$link = get_transient('vpanel_dribbble_page_url');
	$access_token = vpanel_options('dribbble_access_token');
	if ($return == 'link') {
		if ($link !== false) return $link;
	}else {
		if ($count !== false) return $count;
	}
	$count = 0;
	$link = '';
	$data = wp_remote_get('https://api.dribbble.com/v1/users/'.$dribbble.'/?user='.$dribbble.'&access_token='.$access_token);
	if (!is_wp_error($data)) {
		$json = json_decode( $data['body'], true );
		$count = intval($json['followers_count']);
		$link = $json['html_url'];
		set_transient('vpanel_dribbble_followers', $count, 60*60*24);
		set_transient('vpanel_dribbble_page_url', $link, 60*60*24);
	}
	if ($return == 'link') {
		return $link;
	}else {
		return $count;
	}
}
/* vpanel_counter_youtube */
function vpanel_counter_youtube ($youtube, $return = 'count') {
	$count = get_transient('vpanel_youtube_followers');
	$api_key = vpanel_options('google_api');
	if ($count !== false) return $count;
	$count = 0;
	$data = wp_remote_get('https://www.googleapis.com/youtube/v3/channels?part=statistics&id='.$youtube.'&key='.$api_key);
	if (!is_wp_error($data)) {
		$json = json_decode( $data['body'], true );
		$count = intval($json['items'][0]['statistics']['subscriberCount']);
		set_transient('vpanel_youtube_followers', $count, 60*60*24);
	}
	return $count;
}
/* vpanel_counter_vimeo */
function vpanel_counter_vimeo ($vimeo, $return = 'count') {
	$count = get_transient('vpanel_vimeo_followers');
	$link = get_transient('vpanel_vimeo_page_url');
	if ($return == 'link') {
		if ($link !== false) return $link;
	}else {
		if ($count !== false) return $count;
	}
	$count = 0;
	$link = '';
	$data = wp_remote_get('http://vimeo.com/api/v2/channel/'.$vimeo.'/info.json');
	if (!is_wp_error($data)) {
		$json = json_decode( $data['body'], true );
		$count = intval($json['total_subscribers']);
		$link = $json['url'];
		set_transient('vpanel_vimeo_followers', $count, 60*60*24);
		set_transient('vpanel_vimeo_page_url', $link, 60*60*24);
	}
	if ($return == 'link') {
		return $link;
	}else {
		return $count;
	}
}
/* FetchData */
function FetchData($json_url='',$use_curl=false){
    if($use_curl){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $json_url);
        $json_data = curl_exec($ch);
        curl_close($ch);
        return json_decode($json_data);
    }else{
        $json_data = @file_get_contents($json_url);
        if($json_data == true){
        	return json_decode($json_data);
    	}else{ return null;}
    }
}
/* nbr_format */
function nbr_format($nbr){
	if (is_numeric($nbr)) {
		return number_format($nbr);
	}else{
		return null;
	}
}
/* Vpanel_posts */
function Vpanel_posts($posts_per_page = 5,$orderby,$display_date,$posts_excerpt,$excerpt_title = 5,$show_images = "on",$post_or_portfolio = "post",$display_review = "on",$display_author = "on",$display = "",$category = "",$categories = array(),$category_portfolio = "",$categories_portfolio = array()) {
	global $post;
	$author_by = vpanel_options("author_by");
	if ($orderby == "popular") {
		$orderby = array('orderby' => 'comment_count');
	}elseif ($orderby == "random") {
		$orderby = array('orderby' => 'rand');
	}elseif ($orderby == "most_visited") {
		$orderby = array("orderby" => "meta_value_num","meta_key" => "post_stats","meta_query" => array(array('type' => 'numeric',"key" => "post_stats","value" => 0,"compare" => ">")));
	}elseif ($orderby == "most_rated") {
		$orderby = array("orderby" => "meta_value_num","meta_key" => "vbegy_final_review","meta_query" => array(array('type' => 'numeric',"key" => "vbegy_final_review","value" => 0,"compare" => ">")));
	}else {
		$orderby = array();
	}
	
	if ($post_or_portfolio == "post") {
		$category = $category;
		$categories = $categories;
		$taxonomy = "category";
	}else if ($post_or_portfolio == "portfolio") {
		$category = $category_portfolio;
		$categories = $categories_portfolio;
		$taxonomy = "portfolio-category";
	}
	if ($display == "category") {
		query_posts(array_merge($orderby,array('post_type' => $post_or_portfolio,'ignore_sticky_posts' => 1,'cache_results' => false,'no_found_rows' => true,'posts_per_page' => $posts_per_page,'tax_query' => array(array('taxonomy' => $taxonomy,'field' => 'id','terms' => $category)))));
	}else if ($display == "categories") {
		query_posts(array_merge($orderby,array('post_type' => $post_or_portfolio,'ignore_sticky_posts' => 1,'cache_results' => false,'no_found_rows' => true,'posts_per_page' => $posts_per_page,'tax_query' => array(array('taxonomy' => $taxonomy,'field' => 'id','terms' => $categories)))));
	}else {
		query_posts(array_merge($orderby,array('post_type' => $post_or_portfolio,'ignore_sticky_posts' => 1,'cache_results' => false,'no_found_rows' => true,'posts_per_page' => $posts_per_page)));
	}
	
	$date_format = (vpanel_options("date_format")?vpanel_options("date_format"):get_option("date_format"));
	if ( have_posts()) :
		echo "<ul>";
			while ( have_posts() ) : the_post();
				$vbegy_what_post = rwmb_meta('vbegy_what_post','select',$post->ID);
				$video_type = rwmb_meta('vbegy_video_post_type',"select",$post->ID);
				$post_username = get_post_meta($post->ID, 'post_username',true);
				$post_email = get_post_meta($post->ID, 'post_email',true);?>
				<li class="widget-posts-<?php if (is_sticky()) {?>sticky<?php }else if ($vbegy_what_post == "google") {?>google<?php }else if ($vbegy_what_post == "audio") {?>volume-up<?php }else if ($vbegy_what_post == "video") {if ($video_type == 'youtube') {?>youtube<?php }else if ($video_type == 'vimeo') {?>vimeo<?php }else if ($video_type == 'daily' || $video_type == 'embed') {?>daily<?php }?><?php }else if ($vbegy_what_post == "slideshow") {?>slideshow<?php }else if ($vbegy_what_post == "quote") {?>quote<?php }else if ($vbegy_what_post == "link") {?>link<?php }else if ($vbegy_what_post == "soundcloud") {?>soundcloud<?php }else if ($vbegy_what_post == "twitter") {?>twitter<?php }else if ($vbegy_what_post == "facebook") {?>facebook<?php }else {if (has_post_thumbnail()) {?>image<?php }else {?>text<?php }}?><?php echo (has_post_thumbnail()?'':' widget-no-img')?>">
					<?php if ($show_images == "on") {?>
						<div class="widget-posts-img">
							<a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark">
								<i class="fa fa-<?php if (is_sticky()) {?>thumb-tack<?php }else if ($vbegy_what_post == "google") {?>map-marker<?php }else if ($vbegy_what_post == "audio") {?>volume-up<?php }else if ($vbegy_what_post == "video") {if ($video_type == 'youtube') {?>youtube-play<?php }else if ($video_type == 'vimeo') {?>vimeo-square<?php }else if ($video_type == 'daily' || $video_type == 'embed') {?>video-camera<?php }?><?php }else if ($vbegy_what_post == "slideshow") {?>film<?php }else if ($vbegy_what_post == "quote") {?>quote-left<?php }else if ($vbegy_what_post == "link") {?>link<?php }else if ($vbegy_what_post == "soundcloud") {?>soundcloud<?php }else if ($vbegy_what_post == "twitter") {?>twitter<?php }else if ($vbegy_what_post == "facebook") {?>facebook<?php }else {if (has_post_thumbnail()) {?>image<?php }else {?>file-text<?php }}?>"></i>
								<?php if (has_post_thumbnail()) {echo get_aq_resize_img('full',70,70);}?>
							</a>
						</div>
					<?php }?>
					<div class="widget-posts-content">
						<a href="<?php the_permalink();?>" title="<?php printf('%s',the_title_attribute('echo=0')); ?>" rel="bookmark"><?php excerpt_title($excerpt_title);?></a>
						<?php if ($author_by == 'on' && $display_author == "on") {?>
							<span><i class="fa fa-user"></i><?php _e("by","vbegy")?> : <?php echo ($post->post_author > 0?the_author_posts_link():$post_username);?></span>
						<?php }?>
						<?php if ($display_date == "on") {?>
						<span><i class="fa fa-clock-o"></i><?php the_time($date_format);?></span>
						<?php }
						if ($display_review == "on") {
							echo vbegy_get_review();
						}?>
					</div>
				</li>
			<?php endwhile;
		echo "</ul>";
	endif;
	wp_reset_postdata();
}
/* Vpanel_post_big_images */
function Vpanel_post_big_images($posts_per_page = 3,$orderby,$post_or_portfolio = "post",$excerpt_title = 5,$posts_excerpt = 10,$display_meta,$display_review = "on",$display = "",$category = "",$categories = array(),$category_portfolio = "",$categories_portfolio = array()) {
	global $post;
	if ($orderby == "popular") {
		$orderby = array('orderby' => 'comment_count');
	}elseif ($orderby == "random") {
		$orderby = array('orderby' => 'rand');
	}elseif ($orderby == "most_visited") {
		$orderby = array("orderby" => "meta_value_num","meta_key" => "post_stats","meta_query" => array(array('type' => 'numeric',"key" => "post_stats","value" => 0,"compare" => ">")));
	}elseif ($orderby == "most_rated") {
		$orderby = array("orderby" => "meta_value_num","meta_key" => "vbegy_final_review","meta_query" => array(array('type' => 'numeric',"key" => "vbegy_final_review","value" => 0,"compare" => ">")));
	}else {
		$orderby = array();
	}
	
	if ($post_or_portfolio == "post") {
		$category = $category;
		$categories = $categories;
		$taxonomy = "category";
	}else if ($post_or_portfolio == "portfolio") {
		$category = $category_portfolio;
		$categories = $categories_portfolio;
		$taxonomy = "portfolio-category";
	}
	if ($display == "category") {
		query_posts(array_merge($orderby,array('post_type' => $post_or_portfolio,'ignore_sticky_posts' => 1,'cache_results' => false,'no_found_rows' => true,'posts_per_page' => $posts_per_page,'tax_query' => array(array('taxonomy' => $taxonomy,'field' => 'id','terms' => $category)))));
	}else if ($display == "categories") {
		query_posts(array_merge($orderby,array('post_type' => $post_or_portfolio,'ignore_sticky_posts' => 1,'cache_results' => false,'no_found_rows' => true,'posts_per_page' => $posts_per_page,'tax_query' => array(array('taxonomy' => $taxonomy,'field' => 'id','terms' => $categories)))));
	}else {
		query_posts(array_merge($orderby,array('post_type' => $post_or_portfolio,'ignore_sticky_posts' => 1,'cache_results' => false,'no_found_rows' => true,'posts_per_page' => $posts_per_page)));
	}
	
	$date_format = (vpanel_options("date_format")?vpanel_options("date_format"):get_option("date_format"));
	if ( have_posts()) :
		echo "<ul>";
			while ( have_posts() ) : the_post();?>
				<li class="widget-posts-image">
					<?php if (has_post_thumbnail()) {?>
						<div class="post-img-big">
							<a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark">
								<?php echo get_aq_resize_img('full',320,320)?>
							</a>
						</div>
					<?php }?>
					<div class="clearfix"></div>
					<div class="post-content-small">
						<h3>
							<a href="<?php the_permalink();?>" title="<?php printf('%s',the_title_attribute('echo=0')); ?>" rel="bookmark">
								<?php if ($posts_excerpt == 0 && $show_images != "on") {?>
									<i class="fa fa-angle-double-right"></i>
								<?php }
								excerpt_title($excerpt_title);?>
							</a>
						</h3>
						<?php if ($display_meta == "on") {?>
							<div class="clearfix"></div>
							<span <?php echo ($posts_excerpt == 0?"class='margin_t_5'":"")?>><?php the_time($date_format);?></span>
							<span <?php echo ($posts_excerpt == 0?"class='margin_t_5'":"")?>><?php comments_popup_link(__('0 Comments', 'vbegy'), __('1 Comment', 'vbegy'), '% '.__('Comments', 'vbegy'));?></span>
						<?php }
						if ($posts_excerpt != 0) {?>
							<p><?php excerpt($posts_excerpt);?></p>
						<?php }
						if ($display_review == "on") {
							echo vbegy_get_review();
						}?>
					</div>
				</li>
			<?php endwhile;
		echo "</ul>";
	endif;
	wp_reset_postdata();
}
/* Vpanel_post_slideshow */
function Vpanel_post_slideshow($posts_per_page,$orderby,$post_or_portfolio = "post",$display = "",$category = "",$categories = array(),$category_portfolio = "",$categories_portfolio = array()) {
	global $post;
	if ($orderby == "popular") {
		$orderby = array('orderby' => 'comment_count');
	}elseif ($orderby == "random") {
		$orderby = array('orderby' => 'rand');
	}elseif ($orderby == "most_visited") {
		$orderby = array("orderby" => "meta_value_num","meta_key" => "post_stats","meta_query" => array(array('type' => 'numeric',"key" => "post_stats","value" => 0,"compare" => ">")));
	}elseif ($orderby == "most_rated") {
		$orderby = array("orderby" => "meta_value_num","meta_key" => "vbegy_final_review","meta_query" => array(array('type' => 'numeric',"key" => "vbegy_final_review","value" => 0,"compare" => ">")));
	}else {
		$orderby = array();
	}
	
	if ($post_or_portfolio == "post") {
		$category = $category;
		$categories = $categories;
		$taxonomy = "category";
	}else if ($post_or_portfolio == "portfolio") {
		$category = $category_portfolio;
		$categories = $categories_portfolio;
		$taxonomy = "portfolio-category";
	}
	if ($display == "category") {
		query_posts(array_merge($orderby,array('post_type' => $post_or_portfolio,'ignore_sticky_posts' => 1,'cache_results' => false,'no_found_rows' => true,'posts_per_page' => $posts_per_page,'tax_query' => array(array('taxonomy' => $taxonomy,'field' => 'id','terms' => $category)))));
	}else if ($display == "categories") {
		query_posts(array_merge($orderby,array('post_type' => $post_or_portfolio,'ignore_sticky_posts' => 1,'cache_results' => false,'no_found_rows' => true,'posts_per_page' => $posts_per_page,'tax_query' => array(array('taxonomy' => $taxonomy,'field' => 'id','terms' => $categories)))));
	}else {
		query_posts(array_merge($orderby,array('post_type' => $post_or_portfolio,'ignore_sticky_posts' => 1,'cache_results' => false,'no_found_rows' => true,'posts_per_page' => $posts_per_page)));
	}
	
	$date_format = (vpanel_options("date_format")?vpanel_options("date_format"):get_option("date_format"));
	if ( have_posts()) :
		$post_width = 300;
		$post_height = 300;
		$excerpt_related_title = vpanel_options('excerpt_related_title') ? vpanel_options('excerpt_related_title') : 5;?>
		<div class="related-posts">
			<div>
				<?php while ( have_posts() ) : the_post();
					$vbegy_what_post = rwmb_meta('vbegy_what_post','select',$post->ID);
					$video_id = rwmb_meta('vbegy_video_post_id',"select",$post->ID);
					$video_type = rwmb_meta('vbegy_video_post_type',"text",$post->ID);
					if ($video_type == 'youtube') {
						$type = "http://www.youtube.com/embed/".$video_id;
					}else if ($video_type == 'vimeo') {
						$type = "http://player.vimeo.com/video/".$video_id;
					}else if ($video_type == 'daily' || $video_type == 'embed') {
						$type = "http://www.dailymotion.com/swf/video/".$video_id;
					}
					$vbegy_slideshow_type = rwmb_meta('vbegy_slideshow_type','select',$post->ID);
					if (has_post_thumbnail() || $vbegy_what_post == "video") {?>
						<div class="related-post-item">
							<div class="related-post-one">
								<div class="related-post-img">
									<a itemprop="url" href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark">
										<?php
										if ($vbegy_what_post == "image" || $vbegy_what_post == "slideshow") {
											if (has_post_thumbnail() && $vbegy_what_post == "image") {
												echo get_aq_resize_img('full',$post_width,$post_height,$img_lightbox = "lightbox");
											}else if (has_post_thumbnail() && $vbegy_what_post == "slideshow") {
												echo get_aq_resize_img('full',$post_width,$post_height);
											}
										}else if ($vbegy_what_post == "video") {
											echo '<iframe frameborder="0" allowfullscreen height="'.$post_height.'" src="'.$type.'"></iframe>';
										}else {
											if (has_post_thumbnail()) {
												echo get_aq_resize_img('full',$post_width,$post_height,$img_lightbox = "lightbox");
											}
										}
										?>
									</a>
									<div class="related-post-type">
										<i class="fa fa-<?php if (is_sticky()) {?>thumb-tack<?php }else if ($vbegy_what_post == "google") {?>map-marker<?php }else if ($vbegy_what_post == "video") {if ($video_type == 'youtube') {?>youtube-play<?php }else if ($video_type == 'vimeo') {?>vimeo-square<?php }else if ($video_type == 'daily' || $video_type == 'embed') {?>video-camera<?php }?><?php }else if ($vbegy_what_post == "slideshow") {?>film<?php }else if ($vbegy_what_post == "quote") {?>quote-left<?php }else if ($vbegy_what_post == "link") {?>link<?php }else if ($vbegy_what_post == "soundcloud") {?>soundcloud<?php }else if ($vbegy_what_post == "twitter") {?>twitter<?php }else if ($vbegy_what_post == "facebook") {?>facebook<?php }else {if (has_post_thumbnail()) {?>image<?php }else {?>file-text<?php }}?>"></i>
									</div>
								</div>
								<div class="related-post-head">
									<a itemprop="url" href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php excerpt_title($excerpt_related_title)?></a>
									<span><i class="fa fa-clock-o"></i><?php the_time($date_format);?></span>
									<span><i class="fa fa-comments"></i><?php comments_popup_link(__('0 Comments', 'vbegy'), __('1 Comment', 'vbegy'), '% '.__('Comments', 'vbegy'));?></span>
								</div>
							</div>
						</div>
					<?php }
				endwhile;?>
			</div>
		</div><!-- End related-posts -->
	<?php endif;
	wp_reset_postdata();
}
/* Vpanel_posts_images */
function Vpanel_posts_images($posts_per_page = 5,$orderby,$post_or_portfolio = "post",$display = "",$category = "",$categories = array(),$category_portfolio = "",$categories_portfolio = array()) {
	global $post;
	if ($orderby == "popular") {
		$orderby = array('orderby' => 'comment_count');
	}elseif ($orderby == "random") {
		$orderby = array('orderby' => 'rand');
	}elseif ($orderby == "most_visited") {
		$orderby = array("orderby" => "meta_value_num","meta_key" => "post_stats","meta_query" => array(array('type' => 'numeric',"key" => "post_stats","value" => 0,"compare" => ">")));
	}elseif ($orderby == "most_rated") {
		$orderby = array("orderby" => "meta_value_num","meta_key" => "vbegy_final_review","meta_query" => array(array('type' => 'numeric',"key" => "vbegy_final_review","value" => 0,"compare" => ">")));
	}else {
		$orderby = array();
	}
	
	if ($post_or_portfolio == "post") {
		$category = $category;
		$categories = $categories;
		$taxonomy = "category";
	}else if ($post_or_portfolio == "portfolio") {
		$category = $category_portfolio;
		$categories = $categories_portfolio;
		$taxonomy = "portfolio-category";
	}
	if ($display == "category") {
		query_posts(array_merge($orderby,array('post_type' => $post_or_portfolio,'ignore_sticky_posts' => 1,'cache_results' => false,'no_found_rows' => true,'posts_per_page' => $posts_per_page,'tax_query' => array(array('taxonomy' => $taxonomy,'field' => 'id','terms' => $category)))));
	}else if ($display == "categories") {
		query_posts(array_merge($orderby,array('post_type' => $post_or_portfolio,'ignore_sticky_posts' => 1,'cache_results' => false,'no_found_rows' => true,'posts_per_page' => $posts_per_page,'tax_query' => array(array('taxonomy' => $taxonomy,'field' => 'id','terms' => $categories)))));
	}else {
		query_posts(array_merge($orderby,array('post_type' => $post_or_portfolio,'ignore_sticky_posts' => 1,'cache_results' => false,'no_found_rows' => true,'posts_per_page' => $posts_per_page)));
	}
	
	if ( have_posts()) :
		while ( have_posts() ) : the_post();
			if (has_post_thumbnail()) {?>
				<a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark">
					<?php echo get_aq_resize_img('full',76,76)?>
				</a>
			<?php }
		endwhile;
	endif;
	wp_reset_postdata();
}
/* Vpanel_comments */
function Vpanel_comments($post_or_portfolio = "post",$comments_number = 5,$comment_excerpt = 30,$show_images = "on") {
	$comments = get_comments(array("post_type" => $post_or_portfolio,"status" => "approve","number" => $comments_number));
	echo "<div class='widget-comments'><ul>";
		foreach ($comments as $comment) {
			$you_avatar = get_the_author_meta('you_avatar',$comment->user_id);
			$user_profile_page = get_author_posts_url($comment->user_id);
		    ?>
		    <li>
		    	<?php if ($show_images == "on") {?>
		    		<div class="widget-comments-img">
		    			<?php if ($comment->user_id != 0) {?>
		    				<a href="<?php echo esc_url($user_profile_page)?>">
		    			<?php }
		    				if ($you_avatar && $comment->user_id != 0) {
		    					$you_avatar_img = get_aq_resize_url(esc_attr($you_avatar),"full",65,65);
		    					echo "<img alt='".$comment->comment_author."' src='".$you_avatar_img."'>";
		    				}else {
		    					echo get_avatar($comment,'65','');
		    				}
		    			if ($comment->user_id != 0) {?>
		    				</a>
		    			<?php }?>
		    		</div>
		    	<?php }?>
		    	<div class="widget-comments-content">
		    		<?php echo ($comment->comment_author_url != ""?"<a href='".$comment->comment_author_url."' target='_blank'>":"").strip_tags($comment->comment_author).($comment->comment_author_url != ""?"</a>":"") ?>
		    		<p><a href="<?php echo get_permalink($comment->comment_post_ID);?>#comment-<?php echo esc_attr($comment->comment_ID);?>"><?php echo wp_html_excerpt($comment->comment_content,$comment_excerpt);?></a></p>
		    	</div>
		    </li>
		    <?php
		}
	echo "</ul></div>";
}
/* vbegy_comment */
function vbegy_comment($comment,$args,$depth) {
    $GLOBALS['comment'] = $comment;
    $add_below = '';
    ?>
    <li <?php comment_class('comment');?> id="comment-<?php comment_ID();?>">
    	<div class="comment-body clearfix">
    	    <div class="avatar">
    	    	<?php 
    	    	if ($comment->user_id != 0 && get_the_author_meta('you_avatar', $comment->user_id)) {
    	    		$you_avatar_img = get_aq_resize_url(esc_attr(get_the_author_meta('you_avatar', $comment->user_id)),"full",70,70);
    	    		echo "<img alt='".$comment->comment_author."' src='".$you_avatar_img."'>";
    	    	}else {
    	    		echo get_avatar($comment,70);
    	    	}?>
    	    </div>
    	    <div class="comment-text">
    	        <div class="author clearfix">
    	        	<div class="comment-meta">
    	                <span><?php echo get_comment_author();?></span>
    	                <div class="date"><?php printf('%1$s at %2$s',get_comment_date(), get_comment_time()) ?></div>
    	            </div>
    	            <?php
    	            edit_comment_link(__("Edit","vbegy"),'','');
    	            comment_reply_link(array_merge($args,array('reply_text' => __("Reply","vbegy"),'add_below' => $add_below,'depth' => $depth,'max_depth' => $args['max_depth'])));
    	            ?>
    	        </div>
    	        <div class="text">
    	        	<?php if ($comment->comment_approved == '0') : ?>
    	        	    <em><?php _e('Your comment is awaiting moderation.','vbegy')?></em><br>
    	        	<?php endif; ?>
    	        	<?php comment_text() ?>
    	        </div>
    	    </div>
    	</div>
    <?php
}
/* vpanel_pagination */
if ( ! function_exists('vpanel_pagination')) {
	function vpanel_pagination( $args = array(),$query = '') {
		global $wp_rewrite,$wp_query;
		do_action('vpanel_pagination_start');
		if ( $query) {
			$wp_query = $query;
		} // End IF Statement
		/* If there's not more than one page,return nothing. */
		if ( 1 >= $wp_query->max_num_pages)
			return;
		/* Get the current page. */
		$current = ( get_query_var('paged') ? absint( get_query_var('paged')) : 1);
		/* Get the max number of pages. */
		$max_num_pages = intval( $wp_query->max_num_pages);
		/* Set up some default arguments for the paginate_links() function. */
		$defaults = array(
			'base' => add_query_arg('paged','%#%'),
			'format' => '',
			'total' => $max_num_pages,
			'current' => $current,
			'prev_next' => true,
			'prev_text' => __('<i class="fa fa-angle-left"></i>','vbegy'),// Translate in WordPress. This is the default.
			'next_text' => __('<i class="fa fa-angle-right"></i>','vbegy'),// Translate in WordPress. This is the default.
			'show_all' => false,
			'end_size' => 1,
			'mid_size' => 1,
			'add_fragment' => '',
			'type' => 'plain',
			'before' => '<div class="pagination">',// Begin vpanel_pagination() arguments.
			'after' => '</div><div class="clearfix"></div>',
			'echo' => true,
		);
		/* Add the $base argument to the array if the user is using permalinks. */
		if ( $wp_rewrite->using_permalinks())
			$defaults['base'] = user_trailingslashit( trailingslashit( get_pagenum_link()) . 'page/%#%');
		/* If we're on a search results page,we need to change this up a bit. */
		if ( is_search()) {
		/* If we're in BuddyPress,use the default "unpretty" URL structure. */
			if ( class_exists('BP_Core_User')) {
				$search_query = get_query_var('s');
				$paged = get_query_var('paged');
				$base = user_trailingslashit( home_url()) . '?s=' . $search_query . '&paged=%#%';
				$defaults['base'] = $base;
			} else {
				$search_permastruct = $wp_rewrite->get_search_permastruct();
				if ( !empty( $search_permastruct))
					$defaults['base'] = user_trailingslashit( trailingslashit( get_search_link()) . 'page/%#%');
			}
		}
		/* Merge the arguments input with the defaults. */
		$args = wp_parse_args( $args,$defaults);
		/* Allow developers to overwrite the arguments with a filter. */
		$args = apply_filters('vpanel_pagination_args',$args);
		/* Don't allow the user to set this to an array. */
		if ('array' == $args['type'])
			$args['type'] = 'plain';
		/* Make sure raw querystrings are displayed at the end of the URL,if using pretty permalinks. */
		$pattern = '/\?(.*?)\//i';
		preg_match( $pattern,$args['base'],$raw_querystring);
		if ( $wp_rewrite->using_permalinks() && $raw_querystring)
			$raw_querystring[0] = str_replace('','',$raw_querystring[0]);
			if (!empty($raw_querystring)) {
				@$args['base'] = str_replace( $raw_querystring[0],'',$args['base']);
				@$args['base'] .= substr( $raw_querystring[0],0,-1);
			}
		/* Get the paginated links. */
		$page_links = paginate_links( $args);
		/* Remove 'page/1' from the entire output since it's not needed. */
		$page_links = str_replace( array('&#038;paged=1\'','/page/1\''),'\'',$page_links);
		/* Wrap the paginated links with the $before and $after elements. */
		$page_links = $args['before'] . $page_links . $args['after'];
		/* Allow devs to completely overwrite the output. */
		$page_links = apply_filters('vpanel_pagination',$page_links);
		do_action('vpanel_pagination_end');
		/* Return the paginated links for use in themes. */
		if ( $args['echo'])
			echo $page_links;
		else
			return $page_links;
	}
}
/* vpanel_admin_bar */
function vpanel_admin_bar() {
	global $wp_admin_bar;
	if (is_super_admin()) {
		$wp_admin_bar->add_menu( array(
			'parent' => 0,
			'id' => 'vpanel_page',
			'title' => theme_name.' Settings' ,
			'href' => admin_url( 'admin.php?page=options')
		));
	}
}
add_action( 'wp_before_admin_bar_render', 'vpanel_admin_bar' );
/* breadcrumbs */
function breadcrumbs ($args = array()) {
	global $post,$wp_query;
	$breadcrumbs = vpanel_options("breadcrumbs");
	if (is_single() || is_page()) {
		$vbegy_custom_header = rwmb_meta('vbegy_custom_header','checkbox',$post->ID);
	}
	if ((is_single() || is_page()) && isset($vbegy_custom_header) && $vbegy_custom_header == 1) {
		$breadcrumbs = rwmb_meta('vbegy_breadcrumbs','checkbox',$post->ID);
		if ($breadcrumbs == 1) {
			$breadcrumbs = "on";
		}
	}
	
    $home       = '<i class="fa fa-home"></i>'.__('Home','vbegy');
    $before     = '<span class="crumbs-span">/</span><span class="current">';
    $after      = '</span>';
    if ((!is_home() && !is_front_page()) || is_paged()) {
    	if (isset($breadcrumbs) && $breadcrumbs == "on") {
    		$homeLink = home_url();
			echo '<div class="breadcrumbs"><div class="crumbs">
	        <a href="' . $homeLink . '">' . $home . '</a>';
	        if (is_category() || is_tag() || is_tax()) {
	            global $wp_query;
	            $term = $wp_query->get_queried_object();
	        	$taxonomy = get_taxonomy( $term->taxonomy );
	        	if ( isset($item) && is_array($item) && ( is_taxonomy_hierarchical( $term->taxonomy ) && $term->parent ) && $parents = breadcrumbs_plus_get_term_parents( $term->parent, $term->taxonomy ) )
	        		$item = array_merge( $item, $parents );
	        	$item['last'] = $term->name;
	            echo ($before . '' . single_cat_title('', false) . '' . $after);
	        }else if (is_day()) {
	            echo ($before .'<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . ''.$after);
	            echo ($before .'<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a>' . ''.$after);
	            echo ($before . get_the_time('d') . $after);
	        }else if (is_month()) {
	            echo ($before .'<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . ''.$after);
	            echo ($before . get_the_time('F') . $after);
	        }else if (is_year()) {
	            echo ($before . get_the_time('Y') . $after);
	        }else if (is_single() && !is_attachment()) {
	            if (get_post_type() != 'post') {
	                $post_type = get_post_type_object(get_post_type());
	                $slug = $post_type->rewrite;
	                echo ($before .'<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>' . ''.$after);
	                echo "".$before . get_the_title() . $after;
	            }else {
	                $cat = get_the_category(); $cat = $cat[0];
	                echo ($before .get_category_parents($cat, TRUE, ' '). $after);
	                echo ($before . get_the_title() . $after);
	            }
	        }else if (!is_single() && !is_page() && get_post_type() != 'post') {
	            if (is_author()) {
	                global $author;
	    			$userdata = get_userdata($author);
	    			echo ($before . $userdata->display_name . $after);
	            }else {
	                $post_type = get_post_type_object(get_post_type());
	            	echo ($before . (isset($post_type->labels->singular_name)?$post_type->labels->singular_name:__("Error 404","vbegy")) . $after);
	            }
	        }else if (is_attachment()) {
	            $parent = get_post($post->post_parent);
	            $cat = get_the_category($parent->ID);
	            //echo ($before .'<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>' . ''. $after);
	            echo ($before . get_the_title() . $after);
	        }else if (is_page() && !$post->post_parent) {
	            echo ($before . get_the_title() . $after);
	        }else if (is_page() && $post->post_parent) {
	            $parent_id  = $post->post_parent;
	            $breadcrumbs = array();
	            while ($parent_id) {
	                $page = get_page($parent_id);
	                $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
	                $parent_id  = $page->post_parent;
	            }
	            $breadcrumbs = array_reverse($breadcrumbs);
	            foreach ($breadcrumbs as $crumb) echo ($crumb . ' ');
	            echo ($before . get_the_title() . $after);
	        }else if (is_search()) {
	            echo ($before . __('Search results for ', 'vbegy') . '"' . get_search_query() . '"' . $after);
	        }else if (is_tag()) {
	            echo ($before . __('Posts tagged ', 'vbegy') . '"' . single_tag_title('', false) . '"' . $after);
	        }else if ( is_author() ) {
	            global $author;
	            $userdata = get_userdata($author);
	            echo ($before . $userdata->display_name . $after);
	        }else if (is_404()) {
	            echo ($before . __('Error 404 ', 'vbegy') . $after);
	        }
	        if (get_query_var('paged')) {
	            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo '';
	            echo ($before . __('Page', 'vbegy') . ' ' . esc_attr(get_query_var('paged')) . $after);
	            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo '';
	        }
	    	echo '</div></div>';
	    }
	}
}
/* breadcrumbs_plus_get_term_parents */
function breadcrumbs_plus_get_term_parents( $parent_id = '', $taxonomy = '', $separator = '/' ) {
	$html = array();
	$parents = array();
	if ( empty( $parent_id ) || empty( $taxonomy ) )
		return $parents;
	while ( $parent_id ) {
		$parent = get_term( $parent_id, $taxonomy );
		$parents[] = '<a href="' . get_term_link( $parent, $taxonomy ) . '" title="' . esc_attr( $parent->name ) . '">' . $parent->name . '</a>';
		$parent_id = $parent->parent;
	}
	if ( $parents )
		$parents = array_reverse( $parents );
	return $parents;
}
/* vpanel_show_extra_profile_fields */
add_action( 'show_user_profile', 'vpanel_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'vpanel_show_extra_profile_fields' );
function vpanel_show_extra_profile_fields( $user ) { ?>
	<table class="form-table">
		<tr>
			<th><label for="you_avatar"><?php _e("Your avatar","vbegy")?></label></th>
			<td>
				<input type="text" size="36" class="upload upload_meta regular-text" value="<?php echo esc_attr( get_the_author_meta('you_avatar', $user->ID ) ); ?>" id="you_avatar" name="you_avatar">
				<input id="you_avatar_button" class="upload_image_button button upload-button-2" type="button" value="Upload Image">
			</td>
		</tr>
		<?php if (get_the_author_meta('you_avatar', $user->ID )) {?>
		<tr>
			<th><label><?php _e("Your avatar","vbegy")?></label></th>
			<td>
				<div class="you_avatar"><img alt="" src="<?php echo esc_attr( get_the_author_meta('you_avatar', $user->ID ) ); ?>"></div>
			</td>
		</tr>
		<?php } ?>
	<h3><?php _e( 'Social Networking', 'vbegy' ) ?></h3>
	<table class="form-table">
		<tr>
			<th><label for="google"><?php _e("Google +","vbegy")?></label></th>
			<td>
				<input type="text" name="google" id="google" value="<?php echo esc_url_raw( get_the_author_meta( 'google', $user->ID ) ); ?>" class="regular-text"><br>
			</td>
		</tr>
		<tr>
			<th><label for="twitter"><?php _e("Twitter","vbegy")?></label></th>
			<td>
				<input type="text" name="twitter" id="twitter" value="<?php echo esc_url_raw( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text"><br>
			</td>
		</tr>
		<tr>
			<th><label for="facebook"><?php _e("Facebook","vbegy")?></label></th>
			<td>
				<input type="text" name="facebook" id="facebook" value="<?php echo esc_url_raw( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="regular-text"><br>
			</td>
		</tr>
		<tr>
			<th><label for="linkedin"><?php _e("linkedin","vbegy")?></label></th>
			<td>
				<input type="text" name="linkedin" id="linkedin" value="<?php echo esc_url_raw( get_the_author_meta( 'linkedin', $user->ID ) ); ?>" class="regular-text"><br>
			</td>
		</tr>
		<tr>
			<th><label for="youtube"><?php _e("Youtube","vbegy")?></label></th>
			<td>
				<input type="text" name="youtube" id="youtube" value="<?php echo esc_url_raw( get_the_author_meta( 'youtube', $user->ID ) ); ?>" class="regular-text"><br>
			</td>
		</tr>
	</table>
<?php }
/* Save user's meta */
add_action( 'personal_options_update', 'vpanel_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'vpanel_save_extra_profile_fields' );
function vpanel_save_extra_profile_fields( $user_id ) {
	if ( !current_user_can( 'edit_user', $user_id ) ) return false;
	update_user_meta( $user_id, 'google', esc_url_raw($_POST['google'] ));
	update_user_meta( $user_id, 'twitter', esc_url_raw($_POST['twitter']) );
	update_user_meta( $user_id, 'facebook', esc_url_raw($_POST['facebook']) );
	update_user_meta( $user_id, 'linkedin', esc_url_raw($_POST['linkedin']) );
	update_user_meta( $user_id, 'youtube', esc_url_raw($_POST['youtube']) );
	if (isset($_POST['you_avatar'])) {
		update_user_meta( $user_id, 'you_avatar', esc_attr($_POST['you_avatar']) );
	}
}
/* post_like */
function post_like () {
	$id = (int)$_POST['id'];
	$post_like = (int)get_post_meta($id,'post_like',true);
	if(!$post_like)
		$post_like = 0;
	$post_like++;
	$update = update_post_meta($id,'post_like',$post_like);
	if($update) {
		setcookie('logger_post_like'.$id,"logger_like_yes",time()+3600*24*365,'/');
	}
	echo esc_attr($post_like);
	die();
}
add_action('wp_ajax_post_like','post_like');
add_action('wp_ajax_nopriv_post_like','post_like');
/* vbegy_review */
function vbegy_review() {
	global $post;
	$review_title = rwmb_meta('vbegy_review_title','text',$post->ID);
	$brief_summary = rwmb_meta('vbegy_brief_summary','text',$post->ID);
	$review_summary = rwmb_meta('vbegy_review_summary','textarea',$post->ID);
	$review_type = rwmb_meta('vbegy_review_type','select',$post->ID);
	$review_position = rwmb_meta('vbegy_review_position','select',$post->ID);
	$final_score = $item_length = 0;
	?>
    <div itemscope itemtype="http://data-vocabulary.org/Review-aggregate" class="review_box<?php echo ($review_position == "top"?" review_box_top":"").($review_position == "top_f"?" review_box_top_f":"").($review_position == "bottom"?" review_box_bottom":"");?> clearfix">
        <div class="post-title"><?php echo esc_attr($review_title);?></div>
        <?php $builder_rating_item = get_post_meta($post->ID,'builder_rating_item');
        if ($builder_rating_item) {?>
            <div class="review_criteria">
        		<?php
        		$builder_rating_item = $builder_rating_item[0];
        		foreach ($builder_rating_item as $builder_rating) {
        			$item_length ++;
    			    $final_score += $builder_rating["rating_score"];
        			?>
	                <div class="criteria_item clearfix">
	                    <div class="criteria_name <?php echo ($review_type == 'percentage' || $review_type == 'points'?"criteria_score_name":"")?>"><?php echo esc_attr($builder_rating["rating_description"]);?></div>
                    	<?php if ($review_type == 'percentage'):?>
                    		<div class="rating_score" style="width:<?php echo esc_attr($builder_rating["rating_score"]*10)?>%;"><?php echo esc_attr($builder_rating["rating_score"]*10)?> %</div>
                    	<?php elseif ($review_type == 'points'): $point =  $builder_rating["rating_score"]/10; ?>
                    		<div class="rating_score" style="width:<?php echo esc_attr($builder_rating["rating_score"]*10)?>%;"><?php echo esc_attr($builder_rating["rating_score"])?></div>
                    	<?php else:?>
                        	<div class="criteria_stars">
                        		<span style="width:<?php echo esc_attr($builder_rating["rating_score"]*10)?>%;"></span>
                        	</div>
                    	<?php endif;?>
	                </div>
            	<?php }?>
            </div>
            
            <div class="review_results">
                <div class="review_summary">
                    <span class="summary_score title"><?php echo esc_attr($brief_summary);?></span>
                    <span class="summary_title"><?php _e('summary','vbegy')?></span> : <?php echo esc_attr($review_summary);?>
                    <div class="clearfix"></div>
                </div>
                <?php if ($review_type == 'percentage'):?>
                <div class="review_rating"><?php _e('rating','vbegy')?> : <?php echo round($final_score/$item_length,1)*10;?>%</div>
                <?php elseif ($review_type == 'points'):?>
                <div class="review_rating"><?php _e('rating','vbegy')?> : <?php echo round($final_score/$item_length,1);?></div>
                <?php else:?>
	                <div class="review_rating"><?php _e('rating','vbegy')?> : <?php echo round($final_score/$item_length,1);?>
		                <div class="criteria_stars">
		                	<span style="width:<?php echo esc_attr(round($final_score/$item_length,1)*10)?>%;"></span>
		                </div>
	                </div>
                <?php endif;?>
            </div>
        </div>
    <?php }
}
/* vbegy_get_review */
function vbegy_get_review() {
	global $post;
	$final_score = $item_length = 0;
	$builder_rating_item = get_post_meta($post->ID,'builder_rating_item');
    if ($builder_rating_item) {
    	$builder_rating_item = $builder_rating_item[0];
    	foreach ($builder_rating_item as $builder_rating) {
    		$item_length ++;
    	    $final_score += $builder_rating["rating_score"];
    	}
    	$final_score_star = round($final_score/$item_length,1)*10;
    	$out = '<div class="criteria_stars criteria_stars_small">
    		<span style="width:'.$final_score_star.'%;"></span>
    	</div>';
    	return $out;
    }
}
/* vpanel_general_typography */
function vpanel_general_typography ($vpanel_general_typography,$vpanel_css) {
	$custom_css = '';
	$general_typography = vpanel_options($vpanel_general_typography);
	if (
	(isset($general_typography["style"]) && $general_typography["style"] != "" && $general_typography["style"] != "default") || 
	(isset($general_typography["size"]) && $general_typography["size"] != "" && $general_typography["size"] != "default" && is_string($general_typography["size"])) || 
	(isset($general_typography["color"]) && $general_typography["color"] != "")) {
	$custom_css .= '
		'.$vpanel_css.' {';
			if (isset($general_typography["size"]) && $general_typography["size"] != "" && $general_typography["size"] != "default" && is_string($general_typography["size"])) {
				$custom_css .= 'font-size: '.$general_typography["size"].';';
			}
			if (isset($general_typography["color"]) && $general_typography["color"] != "") {
				$custom_css .= 'color: '.$general_typography["color"].';';
			}
			if (isset($general_typography["style"]) && $general_typography["style"] != "default") {
				if ($general_typography["style"] == "bold italic") {
					$custom_css .= 'font-weight: bold;';
				}else {
					$custom_css .= 'font-weight: '.$general_typography["style"].';';
				}
				if ($general_typography["style"] == "italic" || $general_typography["style"] == "bold italic") {
					$custom_css .= 'font-style: italic;';
				}
			}
		$custom_css .= '}';
	}
	return $custom_css;
}
/* vpanel_general_color */
function vpanel_general_color ($vpanel_general_color,$vpanel_css,$vpanel_type,$important = false) {
	$custom_css = '';
	$important = ($important == true?" !important":"");
	$general_link_color = vpanel_options($vpanel_general_color);
	if (isset($general_link_color) && $general_link_color != "") {
		$custom_css .= '
		'.$vpanel_css.' {
			'.$vpanel_type.': '.$general_link_color.$important.';
		}';
	}
	return $custom_css;
}

function vpanel_general_background ($vpanel_general_background,$full_screen_background,$vpanel_css) {
	$custom_css = '';
	$general_image = vpanel_options($vpanel_general_background);
	$general_background_color = $general_image["color"];
	$general_background_img = $general_image["image"];
	$general_background_repeat = $general_image["repeat"];
	$general_background_position = $general_image["position"];
	$general_background_fixed = $general_image["attachment"];
	$general_full_screen_background = vpanel_options($full_screen_background);
	
	if ($general_full_screen_background == "on") {
		$custom_css .= $vpanel_css.' {';
			if (!empty($background_color)) {
				$custom_css .= 'background-color: '.$general_background_color.';';
			}
			$custom_css .= 'background-image : url("'.$general_background_img.'") ;
			filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src="'.$general_background_img.'",sizingMethod="scale");
			-ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\''.$general_background_img.'\',sizingMethod=\'scale\')";
			background-size: cover;
		}';
	}else {
		if (!empty($general_image)) {
			if ($general_full_screen_background != "on") {
				if ((isset($general_background_img) && $general_background_img != "") || isset($general_background_color) && $general_background_color != "") {
					$custom_css .= $vpanel_css.'{background:'.esc_attr($general_background_color).(isset($general_background_img) && $general_background_img != ""?' url("'.esc_attr($general_background_img).'") '.esc_attr($general_background_repeat).' '.esc_attr($general_background_fixed).' '.esc_attr($general_background_position):'').';}';
				}
			}
		}
	}
	return $custom_css;
}
/* update_options && reset_options */
if (is_admin()) {
	/* update_options */
	function update_options(){
		global $themename;
		$post_re = $_POST;
		$all_save = $post_re[vpanel_options];
		unset($all_save['export_setting']);
		//echo "<pre>";print_r($all_save);echo "</pre>";
		if(isset($all_save['import_setting']) && $all_save['import_setting'] != "") {
			$data = unserialize(base64_decode($all_save['import_setting']));
			$array_options = array(vpanel_options,"sidebars");
			foreach($array_options as $option){
				if(isset($data[$option])){
					update_option($option,$data[$option]);
				}else{
					delete_option($option);
				}
			}
			echo 2;
			update_option("FlushRewriteRules",true);
			die();
		}else {
			update_option(vpanel_options,$post_re[vpanel_options]);
			/* sidebars */
			if (isset($post_re["sidebars"])) {
				update_option("sidebars",$post_re["sidebars"]);
			}else {
				delete_option("sidebars");
			}
		}
		update_option("FlushRewriteRules",true);
		die(1);
	}
	add_action( 'wp_ajax_update_options', 'update_options' );
	/* reset_options */
	function reset_options() {
		global $themename;
		$options = & Options_Framework::_optionsframework_options();
		foreach ($options as $option) {
			if (isset($option['id'])) {
				$option_std = $option['std'];
				$option_res[$option['id']] = $option['std'];
			}
		}
		update_option(vpanel_options,$option_res);
		update_option("FlushRewriteRules",true);
		die(1);
	}
	add_action( 'wp_ajax_reset_options', 'reset_options' );
}
?>