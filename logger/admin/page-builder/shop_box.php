<?php
if (class_exists('woocommerce')) {
	function Vpanel_Shop_Box($box_title,$box_posts_num,$box_display,$box_cats,$categories,$orderby,$vbegy_sidebar,$animate,$scroll) {
		global $post;
		$scroll = (isset($scroll) && $scroll != ""?$scroll:"");
		$animate_class = (isset($animate) && $animate != "" && $animate != "none"?"animation ":"");
		$data_animate = (isset($animate) && $animate != "" && $animate != "none"?" data-animate='".esc_attr($animate)."'":"");
		$date_format = (vpanel_options("date_format")?vpanel_options("date_format"):get_option("date_format"));
		$author_by = vpanel_options("author_by");
		$rand_box = rand(1,1000);
		$implode_c = "";
		if (isset($categories) && is_array($categories)) {
			$implode_c = implode(",",$categories);
		}
		$cat_array = array();
		if (isset($box_display) && $box_display == "categories") {
			$cat_array = array('tax_query' => array(array('taxonomy' => 'product_cat','field' => 'id','terms' => $implode_c)));
		}else if (isset($box_display) && $box_display == "category") {
			$cat_array = array('tax_query' => array(array('taxonomy' => 'product_cat','field' => 'id','terms' => $box_cats)));
		}
		if ($orderby == "popular") {
			$orderby = array('orderby' => 'comment_count');
		}else if ($orderby == "random") {
			$orderby = array('orderby' => 'rand');
		}else {
			$orderby = array();
		}
		query_posts(array_merge($orderby,$cat_array,array('ignore_sticky_posts' => 1,'posts_per_page' => $box_posts_num,'post_type' => 'product')));?>
		<div class="<?php echo ($animate_class)?>block-box<?php echo ($vbegy_sidebar == "full"?" block-box-full":" block-box-half")?>"<?php echo ($data_animate)?>>
			<?php if (isset($box_title) && $box_title != "" || $box_display == "category") {
				if (isset($box_display) && $box_display == "category") {
					$term = get_term($box_cats,'product_cat');
				}?>
				<div class="block-box-title"><?php echo (isset($box_title) && $box_title != ""?$box_title:(isset($box_display) && $box_display == "category"?"<a href='".get_term_link($term->term_id,'product_cat')."'>".$term->name."</a><a class='block-box-title-more' href='".get_term_link($term->term_id,'product_cat')."'>".__("More","vbegy")."</a>":""))?></div>
			<?php }?>
			<div class="woocommerce-page">
				<?php if ($scroll == "yes") {?><div class="carousel-box carousel-box<?php echo esc_attr($rand_box);?>"><?php }?>
				    <ul class = "products woocommerce_products products_grid clearfix">
				        <?php while (have_posts()) : the_post();
				            woocommerce_get_template_part('content', 'product');
				        endwhile;?>
				    </ul>
			    <?php if ($scroll == "yes") {?></div><?php }?>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
		<?php if ($scroll == "yes") {?>
			<script type="text/javascript">
				(function($) { "use strict";
					jQuery(".block-box-half .carousel-box<?php echo esc_js($rand_box);?> > ul").each(function () {
						var vids = jQuery(".product",this);
						for(var i = 0; i < vids.length; i+=3) {
						    vids.slice(i, i+3).wrapAll('<li></li>');
						}
					});
					jQuery(".block-box-full .carousel-box<?php echo esc_js($rand_box);?> > ul").each(function () {
						var vids = jQuery(".product",this);
						for(var i = 0; i < vids.length; i+=4) {
						    vids.slice(i, i+4).wrapAll('<li></li>');
						}
					});
					jQuery(".carousel-box<?php echo esc_js($rand_box);?> > ul").bxSlider({easing: "linear",tickerHover: true,slideWidth: 1170,adaptiveHeightSpeed: 1500,moveSlides: 1,maxSlides: 1,auto: true});
				})(jQuery);
			</script>
		<?php }
	}
}