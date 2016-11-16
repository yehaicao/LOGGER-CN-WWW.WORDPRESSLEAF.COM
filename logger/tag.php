<?php get_header();
	$vbegy_sidebar_all = vpanel_options("sidebar_layout");
	$post_style = vpanel_options("post_style");
	if ($post_style == "style_2" || $post_style == "style_3") {echo "<div class='row blog-all isotope'>";}
	get_template_part("loop","tag");
	if ($post_style == "style_2" || $post_style == "style_3") {echo "</div>";}
	get_template_part("includes/pagination");
get_footer();?>