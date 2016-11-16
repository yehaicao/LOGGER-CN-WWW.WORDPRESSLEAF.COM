<?php if ( class_exists( 'woocommerce' ) ) {
	add_theme_support( 'woocommerce' );
	/* Custom woocommerece styles/scripts */
	add_action( 'wp_enqueue_scripts', 'wp_enqueue_woocommerce_style' );
	function wp_enqueue_woocommerce_style() {
		if (is_rtl()) {
			wp_register_style( 'woocommerce', get_template_directory_uri() . '/admin/woocommerce/woocommerce-rtl.css' );
			wp_register_style( 'woocommerce-responsive', get_template_directory_uri() . '/admin/woocommerce/woocommerce-media-rtl.css' );
		}else {
			wp_register_style( 'woocommerce', get_template_directory_uri() . '/admin/woocommerce/woocommerce.css' );
			wp_register_style( 'woocommerce-responsive', get_template_directory_uri() . '/admin/woocommerce/woocommerce-media.css' );
		}
		wp_register_script( 'woocommerce-js', get_template_directory_uri() . '/admin/woocommerce/woocommerce.js' );
		wp_enqueue_style( 'woocommerce' );
		wp_enqueue_script( 'prettyphoto' );
		wp_enqueue_script( 'woocommerce-js' );
		wp_enqueue_style('woocommerce-responsive');
		wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
		wp_dequeue_script( 'prettyPhoto-init' ); // in my js
	}
	// Remove woocommerce defauly styles
	add_filter( 'woocommerce_enqueue_styles', '__return_false' );
	/* Add my owns */
	add_action( 'woocommerce_before_shop_loop', 'woocommerce_cusotm_ordering_p1', 10 );
	add_action( 'woocommerce_before_shop_loop', 'woocommerce_cusotm_ordering_p2', 30 );
	/* Remove from the product */
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
	/* add to product */
	add_action( 'woocommerce_before_shop_loop_item', 'woocommerce_show_product_loop_sale_flash', 10);
	add_action( 'woocommerce_before_shop_loop_item', 'woocommerce_shop_thumbnail', 10);
	add_action( 'woocommerce_woo_product_head', 'woocommerce_template_loop_add_to_cart', 10);
	add_action( 'woocommerce_woo_product_details', 'woocommerce_template_loop_add_to_cart', 20);
	add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_get_categories', 1 );
	remove_filter( 'woocommerce_cart_item_price','woocommerce_cart_item_price');
	
	function woocommerce_get_categories () {
		global $product,$woocommerce;
		echo $product->get_categories( ', ', '' );
	}
	/* Functions Start Here */
	add_filter('woocommerce_show_page_title', 'override_page_title');
	function override_page_title() {
		return false;
	}
	//custom order
	function woocommerce_cusotm_ordering_p1() {
		echo '<div class="clearfix"></div><div class="woocommerce-sort-by">';
	}
	function woocommerce_cusotm_ordering_p2() {
		echo '</div><div class="clearfix"></div>';
	}
	
	//thumbnail
	function woocommerce_shop_thumbnail () {
		global $product,$woocommerce;
		$rating = $product->get_rating_html(); //get rating
		$cart_url = $woocommerce->cart->get_cart_url();
		$output = "<div class='woocommerce_product_thumbnail'><div class='overlay'></div>";
		$output .= get_aq_resize_img('full',230,280);
		$output .= woocommerce_add_to_cart_button();
		if($product->product_type == 'simple') $output .= "<a href='$cart_url' class='woocommerce_cart_loading woocommerce_added_check'></a>";
		$output .= "</div>";
		echo $output;
	}
	//prducts per row
	add_filter('loop_shop_columns', 'woocommerce_loop_columns');
	if (!function_exists('loop_columns')) {
		function woocommerce_loop_columns() {
			$cols = vpanel_options('shop_products_columns');
			if (empty($cols)) {
				$cols = 3;
			}
			return $cols; 
		}
	}
	/* add to cart button */
	function woocommerce_add_to_cart_button() {
		global $product,$woocommerce,$yith_wcwl;
		
		if ($product->product_type == 'bundle' ){
			$product = new WC_Product_Bundle($product->id);
		}
		$btclass  = "";
		$output = '';
		ob_start();
		woocommerce_template_loop_add_to_cart();
		$output .= ob_get_clean();
		if (!empty($output)) {
			$pos = strpos($output, ">");
			if ($pos !== false) {
				$output = substr_replace($output,">", $pos , strlen(1));
			}
		}
		if ($product->product_type == 'variable' && empty($output)) {
			$output = "<a class='woocommerce_woo_bt button button' href='".get_permalink($product->id)."'>".__('Select options','vbegy')."</a>";
		}
		if ( class_exists( 'YITH_WCWL_UI' ) )  {
			//$output .= do_shortcode( "[yith_wcwl_add_to_wishlist]" );
		}
		if ($product->product_type == 'simple') {
			//$output .= "<br><a class='woocommerce_woo_bt show_details_button button' href='".get_permalink($product->id)."'>".__('Show details','vbegy')."</a>";
		}else {
			$btclass  = "single_bt";
		}
		if($output) return "<div class='woocommerce_woo_cart_bt $btclass'>$output</div>";
	}
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products',20);
	remove_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products',10);
	add_action( 'woocommerce_after_single_product', 'vpanel_related_products', 20);
	function vpanel_related_products() {
		global $post;
		$sidebar_post = rwmb_meta('vbegy_sidebar','radio',$post->ID);
		$related_post_s = rwmb_meta('vbegy_related_post_s','checkbox',$post->ID);
		$related_number_s = rwmb_meta('vbegy_related_number_s','text',$post->ID);
		$custom_page_setting = rwmb_meta('vbegy_custom_page_setting','checkbox',$post->ID);
		$related_post = vpanel_options("related_post");
		if (($related_post == "on" && $related_post_s == "") || ($related_post == "on" && isset($custom_page_setting) && $custom_page_setting == 0) || ($related_post == "on" && isset($custom_page_setting) && $custom_page_setting == 1 && isset($related_post_s) && $related_post_s != 0) || (isset($custom_page_setting) && $custom_page_setting == 1 && isset($related_post_s) && $related_post_s == 1)) {
			
			if (isset($custom_page_setting) && $custom_page_setting == 1) {
				$related_number = $related_number_s;
				$related_number = (isset($related_number) && $related_number?$related_number:3);
			}else {
				if (isset($sidebar_post) && $sidebar_post == "full") {
					$related_number = vpanel_options('related_products_number_full');
					$related_number = (isset($related_number) && $related_number?$related_number:4);
				}else {
					$related_number = vpanel_options('related_products_number');
					$related_number = (isset($related_number) && $related_number?$related_number:3);
				}
			}
		
			woocommerce_related_products(array('posts_per_page' => $related_number));
		}
	}
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
	remove_action( 'woocommerce_after_single_product', 'woocommerce_upsell_display',10);
	add_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsells_products', 19);
	function woocommerce_upsells_products() {
		woocommerce_upsell_display(4,4);
	}
	/* products per page */
	$pcount = vpanel_options('woo_products_per_page');
	if ($pcount == '') {
		$pcount = 9;
	}
	add_filter( 'loop_shop_per_page', create_function( '$cols', 'global $pcount; return $pcount;' ), 20 );
	/* breadcrumb */
	add_filter( 'woocommerce_breadcrumb_defaults', 'woocommerce_change_breadcrumb_delimiter' );
	function woocommerce_change_breadcrumb_delimiter( $defaults ) {
		$defaults['delimiter'] = '';
		if (is_rtl()) {
			$defaults['delimiter'] = '';
		}
		return $defaults;
	}
	/* pagination */
	remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
	function woocommerce_woo_pagination() {
		echo "<div class='clearfix'></div>";
		vpanel_pagination();	
	}
	add_action( 'woocommerce_after_shop_loop', 'woocommerce_woo_pagination', 10);
	/* Single Product */
	add_action( 'woocommerce_single_product_summary', 'product_share_views',50);
	add_action( 'woocommerce_after_single_product_summary', 'product_navigation',10);
	/* functions */
	function product_navigation () {
		global $post;
		$post_navigation = vpanel_options("post_navigation");
		$post_navigation_s = rwmb_meta('vbegy_post_navigation_s','checkbox',$post->ID);
		$custom_page_setting = rwmb_meta('vbegy_custom_page_setting','checkbox',$post->ID);
		if (($post_navigation == "on" && $post_navigation_s == "") || ($post_navigation == "on" && isset($custom_page_setting) && $custom_page_setting == 0) || ($post_navigation == "on" && isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_navigation_s) && $post_navigation_s != 0) || (isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_navigation_s) && $post_navigation_s == 1)) {?>
			<div class="clearfix"></div>
			<div class="page-navigation page-navigation-single clearfix row">
				<div class="col-md-6">
					<div class="nav-next"><?php previous_post('%','<span>'.__('Previous product','vbegy').'</span><br>');?></div>
				</div>
				<div class="col-md-6">
					<div class="nav-previous"><?php next_post('%','<span>'.__('Next product','vbegy').'</span><br>')?></div>
				</div>
			</div><!-- End page-navigation -->
		<?php }
	}
	function product_share_views () {
		global $post;
		$post_views = vpanel_options("post_views");
		$post_share = vpanel_options("post_share");
		$post_share_s = rwmb_meta('vbegy_post_share_s','checkbox',$post->ID);
		$post_views_s = rwmb_meta('vbegy_post_views_s','checkbox',$post->ID);
		$custom_page_setting = rwmb_meta('vbegy_custom_page_setting','checkbox',$post->ID);
		if ((($post_views == "on" && $post_views_s == "") || ($post_views == "on" && isset($custom_page_setting) && $custom_page_setting == 0) || ($post_views == "on" && isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_views_s) && $post_views_s != 0) || (isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_views_s) && $post_views_s == 1)) || (($post_share == "on" && $post_share_s == "") || ($post_share == "on" && isset($custom_page_setting) && $custom_page_setting == 0) || ($post_share == "on" && isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_share_s) && $post_share_s != 0) || (isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_share_s) && $post_share_s == 1))) {
			if (($post_views == "on" && $post_views_s == "") || ($post_views == "on" && isset($custom_page_setting) && $custom_page_setting == 0) || ($post_views == "on" && isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_views_s) && $post_views_s != 0) || (isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_views_s) && $post_views_s == 1)) {
				$post_stats = get_post_meta($post->ID, 'post_stats', true);
				/*<div><i class="fa fa-eye"></i><span><?php echo (isset($post_stats) && $post_stats != ""?(int)$post_stats:0)?> </span><?php _e("Views","vbegy")?></div>*/
			}
			if (($post_share == "on" && $post_share_s == "") || ($post_share == "on" && isset($custom_page_setting) && $custom_page_setting == 0) || ($post_share == "on" && isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_share_s) && $post_share_s != 0) || (isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_share_s) && $post_share_s == 1)) {?>
				<h4 class="woo-share-title"><?php _e("Share This","vbegy")?></h4>
				<div class="woo-share-social">
					<ul>
						<li class="social-facebook"><a href="http://www.facebook.com/sharer.php?u=<?php echo urlencode(get_permalink());?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
						<li class="social-twitter"><a href="http://twitter.com/home?status=<?php echo urlencode(get_permalink());?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
						<li class="social-google"><a href="http://plus.google.com/share?url=<?php echo urlencode(get_permalink());?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
					</ul>
				</div><!-- End follow-social -->
			<?php }
		}
	}
	function woocommerce_is_woocommerce_page () {
		if (function_exists ( "is_woocommerce" ) && is_woocommerce()) {
			return true;
		}
		$woocommerce_keys =
		array ( "woocommerce_shop_page_id" ,
			"woocommerce_terms_page_id" ,
			"woocommerce_cart_page_id" ,
			"woocommerce_checkout_page_id" ,
			"woocommerce_pay_page_id" ,
			"woocommerce_thanks_page_id" ,
			"woocommerce_myaccount_page_id" ,
			"woocommerce_edit_address_page_id" ,
			"woocommerce_view_order_page_id" ,
			"woocommerce_change_password_page_id" ,
			"woocommerce_logout_page_id" ,
			"woocommerce_lost_password_page_id" );
		foreach ( $woocommerce_keys as $wc_page_id ) {
			if ( get_the_ID () == get_option ( $wc_page_id , 0 ) ) {
				return true ;
			}
		}
		return false;
	}
	/* Cart in breaking news */
	add_filter( 'wp_nav_menu_items', 'woocommerce_cart_in_bn', 10, 2 );
	function woocommerce_cart_in_bn ( $items, $args ) {
		if ( $args->theme_location == 'breaking') {
			$items .= woocommerce_bn_cart_button();
		}
		return $items;
	}
	function woocommerce_bn_cart_button () {
		$nav_cart = vpanel_options('nav_cart');
		$nav_cart = 1;
		if ($nav_cart == 1) {
			if (class_exists('woocommerce')) {
				global $woocommerce;
				$cart_url = $woocommerce->cart->get_cart_url();
				$num = $woocommerce->cart->cart_contents_count;
			}
			$in_woo = vpanel_options('nav_cart_in_woo');
			$output = '<li><a href="'.$cart_url.'" class="nav-button nav-cart"><i class="enotype-icon-cart"></i><span class="numofitems" data-num="'.$num.'">'.$num.'</span></a></li>';
			
			if ($in_woo) {
				if(function_exists('is_woocommerce') && woocommerce_is_woocommerce_page()) {
					return $output;
				}
			}else {
				return $output;
			}
		} 
	}
	
	add_action( 'init', 'woocommerce_clear_cart_url' );
	function woocommerce_clear_cart_url() {
		global $woocommerce;
		if ( isset( $_GET['empty-cart'] ) ) {
			$woocommerce->cart->empty_cart(); 
		}
	}
}