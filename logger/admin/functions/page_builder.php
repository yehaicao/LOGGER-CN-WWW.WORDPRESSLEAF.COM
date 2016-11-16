<?php
/*-----------------------------------------------------------------------------------*/
/* Add meta boxes */
/*-----------------------------------------------------------------------------------*/
add_action ('add_meta_boxes','builder_meta_boxes');
function builder_meta_boxes() {
	global $post;
	add_meta_box ('builder_slideshow',__('Page slideshow','vbegy'),'builder_slideshow','page','normal','high');
	add_meta_box ('builder_slideshow',__('Page slideshow','vbegy'),'builder_slideshow','post','normal','high');
	add_meta_box ('builder_slideshow',__('Page slideshow','vbegy'),'builder_slideshow','portfolio','normal','high');
	add_meta_box ('builder_meta',__('Page builder','vbegy'),'builder_meta','page','normal','high');
	add_meta_box ('builder_rating',__('Rating','vbegy'),'builder_rating','post','normal','high');
	if ($post->post_status != "auto-draft") {
		add_meta_box ('builder_meta_export',__('Export and Import','vbegy'),'builder_meta_export','page','side','core');
		add_meta_box ('builder_meta_export',__('Export and Import','vbegy'),'builder_meta_export','landing','side','core');
	}
	add_meta_box ('builder_meta_export',__('Sort the sections','vbegy'),'sort_the_sections','post','side','low');
	add_meta_box ('builder_meta_export',__('Sort the sections','vbegy'),'sort_the_sections','portfolio','side','low');
}
/*-----------------------------------------------------------------------------------*/
/* Sort the sections */
/*-----------------------------------------------------------------------------------*/
function sort_the_sections() {
	global $post;
	$vbegy_custom_sections = get_post_meta($post->ID,"vbegy_custom_sections",true);
	?>
	<div class="minor-publishing">
		<div class="rwmb-field">
			<div class="rwmb-label">
				<label for="vbegy_custom_sections">Custom sections</label>
			</div>
			<div class="rwmb-input vpanel_checkbox_input">
				<input type="checkbox" class="rwmb-checkbox" name="vbegy_custom_sections" id="vbegy_custom_sections" value="1"<?php if (isset($vbegy_custom_sections) && $vbegy_custom_sections == 1) {echo " checked='checked'";}?>>
			</div>
		</div>
		<ul id="sort-sections">
			<?php
			$order_sections_li = get_post_meta($post->ID,"order_sections_li");
			if (empty($order_sections_li)) {
				$order_sections_li = array(0 => array(1 => "next_previous",2 => "advertising",3 => "author",4 => "related",5 => "comments"));
			}
			$order_sections = $order_sections_li[0];
			$i = 0;
			foreach ($order_sections as $key_r => $value_r) {
				$i++;
				if ($value_r == "") {
					unset($order_sections[$key_r]);
				}else {?>
					<li id="<?php echo esc_attr($value_r)?>" class="ui-state-default">
						<div class="widget-head"><span>
						<?php if ($value_r == "next_previous") {
							echo esc_attr("Next and Previous articles");
						}else if ($value_r == "advertising") {
							echo esc_attr("Advertising");
						}else if ($value_r == "author") {
							echo esc_attr("About the author");
						}else if ($value_r == "related") {
							echo esc_attr("Related articles");
						}else if ($value_r == "comments") {
							echo esc_attr("Comments");
						}?>
						</span></div>
						<input name="order_sections_li[<?php echo esc_attr($i);?>]" value="<?php if ($value_r == "next_previous") {echo esc_attr("next_previous");}else if ($value_r == "advertising") {echo esc_attr("advertising");}else if ($value_r == "author") {echo esc_attr("author");}else if ($value_r == "related") {echo esc_attr("related");}else if ($value_r == "comments") {echo esc_attr("comments");}?>" type="hidden">
					</li>
				<?php }
			}
			?>
		</ul>
	</div>
	<?php
}
/*-----------------------------------------------------------------------------------*/
/* builder meta box export and import */
/*-----------------------------------------------------------------------------------*/
$export = array("builder_item","builder_slide_item");
function builder_meta_export() {
	global $post,$export;
	$current_options = array();
	foreach($export as $option) {
		if (get_post_meta($post->ID,$option))
			$current_options[$option] = get_post_meta($post->ID,$option);
			$current_options[$option] = get_post_meta($post->ID,$option,true);
	}
	?>
	<div class="minor-publishing">
		<textarea class="builder_textarea builder_select" id="builder_textarea"><?php echo json_encode($current_options);?></textarea>
		<p><?php _e('This is ( Page builder , Custom Slideshow ).','vbegy')?></p>
	</div>
	<div class="major-publishing-actions">
		<a class="button button-primary button-large builder_import"><?php _e('Import','vbegy')?></a>
	</div>
	<?php
}
add_action("wp_ajax_nopriv_save_builder_import","save_builder_import");
add_action("wp_ajax_save_builder_import","save_builder_import");
function save_builder_import() {
	global $export;
	$builder_textarea = json_decode(stripcslashes($_POST["builder_textarea"]),true);
	$post_id = (int)esc_html($_POST["post_id"]);
	foreach($export as $option) {
		update_post_meta($post_id,$option,$builder_textarea[$option]);
	}
	die();
}
/*-----------------------------------------------------------------------------------*/
/* builder meta box */
/*-----------------------------------------------------------------------------------*/
function builder_meta() {
	global $post;
	wp_nonce_field ('builder_save_meta','builder_save_meta_nonce');
	$categories_obj = get_categories('hide_empty=0');
	$categories = array();
	foreach ($categories_obj as $pn_cat) {
		$categories[$pn_cat->cat_ID] = $pn_cat->cat_name;
	}
	
	$product_cat_obj = get_categories('hide_empty=0&taxonomy=product_cat');
	$product_cat = array();
	foreach ($product_cat_obj as $p_cat) {
		$product_cat[$p_cat->cat_ID] = $p_cat->cat_name;
	}
	$vbegy_pagination = get_post_meta($post->ID,"vbegy_pagination",true);
	?>
	<div class="rwmb-field">
		<div class="rwmb-label">
			<label for="vbegy_pagination">Pagination</label>
		</div>
		<div class="rwmb-input vpanel_checkbox_input">
			<input type="checkbox" class="rwmb-checkbox" name="vbegy_pagination" id="vbegy_pagination" value="1"<?php if (isset($vbegy_pagination) && $vbegy_pagination == 1) {echo " checked='checked'";}?>>
		</div>
	</div>
	
	<select style="display:none" id="categories_select">
		<?php foreach ($categories as $key => $option) {?>
		<option value="<?php echo esc_attr($key);?>"><?php echo esc_attr($option);?></option>
		<?php }?>
	</select>
	<select style="display:none" id="product_cat">
		<?php foreach ($product_cat as $key => $option) {?>
		<option value="<?php echo esc_attr($key);?>"><?php echo esc_attr($option);?></option>
		<?php }?>
	</select>
	
	<div class="add-item" add-item="slideshow"><?php _e('+ Slideshow','vbegy')?></div>
	<div class="add-item" add-item="box_news"><?php _e('+ Box news','vbegy')?></div>
	<div class="add-item" add-item="pictures_news"><?php _e('+ Pictures news','vbegy')?></div>
	<div class="add-item" add-item="tabs_news"><?php _e('+ Tabs box news','vbegy')?></div>
	<div class="add-item" add-item="scroll_news"><?php _e('+ Scroll news','vbegy')?></div>
	<div class="add-item" add-item="recent_posts"><?php _e('+ Recent posts','vbegy')?></div>
	<?php if (class_exists('woocommerce')) {?>
		<div class="add-item" add-item="shop_box"><?php _e('+ Shop box','vbegy')?></div>
	<?php }?>
	<div class="add-item" add-item="adv"><?php _e('+ Adv or HTML code','vbegy')?></div>
	<div class="add-item" add-item="clear"><?php _e('+ Clear','vbegy')?></div>
	<div class="add-item" add-item="gap"><?php _e('+ Gap','vbegy')?></div>
    <div class="clear"></div>
    
    <a id="expand-all">
    	<span class="expand-all"><?php _e('[+] Expand All','vbegy')?></span>
    	<span class="expand-all2"><?php _e('[-] Collapse All','vbegy')?></span>
    </a>
    <div class="clear"></div>
    
	<ul id="builder">
    	<?php
		$builder_item = get_post_meta($post->ID,'builder_item');
		$i = 0;
		if ($builder_item) {
			$builder_item = $builder_item[0];
			foreach ($builder_item as $builder) {$i++;
				?>
				<li id="builder_<?php echo esc_attr($i);?>" class="ui-state-default">
				    <?php if ($builder['type'] == 'slideshow') {?>
				    	<div class="widget-head">
				    		<span class="vpanel<?php echo esc_attr($i);?>">Slideshow - <span><?php echo (isset($builder['box_title']) && $builder['box_title'] != ""?$builder['box_title']:(isset($builder['box_display']) && $builder['box_display'] == "category"?get_the_category_by_ID($builder['box_cats']):""))?></span></span>
				    		<a class="builder-toggle-open">+</a>
				    		<a class="builder-toggle-close">-</a>
				    	</div>
				    	<div class="widget-content">
				    	    <label for="builder_item[<?php echo esc_attr($i);?>][box_title]">
				    	    	<span>Slideshow title :</span>
				    	        <input id="builder_item[<?php echo esc_attr($i);?>][box_title]" class="builder_label_key" name="builder_item[<?php echo esc_attr($i);?>][box_title]" value="<?php echo (isset($builder['box_title'])?$builder['box_title']:"")?>" type="text">
				    	    </label>
				    	    
				    	    <label for="builder_item[<?php echo esc_attr($i);?>][box_posts_num]">
				    	        <span>Number of posts :</span>
				    	        <input id="builder_item[<?php echo esc_attr($i);?>][box_posts_num]" name="builder_item[<?php echo esc_attr($i);?>][box_posts_num]" value="<?php echo (isset($builder['box_posts_num'])?$builder['box_posts_num']:"")?>" type="text">
				    	    </label>
				    	    
				    	    <label for="builder_item[<?php echo esc_attr($i);?>][box_display]">
				    	        <span>Display :</span>
				    	    	<div class="styled-select">
				    	            <select class="builder_box_display" id="builder_item[<?php echo esc_attr($i);?>][box_display]" name="builder_item[<?php echo esc_attr($i);?>][box_display]">
				    	        		<option value="">Latest Posts</option>
				    	        		<option value="category" <?php if (isset($builder['box_display']) && $builder['box_display'] == "category") {echo ' selected="selected"';}?>>Single Category</option>
				    	        		<option value="categories" <?php if (isset($builder['box_display']) && $builder['box_display'] == "categories") {echo ' selected="selected"';}?>>Multiple categories</option>
				    	            </select>
				    	        </div>
				    	    </label>
				    	    
				    	    <label class="label_category" for="builder_item[<?php echo esc_attr($i);?>][box_cats]">
				    	        <span>Category :</span>
				    	    	<div class="styled-select">
				    	            <select class="builder_select_name" id="builder_item[<?php echo esc_attr($i);?>][box_cats]" name="builder_item[<?php echo esc_attr($i);?>][box_cats]">
				    	            <?php foreach ($categories as $key => $option) {?>
				    	        		<option value="<?php echo esc_attr($key);?>" <?php if ($builder['box_cats'] == $key) {echo ' selected="selected"';}?>><?php echo esc_attr($option);?></option>
				    	        	<?php }?>
				    	            </select>
				    	        </div>
				    	    </label>
				    	    
				    	    <label class="label_categories" for="builder_item[<?php echo esc_attr($i);?>][categories]">
				    	        <span>Categories :</span>
				    	        <select multiple="multiple" id="builder_item[<?php echo esc_attr($i);?>][categories][]" name="builder_item[<?php echo esc_attr($i);?>][categories][]">
				    	        	<?php foreach ($categories as $key => $option) {?>
				    	        		<option value="<?php echo esc_attr($key) ?>" <?php if (isset($builder['categories']) && is_array($builder['categories']) && in_array($key,$builder['categories'])) {echo ' selected="selected"';} ?>><?php echo esc_attr($option); ?></option>
				    	        	<?php } ?>
				    	        </select>
				    	        <div class="clear"></div>
				    	    </label>
				    	    
				    	    <label for="builder_item[<?php echo esc_attr($i);?>][slide_overlay]">
				    	        <span>Slideshow overlay :</span>
				    	    	<div class="styled-select">
				    	            <select id="builder_item[<?php echo esc_attr($i);?>][slide_overlay]" name="builder_item[<?php echo esc_attr($i);?>][slide_overlay]">
				    	        		<option value="enable" <?php if ($builder['slide_overlay'] == "enable") {echo ' selected="selected"';}?>>Enable</option>
				    	        		<option value="title" <?php if ($builder['slide_overlay'] == "title") {echo ' selected="selected"';}?>>Show title only</option>
				    	        		<option value="disable" <?php if ($builder['slide_overlay'] == "disable") {echo ' selected="selected"';}?>>Disable</option>
				    	            </select>
				    	        </div>
				    	    </label>
				    	    
				    	    <label for="builder_item[<?php echo esc_attr($i);?>][excerpt_title]">
				    	    	<span>Excerpt title :</span>
				    	        <input id="builder_item[<?php echo esc_attr($i);?>][excerpt_title]" name="builder_item[<?php echo esc_attr($i);?>][excerpt_title]" value="<?php echo (isset($builder['excerpt_title'])?$builder['excerpt_title']:"5")?>" type="text">
				    	    </label>
				    	    
				    	    <label for="builder_item[<?php echo esc_attr($i);?>][excerpt]">
				    	    	<span>Excerpt :</span>
				    	        <input id="builder_item[<?php echo esc_attr($i);?>][excerpt]" name="builder_item[<?php echo esc_attr($i);?>][excerpt]" value="<?php echo (isset($builder['excerpt'])?$builder['excerpt']:"25")?>" type="text">
				    	    </label>
				    	    
				    	    <label for="builder_item[<?php echo esc_attr($i);?>][order_by]">
				    	        <span>Order by :</span>
				    	    	<div class="styled-select">
				    	            <select id="builder_item[<?php echo esc_attr($i);?>][order_by]" name="builder_item[<?php echo esc_attr($i);?>][order_by]">
				    	        		<option value="recent" <?php if (isset($builder['order_by']) && $builder['order_by'] == "recent") {echo ' selected="selected"';}?>>Recent</option>
				    	        		<option value="popular" <?php if (isset($builder['order_by']) && $builder['order_by'] == "popular") {echo ' selected="selected"';}?>>Popular</option>
				    	        		<option value="random" <?php if (isset($builder['order_by']) && $builder['order_by'] == "random") {echo ' selected="selected"';}?>>Random</option>
				    	            </select>
				    	        </div>
				    	    </label>
				    	    
				    		<input id="builder_item[<?php echo esc_attr($i);?>][type]" name="builder_item[<?php echo esc_attr($i);?>][type]" value="<?php echo (isset($builder['type'])?$builder['type']:"");?>" type="hidden">
				    	</div>
				    <?php }else if ($builder['type'] == 'box_news') {?>
						<div class="widget-head">
							<span class="vpanel<?php echo esc_attr($i);?>">Box news - <span><?php echo (isset($builder['box_title']) && $builder['box_title'] != ""?$builder['box_title']:(isset($builder['box_display']) && $builder['box_display'] == "category"?get_the_category_by_ID($builder['box_cats']):""))?></span></span>
							<a class="builder-toggle-open">+</a>
							<a class="builder-toggle-close">-</a>
						</div>
						<div class="widget-content">
				            <label for="builder_item[<?php echo esc_attr($i);?>][box_title]">
				            	<span>Box title :</span>
				                <input id="builder_item[<?php echo esc_attr($i);?>][box_title]" class="builder_label_key" name="builder_item[<?php echo esc_attr($i);?>][box_title]" value="<?php echo (isset($builder['box_title'])?$builder['box_title']:"")?>" type="text">
				                <div class="explain vpanel_help"><div class="tooltip_s" data-title="Leave field blank if you want show the category name ."><i class="dashicons dashicons-info"></i></div></div>
				            </label>
				            
				            <label for="builder_item[<?php echo esc_attr($i);?>][box_posts_num]">
				                <span>Number of posts :</span>
				                <input id="builder_item[<?php echo esc_attr($i);?>][box_posts_num]" name="builder_item[<?php echo esc_attr($i);?>][box_posts_num]" value="<?php echo (isset($builder['box_posts_num'])?$builder['box_posts_num']:"")?>" type="text">
				            </label>
				            
				            <label for="builder_item[<?php echo esc_attr($i);?>][box_display]">
				                <span>Display :</span>
				            	<div class="styled-select">
				                    <select class="builder_box_display" id="builder_item[<?php echo esc_attr($i);?>][box_display]" name="builder_item[<?php echo esc_attr($i);?>][box_display]">
				                		<option value="">Latest Posts</option>
				                		<option value="category" <?php if (isset($builder['box_display']) && $builder['box_display'] == "category") {echo ' selected="selected"';}?>>Single Category</option>
				                		<option value="categories" <?php if (isset($builder['box_display']) && $builder['box_display'] == "categories") {echo ' selected="selected"';}?>>Multiple categories</option>
				                    </select>
				                </div>
				            </label>
				            
				            <label class="label_category" for="builder_item[<?php echo esc_attr($i);?>][box_cats]">
				                <span>Category :</span>
				            	<div class="styled-select">
				                    <select class="builder_select_name" id="builder_item[<?php echo esc_attr($i);?>][box_cats]" name="builder_item[<?php echo esc_attr($i);?>][box_cats]">
				                    <?php foreach ($categories as $key => $option) {?>
				                		<option value="<?php echo esc_attr($key);?>" <?php if ($builder['box_cats'] == $key) {echo ' selected="selected"';}?>><?php echo esc_attr($option);?></option>
				                	<?php }?>
				                    </select>
				                </div>
				            </label>
				            
				            <label class="label_categories" for="builder_item[<?php echo esc_attr($i);?>][categories]">
				                <span>Categories :</span>
			                	<select multiple="multiple" id="builder_item[<?php echo esc_attr($i);?>][categories][]" name="builder_item[<?php echo esc_attr($i);?>][categories][]">
			                		<?php foreach ($categories as $key => $option) {?>
			                			<option value="<?php echo esc_attr($key) ?>" <?php if (isset($builder['categories']) && is_array($builder['categories']) && in_array($key,$builder['categories'])) {echo ' selected="selected"';} ?>><?php echo esc_attr($option); ?></option>
			                		<?php } ?>
			                	</select>
				                <div class="clear"></div>
				            </label>
				            
				            <label>
				                <span>Box style :</span>
				                <ul class="checkbox_select">
									<li>
										<input type="radio" <?php if (isset($builder['box_style']) && $builder['box_style'] == "home_1") {echo ' checked="checked"';}?> value="home_1" id="builder_item[<?php echo esc_attr($i);?>][home_1]" name="builder_item[<?php echo esc_attr($i);?>][box_style]">
										<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri();?>/admin/images/home_1.png"></a>
									</li>
									<li>
										<input type="radio" <?php if (isset($builder['box_style']) && $builder['box_style'] == "home_2") {echo ' checked="checked"';}?> value="home_2" id="builder_item[<?php echo esc_attr($i);?>][home_2]" name="builder_item[<?php echo esc_attr($i);?>][box_style]">
										<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri();?>/admin/images/home_2.png"></a>
									</li>
									<li>
										<input type="radio" <?php if (isset($builder['box_style']) && $builder['box_style'] == "home_3") {echo ' checked="checked"';}?> value="home_3" id="builder_item[<?php echo esc_attr($i);?>][home_3]" name="builder_item[<?php echo esc_attr($i);?>][box_style]">
										<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri();?>/admin/images/home_3.png"></a>
									</li>
									<li>
										<input type="radio" <?php if (isset($builder['box_style']) && $builder['box_style'] == "home_4") {echo ' checked="checked"';}?> value="home_4" id="builder_item[<?php echo esc_attr($i);?>][home_4]" name="builder_item[<?php echo esc_attr($i);?>][box_style]">
										<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri();?>/admin/images/home_4.png"></a>
									</li>
									<li>
										<input type="radio" <?php if (isset($builder['box_style']) && $builder['box_style'] == "home_5") {echo ' checked="checked"';}?> value="home_5" id="builder_item[<?php echo esc_attr($i);?>][home_5]" name="builder_item[<?php echo esc_attr($i);?>][box_style]">
										<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri();?>/admin/images/home_5.png"></a>
									</li>
									<li>
										<input type="radio" <?php if (isset($builder['box_style']) && $builder['box_style'] == "home_6") {echo ' checked="checked"';}?> value="home_6" id="builder_item[<?php echo esc_attr($i);?>][home_6]" name="builder_item[<?php echo esc_attr($i);?>][box_style]">
										<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri();?>/admin/images/home_6.png"></a>
									</li>
									<li>
										<input type="radio" <?php if (isset($builder['box_style']) && $builder['box_style'] == "home_7") {echo ' checked="checked"';}?> value="home_7" id="builder_item[<?php echo esc_attr($i);?>][home_7]" name="builder_item[<?php echo esc_attr($i);?>][box_style]">
										<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri();?>/admin/images/home_7.png"></a>
									</li>
									<li>
										<input type="radio" <?php if (isset($builder['box_style']) && $builder['box_style'] == "home_8") {echo ' checked="checked"';}?> value="home_8" id="builder_item[<?php echo esc_attr($i);?>][home_8]" name="builder_item[<?php echo esc_attr($i);?>][box_style]">
										<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri();?>/admin/images/home_8.png"></a>
									</li>
									<li>
										<input type="radio" <?php if (isset($builder['box_style']) && $builder['box_style'] == "home_9") {echo ' checked="checked"';}?> value="home_9" id="builder_item[<?php echo esc_attr($i);?>][home_9]" name="builder_item[<?php echo esc_attr($i);?>][box_style]">
										<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri();?>/admin/images/home_9.png"></a>
									</li>
									<li>
										<input type="radio" <?php if (isset($builder['box_style']) && $builder['box_style'] == "home_10") {echo ' checked="checked"';}?> value="home_10" id="builder_item[<?php echo esc_attr($i);?>][home_10]" name="builder_item[<?php echo esc_attr($i);?>][box_style]">
										<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri();?>/admin/images/home_10.png"></a>
									</li>
									<li>
										<input type="radio" <?php if (isset($builder['box_style']) && $builder['box_style'] == "home_11") {echo ' checked="checked"';}?> value="home_11" id="builder_item[<?php echo esc_attr($i);?>][home_11]" name="builder_item[<?php echo esc_attr($i);?>][box_style]">
										<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri();?>/admin/images/home_11.png"></a>
									</li>
								</ul>
								<div class="explain vpanel_help"><div class="tooltip_s" data-title="Box layout style ."><i class="dashicons dashicons-info"></i></div></div>
								<div class="clear"></div>
				            </label>
				            
				            <label for="builder_item[<?php echo esc_attr($i);?>][excerpt_title]">
				            	<span>Excerpt title :</span>
				                <input id="builder_item[<?php echo esc_attr($i);?>][excerpt_title]" name="builder_item[<?php echo esc_attr($i);?>][excerpt_title]" value="<?php echo (isset($builder['excerpt_title'])?$builder['excerpt_title']:"5")?>" type="text">
				            </label>
				            
				            <label for="builder_item[<?php echo esc_attr($i);?>][excerpt]">
				            	<span>Excerpt :</span>
				                <input id="builder_item[<?php echo esc_attr($i);?>][excerpt]" name="builder_item[<?php echo esc_attr($i);?>][excerpt]" value="<?php echo (isset($builder['excerpt'])?$builder['excerpt']:"35")?>" type="text">
				            </label>
				            
				            <label for="builder_item[<?php echo esc_attr($i);?>][order_by]">
				                <span>Order by :</span>
				            	<div class="styled-select">
				                    <select id="builder_item[<?php echo esc_attr($i);?>][order_by]" name="builder_item[<?php echo esc_attr($i);?>][order_by]">
				                		<option value="recent" <?php if (isset($builder['order_by']) && $builder['order_by'] == "recent") {echo ' selected="selected"';}?>>Recent</option>
				                		<option value="popular" <?php if (isset($builder['order_by']) && $builder['order_by'] == "popular") {echo ' selected="selected"';}?>>Popular</option>
				                		<option value="random" <?php if (isset($builder['order_by']) && $builder['order_by'] == "random") {echo ' selected="selected"';}?>>Random</option>
				                    </select>
				                </div>
				            </label>
				            
				            <label for="builder_item[<?php echo esc_attr($i);?>][animate]">
				                <span>Box animate :</span>
				            	<div class="styled-select">
				                    <select id="builder_item[<?php echo esc_attr($i);?>][animate]" name="builder_item[<?php echo esc_attr($i);?>][animate]">
				                    	<option value="none" <?php if (isset($builder['animate']) && $builder['animate'] == "recent") {echo ' selected="selected"';}?>>none</option>
				                    	<option value="bounce" <?php if (isset($builder['animate']) && $builder['animate'] == "bounce") {echo ' selected="selected"';}?>>bounce</option>
				                    	<option value="bounceIn" <?php if (isset($builder['animate']) && $builder['animate'] == "bounceIn") {echo ' selected="selected"';}?>>bounceIn</option>
				                    	<option value="bounceInDown" <?php if (isset($builder['animate']) && $builder['animate'] == "bounceInDown") {echo ' selected="selected"';}?>>bounceInDown</option>
				                    	<option value="bounceInUp" <?php if (isset($builder['animate']) && $builder['animate'] == "bounceInUp") {echo ' selected="selected"';}?>>bounceInUp</option>
				                    	<option value="bounceInLeft" <?php if (isset($builder['animate']) && $builder['animate'] == "bounceInLeft") {echo ' selected="selected"';}?>>bounceInLeft</option>
				                    	<option value="bounceInRight" <?php if (isset($builder['animate']) && $builder['animate'] == "bounceInRight") {echo ' selected="selected"';}?>>bounceInRight</option>
				                    	<option value="fadeIn" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeIn") {echo ' selected="selected"';}?>>fadeIn</option>
				                    	<option value="fadeInUp" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInUp") {echo ' selected="selected"';}?>>fadeInUp</option>
				                    	<option value="fadeInDown" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInDown") {echo ' selected="selected"';}?>>fadeInDown</option>
				                    	<option value="fadeInLeft" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInLeft") {echo ' selected="selected"';}?>>fadeInLeft</option>
				                    	<option value="fadeInRight" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInRight") {echo ' selected="selected"';}?>>fadeInRight</option>
				                    	<option value="fadeInUpBig" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInUpBig") {echo ' selected="selected"';}?>>fadeInUpBig</option>
				                    	<option value="fadeInDownBig" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInDownBig") {echo ' selected="selected"';}?>>fadeInDownBig</option>
				                    	<option value="fadeInLeftBig" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInLeftBig") {echo ' selected="selected"';}?>>fadeInLeftBig</option>
				                    	<option value="fadeInRightBig" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInRightBig") {echo ' selected="selected"';}?>>fadeInRightBig</option>
				                    	<option value="flash" <?php if (isset($builder['animate']) && $builder['animate'] == "flash") {echo ' selected="selected"';}?>>flash</option>
				                    	<option value="flip" <?php if (isset($builder['animate']) && $builder['animate'] == "flip") {echo ' selected="selected"';}?>>flip</option>
				                    	<option value="flipInX" <?php if (isset($builder['animate']) && $builder['animate'] == "flipInX") {echo ' selected="selected"';}?>>flipInX</option>
				                    	<option value="flipInY" <?php if (isset($builder['animate']) && $builder['animate'] == "flipInY") {echo ' selected="selected"';}?>>flipInY</option>
				                    	<option value="lightSpeedIn" <?php if (isset($builder['animate']) && $builder['animate'] == "lightSpeedIn") {echo ' selected="selected"';}?>>lightSpeedIn</option>
				                    	<option value="pulse" <?php if (isset($builder['animate']) && $builder['animate'] == "pulse") {echo ' selected="selected"';}?>>pulse</option>
				                    	<option value="rotateIn" <?php if (isset($builder['animate']) && $builder['animate'] == "rotateIn") {echo ' selected="selected"';}?>>rotateIn</option>
				                    	<option value="rotateInDownLeft" <?php if (isset($builder['animate']) && $builder['animate'] == "rotateInDownLeft") {echo ' selected="selected"';}?>>rotateInDownLeft</option>
				                    	<option value="rotateInDownRight" <?php if (isset($builder['animate']) && $builder['animate'] == "rotateInDownRight") {echo ' selected="selected"';}?>>rotateInDownRight</option>
				                    	<option value="rotateInUpLeft" <?php if (isset($builder['animate']) && $builder['animate'] == "rotateInUpLeft") {echo ' selected="selected"';}?>>rotateInUpLeft</option>
				                    	<option value="rotateInUpRight" <?php if (isset($builder['animate']) && $builder['animate'] == "rotateInUpRight") {echo ' selected="selected"';}?>>rotateInUpRight</option>
				                    	<option value="rollIn" <?php if (isset($builder['animate']) && $builder['animate'] == "rollIn") {echo ' selected="selected"';}?>>rollIn</option>
				                    	<option value="shake" <?php if (isset($builder['animate']) && $builder['animate'] == "shake") {echo ' selected="selected"';}?>>shake</option>
				                    	<option value="swing" <?php if (isset($builder['animate']) && $builder['animate'] == "swing") {echo ' selected="selected"';}?>>swing</option>
				                    	<option value="tada" <?php if (isset($builder['animate']) && $builder['animate'] == "tada") {echo ' selected="selected"';}?>>tada</option>
				                    	<option value="wobble" <?php if (isset($builder['animate']) && $builder['animate'] == "wobble") {echo ' selected="selected"';}?>>wobble</option>
				                    	<option value="wiggle" <?php if (isset($builder['animate']) && $builder['animate'] == "wiggle") {echo ' selected="selected"';}?>>wiggle</option>
				                    </select>
				                </div>
				            </label>
				            
							<input id="builder_item[<?php echo esc_attr($i);?>][type]" name="builder_item[<?php echo esc_attr($i);?>][type]" value="<?php echo (isset($builder['type'])?$builder['type']:"");?>" type="hidden">
						</div>
					<?php }else if ($builder['type'] == 'pictures_news') {?>
						<div class="widget-head">
							<span class="vpanel<?php echo esc_attr($i);?>">Pictures news - <span><?php echo (isset($builder['box_title']) && $builder['box_title'] != ""?$builder['box_title']:(isset($builder['box_display']) && $builder['box_display'] == "category"?get_the_category_by_ID($builder['box_cats']):""))?></span></span>
							<a class="builder-toggle-open">+</a>
							<a class="builder-toggle-close">-</a>
						</div>
						<div class="widget-content">
						    <label for="builder_item[<?php echo esc_attr($i);?>][box_title]">
						    	<span>Pictures title :</span>
						        <input id="builder_item[<?php echo esc_attr($i);?>][box_title]" class="builder_label_key" name="builder_item[<?php echo esc_attr($i);?>][box_title]" value="<?php echo (isset($builder['box_title'])?$builder['box_title']:"")?>" type="text">
						    </label>
						    
						    <label for="builder_item[<?php echo esc_attr($i);?>][box_posts_num]">
						        <span>Number of posts :</span>
						        <input id="builder_item[<?php echo esc_attr($i);?>][box_posts_num]" name="builder_item[<?php echo esc_attr($i);?>][box_posts_num]" value="<?php echo (isset($builder['box_posts_num'])?$builder['box_posts_num']:"")?>" type="text">
						    </label>
						    
						    <label for="builder_item[<?php echo esc_attr($i);?>][box_display]">
						        <span>Display :</span>
						    	<div class="styled-select">
						            <select class="builder_box_display" id="builder_item[<?php echo esc_attr($i);?>][box_display]" name="builder_item[<?php echo esc_attr($i);?>][box_display]">
						        		<option value="">Latest Posts</option>
						        		<option value="category" <?php if (isset($builder['box_display']) && $builder['box_display'] == "category") {echo ' selected="selected"';}?>>Single Category</option>
						        		<option value="categories" <?php if (isset($builder['box_display']) && $builder['box_display'] == "categories") {echo ' selected="selected"';}?>>Multiple categories</option>
						            </select>
						        </div>
						    </label>
						    
						    <label class="label_category" for="builder_item[<?php echo esc_attr($i);?>][box_cats]">
						        <span>Category :</span>
						    	<div class="styled-select">
						            <select class="builder_select_name" id="builder_item[<?php echo esc_attr($i);?>][box_cats]" name="builder_item[<?php echo esc_attr($i);?>][box_cats]">
						            <?php foreach ($categories as $key => $option) {?>
						        		<option value="<?php echo esc_attr($key);?>" <?php if ($builder['box_cats'] == $key) {echo ' selected="selected"';}?>><?php echo esc_attr($option);?></option>
						        	<?php }?>
						            </select>
						        </div>
						    </label>
						    
						    <label class="label_categories" for="builder_item[<?php echo esc_attr($i);?>][categories]">
						        <span>Categories :</span>
						        <select multiple="multiple" id="builder_item[<?php echo esc_attr($i);?>][categories][]" name="builder_item[<?php echo esc_attr($i);?>][categories][]">
						        	<?php foreach ($categories as $key => $option) {?>
						        		<option value="<?php echo esc_attr($key) ?>" <?php if (isset($builder['categories']) && is_array($builder['categories']) && in_array($key,$builder['categories'])) {echo ' selected="selected"';} ?>><?php echo esc_attr($option); ?></option>
						        	<?php } ?>
						        </select>
						        <div class="clear"></div>
						    </label>
						    
						    <label>
						        <span>Pictures news style :</span>
						        <ul class="checkbox_select">
									<li>
										<input type="radio" <?php if (isset($builder['box_style']) && $builder['box_style'] == "pictures_1") {echo ' checked="checked"';}?> value="pictures_1" id="builder_item[<?php echo esc_attr($i);?>][pictures_1]" name="builder_item[<?php echo esc_attr($i);?>][box_style]">
										<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri();?>/admin/images/pictures_1.png"></a>
									</li>
									<li>
										<input type="radio" <?php if (isset($builder['box_style']) && $builder['box_style'] == "pictures_2") {echo ' checked="checked"';}?> value="pictures_2" id="builder_item[<?php echo esc_attr($i);?>][pictures_2]" name="builder_item[<?php echo esc_attr($i);?>][box_style]">
										<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri();?>/admin/images/pictures_2.png"></a>
									</li>
								</ul>
								<div class="explain vpanel_help"><div class="tooltip_s" data-title="Pictures news layout style ."><i class="dashicons dashicons-info"></i></div></div>
								<div class="clear"></div>
						    </label>
						    
						    <label for="builder_item[<?php echo esc_attr($i);?>][order_by]">
						        <span>Order by :</span>
						    	<div class="styled-select">
						            <select id="builder_item[<?php echo esc_attr($i);?>][order_by]" name="builder_item[<?php echo esc_attr($i);?>][order_by]">
						        		<option value="recent" <?php if (isset($builder['order_by']) && $builder['order_by'] == "recent") {echo ' selected="selected"';}?>>Recent</option>
						        		<option value="popular" <?php if (isset($builder['order_by']) && $builder['order_by'] == "popular") {echo ' selected="selected"';}?>>Popular</option>
						        		<option value="random" <?php if (isset($builder['order_by']) && $builder['order_by'] == "random") {echo ' selected="selected"';}?>>Random</option>
						            </select>
						        </div>
						    </label>
						    
						    <label for="builder_item[<?php echo esc_attr($i);?>][animate]">
						        <span>Box animate :</span>
						    	<div class="styled-select">
						            <select id="builder_item[<?php echo esc_attr($i);?>][animate]" name="builder_item[<?php echo esc_attr($i);?>][animate]">
						            	<option value="none" <?php if (isset($builder['animate']) && $builder['animate'] == "recent") {echo ' selected="selected"';}?>>none</option>
						            	<option value="bounce" <?php if (isset($builder['animate']) && $builder['animate'] == "bounce") {echo ' selected="selected"';}?>>bounce</option>
						            	<option value="bounceIn" <?php if (isset($builder['animate']) && $builder['animate'] == "bounceIn") {echo ' selected="selected"';}?>>bounceIn</option>
						            	<option value="bounceInDown" <?php if (isset($builder['animate']) && $builder['animate'] == "bounceInDown") {echo ' selected="selected"';}?>>bounceInDown</option>
						            	<option value="bounceInUp" <?php if (isset($builder['animate']) && $builder['animate'] == "bounceInUp") {echo ' selected="selected"';}?>>bounceInUp</option>
						            	<option value="bounceInLeft" <?php if (isset($builder['animate']) && $builder['animate'] == "bounceInLeft") {echo ' selected="selected"';}?>>bounceInLeft</option>
						            	<option value="bounceInRight" <?php if (isset($builder['animate']) && $builder['animate'] == "bounceInRight") {echo ' selected="selected"';}?>>bounceInRight</option>
						            	<option value="fadeIn" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeIn") {echo ' selected="selected"';}?>>fadeIn</option>
						            	<option value="fadeInUp" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInUp") {echo ' selected="selected"';}?>>fadeInUp</option>
						            	<option value="fadeInDown" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInDown") {echo ' selected="selected"';}?>>fadeInDown</option>
						            	<option value="fadeInLeft" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInLeft") {echo ' selected="selected"';}?>>fadeInLeft</option>
						            	<option value="fadeInRight" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInRight") {echo ' selected="selected"';}?>>fadeInRight</option>
						            	<option value="fadeInUpBig" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInUpBig") {echo ' selected="selected"';}?>>fadeInUpBig</option>
						            	<option value="fadeInDownBig" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInDownBig") {echo ' selected="selected"';}?>>fadeInDownBig</option>
						            	<option value="fadeInLeftBig" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInLeftBig") {echo ' selected="selected"';}?>>fadeInLeftBig</option>
						            	<option value="fadeInRightBig" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInRightBig") {echo ' selected="selected"';}?>>fadeInRightBig</option>
						            	<option value="flash" <?php if (isset($builder['animate']) && $builder['animate'] == "flash") {echo ' selected="selected"';}?>>flash</option>
						            	<option value="flip" <?php if (isset($builder['animate']) && $builder['animate'] == "flip") {echo ' selected="selected"';}?>>flip</option>
						            	<option value="flipInX" <?php if (isset($builder['animate']) && $builder['animate'] == "flipInX") {echo ' selected="selected"';}?>>flipInX</option>
						            	<option value="flipInY" <?php if (isset($builder['animate']) && $builder['animate'] == "flipInY") {echo ' selected="selected"';}?>>flipInY</option>
						            	<option value="lightSpeedIn" <?php if (isset($builder['animate']) && $builder['animate'] == "lightSpeedIn") {echo ' selected="selected"';}?>>lightSpeedIn</option>
						            	<option value="pulse" <?php if (isset($builder['animate']) && $builder['animate'] == "pulse") {echo ' selected="selected"';}?>>pulse</option>
						            	<option value="rotateIn" <?php if (isset($builder['animate']) && $builder['animate'] == "rotateIn") {echo ' selected="selected"';}?>>rotateIn</option>
						            	<option value="rotateInDownLeft" <?php if (isset($builder['animate']) && $builder['animate'] == "rotateInDownLeft") {echo ' selected="selected"';}?>>rotateInDownLeft</option>
						            	<option value="rotateInDownRight" <?php if (isset($builder['animate']) && $builder['animate'] == "rotateInDownRight") {echo ' selected="selected"';}?>>rotateInDownRight</option>
						            	<option value="rotateInUpLeft" <?php if (isset($builder['animate']) && $builder['animate'] == "rotateInUpLeft") {echo ' selected="selected"';}?>>rotateInUpLeft</option>
						            	<option value="rotateInUpRight" <?php if (isset($builder['animate']) && $builder['animate'] == "rotateInUpRight") {echo ' selected="selected"';}?>>rotateInUpRight</option>
						            	<option value="rollIn" <?php if (isset($builder['animate']) && $builder['animate'] == "rollIn") {echo ' selected="selected"';}?>>rollIn</option>
						            	<option value="shake" <?php if (isset($builder['animate']) && $builder['animate'] == "shake") {echo ' selected="selected"';}?>>shake</option>
						            	<option value="swing" <?php if (isset($builder['animate']) && $builder['animate'] == "swing") {echo ' selected="selected"';}?>>swing</option>
						            	<option value="tada" <?php if (isset($builder['animate']) && $builder['animate'] == "tada") {echo ' selected="selected"';}?>>tada</option>
						            	<option value="wobble" <?php if (isset($builder['animate']) && $builder['animate'] == "wobble") {echo ' selected="selected"';}?>>wobble</option>
						            	<option value="wiggle" <?php if (isset($builder['animate']) && $builder['animate'] == "wiggle") {echo ' selected="selected"';}?>>wiggle</option>
						            </select>
						        </div>
						    </label>
						    
							<input id="builder_item[<?php echo esc_attr($i);?>][type]" name="builder_item[<?php echo esc_attr($i);?>][type]" value="<?php echo (isset($builder['type'])?$builder['type']:"");?>" type="hidden">
						</div>
					<?php }else if ($builder['type'] == 'tabs_news') {?>
						<div class="widget-head">
							<span class="vpanel<?php echo esc_attr($i);?>">Tabs box news - <span><?php echo (isset($builder['box_title']) && $builder['box_title'] != ""?$builder['box_title']:"")?></span></span>
							<a class="builder-toggle-open">+</a>
							<a class="builder-toggle-close">-</a>
						</div>
						<div class="widget-content">
						    <label for="builder_item[<?php echo esc_attr($i);?>][box_title]">
						    	<span>Tabs title :</span>
						        <input id="builder_item[<?php echo esc_attr($i);?>][box_title]" class="builder_label_key" name="builder_item[<?php echo esc_attr($i);?>][box_title]" value="<?php echo (isset($builder['box_title'])?$builder['box_title']:"")?>" type="text">
						    </label>
						    
						    <label for="builder_item[<?php echo esc_attr($i);?>][box_posts_num]">
						        <span>Number of posts :</span>
						        <input id="builder_item[<?php echo esc_attr($i);?>][box_posts_num]" name="builder_item[<?php echo esc_attr($i);?>][box_posts_num]" value="<?php echo (isset($builder['box_posts_num'])?$builder['box_posts_num']:"")?>" type="text">
						    </label>
						    
						    <label for="builder_item[<?php echo esc_attr($i);?>][box_cats]">
							    <span>Category :</span>
							    <select multiple="multiple" id="builder_item[<?php echo esc_attr($i);?>][box_cats][]" name="builder_item[<?php echo esc_attr($i);?>][box_cats][]">
							    	<?php foreach ($categories as $key => $option) {?>
							    		<option value="<?php echo esc_attr($key) ?>" <?php if (isset($builder['box_cats']) && is_array($builder['box_cats']) && in_array($key,$builder['box_cats'])) {echo ' selected="selected"';} ?>><?php echo esc_attr($option); ?></option>
							    	<?php } ?>
							    </select>
							    <div class="clear"></div>
						    </label>
						    
						    <label>
						        <span>Tabs box news style :</span>
						        <ul class="checkbox_select">
						        	<li>
						        		<input type="radio" <?php if (isset($builder['box_style']) && $builder['box_style'] == "home_1") {echo ' checked="checked"';}?> value="home_1" id="builder_item[<?php echo esc_attr($i);?>][home_1]" name="builder_item[<?php echo esc_attr($i);?>][box_style]">
						        		<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri();?>/admin/images/home_1.png"></a>
						        	</li>
						        	<li>
						        		<input type="radio" <?php if (isset($builder['box_style']) && $builder['box_style'] == "home_2") {echo ' checked="checked"';}?> value="home_2" id="builder_item[<?php echo esc_attr($i);?>][home_2]" name="builder_item[<?php echo esc_attr($i);?>][box_style]">
						        		<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri();?>/admin/images/home_2.png"></a>
						        	</li>
						        	<li>
						        		<input type="radio" <?php if (isset($builder['box_style']) && $builder['box_style'] == "home_3") {echo ' checked="checked"';}?> value="home_3" id="builder_item[<?php echo esc_attr($i);?>][home_3]" name="builder_item[<?php echo esc_attr($i);?>][box_style]">
						        		<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri();?>/admin/images/home_3.png"></a>
						        	</li>
						        	<li>
						        		<input type="radio" <?php if (isset($builder['box_style']) && $builder['box_style'] == "home_4") {echo ' checked="checked"';}?> value="home_4" id="builder_item[<?php echo esc_attr($i);?>][home_4]" name="builder_item[<?php echo esc_attr($i);?>][box_style]">
						        		<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri();?>/admin/images/home_4.png"></a>
						        	</li>
						        	<li>
						        		<input type="radio" <?php if (isset($builder['box_style']) && $builder['box_style'] == "home_5") {echo ' checked="checked"';}?> value="home_5" id="builder_item[<?php echo esc_attr($i);?>][home_5]" name="builder_item[<?php echo esc_attr($i);?>][box_style]">
						        		<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri();?>/admin/images/home_5.png"></a>
						        	</li>
						        	<li>
						        		<input type="radio" <?php if (isset($builder['box_style']) && $builder['box_style'] == "home_6") {echo ' checked="checked"';}?> value="home_6" id="builder_item[<?php echo esc_attr($i);?>][home_6]" name="builder_item[<?php echo esc_attr($i);?>][box_style]">
						        		<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri();?>/admin/images/home_6.png"></a>
						        	</li>
						        	<li>
						        		<input type="radio" <?php if (isset($builder['box_style']) && $builder['box_style'] == "home_7") {echo ' checked="checked"';}?> value="home_7" id="builder_item[<?php echo esc_attr($i);?>][home_7]" name="builder_item[<?php echo esc_attr($i);?>][box_style]">
						        		<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri();?>/admin/images/home_7.png"></a>
						        	</li>
						        	<li>
						        		<input type="radio" <?php if (isset($builder['box_style']) && $builder['box_style'] == "home_8") {echo ' checked="checked"';}?> value="home_8" id="builder_item[<?php echo esc_attr($i);?>][home_8]" name="builder_item[<?php echo esc_attr($i);?>][box_style]">
						        		<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri();?>/admin/images/home_8.png"></a>
						        	</li>
						        	<li>
						        		<input type="radio" <?php if (isset($builder['box_style']) && $builder['box_style'] == "home_9") {echo ' checked="checked"';}?> value="home_9" id="builder_item[<?php echo esc_attr($i);?>][home_9]" name="builder_item[<?php echo esc_attr($i);?>][box_style]">
						        		<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri();?>/admin/images/home_9.png"></a>
						        	</li>
						        	<li>
						        		<input type="radio" <?php if (isset($builder['box_style']) && $builder['box_style'] == "home_10") {echo ' checked="checked"';}?> value="home_10" id="builder_item[<?php echo esc_attr($i);?>][home_10]" name="builder_item[<?php echo esc_attr($i);?>][box_style]">
						        		<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri();?>/admin/images/home_10.png"></a>
						        	</li>
						        	<li>
						        		<input type="radio" <?php if (isset($builder['box_style']) && $builder['box_style'] == "home_11") {echo ' checked="checked"';}?> value="home_11" id="builder_item[<?php echo esc_attr($i);?>][home_11]" name="builder_item[<?php echo esc_attr($i);?>][box_style]">
						        		<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri();?>/admin/images/home_11.png"></a>
						        	</li>
						        </ul>
								<div class="explain vpanel_help"><div class="tooltip_s" data-title="Tabs box news layout style ."><i class="dashicons dashicons-info"></i></div></div>
								<div class="clear"></div>
						    </label>
						    
						    <label for="builder_item[<?php echo esc_attr($i);?>][excerpt_title]">
						    	<span>Excerpt title :</span>
						        <input id="builder_item[<?php echo esc_attr($i);?>][excerpt_title]" name="builder_item[<?php echo esc_attr($i);?>][excerpt_title]" value="<?php echo (isset($builder['excerpt_title'])?$builder['excerpt_title']:"5")?>" type="text">
						    </label>
						    
						    <label for="builder_item[<?php echo esc_attr($i);?>][excerpt]">
						    	<span>Excerpt :</span>
						        <input id="builder_item[<?php echo esc_attr($i);?>][excerpt]" name="builder_item[<?php echo esc_attr($i);?>][excerpt]" value="<?php echo (isset($builder['excerpt'])?$builder['excerpt']:"35")?>" type="text">
						    </label>
						    
						    <label for="builder_item[<?php echo esc_attr($i);?>][order_by]">
						        <span>Order by :</span>
						    	<div class="styled-select">
						            <select id="builder_item[<?php echo esc_attr($i);?>][order_by]" name="builder_item[<?php echo esc_attr($i);?>][order_by]">
						        		<option value="recent" <?php if (isset($builder['order_by']) && $builder['order_by'] == "recent") {echo ' selected="selected"';}?>>Recent</option>
						        		<option value="popular" <?php if (isset($builder['order_by']) && $builder['order_by'] == "popular") {echo ' selected="selected"';}?>>Popular</option>
						        		<option value="random" <?php if (isset($builder['order_by']) && $builder['order_by'] == "random") {echo ' selected="selected"';}?>>Random</option>
						            </select>
						        </div>
						    </label>
						    
						    <label for="builder_item[<?php echo esc_attr($i);?>][animate]">
						        <span>Box animate :</span>
						    	<div class="styled-select">
						            <select id="builder_item[<?php echo esc_attr($i);?>][animate]" name="builder_item[<?php echo esc_attr($i);?>][animate]">
						            	<option value="none" <?php if (isset($builder['animate']) && $builder['animate'] == "recent") {echo ' selected="selected"';}?>>none</option>
						            	<option value="bounce" <?php if (isset($builder['animate']) && $builder['animate'] == "bounce") {echo ' selected="selected"';}?>>bounce</option>
						            	<option value="bounceIn" <?php if (isset($builder['animate']) && $builder['animate'] == "bounceIn") {echo ' selected="selected"';}?>>bounceIn</option>
						            	<option value="bounceInDown" <?php if (isset($builder['animate']) && $builder['animate'] == "bounceInDown") {echo ' selected="selected"';}?>>bounceInDown</option>
						            	<option value="bounceInUp" <?php if (isset($builder['animate']) && $builder['animate'] == "bounceInUp") {echo ' selected="selected"';}?>>bounceInUp</option>
						            	<option value="bounceInLeft" <?php if (isset($builder['animate']) && $builder['animate'] == "bounceInLeft") {echo ' selected="selected"';}?>>bounceInLeft</option>
						            	<option value="bounceInRight" <?php if (isset($builder['animate']) && $builder['animate'] == "bounceInRight") {echo ' selected="selected"';}?>>bounceInRight</option>
						            	<option value="fadeIn" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeIn") {echo ' selected="selected"';}?>>fadeIn</option>
						            	<option value="fadeInUp" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInUp") {echo ' selected="selected"';}?>>fadeInUp</option>
						            	<option value="fadeInDown" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInDown") {echo ' selected="selected"';}?>>fadeInDown</option>
						            	<option value="fadeInLeft" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInLeft") {echo ' selected="selected"';}?>>fadeInLeft</option>
						            	<option value="fadeInRight" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInRight") {echo ' selected="selected"';}?>>fadeInRight</option>
						            	<option value="fadeInUpBig" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInUpBig") {echo ' selected="selected"';}?>>fadeInUpBig</option>
						            	<option value="fadeInDownBig" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInDownBig") {echo ' selected="selected"';}?>>fadeInDownBig</option>
						            	<option value="fadeInLeftBig" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInLeftBig") {echo ' selected="selected"';}?>>fadeInLeftBig</option>
						            	<option value="fadeInRightBig" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInRightBig") {echo ' selected="selected"';}?>>fadeInRightBig</option>
						            	<option value="flash" <?php if (isset($builder['animate']) && $builder['animate'] == "flash") {echo ' selected="selected"';}?>>flash</option>
						            	<option value="flip" <?php if (isset($builder['animate']) && $builder['animate'] == "flip") {echo ' selected="selected"';}?>>flip</option>
						            	<option value="flipInX" <?php if (isset($builder['animate']) && $builder['animate'] == "flipInX") {echo ' selected="selected"';}?>>flipInX</option>
						            	<option value="flipInY" <?php if (isset($builder['animate']) && $builder['animate'] == "flipInY") {echo ' selected="selected"';}?>>flipInY</option>
						            	<option value="lightSpeedIn" <?php if (isset($builder['animate']) && $builder['animate'] == "lightSpeedIn") {echo ' selected="selected"';}?>>lightSpeedIn</option>
						            	<option value="pulse" <?php if (isset($builder['animate']) && $builder['animate'] == "pulse") {echo ' selected="selected"';}?>>pulse</option>
						            	<option value="rotateIn" <?php if (isset($builder['animate']) && $builder['animate'] == "rotateIn") {echo ' selected="selected"';}?>>rotateIn</option>
						            	<option value="rotateInDownLeft" <?php if (isset($builder['animate']) && $builder['animate'] == "rotateInDownLeft") {echo ' selected="selected"';}?>>rotateInDownLeft</option>
						            	<option value="rotateInDownRight" <?php if (isset($builder['animate']) && $builder['animate'] == "rotateInDownRight") {echo ' selected="selected"';}?>>rotateInDownRight</option>
						            	<option value="rotateInUpLeft" <?php if (isset($builder['animate']) && $builder['animate'] == "rotateInUpLeft") {echo ' selected="selected"';}?>>rotateInUpLeft</option>
						            	<option value="rotateInUpRight" <?php if (isset($builder['animate']) && $builder['animate'] == "rotateInUpRight") {echo ' selected="selected"';}?>>rotateInUpRight</option>
						            	<option value="rollIn" <?php if (isset($builder['animate']) && $builder['animate'] == "rollIn") {echo ' selected="selected"';}?>>rollIn</option>
						            	<option value="shake" <?php if (isset($builder['animate']) && $builder['animate'] == "shake") {echo ' selected="selected"';}?>>shake</option>
						            	<option value="swing" <?php if (isset($builder['animate']) && $builder['animate'] == "swing") {echo ' selected="selected"';}?>>swing</option>
						            	<option value="tada" <?php if (isset($builder['animate']) && $builder['animate'] == "tada") {echo ' selected="selected"';}?>>tada</option>
						            	<option value="wobble" <?php if (isset($builder['animate']) && $builder['animate'] == "wobble") {echo ' selected="selected"';}?>>wobble</option>
						            	<option value="wiggle" <?php if (isset($builder['animate']) && $builder['animate'] == "wiggle") {echo ' selected="selected"';}?>>wiggle</option>
						            </select>
						        </div>
						    </label>
						    
							<input id="builder_item[<?php echo esc_attr($i);?>][type]" name="builder_item[<?php echo esc_attr($i);?>][type]" value="<?php echo (isset($builder['type'])?$builder['type']:"");?>" type="hidden">
						</div>
					<?php }else if ($builder['type'] == 'scroll_news') {?>
						<div class="widget-head">
							<span class="vpanel<?php echo esc_attr($i);?>">Scroll news - <span><?php echo (isset($builder['box_title']) && $builder['box_title'] != ""?$builder['box_title']:(isset($builder['box_display']) && $builder['box_display'] == "category"?get_the_category_by_ID($builder['box_cats']):""))?></span></span>
							<a class="builder-toggle-open">+</a>
							<a class="builder-toggle-close">-</a>
						</div>
						<div class="widget-content">
						    <label for="builder_item[<?php echo esc_attr($i);?>][box_title]">
						    	<span>Scroll title :</span>
						        <input id="builder_item[<?php echo esc_attr($i);?>][box_title]" class="builder_label_key" name="builder_item[<?php echo esc_attr($i);?>][box_title]" value="<?php echo (isset($builder['box_title'])?$builder['box_title']:"")?>" type="text">
						    </label>
						    
						    <label for="builder_item[<?php echo esc_attr($i);?>][box_posts_num]">
						        <span>Number of posts :</span>
						        <input id="builder_item[<?php echo esc_attr($i);?>][box_posts_num]" name="builder_item[<?php echo esc_attr($i);?>][box_posts_num]" value="<?php echo (isset($builder['box_posts_num'])?$builder['box_posts_num']:"")?>" type="text">
						    </label>
						    
						    <label for="builder_item[<?php echo esc_attr($i);?>][box_display]">
						        <span>Display :</span>
						    	<div class="styled-select">
						            <select class="builder_box_display" id="builder_item[<?php echo esc_attr($i);?>][box_display]" name="builder_item[<?php echo esc_attr($i);?>][box_display]">
						        		<option value="">Latest Posts</option>
						        		<option value="category" <?php if (isset($builder['box_display']) && $builder['box_display'] == "category") {echo ' selected="selected"';}?>>Single Category</option>
						        		<option value="categories" <?php if (isset($builder['box_display']) && $builder['box_display'] == "categories") {echo ' selected="selected"';}?>>Multiple categories</option>
						            </select>
						        </div>
						    </label>
						    
						    <label class="label_category" for="builder_item[<?php echo esc_attr($i);?>][box_cats]">
						        <span>Category :</span>
						    	<div class="styled-select">
						            <select class="builder_select_name" id="builder_item[<?php echo esc_attr($i);?>][box_cats]" name="builder_item[<?php echo esc_attr($i);?>][box_cats]">
						            <?php foreach ($categories as $key => $option) {?>
						        		<option value="<?php echo esc_attr($key);?>" <?php if ($builder['box_cats'] == $key) {echo ' selected="selected"';}?>><?php echo esc_attr($option);?></option>
						        	<?php }?>
						            </select>
						        </div>
						    </label>
						    
						    <label class="label_categories" for="builder_item[<?php echo esc_attr($i);?>][categories]">
						        <span>Categories :</span>
						        <select multiple="multiple" id="builder_item[<?php echo esc_attr($i);?>][categories][]" name="builder_item[<?php echo esc_attr($i);?>][categories][]">
						        	<?php foreach ($categories as $key => $option) {?>
						        		<option value="<?php echo esc_attr($key) ?>" <?php if (isset($builder['categories']) && is_array($builder['categories']) && in_array($key,$builder['categories'])) {echo ' selected="selected"';} ?>><?php echo esc_attr($option); ?></option>
						        	<?php } ?>
						        </select>
						        <div class="clear"></div>
						    </label>
						    
						    <label>
						        <span>Scroll news style :</span>
						        <ul class="checkbox_select">
						        	<li>
						        		<input type="radio" <?php if (isset($builder['box_style']) && $builder['box_style'] == "scroll_1") {echo ' checked="checked"';}?> value="scroll_1" id="builder_item[<?php echo esc_attr($i);?>][scroll_1]" name="builder_item[<?php echo esc_attr($i);?>][box_style]">
						        		<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri();?>/admin/images/scroll_1.png"></a>
						        	</li>
						        	<li>
						        		<input type="radio" <?php if (isset($builder['box_style']) && $builder['box_style'] == "scroll_2") {echo ' checked="checked"';}?> value="scroll_2" id="builder_item[<?php echo esc_attr($i);?>][scroll_2]" name="builder_item[<?php echo esc_attr($i);?>][box_style]">
						        		<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri();?>/admin/images/scroll_2.png"></a>
						        	</li>
						        </ul>
						    	<div class="explain vpanel_help"><div class="tooltip_s" data-title="Scroll news layout style ."><i class="dashicons dashicons-info"></i></div></div>
						    	<div class="clear"></div>
						    </label>
						    
						    <label for="builder_item[<?php echo esc_attr($i);?>][excerpt_title]">
						    	<span>Excerpt title :</span>
						        <input id="builder_item[<?php echo esc_attr($i);?>][excerpt_title]" name="builder_item[<?php echo esc_attr($i);?>][excerpt_title]" value="<?php echo (isset($builder['excerpt_title'])?$builder['excerpt_title']:"5")?>" type="text">
						    </label>
						    
						    <label for="builder_item[<?php echo esc_attr($i);?>][order_by]">
						        <span>Order by :</span>
						    	<div class="styled-select">
						            <select id="builder_item[<?php echo esc_attr($i);?>][order_by]" name="builder_item[<?php echo esc_attr($i);?>][order_by]">
						        		<option value="recent" <?php if (isset($builder['order_by']) && $builder['order_by'] == "recent") {echo ' selected="selected"';}?>>Recent</option>
						        		<option value="popular" <?php if (isset($builder['order_by']) && $builder['order_by'] == "popular") {echo ' selected="selected"';}?>>Popular</option>
						        		<option value="random" <?php if (isset($builder['order_by']) && $builder['order_by'] == "random") {echo ' selected="selected"';}?>>Random</option>
						            </select>
						        </div>
						    </label>
						    
						    <label for="builder_item[<?php echo esc_attr($i);?>][animate]">
						        <span>Box animate :</span>
						    	<div class="styled-select">
						            <select id="builder_item[<?php echo esc_attr($i);?>][animate]" name="builder_item[<?php echo esc_attr($i);?>][animate]">
						            	<option value="none" <?php if (isset($builder['animate']) && $builder['animate'] == "recent") {echo ' selected="selected"';}?>>none</option>
						            	<option value="bounce" <?php if (isset($builder['animate']) && $builder['animate'] == "bounce") {echo ' selected="selected"';}?>>bounce</option>
						            	<option value="bounceIn" <?php if (isset($builder['animate']) && $builder['animate'] == "bounceIn") {echo ' selected="selected"';}?>>bounceIn</option>
						            	<option value="bounceInDown" <?php if (isset($builder['animate']) && $builder['animate'] == "bounceInDown") {echo ' selected="selected"';}?>>bounceInDown</option>
						            	<option value="bounceInUp" <?php if (isset($builder['animate']) && $builder['animate'] == "bounceInUp") {echo ' selected="selected"';}?>>bounceInUp</option>
						            	<option value="bounceInLeft" <?php if (isset($builder['animate']) && $builder['animate'] == "bounceInLeft") {echo ' selected="selected"';}?>>bounceInLeft</option>
						            	<option value="bounceInRight" <?php if (isset($builder['animate']) && $builder['animate'] == "bounceInRight") {echo ' selected="selected"';}?>>bounceInRight</option>
						            	<option value="fadeIn" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeIn") {echo ' selected="selected"';}?>>fadeIn</option>
						            	<option value="fadeInUp" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInUp") {echo ' selected="selected"';}?>>fadeInUp</option>
						            	<option value="fadeInDown" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInDown") {echo ' selected="selected"';}?>>fadeInDown</option>
						            	<option value="fadeInLeft" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInLeft") {echo ' selected="selected"';}?>>fadeInLeft</option>
						            	<option value="fadeInRight" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInRight") {echo ' selected="selected"';}?>>fadeInRight</option>
						            	<option value="fadeInUpBig" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInUpBig") {echo ' selected="selected"';}?>>fadeInUpBig</option>
						            	<option value="fadeInDownBig" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInDownBig") {echo ' selected="selected"';}?>>fadeInDownBig</option>
						            	<option value="fadeInLeftBig" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInLeftBig") {echo ' selected="selected"';}?>>fadeInLeftBig</option>
						            	<option value="fadeInRightBig" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInRightBig") {echo ' selected="selected"';}?>>fadeInRightBig</option>
						            	<option value="flash" <?php if (isset($builder['animate']) && $builder['animate'] == "flash") {echo ' selected="selected"';}?>>flash</option>
						            	<option value="flip" <?php if (isset($builder['animate']) && $builder['animate'] == "flip") {echo ' selected="selected"';}?>>flip</option>
						            	<option value="flipInX" <?php if (isset($builder['animate']) && $builder['animate'] == "flipInX") {echo ' selected="selected"';}?>>flipInX</option>
						            	<option value="flipInY" <?php if (isset($builder['animate']) && $builder['animate'] == "flipInY") {echo ' selected="selected"';}?>>flipInY</option>
						            	<option value="lightSpeedIn" <?php if (isset($builder['animate']) && $builder['animate'] == "lightSpeedIn") {echo ' selected="selected"';}?>>lightSpeedIn</option>
						            	<option value="pulse" <?php if (isset($builder['animate']) && $builder['animate'] == "pulse") {echo ' selected="selected"';}?>>pulse</option>
						            	<option value="rotateIn" <?php if (isset($builder['animate']) && $builder['animate'] == "rotateIn") {echo ' selected="selected"';}?>>rotateIn</option>
						            	<option value="rotateInDownLeft" <?php if (isset($builder['animate']) && $builder['animate'] == "rotateInDownLeft") {echo ' selected="selected"';}?>>rotateInDownLeft</option>
						            	<option value="rotateInDownRight" <?php if (isset($builder['animate']) && $builder['animate'] == "rotateInDownRight") {echo ' selected="selected"';}?>>rotateInDownRight</option>
						            	<option value="rotateInUpLeft" <?php if (isset($builder['animate']) && $builder['animate'] == "rotateInUpLeft") {echo ' selected="selected"';}?>>rotateInUpLeft</option>
						            	<option value="rotateInUpRight" <?php if (isset($builder['animate']) && $builder['animate'] == "rotateInUpRight") {echo ' selected="selected"';}?>>rotateInUpRight</option>
						            	<option value="rollIn" <?php if (isset($builder['animate']) && $builder['animate'] == "rollIn") {echo ' selected="selected"';}?>>rollIn</option>
						            	<option value="shake" <?php if (isset($builder['animate']) && $builder['animate'] == "shake") {echo ' selected="selected"';}?>>shake</option>
						            	<option value="swing" <?php if (isset($builder['animate']) && $builder['animate'] == "swing") {echo ' selected="selected"';}?>>swing</option>
						            	<option value="tada" <?php if (isset($builder['animate']) && $builder['animate'] == "tada") {echo ' selected="selected"';}?>>tada</option>
						            	<option value="wobble" <?php if (isset($builder['animate']) && $builder['animate'] == "wobble") {echo ' selected="selected"';}?>>wobble</option>
						            	<option value="wiggle" <?php if (isset($builder['animate']) && $builder['animate'] == "wiggle") {echo ' selected="selected"';}?>>wiggle</option>
						            </select>
						        </div>
						    </label>
						    
							<input id="builder_item[<?php echo esc_attr($i);?>][type]" name="builder_item[<?php echo esc_attr($i);?>][type]" value="<?php echo (isset($builder['type'])?$builder['type']:"");?>" type="hidden">
						</div>
					<?php }else if ($builder['type'] == 'recent_posts') {?>
						<div class="widget-head">
							<span class="vpanel<?php echo esc_attr($i);?>">Recent posts - <span><?php echo (isset($builder['box_title']) && $builder['box_title'] != ""?$builder['box_title']:(isset($builder['box_display']) && $builder['box_display'] == "category"?get_the_category_by_ID($builder['box_cats']):""))?></span></span>
							<a class="builder-toggle-open">+</a>
							<a class="builder-toggle-close">-</a>
						</div>
						<div class="widget-content">
						    <label for="builder_item[<?php echo esc_attr($i);?>][box_title]">
						    	<span>Recent posts title :</span>
						        <input id="builder_item[<?php echo esc_attr($i);?>][box_title]" class="builder_label_key" name="builder_item[<?php echo esc_attr($i);?>][box_title]" value="<?php echo (isset($builder['box_title'])?$builder['box_title']:"")?>" type="text">
						    </label>
						    
						    <label for="builder_item[<?php echo esc_attr($i);?>][box_posts_num]">
						        <span>Number of posts :</span>
						        <input id="builder_item[<?php echo esc_attr($i);?>][box_posts_num]" name="builder_item[<?php echo esc_attr($i);?>][box_posts_num]" value="<?php echo (isset($builder['box_posts_num'])?$builder['box_posts_num']:"")?>" type="text">
						    </label>
						    
						    <label for="builder_item[<?php echo esc_attr($i);?>][box_display]">
						        <span>Display :</span>
						    	<div class="styled-select">
						            <select class="builder_box_display" id="builder_item[<?php echo esc_attr($i);?>][box_display]" name="builder_item[<?php echo esc_attr($i);?>][box_display]">
						        		<option value="">Latest Posts</option>
						        		<option value="category" <?php if (isset($builder['box_display']) && $builder['box_display'] == "category") {echo ' selected="selected"';}?>>Single Category</option>
						        		<option value="categories" <?php if (isset($builder['box_display']) && $builder['box_display'] == "categories") {echo ' selected="selected"';}?>>Multiple categories</option>
						            </select>
						        </div>
						    </label>
						    
						    <label class="label_category" for="builder_item[<?php echo esc_attr($i);?>][box_cats]">
						        <span>Category :</span>
						    	<div class="styled-select">
						            <select class="builder_select_name" id="builder_item[<?php echo esc_attr($i);?>][box_cats]" name="builder_item[<?php echo esc_attr($i);?>][box_cats]">
						            <?php foreach ($categories as $key => $option) {?>
						        		<option value="<?php echo esc_attr($key);?>" <?php if ($builder['box_cats'] == $key) {echo ' selected="selected"';}?>><?php echo esc_attr($option);?></option>
						        	<?php }?>
						            </select>
						        </div>
						    </label>
						    
						    <label class="label_categories" for="builder_item[<?php echo esc_attr($i);?>][categories]">
						        <span>Categories :</span>
						        <select multiple="multiple" id="builder_item[<?php echo esc_attr($i);?>][categories][]" name="builder_item[<?php echo esc_attr($i);?>][categories][]">
						        	<?php foreach ($categories as $key => $option) {?>
						        		<option value="<?php echo esc_attr($key) ?>" <?php if (isset($builder['categories']) && is_array($builder['categories']) && in_array($key,$builder['categories'])) {echo ' selected="selected"';} ?>><?php echo esc_attr($option); ?></option>
						        	<?php } ?>
						        </select>
						        <div class="clear"></div>
						    </label>
						    
						    <label>
						        <span>Recent posts style :</span>
						        <ul class="checkbox_select">
						        	<li>
						        		<input type="radio" <?php if (isset($builder['box_style']) && $builder['box_style'] == "recent_1") {echo ' checked="checked"';}?> value="recent_1" id="builder_item[<?php echo esc_attr($i);?>][recent_1]" name="builder_item[<?php echo esc_attr($i);?>][box_style]">
						        		<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri();?>/admin/images/recent_1.png"></a>
						        	</li>
						        	<li>
						        		<input type="radio" <?php if (isset($builder['box_style']) && $builder['box_style'] == "recent_2") {echo ' checked="checked"';}?> value="recent_2" id="builder_item[<?php echo esc_attr($i);?>][recent_2]" name="builder_item[<?php echo esc_attr($i);?>][box_style]">
						        		<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri();?>/admin/images/recent_2.png"></a>
						        	</li>
						        	<li>
						        		<input type="radio" <?php if (isset($builder['box_style']) && $builder['box_style'] == "recent_3") {echo ' checked="checked"';}?> value="recent_3" id="builder_item[<?php echo esc_attr($i);?>][recent_3]" name="builder_item[<?php echo esc_attr($i);?>][box_style]">
						        		<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri();?>/admin/images/recent_3.png"></a>
						        	</li>
						        	<li>
						        		<input type="radio" <?php if (isset($builder['box_style']) && $builder['box_style'] == "recent_4") {echo ' checked="checked"';}?> value="recent_4" id="builder_item[<?php echo esc_attr($i);?>][recent_4]" name="builder_item[<?php echo esc_attr($i);?>][box_style]">
						        		<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri();?>/admin/images/recent_4.png"></a>
						        	</li>
						        </ul>
						    	<div class="explain vpanel_help"><div class="tooltip_s" data-title="Recent posts layout style ."><i class="dashicons dashicons-info"></i></div></div>
						    	<div class="clear"></div>
						    </label>
						    
						    <label for="builder_item[<?php echo esc_attr($i);?>][excerpt_title]">
						    	<span>Excerpt title :</span>
						        <input id="builder_item[<?php echo esc_attr($i);?>][excerpt_title]" name="builder_item[<?php echo esc_attr($i);?>][excerpt_title]" value="<?php echo (isset($builder['excerpt_title'])?$builder['excerpt_title']:"5")?>" type="text">
						    </label>
						    
						    <label for="builder_item[<?php echo esc_attr($i);?>][excerpt]">
						    	<span>Excerpt :</span>
						        <input id="builder_item[<?php echo esc_attr($i);?>][excerpt]" name="builder_item[<?php echo esc_attr($i);?>][excerpt]" value="<?php echo (isset($builder['excerpt'])?$builder['excerpt']:"35")?>" type="text">
						    </label>
						    
						    <label for="builder_item[<?php echo esc_attr($i);?>][order_by]">
						        <span>Order by :</span>
						    	<div class="styled-select">
						            <select id="builder_item[<?php echo esc_attr($i);?>][order_by]" name="builder_item[<?php echo esc_attr($i);?>][order_by]">
						        		<option value="recent" <?php if (isset($builder['order_by']) && $builder['order_by'] == "recent") {echo ' selected="selected"';}?>>Recent</option>
						        		<option value="popular" <?php if (isset($builder['order_by']) && $builder['order_by'] == "popular") {echo ' selected="selected"';}?>>Popular</option>
						        		<option value="random" <?php if (isset($builder['order_by']) && $builder['order_by'] == "random") {echo ' selected="selected"';}?>>Random</option>
						            </select>
						        </div>
						    </label>
						    
						    <label for="builder_item[<?php echo esc_attr($i);?>][animate]">
						        <span>Box animate :</span>
						    	<div class="styled-select">
						            <select id="builder_item[<?php echo esc_attr($i);?>][animate]" name="builder_item[<?php echo esc_attr($i);?>][animate]">
						            	<option value="none" <?php if (isset($builder['animate']) && $builder['animate'] == "recent") {echo ' selected="selected"';}?>>none</option>
						            	<option value="bounce" <?php if (isset($builder['animate']) && $builder['animate'] == "bounce") {echo ' selected="selected"';}?>>bounce</option>
						            	<option value="bounceIn" <?php if (isset($builder['animate']) && $builder['animate'] == "bounceIn") {echo ' selected="selected"';}?>>bounceIn</option>
						            	<option value="bounceInDown" <?php if (isset($builder['animate']) && $builder['animate'] == "bounceInDown") {echo ' selected="selected"';}?>>bounceInDown</option>
						            	<option value="bounceInUp" <?php if (isset($builder['animate']) && $builder['animate'] == "bounceInUp") {echo ' selected="selected"';}?>>bounceInUp</option>
						            	<option value="bounceInLeft" <?php if (isset($builder['animate']) && $builder['animate'] == "bounceInLeft") {echo ' selected="selected"';}?>>bounceInLeft</option>
						            	<option value="bounceInRight" <?php if (isset($builder['animate']) && $builder['animate'] == "bounceInRight") {echo ' selected="selected"';}?>>bounceInRight</option>
						            	<option value="fadeIn" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeIn") {echo ' selected="selected"';}?>>fadeIn</option>
						            	<option value="fadeInUp" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInUp") {echo ' selected="selected"';}?>>fadeInUp</option>
						            	<option value="fadeInDown" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInDown") {echo ' selected="selected"';}?>>fadeInDown</option>
						            	<option value="fadeInLeft" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInLeft") {echo ' selected="selected"';}?>>fadeInLeft</option>
						            	<option value="fadeInRight" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInRight") {echo ' selected="selected"';}?>>fadeInRight</option>
						            	<option value="fadeInUpBig" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInUpBig") {echo ' selected="selected"';}?>>fadeInUpBig</option>
						            	<option value="fadeInDownBig" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInDownBig") {echo ' selected="selected"';}?>>fadeInDownBig</option>
						            	<option value="fadeInLeftBig" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInLeftBig") {echo ' selected="selected"';}?>>fadeInLeftBig</option>
						            	<option value="fadeInRightBig" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInRightBig") {echo ' selected="selected"';}?>>fadeInRightBig</option>
						            	<option value="flash" <?php if (isset($builder['animate']) && $builder['animate'] == "flash") {echo ' selected="selected"';}?>>flash</option>
						            	<option value="flip" <?php if (isset($builder['animate']) && $builder['animate'] == "flip") {echo ' selected="selected"';}?>>flip</option>
						            	<option value="flipInX" <?php if (isset($builder['animate']) && $builder['animate'] == "flipInX") {echo ' selected="selected"';}?>>flipInX</option>
						            	<option value="flipInY" <?php if (isset($builder['animate']) && $builder['animate'] == "flipInY") {echo ' selected="selected"';}?>>flipInY</option>
						            	<option value="lightSpeedIn" <?php if (isset($builder['animate']) && $builder['animate'] == "lightSpeedIn") {echo ' selected="selected"';}?>>lightSpeedIn</option>
						            	<option value="pulse" <?php if (isset($builder['animate']) && $builder['animate'] == "pulse") {echo ' selected="selected"';}?>>pulse</option>
						            	<option value="rotateIn" <?php if (isset($builder['animate']) && $builder['animate'] == "rotateIn") {echo ' selected="selected"';}?>>rotateIn</option>
						            	<option value="rotateInDownLeft" <?php if (isset($builder['animate']) && $builder['animate'] == "rotateInDownLeft") {echo ' selected="selected"';}?>>rotateInDownLeft</option>
						            	<option value="rotateInDownRight" <?php if (isset($builder['animate']) && $builder['animate'] == "rotateInDownRight") {echo ' selected="selected"';}?>>rotateInDownRight</option>
						            	<option value="rotateInUpLeft" <?php if (isset($builder['animate']) && $builder['animate'] == "rotateInUpLeft") {echo ' selected="selected"';}?>>rotateInUpLeft</option>
						            	<option value="rotateInUpRight" <?php if (isset($builder['animate']) && $builder['animate'] == "rotateInUpRight") {echo ' selected="selected"';}?>>rotateInUpRight</option>
						            	<option value="rollIn" <?php if (isset($builder['animate']) && $builder['animate'] == "rollIn") {echo ' selected="selected"';}?>>rollIn</option>
						            	<option value="shake" <?php if (isset($builder['animate']) && $builder['animate'] == "shake") {echo ' selected="selected"';}?>>shake</option>
						            	<option value="swing" <?php if (isset($builder['animate']) && $builder['animate'] == "swing") {echo ' selected="selected"';}?>>swing</option>
						            	<option value="tada" <?php if (isset($builder['animate']) && $builder['animate'] == "tada") {echo ' selected="selected"';}?>>tada</option>
						            	<option value="wobble" <?php if (isset($builder['animate']) && $builder['animate'] == "wobble") {echo ' selected="selected"';}?>>wobble</option>
						            	<option value="wiggle" <?php if (isset($builder['animate']) && $builder['animate'] == "wiggle") {echo ' selected="selected"';}?>>wiggle</option>
						            </select>
						        </div>
						    </label>
						    
							<input id="builder_item[<?php echo esc_attr($i);?>][type]" name="builder_item[<?php echo esc_attr($i);?>][type]" value="<?php echo (isset($builder['type'])?$builder['type']:"");?>" type="hidden">
						</div>
					<?php }else if (class_exists('woocommerce') && $builder['type'] == 'shop_box') {?>
						<div class="widget-head">
							<span class="vpanel<?php echo esc_attr($i);?>">Shop box - <span><?php echo (isset($builder['box_title']) && $builder['box_title'] != ""?$builder['box_title']:(isset($builder['box_display']) && $builder['box_display'] == "category"?get_the_category_by_ID($builder['box_cats']):""))?></span></span>
							<a class="builder-toggle-open">+</a>
							<a class="builder-toggle-close">-</a>
						</div>
						<div class="widget-content">
					        <label for="builder_item[<?php echo esc_attr($i);?>][box_title]">
					        	<span>Shop box title :</span>
					            <input id="builder_item[<?php echo esc_attr($i);?>][box_title]" class="builder_label_key" name="builder_item[<?php echo esc_attr($i);?>][box_title]" value="<?php echo (isset($builder['box_title'])?$builder['box_title']:"")?>" type="text">
					            <div class="explain vpanel_help"><div class="tooltip_s" data-title="Leave field blank if you want show the category name ."><i class="dashicons dashicons-info"></i></div></div>
					        </label>
					        
					        <label for="builder_item[<?php echo esc_attr($i);?>][box_posts_num]">
					            <span>Number of posts :</span>
					            <input id="builder_item[<?php echo esc_attr($i);?>][box_posts_num]" name="builder_item[<?php echo esc_attr($i);?>][box_posts_num]" value="<?php echo (isset($builder['box_posts_num'])?$builder['box_posts_num']:"")?>" type="text">
					        </label>
					        
					        <label for="builder_item[<?php echo esc_attr($i);?>][box_display]">
					            <span>Display :</span>
					        	<div class="styled-select">
					                <select class="builder_box_display" id="builder_item[<?php echo esc_attr($i);?>][box_display]" name="builder_item[<?php echo esc_attr($i);?>][box_display]">
					            		<option value="">Latest Posts</option>
					            		<option value="category" <?php if (isset($builder['box_display']) && $builder['box_display'] == "category") {echo ' selected="selected"';}?>>Single Category</option>
					            		<option value="categories" <?php if (isset($builder['box_display']) && $builder['box_display'] == "categories") {echo ' selected="selected"';}?>>Multiple categories</option>
					                </select>
					            </div>
					        </label>
					        
					        <label class="label_category" for="builder_item[<?php echo esc_attr($i);?>][box_cats]">
					            <span>Category :</span>
					        	<div class="styled-select">
					                <select class="builder_select_name" id="builder_item[<?php echo esc_attr($i);?>][box_cats]" name="builder_item[<?php echo esc_attr($i);?>][box_cats]">
					                <?php foreach ($product_cat as $key => $option) {?>
					            		<option value="<?php echo esc_attr($key);?>" <?php if ($builder['box_cats'] == $key) {echo ' selected="selected"';}?>><?php echo esc_attr($option);?></option>
					            	<?php }?>
					                </select>
					            </div>
					        </label>
					        
					        <label class="label_categories" for="builder_item[<?php echo esc_attr($i);?>][categories]">
					            <span>Categories :</span>
					        	<select multiple="multiple" id="builder_item[<?php echo esc_attr($i);?>][categories][]" name="builder_item[<?php echo esc_attr($i);?>][categories][]">
					        		<?php foreach ($product_cat as $key => $option) {?>
					        			<option value="<?php echo esc_attr($key) ?>" <?php if (isset($builder['categories']) && is_array($builder['categories']) && in_array($key,$builder['categories'])) {echo ' selected="selected"';} ?>><?php echo esc_attr($option); ?></option>
					        		<?php } ?>
					        	</select>
					            <div class="clear"></div>
					        </label>
					        
					        <label for="builder_item[<?php echo esc_attr($i);?>][order_by]">
					            <span>Order by :</span>
					        	<div class="styled-select">
					                <select id="builder_item[<?php echo esc_attr($i);?>][order_by]" name="builder_item[<?php echo esc_attr($i);?>][order_by]">
					            		<option value="recent" <?php if (isset($builder['order_by']) && $builder['order_by'] == "recent") {echo ' selected="selected"';}?>>Recent</option>
					            		<option value="popular" <?php if (isset($builder['order_by']) && $builder['order_by'] == "popular") {echo ' selected="selected"';}?>>Popular</option>
					            		<option value="random" <?php if (isset($builder['order_by']) && $builder['order_by'] == "random") {echo ' selected="selected"';}?>>Random</option>
					                </select>
					            </div>
					        </label>
					        
					        <label for="builder_item[<?php echo esc_attr($i);?>][scroll]">
					            <span>Scroll :</span>
					        	<div class="styled-select">
					                <select id="builder_item[<?php echo esc_attr($i);?>][scroll]" name="builder_item[<?php echo esc_attr($i);?>][scroll]">
					            		<option value="no" <?php if (isset($builder['scroll']) && $builder['scroll'] == "no") {echo ' selected="selected"';}?>>No</option>
					            		<option value="yes" <?php if (isset($builder['scroll']) && $builder['scroll'] == "yes") {echo ' selected="selected"';}?>>Yes</option>
					                </select>
					            </div>
					        </label>
					        
					        <label for="builder_item[<?php echo esc_attr($i);?>][animate]">
					            <span>Box animate :</span>
					        	<div class="styled-select">
					                <select id="builder_item[<?php echo esc_attr($i);?>][animate]" name="builder_item[<?php echo esc_attr($i);?>][animate]">
					                	<option value="none" <?php if (isset($builder['animate']) && $builder['animate'] == "recent") {echo ' selected="selected"';}?>>none</option>
					                	<option value="bounce" <?php if (isset($builder['animate']) && $builder['animate'] == "bounce") {echo ' selected="selected"';}?>>bounce</option>
					                	<option value="bounceIn" <?php if (isset($builder['animate']) && $builder['animate'] == "bounceIn") {echo ' selected="selected"';}?>>bounceIn</option>
					                	<option value="bounceInDown" <?php if (isset($builder['animate']) && $builder['animate'] == "bounceInDown") {echo ' selected="selected"';}?>>bounceInDown</option>
					                	<option value="bounceInUp" <?php if (isset($builder['animate']) && $builder['animate'] == "bounceInUp") {echo ' selected="selected"';}?>>bounceInUp</option>
					                	<option value="bounceInLeft" <?php if (isset($builder['animate']) && $builder['animate'] == "bounceInLeft") {echo ' selected="selected"';}?>>bounceInLeft</option>
					                	<option value="bounceInRight" <?php if (isset($builder['animate']) && $builder['animate'] == "bounceInRight") {echo ' selected="selected"';}?>>bounceInRight</option>
					                	<option value="fadeIn" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeIn") {echo ' selected="selected"';}?>>fadeIn</option>
					                	<option value="fadeInUp" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInUp") {echo ' selected="selected"';}?>>fadeInUp</option>
					                	<option value="fadeInDown" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInDown") {echo ' selected="selected"';}?>>fadeInDown</option>
					                	<option value="fadeInLeft" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInLeft") {echo ' selected="selected"';}?>>fadeInLeft</option>
					                	<option value="fadeInRight" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInRight") {echo ' selected="selected"';}?>>fadeInRight</option>
					                	<option value="fadeInUpBig" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInUpBig") {echo ' selected="selected"';}?>>fadeInUpBig</option>
					                	<option value="fadeInDownBig" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInDownBig") {echo ' selected="selected"';}?>>fadeInDownBig</option>
					                	<option value="fadeInLeftBig" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInLeftBig") {echo ' selected="selected"';}?>>fadeInLeftBig</option>
					                	<option value="fadeInRightBig" <?php if (isset($builder['animate']) && $builder['animate'] == "fadeInRightBig") {echo ' selected="selected"';}?>>fadeInRightBig</option>
					                	<option value="flash" <?php if (isset($builder['animate']) && $builder['animate'] == "flash") {echo ' selected="selected"';}?>>flash</option>
					                	<option value="flip" <?php if (isset($builder['animate']) && $builder['animate'] == "flip") {echo ' selected="selected"';}?>>flip</option>
					                	<option value="flipInX" <?php if (isset($builder['animate']) && $builder['animate'] == "flipInX") {echo ' selected="selected"';}?>>flipInX</option>
					                	<option value="flipInY" <?php if (isset($builder['animate']) && $builder['animate'] == "flipInY") {echo ' selected="selected"';}?>>flipInY</option>
					                	<option value="lightSpeedIn" <?php if (isset($builder['animate']) && $builder['animate'] == "lightSpeedIn") {echo ' selected="selected"';}?>>lightSpeedIn</option>
					                	<option value="pulse" <?php if (isset($builder['animate']) && $builder['animate'] == "pulse") {echo ' selected="selected"';}?>>pulse</option>
					                	<option value="rotateIn" <?php if (isset($builder['animate']) && $builder['animate'] == "rotateIn") {echo ' selected="selected"';}?>>rotateIn</option>
					                	<option value="rotateInDownLeft" <?php if (isset($builder['animate']) && $builder['animate'] == "rotateInDownLeft") {echo ' selected="selected"';}?>>rotateInDownLeft</option>
					                	<option value="rotateInDownRight" <?php if (isset($builder['animate']) && $builder['animate'] == "rotateInDownRight") {echo ' selected="selected"';}?>>rotateInDownRight</option>
					                	<option value="rotateInUpLeft" <?php if (isset($builder['animate']) && $builder['animate'] == "rotateInUpLeft") {echo ' selected="selected"';}?>>rotateInUpLeft</option>
					                	<option value="rotateInUpRight" <?php if (isset($builder['animate']) && $builder['animate'] == "rotateInUpRight") {echo ' selected="selected"';}?>>rotateInUpRight</option>
					                	<option value="rollIn" <?php if (isset($builder['animate']) && $builder['animate'] == "rollIn") {echo ' selected="selected"';}?>>rollIn</option>
					                	<option value="shake" <?php if (isset($builder['animate']) && $builder['animate'] == "shake") {echo ' selected="selected"';}?>>shake</option>
					                	<option value="swing" <?php if (isset($builder['animate']) && $builder['animate'] == "swing") {echo ' selected="selected"';}?>>swing</option>
					                	<option value="tada" <?php if (isset($builder['animate']) && $builder['animate'] == "tada") {echo ' selected="selected"';}?>>tada</option>
					                	<option value="wobble" <?php if (isset($builder['animate']) && $builder['animate'] == "wobble") {echo ' selected="selected"';}?>>wobble</option>
					                	<option value="wiggle" <?php if (isset($builder['animate']) && $builder['animate'] == "wiggle") {echo ' selected="selected"';}?>>wiggle</option>
					                </select>
					            </div>
					        </label>
					        
							<input id="builder_item[<?php echo esc_attr($i);?>][type]" name="builder_item[<?php echo esc_attr($i);?>][type]" value="<?php echo (isset($builder['type'])?$builder['type']:"");?>" type="hidden">
						</div>
					<?php }else if ($builder['type'] == 'adv') {?>
						<div class="widget-head">
							<span class="vpanel<?php echo esc_attr($i);?>">Advertising or HTML code</span>
							<a class="builder-toggle-open">+</a>
							<a class="builder-toggle-close">-</a>
						</div>
						<div class="widget-content">
							<label class="adv-label">
								<span>Advertising type :</span>
							    <input type="radio" <?php if (isset($builder['adv_type']) && $builder['adv_type'] == "display_code") {echo ' checked="checked"';}?> value="display_code" id="builder_item[<?php echo esc_attr($i);?>][display_code]" name="builder_item[<?php echo esc_attr($i);?>][adv_type]">
							    <label for="builder_item[<?php echo esc_attr($i);?>][display_code]">Display code</label>
							    
								<input type="radio" <?php if (isset($builder['adv_type']) && $builder['adv_type'] == "custom_image") {echo ' checked="checked"';}?> value="custom_image" id="builder_item[<?php echo esc_attr($i);?>][custom_image]" name="builder_item[<?php echo esc_attr($i);?>][adv_type]">
								<label for="builder_item[<?php echo esc_attr($i);?>][custom_image]">Custom Image</label>
							</label>
							
						    <label class="image-url" for="builder_item[<?php echo esc_attr($i);?>][image_url]">
						    	<span>Image URL :</span>
						    	<input id="builder_item[<?php echo esc_attr($i);?>][image_url]" name="builder_item[<?php echo esc_attr($i);?>][image_url]" value="<?php echo (isset($builder['image_url'])?$builder['image_url']:"")?>" type="text" class="upload upload_image_<?php echo esc_attr($i);?>">
								<input class="upload_image_button button upload-button-2" rel="<?php echo esc_attr($i);?>" type="button" value="Upload">
						        <input type="hidden" class="image_id" name="builder_item[<?php echo esc_attr($i);?>][image_id]" value="<?php echo (isset($builder['image_id'])?$builder['image_id']:"")?>">
						        <div class="clear"></div>
						    </label>
						    
						    <label class="adv-url" for="builder_item[<?php echo esc_attr($i);?>][adv_url]">
						    	<span>Advertising url :</span>
						        <input id="builder_item[<?php echo esc_attr($i);?>][adv_url]" class="builder_label_key" name="builder_item[<?php echo esc_attr($i);?>][adv_url]" value="<?php echo (isset($builder['adv_url'])?$builder['adv_url']:"")?>" type="text">
						    </label>
						    
						    <label class="adv-code" for="builder_item[<?php echo esc_attr($i);?>][adv_code]">
						    	<span>Advertising Code html  (Ex: Google ads) :</span>
						    	<textarea id="builder_item[<?php echo esc_attr($i);?>][adv_code]" name="builder_item[<?php echo esc_attr($i);?>][adv_code]"><?php echo (isset($builder['adv_code'])?$builder['adv_code']:"")?></textarea>
						    </label>
						    
						    <label for="builder_item[<?php echo esc_attr($i);?>][adv_box]">
						        <span>Advertising box :</span>
						    	<div class="styled-select">
						            <select id="builder_item[<?php echo esc_attr($i);?>][adv_box]" name="builder_item[<?php echo esc_attr($i);?>][adv_box]">
						        		<option value="enable" <?php if ($builder['adv_box'] == "enable") {echo ' selected="selected"';}?>>Enable</option>
						        		<option value="disable" <?php if ($builder['adv_box'] == "disable") {echo ' selected="selected"';}?>>Disable</option>
						            </select>
						        </div>
						    </label>
						    
							<input id="builder_item[<?php echo esc_attr($i);?>][type]" name="builder_item[<?php echo esc_attr($i);?>][type]" value="<?php echo (isset($builder['type'])?$builder['type']:"");?>" type="hidden">
						</div>
					<?php }else if ($builder['type'] == 'clear') {?>
						<div class="widget-head">
							<span class="vpanel<?php echo esc_attr($i);?>">Clear</span>
						</div>
						<input id="builder_item[<?php echo esc_attr($i);?>][type]" name="builder_item[<?php echo esc_attr($i);?>][type]" value="<?php echo (isset($builder['type'])?$builder['type']:"");?>" type="hidden">
					<?php }else if ($builder['type'] == 'gap') {?>
						<div class="widget-head">
							<span class="vpanel<?php echo esc_attr($i);?>">Gap - <span><?php echo (isset($builder['box_title']) && $builder['box_title'] != ""?$builder['box_title']:"")?></span></span>
							<a class="builder-toggle-open">+</a>
							<a class="builder-toggle-close">-</a>
						</div>
						<div class="widget-content">
						    <label for="builder_item[<?php echo esc_attr($i);?>][box_title]">
						    	<span>Gap height :</span>
						        <input id="builder_item[<?php echo esc_attr($i);?>][box_title]" class="builder_label_key" name="builder_item[<?php echo esc_attr($i);?>][box_title]" value="<?php echo (isset($builder['box_title'])?$builder['box_title']:"")?>" type="text">
						    </label>
						    
							<input id="builder_item[<?php echo esc_attr($i);?>][type]" name="builder_item[<?php echo esc_attr($i);?>][type]" value="<?php echo (isset($builder['type'])?$builder['type']:"");?>" type="hidden">
						</div>
					<?php }?>
					<a class="del-builder-item">x</a>
				</li>
		<?php }
		}else {
			echo "";
		}?>
    </ul>
	<script type="text/javascript">builder_j = <?php echo esc_js($i+1);?>;</script>
    <?php
}
/*-----------------------------------------------------------------------------------*/
/* builder slideshow meta box */
/*-----------------------------------------------------------------------------------*/
function builder_slideshow() {
	global $post;
	wp_nonce_field ('builder_save_meta','builder_save_meta_nonce');
	?>
    <div id="builder_slide_warp">
		<div class="add-item" add-item="add_slide"><?php _e('+ Add new slide','vbegy')?></div>
	    <div class="clear"></div>
		<ul id="builder_slide">
	    	<?php
			$builder_slide_item = get_post_meta($post->ID,'builder_slide_item');
			$k = 0;
			if ($builder_slide_item) {
				$builder_slide_item = $builder_slide_item[0];
				foreach ($builder_slide_item as $builder_slide) {$k++;
					?>
					<li id="builder_slide_<?php echo esc_attr($k);?>" class="ui-state-default">
						<div class="widget-head">
							<span class="vpanel<?php echo esc_attr($k);?>">Slide item - <?php echo esc_attr($k);?></span>
							<a class="builder-toggle-open">+</a>
							<a class="builder-toggle-close">-</a>
						</div>
						<div class="widget-content">
						    <label for="builder_slide_item[<?php echo esc_attr($k);?>][image_url]">
						    	<span>Image URL :</span>
						    	<input id="builder_slide_item[<?php echo esc_attr($k);?>][image_url]" name="builder_slide_item[<?php echo esc_attr($k);?>][image_url]" value="<?php echo (isset($builder_slide['image_url'])?$builder_slide['image_url']:"")?>" type="text" class="upload upload_image_<?php echo esc_attr($k);?>">
								<input class="upload_image_button button upload-button-2" rel="<?php echo esc_attr($k);?>" type="button" value="Upload">
						        <input type="hidden" class="image_id" name="builder_slide_item[<?php echo esc_attr($k);?>][image_id]" value="<?php echo (isset($builder_slide['image_id'])?$builder_slide['image_id']:"")?>">
						        <div class="clear"></div>
						    </label>
						    
						    <label for="builder_slide_item[<?php echo esc_attr($k);?>][slide_link]">
						    	<span>Slide Link :</span>
						        <input id="builder_slide_item[<?php echo esc_attr($k);?>][slide_link]" name="builder_slide_item[<?php echo esc_attr($k);?>][slide_link]" value="<?php echo (isset($builder_slide['slide_link'])?$builder_slide['slide_link']:"")?>" type="text">
						    </label>
						    
						</div>
						<a class="del-builder-item">x</a>
					</li>
			<?php }
			}else {
				echo "";
			}?>
	    </ul>
		<script type="text/javascript">builder_slide_j = <?php echo esc_attr($k+1);?>;</script>
	</div>
    <?php
}
/*-----------------------------------------------------------------------------------*/
/* builder rating meta box */
/*-----------------------------------------------------------------------------------*/
function builder_rating() {
	global $post;
	wp_nonce_field ('builder_save_meta','builder_save_meta_nonce');
	?>
    <div id="builder_rating_warp">
		<div class="add-item" add-item="add_rating"><?php _e('+ Add new review','vbegy')?></div>
	    <div class="clear"></div>
		<ul id="builder_rating_ul">
	    	<?php
			$builder_rating_item = get_post_meta($post->ID,'builder_rating_item');
			$a = 0;
			if ($builder_rating_item) {
				$builder_rating_item = $builder_rating_item[0];
				foreach ($builder_rating_item as $builder_rating) {$a++;
					?>
					<li id="builder_rating_<?php echo $a;?>" class="ui-state-default">
						<div class="widget-head">
							<span class="vpanel<?php echo $a;?>">Rating item - <?php echo $a;?></span>
							<a class="builder-toggle-open">+</a>
							<a class="builder-toggle-close">-</a>
						</div>
						<div class="widget-content">
						    <label for="builder_rating_item[<?php echo $a;?>][rating_description]">
						    	<span>Rating description :</span>
						        <input id="builder_rating_item[<?php echo $a;?>][rating_description]" name="builder_rating_item[<?php echo $a;?>][rating_description]" value="<?php echo (isset($builder_rating['rating_description'])?$builder_rating['rating_description']:"")?>" type="text">
						    </label>
						    
						    <label for="builder_rating_item[<?php echo $a;?>][rating_score]">
						    	<span>Rating score :</span>
						        <input class="rating_score" id="builder_rating_item[<?php echo $a;?>][rating_score]" name="builder_rating_item[<?php echo $a;?>][rating_score]" value="<?php echo (isset($builder_rating['rating_score'])?$builder_rating['rating_score']:"")?>" type="text"> <em class="preview_rating_em" id="preview_rating_<?php echo $a;?>"> </em>
						    </label>
						    
						</div>
						<a class="del-builder-item">x</a>
					</li>
			<?php }
			}else {
				echo "";
			}?>
	    </ul>
		<script type="text/javascript">builder_rating_j = <?php echo $a+1;?>;</script>
	</div>
    <?php
}
/*-----------------------------------------------------------------------------------*/
/* Process builder meta box */
/*-----------------------------------------------------------------------------------*/
add_action ('save_post','builder_meta_save',1,2);
function builder_meta_save ($post_id,$post) {
	global $wpdb;
	if (!$_POST) return $post_id;
	if ($post->post_type != 'page' && $post->post_type != 'post' && $post->post_type != 'portfolio') return $post_id;
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
	if (!isset($_POST['builder_save_meta_nonce']) || !wp_verify_nonce ($_POST['builder_save_meta_nonce'],'builder_save_meta')) return $post_id;
	if (!current_user_can ('edit_post',$post_id)) return $post_id;
	
	if (isset($_POST["builder_item"])) {
		$builders_post = $_POST["builder_item"];
	}
	if (isset($builders_post) && !empty($builders_post)) {
		foreach ($builders_post as $key => $value) {
			if (isset($value["box_title"])) {
				$value["box_title"] = esc_html($value["box_title"]);
			}
			if (isset($value["box_posts_num"])) {
				$value["box_posts_num"] = (int)esc_html($value["box_posts_num"]);
			}
			$builders[$key] = $value;
		}
		update_post_meta($post->ID,"builder_item",$builders);
	}else {
		delete_post_meta($post->ID,"builder_item");
	}
	
	if (isset($_POST["builder_slide_item"])) {
		$builder_slide_post = $_POST["builder_slide_item"];
	}
	if (isset($builder_slide_post) && !empty($builder_slide_post)) {
		foreach ($builder_slide_post as $key_s => $value_s) {
			if (isset($value_s["box_title"])) {
				$value_s["box_title"] = esc_html($value_s["box_title"]);
			}
			if (isset($value_s["box_posts_num"])) {
				$value_s["box_posts_num"] = (int)esc_html($value_s["box_posts_num"]);
			}
			$builder_slides[$key_s] = $value_s;
		}
		update_post_meta($post->ID,"builder_slide_item",$builder_slides);
	}else {
		delete_post_meta($post->ID,"builder_slide_item");
	}
	
	if (isset($_POST["builder_rating_item"])) {
		$builder_rating_post = $_POST["builder_rating_item"];
	}
	if (isset($builder_rating_post) && !empty($builder_rating_post)) {
		foreach ($builder_rating_post as $key_r => $value_r) {
			if (isset($value_r["rating_description"])) {
				$value_r["rating_description"] = esc_html($value_r["rating_description"]);
			}
			if (isset($value_r["rating_score"])) {
				$rating_score = $value_r["rating_score"] = (int)esc_html($value_r["rating_score"]);
			}
			$builder_ratings[$key_r] = $value_r;
		}
		update_post_meta($post->ID,"builder_rating_item",$builder_ratings);
	}else {
		delete_post_meta($post->ID,"builder_rating_item");
	}
	
	if (isset($_POST["vbegy_pagination"]) && $_POST["vbegy_pagination"] == 1) {
		$vbegy_pagination = $_POST["vbegy_pagination"];
		update_post_meta($post->ID,"vbegy_pagination",$vbegy_pagination);
	}else {
		delete_post_meta($post->ID,"vbegy_pagination");
	}
	
	if (isset($_POST["vbegy_custom_sections"]) && $_POST["vbegy_custom_sections"] == 1) {
		$vbegy_custom_sections = $_POST["vbegy_custom_sections"];
		update_post_meta($post->ID,"vbegy_custom_sections",$vbegy_custom_sections);
	}else {
		delete_post_meta($post->ID,"vbegy_custom_sections");
	}
	
	if (isset($_POST["order_sections_li"])) {
		$order_sections_li = $_POST["order_sections_li"];
	}
	if (isset($order_sections_li) && !empty($order_sections_li)) {
		$order_sections_li = $_POST["order_sections_li"];
		update_post_meta($post->ID,"order_sections_li",$order_sections_li);
	}else {
		delete_post_meta($post->ID,"order_sections_li");
	}
}
?>