<?php get_header();
	$vbegy_sidebar = rwmb_meta('vbegy_sidebar','select',$post->ID);
	if ($vbegy_sidebar == "default") {
		$sidebar_layout = vpanel_options('sidebar_layout');
		if ($sidebar_layout == 'centered') {
			$vbegy_sidebar = 'page-centered';
		}elseif ($sidebar_layout == 'left') {
			$vbegy_sidebar = 'page-left-sidebar';
		}elseif ($sidebar_layout == 'full') {
			$vbegy_sidebar = 'full';
		}else {
			$vbegy_sidebar = 'page-right-sidebar';
		}
	}
	
	if (has_post_thumbnail()) {
    	$post_type = " image_post";
	}else {
    	$post_type = " no_image_post";
	}?>
	<article <?php post_class('post clearfix '.$post_type);?> role="article" itemscope="" itemtype="http://schema.org/Article">
		<div class="post-wrap">
    		<div class="post-inner">
				<div class="post-inner-content">
					<?php woocommerce_content(); ?>
				</div>
    			<div class="clearfix"></div>
    		</div><!-- End post-inner -->
		</div><!-- End post-wrap -->
	</article><!-- End post -->
	
	<?php
	$vbegy_share_adv_type = rwmb_meta('vbegy_share_adv_type','radio',$post->ID);
	$vbegy_share_adv_code = rwmb_meta('vbegy_share_adv_code','textarea',$post->ID);
	$vbegy_share_adv_href = rwmb_meta('vbegy_share_adv_href','text',$post->ID);
	$vbegy_share_adv_img = rwmb_meta('vbegy_share_adv_img','upload',$post->ID);
	
	if ((is_single() || is_page()) && (($vbegy_share_adv_type == "display_code" && $vbegy_share_adv_code != "") || ($vbegy_share_adv_type == "custom_image" && $vbegy_share_adv_img != ""))) {
		$share_adv_type = $vbegy_share_adv_type;
		$share_adv_code = $vbegy_share_adv_code;
		$share_adv_href = $vbegy_share_adv_href;
		$share_adv_img = $vbegy_share_adv_img;
	}else {
		$share_adv_type = vpanel_options("share_adv_type");
		$share_adv_code = vpanel_options("share_adv_code");
		$share_adv_href = vpanel_options("share_adv_href");
		$share_adv_img = vpanel_options("share_adv_img");
	}
	if (($share_adv_type == "display_code" && $share_adv_code != "") || ($share_adv_type == "custom_image" && $share_adv_img != "")) {
		echo '<div class="clearfix"></div>
		<div class="advertising">';
		if ($share_adv_type == "display_code") {
			echo stripcslashes($share_adv_code);
		}else {
			if ($share_adv_href != "") {
				echo '<a href="'.$share_adv_href.'">';
			}
			echo '<img alt="" src="'.$share_adv_img.'">';
			if ($share_adv_href != "") {
				echo '</a>';
			}
		}
		echo '</div><!-- End advertising -->
		<div class="clearfix"></div>';
	}
get_footer();?>