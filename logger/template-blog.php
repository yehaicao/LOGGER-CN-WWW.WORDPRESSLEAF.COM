<?php /* Template Name: Blog */
get_header();
	$vbegy_sidebar_all    = rwmb_meta('vbegy_sidebar','radio',$post->ID);
	$post_style           = rwmb_meta('vbegy_post_style','radio',$post->ID);
	$posts_meta           = rwmb_meta('vbegy_post_meta','checkbox',$post->ID);
	$post_type_option     = rwmb_meta('vbegy_post_type','checkbox',$post->ID);
	$post_author          = rwmb_meta('vbegy_post_author','checkbox',$post->ID);
	$post_excerpt         = rwmb_meta('vbegy_post_excerpt','text',$post->ID);
	$post_excerpt         = (isset($post_excerpt) && $post_excerpt != ""?$post_excerpt:5);
	$post_excerpt_title   = rwmb_meta('vbegy_post_excerpt_title','text',$post->ID);
	$post_excerpt_title   = (isset($post_excerpt_title) && $post_excerpt_title != ""?$post_excerpt_title:5);
	$post_share           = rwmb_meta('vbegy_post_share','checkbox',$post->ID);
	$post_views           = rwmb_meta('vbegy_post_views','checkbox',$post->ID);
	$post_pagination      = rwmb_meta('vbegy_post_pagination','radio',$post->ID);
	$post_number          = rwmb_meta('vbegy_post_number','text',$post->ID);
	$orderby_post         = rwmb_meta('vbegy_orderby_post','select',$post->ID);
	$post_display         = rwmb_meta('vbegy_post_display','select',$post->ID);
	$post_single_category = rwmb_meta('vbegy_post_single_category','select',$post->ID);
	$post_categories      = rwmb_meta('vbegy_post_categories','type=checkbox_list',$post->ID);
	$post_posts           = get_post_meta($post->ID,'vbegy_post_posts');
	$post_number          = (isset($post_number) && $post_number != ""?$post_number:get_option("posts_per_page"));
	$vbegy_post_columns   = rwmb_meta("vbegy_post_columns","select",$post->ID);
	$post_portfolio_type  = rwmb_meta("vbegy_post_portfolio_type","select",$post->ID);
	$vbegy_post_margin    = rwmb_meta("vbegy_post_margin","select",$post->ID);
	$vbegy_post_options   = rwmb_meta("vbegy_post_options","select",$post->ID);
	
	$page_tamplate        = true;
	if ($posts_meta == 1) {
		$posts_meta = "on";
	}
	if ($post_type_option == 1) {
		$post_type_option = "on";
	}
	if ($post_author == 1) {
		$post_author = "on";
	}
	if ($post_share == 1) {
		$post_share = "on";
	}
	if ($post_views == 1) {
		$post_views = "on";
	}
	global $vbegy_sidebar;
	$vbegy_sidebar = $vbegy_sidebar_all;
	$author_by     = vpanel_options("author_by");
	if ($post_style == "style_2" || $post_style == "style_3") {echo "<div class='row blog-all isotope'>";}
	$paged = (get_query_var("paged") != ""?(int)get_query_var("paged"):(get_query_var("page") != ""?(int)get_query_var("page"):1));
	if ($orderby_post == "popular") {
		$orderby_post = array('orderby' => 'comment_count');
	}else if ($orderby_post == "random") {
		$orderby_post = array('orderby' => 'rand');
	}else {
		$orderby_post = array();
	}
	
	$taxonomy = 'category';
	$paged = (get_query_var("paged") != ""?(int)get_query_var("paged"):(get_query_var("page") != ""?(int)get_query_var("page"):1));
	if ($post_display == "single_category") {
		$cats_post = array("post_type" => "post","paged" => $paged,"posts_per_page" => $post_number,'tax_query' => array(array('taxonomy' => $taxonomy,'field' => 'id','terms' => $post_single_category)));
	}else if ($post_display == "multiple_categories") {
		$cats_post = array("post_type" => "post","paged" => $paged,"posts_per_page" => $post_number,'tax_query' => array(array('taxonomy' => $taxonomy,'field' => 'id','terms' => $post_categories)));
	}else if ($post_display == "posts") {
		$post_posts = explode(",",$post_posts);
		$cats_post = array('post__in' => $post_posts,'ignore_sticky_posts' => 1);
	}else {
		$cats_post = array("post_type" => "post","paged" => $paged,"posts_per_page" => $post_number);
	}
	
	query_posts(array_merge($orderby_post,$cats_post));
	get_template_part("loop");
	if ($post_style == "style_2" || $post_style == "style_3") {echo "</div>";}
	if ($post_style != "portfolio_style" || (isset($post_style) && $post_style == "portfolio_style" && isset($vbegy_post_options) && ($vbegy_post_options == "pagination" || $vbegy_post_options == "filter_pagination"))) {
		get_template_part("includes/pagination");
	}
	wp_reset_postdata();
get_footer();?>