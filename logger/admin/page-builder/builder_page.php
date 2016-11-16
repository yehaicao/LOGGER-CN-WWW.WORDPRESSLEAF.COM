<?php
function Vpanel_Builder($builder,$vbegy_sidebar,$key_b) {
	global $post;
	if ($builder['type'] == "slideshow") {
		Vpanel_Slideshow($builder['box_posts_num'],$builder['box_display'],$builder['box_cats'],(isset($builder['categories']) && is_array($builder['categories'])?$builder['categories']:""),$builder['slide_overlay'],(isset($builder['excerpt_title']) && (int)$builder['excerpt_title']?$builder['excerpt_title']:""),(isset($builder['excerpt']) && (int)$builder['excerpt']?$builder['excerpt']:""),(isset($builder['order_by']) && $builder['order_by'] != ""?$builder['order_by']:""),$key_b,$vbegy_sidebar);
	}else if ($builder['type'] == "box_news") {
		Vpanel_Box_News($builder['box_title'],$builder['box_posts_num'],$builder['box_display'],$builder['box_cats'],(isset($builder['categories']) && is_array($builder['categories'])?$builder['categories']:""),$builder['box_style'],(isset($builder['excerpt_title']) && (int)$builder['excerpt_title']?$builder['excerpt_title']:""),(isset($builder['excerpt']) && (int)$builder['excerpt']?$builder['excerpt']:""),(isset($builder['order_by']) && $builder['order_by'] != ""?$builder['order_by']:""),$vbegy_sidebar,(isset($builder['animate']) && $builder['animate'] != ""?$builder['animate']:""));
	}else if ($builder['type'] == "pictures_news") {
		Vpanel_Pictures_News($builder['box_title'],$builder['box_posts_num'],$builder['box_display'],$builder['box_cats'],(isset($builder['categories']) && is_array($builder['categories'])?$builder['categories']:""),$builder['box_style'],(isset($builder['order_by']) && $builder['order_by'] != ""?$builder['order_by']:""),$key_b,$vbegy_sidebar,(isset($builder['animate']) && $builder['animate'] != ""?$builder['animate']:""));
	}else if ($builder['type'] == "tabs_news") {
		Vpanel_Tabs_News($builder['box_title'],$builder['box_posts_num'],(isset($builder['box_cats']) && is_array($builder['box_cats'])?$builder['box_cats']:""),$builder['box_style'],(isset($builder['excerpt_title']) && (int)$builder['excerpt_title']?$builder['excerpt_title']:""),(isset($builder['excerpt']) && (int)$builder['excerpt']?$builder['excerpt']:""),(isset($builder['order_by']) && $builder['order_by'] != ""?$builder['order_by']:""),$vbegy_sidebar,(isset($builder['animate']) && $builder['animate'] != ""?$builder['animate']:""));
	}else if ($builder['type'] == "scroll_news") {
		Vpanel_Scroll_News($builder['box_title'],$builder['box_posts_num'],$builder['box_display'],$builder['box_cats'],(isset($builder['categories']) && is_array($builder['categories'])?$builder['categories']:""),$builder['box_style'],(isset($builder['excerpt_title']) && (int)$builder['excerpt_title']?$builder['excerpt_title']:""),(isset($builder['order_by']) && $builder['order_by'] != ""?$builder['order_by']:""),$key_b,$vbegy_sidebar,(isset($builder['animate']) && $builder['animate'] != ""?$builder['animate']:""));
	}else if ($builder['type'] == "recent_posts") {
		Vpanel_Recent_Posts($builder['box_title'],$builder['box_posts_num'],$builder['box_display'],$builder['box_cats'],(isset($builder['categories']) && is_array($builder['categories'])?$builder['categories']:""),$builder['box_style'],(isset($builder['excerpt_title']) && (int)$builder['excerpt_title']?$builder['excerpt_title']:""),(isset($builder['excerpt']) && (int)$builder['excerpt']?$builder['excerpt']:""),(isset($builder['order_by']) && $builder['order_by'] != ""?$builder['order_by']:""),$vbegy_sidebar,(isset($builder['animate']) && $builder['animate'] != ""?$builder['animate']:""));
	}else if (class_exists('woocommerce') && $builder['type'] == "shop_box") {
		Vpanel_Shop_Box($builder['box_title'],$builder['box_posts_num'],$builder['box_display'],$builder['box_cats'],(isset($builder['categories']) && is_array($builder['categories'])?$builder['categories']:""),(isset($builder['order_by']) && $builder['order_by'] != ""?$builder['order_by']:""),$vbegy_sidebar,(isset($builder['animate']) && $builder['animate'] != ""?$builder['animate']:""),(isset($builder['scroll']) && $builder['scroll'] != ""?$builder['scroll']:""));
	}else if ($builder['type'] == "adv") {
		if ($builder['adv_box'] == "enable") {?>
		<div class="block-box block-adv advertising">
		<?php }else {?>
		<div class="advertising">
		<?php }
			if ($builder['adv_type'] == "display_code") {
				echo htmlspecialchars_decode(stripslashes($builder['adv_code']));
			}else {
				if ($builder['adv_url'] != "") {
					echo "<a href='".$builder['adv_url']."'>";
				}
				echo "<img alt='' src='".$builder['image_url']."'>";
				if ($builder['adv_url'] != "") {
					echo "</a>";
				}
			}
		?>
		</div><!-- End block-box -->
		<?php
	}else if ($builder['type'] == "clear") {
		echo "<div class='clearfix'></div>";
	}else if ($builder['type'] == "gap") {
		echo "<div class='clearfix' style='height:".$builder['box_title']."'></div>";
	}
}
?>