<?php
/* portfolio */
if ((bool)get_option("FlushRewriteRules")) {
	flush_rewrite_rules(true);
	delete_option("FlushRewriteRules");
}
add_action( 'init', 'portfolio_init' );
function portfolio_init() {
	$portfolio_slug          = vpanel_options('portfolio_slug');
	$category_portfolio_slug = vpanel_options('category_portfolio_slug');
	$tag_portfolio_slug      = vpanel_options('tag_portfolio_slug');
	$portfolio_slug          = (isset($portfolio_slug) && $portfolio_slug != ""?$portfolio_slug:"portfolio");
	$category_portfolio_slug = (isset($category_portfolio_slug) && $category_portfolio_slug != ""?$category_portfolio_slug:"portfolio-category");
	$tag_portfolio_slug      = (isset($tag_portfolio_slug) && $tag_portfolio_slug != ""?$tag_portfolio_slug:"portfolio-tag");
	$labels = array(
		'name'               => __('portfolio','vbegy'),
		'singular_name'      => __('portfolio','vbegy'),
		'menu_name'          => __('portfolio','vbegy'),
		'name_admin_bar'     => __('portfolio','vbegy'),
		'add_new'            => __('Add New','vbegy'),
		'add_new_item'       => __('Add New portfolio','vbegy'),
		'new_item'           => __('New portfolio','vbegy'),
		'edit_item'          => __('Edit portfolio','vbegy'),
		'view_item'          => __('View portfolio','vbegy'),
		'all_items'          => __('All portfolio','vbegy'),
		'search_items'       => __('Search portfolio','vbegy'),
		'parent_item_colon'  => __('Parent portfolio:','vbegy'),
		'not_found'          => __('No portfolio found.','vbegy'),
		'not_found_in_trash' => __('No portfolio found in Trash.','vbegy'),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => $portfolio_slug, 'with_front' => true, 'pages' => true, 'feeds' => false ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 20,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'comments' )
	);

	register_post_type( 'portfolio', $args );
	
	$labels = array(
		'name' => __('Categories','vbegy'),
		'singular_name' => __('Categories','vbegy'),
		'search_items' =>  __('Search in categories','vbegy'),
		'all_items' => __('All categories','vbegy'),
		'parent_item' => __('Categories','vbegy'),
		'parent_item_colon' => __('Categories','vbegy'),
		'edit_item' => __('Edit','vbegy'),
		'update_item' => __('Edit','vbegy'),
		'add_new_item' => __('Add a new category','vbegy'),
		'new_item_name' => __('Add a new category','vbegy')
	); 	
	
	register_taxonomy('portfolio-category','portfolio',array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => $category_portfolio_slug, 'with_front' => false ),
	));

	register_taxonomy( 'portfolio_tags',
		array('portfolio'),
		array(
			'hierarchical' => false,
			'labels' => array(
				'name' => __('Tags','vbegy'),
				'singular_name' => __('Tags','vbegy'),
				'search_items' =>  __('Search in tags','vbegy'),
				'all_items' => __('All tags','vbegy'),
				'parent_item' => __('Tags','vbegy'),
				'parent_item_colon' => __('Tags','vbegy'),
				'edit_item' => __('Edit','vbegy'),
				'update_item' => __('Edit','vbegy'),
				'add_new_item' => __('Add new tag','vbegy'),
				'new_item_name' => __('Add new tag','vbegy')
			),
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => $tag_portfolio_slug ),
		)
	);
}
/* set_post_stats */
function set_post_stats() {
    $post_id = get_the_ID();
    if (is_single($post_id) || is_page($post_id)) {
        $current_stats = get_post_meta($post_id, 'post_stats', true);
        if (!isset($current_stats)) {
            add_post_meta($post_id, 'post_stats', 1, true);
        }else {
            update_post_meta($post_id, 'post_stats', $current_stats + 1);
        }
    }
}
add_action('wp_head', 'set_post_stats', 1000);
/* extra_category_fields */
function extra_category_fields_edit_style ($tag) {
	if (isset($tag->term_id)) {
		$t_id = $tag->term_id;
		$categories = get_option("categories_$t_id");
	}?>
	<tr class="form-field">
		<th scope="row" valign="top"><label>Post style</label></th>
		<td>
			<div class="rwmb-input vpanel-radio-input">
				<input class="of-input of-radio" type="radio" name="categories[post_style]" id="categories-post_style-default" value="default" <?php echo isset($categories['post_style']) && $categories['post_style'] == "default"?'checked="checked"':''.empty($categories['post_style'])?'checked="checked"':'';?>>
				<label class="radio_no_margin" for="categories-post_style-default">Default</label>
				
				<input class="of-input of-radio" type="radio" name="categories[post_style]" id="categories-post_style-style_1" value="style_1" <?php echo isset($categories['post_style']) && $categories['post_style'] == "style_1"?'checked="checked"':'';?>>
				<label class="radio_no_margin" for="categories-post_style-style_1">1 column</label>
				
				<input class="of-input of-radio" type="radio" name="categories[post_style]" id="categories-post_style-style_2" value="style_2" <?php echo isset($categories['post_style']) && $categories['post_style'] == "style_2"?'checked="checked"':'';?>>
				<label class="radio_no_margin" for="categories-post_style-style_2">2 columns</label>
				
				<input class="of-input of-radio" type="radio" name="categories[post_style]" id="categories-post_style-style_3" value="style_3" <?php echo isset($categories['post_style']) && $categories['post_style'] == "style_3"?'checked="checked"':'';?>>
				<label class="radio_no_margin" for="categories-post_style-style_3">3 columns ( work in full with only )</label>
				
				<input class="of-input of-radio" type="radio" name="categories[post_style]" id="categories-post_style-style_4" value="style_4" <?php echo isset($categories['post_style']) && $categories['post_style'] == "style_4"?'checked="checked"':'';?>>
				<label class="radio_no_margin" for="categories-post_style-style_4">1 columns small image</label>
				
				<input class="of-input of-radio" type="radio" name="categories[post_style]" id="categories-post_style-style_5" value="style_5" <?php echo isset($categories['post_style']) && $categories['post_style'] == "style_5"?'checked="checked"':'';?>>
				<label class="radio_no_margin" for="categories-post_style-style_5">1 columns large image</label>
				
				<input class="of-input of-radio" type="radio" name="categories[post_style]" id="categories-post_style-style_6" value="style_6" <?php echo isset($categories['post_style']) && $categories['post_style'] == "style_6"?'checked="checked"':'';?>>
				<label class="radio_no_margin" for="categories-post_style-style_6">Style 6</label>
				
				<input class="of-input of-radio" type="radio" name="categories[post_style]" id="categories-post_style-style_7" value="style_7" <?php echo isset($categories['post_style']) && $categories['post_style'] == "style_7"?'checked="checked"':'';?>>
				<label class="radio_no_margin" for="categories-post_style-style_7">Style 7</label>
			</div>
			<div class="clear"></div>
		</td>
	</tr>
	
	<tr class="form-field">
		<th scope="row" valign="top"><label>Page layout</label></th>
		<td>
			<div class="rwmb-input">
				<label class="radio_no_margin"><input type="radio" class="rwmb-radio" name="categories[cat_layout]" value="default" <?php echo isset($categories['cat_layout']) && $categories['cat_layout'] == "default"?'checked="checked"':''.empty($categories['cat_layout'])?'checked="checked"':'';?>></label>
				<label class="radio_no_margin"><input type="radio" class="rwmb-radio" name="categories[cat_layout]" value="full" <?php echo isset($categories['cat_layout']) && $categories['cat_layout'] == "full"?'checked="checked"':'';?>></label>
				<label class="radio_no_margin"><input type="radio" class="rwmb-radio" name="categories[cat_layout]" value="fixed" <?php echo isset($categories['cat_layout']) && $categories['cat_layout'] == "fixed"?'checked="checked"':'';?>></label>
				<label class="radio_no_margin"><input type="radio" class="rwmb-radio" name="categories[cat_layout]" value="fixed_2" <?php echo isset($categories['cat_layout']) && $categories['cat_layout'] == "fixed_2"?'checked="checked"':'';?>></label>
			</div>
			<div class="clear"></div>
		</td>
	</tr>
	
	<tr class="form-field">
		<th scope="row" valign="top"><label>Choose template</label></th>
		<td>
			<div class="rwmb-input">
				<label class="radio_no_margin"><input type="radio" class="rwmb-radio" name="categories[cat_template]" value="default" <?php echo isset($categories['cat_template']) && $categories['cat_template'] == "default"?'checked="checked"':''.empty($categories['cat_template'])?'checked="checked"':'';?>></label>
				<label class="radio_no_margin"><input type="radio" class="rwmb-radio" name="categories[cat_template]" value="grid_1200" <?php echo isset($categories['cat_template']) && $categories['cat_template'] == "grid_1200"?'checked="checked"':'';?>></label>
				<label class="radio_no_margin"><input type="radio" class="rwmb-radio" name="categories[cat_template]" value="grid_970" <?php echo isset($categories['cat_template']) && $categories['cat_template'] == "grid_970"?'checked="checked"':'';?>></label>
			</div>
			<div class="clear"></div>
		</td>
	</tr>
	
	<tr class="form-field">
		<th scope="row" valign="top"><label>Sidebar layout</label></th>
		<td>
			<div class="rwmb-input">
				<label class="radio_no_margin"><input type="radio" class="rwmb-radio" name="categories[cat_sidebar_layout]" value="default" <?php echo isset($categories['cat_sidebar_layout']) && $categories['cat_sidebar_layout'] == "default"?'checked="checked"':''.empty($categories['cat_sidebar_layout'])?'checked="checked"':'';?>></label>
				<label class="radio_no_margin"><input type="radio" class="rwmb-radio" name="categories[cat_sidebar_layout]" value="right" <?php echo isset($categories['cat_sidebar_layout']) && $categories['cat_sidebar_layout'] == "right"?'checked="checked"':'';?>></label>
				<label class="radio_no_margin"><input type="radio" class="rwmb-radio" name="categories[cat_sidebar_layout]" value="full" <?php echo isset($categories['cat_sidebar_layout']) && $categories['cat_sidebar_layout'] == "full"?'checked="checked"':'';?>></label>
				<label class="radio_no_margin"><input type="radio" class="rwmb-radio" name="categories[cat_sidebar_layout]" value="left" <?php echo isset($categories['cat_sidebar_layout']) && $categories['cat_sidebar_layout'] == "left"?'checked="checked"':'';?>></label>
				<label class="radio_no_margin"><input type="radio" class="rwmb-radio" name="categories[cat_sidebar_layout]" value="centered" <?php echo isset($categories['cat_sidebar_layout']) && $categories['cat_sidebar_layout'] == "centered"?'checked="checked"':'';?>></label>
			</div>
			<div class="clear"></div>
		</td>
	</tr>
	
	<tr class="form-field">
		<th scope="row" valign="top"><label for="cat_sidebar">Sidebar</label></th>
		<td>
			<div class="styled-select">
				<select name="categories[cat_sidebar]" id="cat_sidebar">
					<?php $sidebars = get_option('sidebars');
					echo "<option ".(isset($categories['cat_sidebar']) && $categories['cat_sidebar'] == "default"?'selected="selected"':'')." value='default'>Default</option>";
					foreach ($GLOBALS['wp_registered_sidebars'] as $sidebar) {
						echo "<option ".(isset($categories['cat_sidebar']) && $categories['cat_sidebar'] == $sidebar['id']?'selected="selected"':'')." value='".$sidebar['id']."'>".$sidebar['name']."</option>";
					}?>
				</select>
			</div>
			<div class="clear"></div>
		</td>
	</tr>
	
	<tr class="form-field">
		<th scope="row" valign="top"><label>Site skin</label></th>
		<td>
			<div class="rwmb-input">
				<label class="radio_no_margin"><input type="radio" class="rwmb-radio" name="categories[cat_skin_l]" value="default" <?php echo isset($categories['cat_skin_l']) && $categories['cat_skin_l'] == "default"?'checked="checked"':''.empty($categories['cat_skin_l'])?'checked="checked"':'';?>></label>
				<label class="radio_no_margin"><input type="radio" class="rwmb-radio" name="categories[cat_skin_l]" value="site_light" <?php echo isset($categories['cat_skin_l']) && $categories['cat_skin_l'] == "site_light"?'checked="checked"':'';?>></label>
				<label class="radio_no_margin"><input type="radio" class="rwmb-radio" name="categories[cat_skin_l]" value="site_dark" <?php echo isset($categories['cat_skin_l']) && $categories['cat_skin_l'] == "site_dark"?'checked="checked"':'';?>></label>
			</div>
			<div class="clear"></div>
		</td>
	</tr>
	
	<tr class="form-field">
		<th scope="row" valign="top"><label>Choose Your Skin</label></th>
		<td>
			<div class="rwmb-input">
				<label class="radio_no_margin"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="default" <?php echo isset($categories['cat_skin']) && $categories['cat_skin'] == "default"?'checked="checked"':''.empty($categories['cat_skin'])?'checked="checked"':'';?>></label>
				<label class="radio_no_margin skin"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="skin" <?php echo isset($categories['cat_skin']) && $categories['cat_skin'] == "skin"?'checked="checked"':'';?>></label>
				<label class="radio_no_margin bright_cyan"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="bright_cyan" <?php echo isset($categories['cat_skin']) && $categories['cat_skin'] == "bright_cyan"?'checked="checked"':'';?>></label>
				<label class="radio_no_margin bright_pink"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="bright_pink" <?php echo isset($categories['cat_skin']) && $categories['cat_skin'] == "bright_pink"?'checked="checked"':'';?>></label>
				<label class="radio_no_margin dark_grayish_blue"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="dark_grayish_blue" <?php echo isset($categories['cat_skin']) && $categories['cat_skin'] == "dark_grayish_blue"?'checked="checked"':'';?>></label>
				<label class="radio_no_margin dark_grayish_cyan"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="dark_grayish_cyan" <?php echo isset($categories['cat_skin']) && $categories['cat_skin'] == "dark_grayish_cyan"?'checked="checked"':'';?>></label>
				<label class="radio_no_margin dark_grayish_cyan_2"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="dark_grayish_cyan_2" <?php echo isset($categories['cat_skin']) && $categories['cat_skin'] == "dark_grayish_cyan_2"?'checked="checked"':'';?>></label>
				<label class="radio_no_margin dark_green"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="dark_green" <?php echo isset($categories['cat_skin']) && $categories['cat_skin'] == "dark_green"?'checked="checked"':'';?>></label>
				<label class="radio_no_margin dark_moderate_violet"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="dark_moderate_violet" <?php echo isset($categories['cat_skin']) && $categories['cat_skin'] == "dark_moderate_violet"?'checked="checked"':'';?>></label>
				<label class="radio_no_margin dark_pink"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="dark_pink" <?php echo isset($categories['cat_skin']) && $categories['cat_skin'] == "dark_pink"?'checked="checked"':'';?>></label>
				<label class="radio_no_margin light_orange"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="light_orange" <?php echo isset($categories['cat_skin']) && $categories['cat_skin'] == "light_orange"?'checked="checked"':'';?>></label>
				<label class="radio_no_margin lime_green"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="lime_green" <?php echo isset($categories['cat_skin']) && $categories['cat_skin'] == "lime_green"?'checked="checked"':'';?>></label>
				<label class="radio_no_margin moderate_blue"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="moderate_blue" <?php echo isset($categories['cat_skin']) && $categories['cat_skin'] == "moderate_blue"?'checked="checked"':'';?>></label>
				<label class="radio_no_margin moderate_blue_2"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="moderate_blue_2" <?php echo isset($categories['cat_skin']) && $categories['cat_skin'] == "moderate_blue_2"?'checked="checked"':'';?>></label>
				<label class="radio_no_margin moderate_cyan"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="moderate_cyan" <?php echo isset($categories['cat_skin']) && $categories['cat_skin'] == "moderate_cyan"?'checked="checked"':'';?>></label>
				<label class="radio_no_margin moderate_violet"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="moderate_violet" <?php echo isset($categories['cat_skin']) && $categories['cat_skin'] == "moderate_violet"?'checked="checked"':'';?>></label>
				<label class="radio_no_margin slightly_desaturated_blue"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="slightly_desaturated_blue" <?php echo isset($categories['cat_skin']) && $categories['cat_skin'] == "slightly_desaturated_blue"?'checked="checked"':'';?>></label>
				<label class="radio_no_margin soft_blue"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="soft_blue" <?php echo isset($categories['cat_skin']) && $categories['cat_skin'] == "soft_blue"?'checked="checked"':'';?>></label>
				<label class="radio_no_margin soft_cyan"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="soft_cyan" <?php echo isset($categories['cat_skin']) && $categories['cat_skin'] == "soft_cyan"?'checked="checked"':'';?>></label>
				<label class="radio_no_margin soft_red"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="soft_red" <?php echo isset($categories['cat_skin']) && $categories['cat_skin'] == "soft_red"?'checked="checked"':'';?>></label>
				<label class="radio_no_margin soft_yellow"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="soft_yellow" <?php echo isset($categories['cat_skin']) && $categories['cat_skin'] == "soft_yellow"?'checked="checked"':'';?>></label>
				<label class="radio_no_margin strong_cyan"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="strong_cyan" <?php echo isset($categories['cat_skin']) && $categories['cat_skin'] == "strong_cyan"?'checked="checked"':'';?>></label>
				<label class="radio_no_margin strong_orange"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="strong_orange" <?php echo isset($categories['cat_skin']) && $categories['cat_skin'] == "strong_orange"?'checked="checked"':'';?>></label>
				<label class="radio_no_margin strong_red"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="strong_red" <?php echo isset($categories['cat_skin']) && $categories['cat_skin'] == "strong_red"?'checked="checked"':'';?>></label>
				<label class="radio_no_margin very_light_pink"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="very_light_pink" <?php echo isset($categories['cat_skin']) && $categories['cat_skin'] == "very_light_pink"?'checked="checked"':'';?>></label>
				<label class="radio_no_margin vivid_cyan"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="vivid_cyan" <?php echo isset($categories['cat_skin']) && $categories['cat_skin'] == "vivid_cyan"?'checked="checked"':'';?>></label>
				<label class="radio_no_margin vivid_orange"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="vivid_orange" <?php echo isset($categories['cat_skin']) && $categories['cat_skin'] == "vivid_orange"?'checked="checked"':'';?>></label>
				<label class="radio_no_margin vivid_orange_2"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="vivid_orange_2" <?php echo isset($categories['cat_skin']) && $categories['cat_skin'] == "vivid_orange_2"?'checked="checked"':'';?>></label>
				<label class="radio_no_margin vivid_orange_3"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="vivid_orange_3" <?php echo isset($categories['cat_skin']) && $categories['cat_skin'] == "vivid_orange_3"?'checked="checked"':'';?>></label>
				<label class="radio_no_margin vivid_yellow"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="vivid_yellow" <?php echo isset($categories['cat_skin']) && $categories['cat_skin'] == "vivid_yellow"?'checked="checked"':'';?>></label>
				<label class="radio_no_margin vivid_yellow_2"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="vivid_yellow_2" <?php echo isset($categories['cat_skin']) && $categories['cat_skin'] == "vivid_yellow_2"?'checked="checked"':'';?>></label>
				<label class="radio_no_margin yellow"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="yellow" <?php echo isset($categories['cat_skin']) && $categories['cat_skin'] == "yellow"?'checked="checked"':'';?>></label>
				<label class="radio_no_margin red"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="red" <?php echo isset($categories['cat_skin']) && $categories['cat_skin'] == "red"?'checked="checked"':'';?>></label>
				<label class="radio_no_margin purple"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="purple" <?php echo isset($categories['cat_skin']) && $categories['cat_skin'] == "purple"?'checked="checked"':'';?>></label>
				<label class="radio_no_margin orange"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="orange" <?php echo isset($categories['cat_skin']) && $categories['cat_skin'] == "orange"?'checked="checked"':'';?>></label>
				<label class="radio_no_margin light_red"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="light_red" <?php echo isset($categories['cat_skin']) && $categories['cat_skin'] == "light_red"?'checked="checked"':'';?>></label>
				<label class="radio_no_margin green"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="green" <?php echo isset($categories['cat_skin']) && $categories['cat_skin'] == "green"?'checked="checked"':'';?>></label>
				<label class="radio_no_margin gray"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="gray" <?php echo isset($categories['cat_skin']) && $categories['cat_skin'] == "gray"?'checked="checked"':'';?>></label>
				<label class="radio_no_margin blue"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="blue" <?php echo isset($categories['cat_skin']) && $categories['cat_skin'] == "blue"?'checked="checked"':'';?>></label>
			</div>
			<div class="clear"></div>
		</td>
	</tr>
	
	<tr class="form-field">
		<th scope="row" valign="top"><label for="primary_color">Primary color</label></th>
		<td>
			<input id="primary_color" class="wp-color-picker" type="text" name="categories[primary_color]" value="<?php echo isset($categories['primary_color']) && $categories['primary_color'] != ""?$categories['primary_color']:'';?>">
			<div class="clear"></div>
		</td>
	</tr>
	
	<tr class="form-field">
		<th scope="row" valign="top"><label for="secondary_color">Secondary Color ( it's darkness more than primary color )</label></th>
		<td>
			<input id="secondary_color" class="wp-color-picker" type="text" name="categories[secondary_color]" value="<?php echo isset($categories['secondary_color']) && $categories['secondary_color'] != ""?$categories['secondary_color']:'';?>">
			<div class="clear"></div>
		</td>
	</tr>
	
	<tr class="form-field form-field-images">
		<th scope="row" valign="top"><label>Background image</label></th>
		<td>
			<input type="text" size="36" class="upload upload_meta regular-text" id="background_img" name="categories[background_img]" value="<?php echo (isset($categories['background_img']) && $categories['background_img'] != ""?$categories['background_img']:'');?>">
			<input id="background_img_button" class="upload_image_button button upload-button-2" type="button" value="Upload Image">
			<div class="clear"></div>
		</td>
	</tr>
	
	<tr class="form-field">
		<th scope="row" valign="top"><label for="background_color">Background color</label></th>
		<td>
			<input id="background_color" class="wp-color-picker" type="text" name="categories[background_color]" value="<?php echo isset($categories['background_color']) && $categories['background_color'] != ""?$categories['background_color']:'';?>">
			<div class="clear"></div>
		</td>
	</tr>
	
	<tr class="form-field">
		<th scope="row" valign="top"><label for="background_repeat">Background repeat</label></th>
		<td>
			<div class="rwmb-input">
				<div class="styled-select">
					<select class="rwmb-select" name="categories[background_repeat]" id="background_repeat" size="0">
						<option value="repeat" <?php echo (isset($categories['background_repeat']) && $categories['background_repeat'] == 'repeat'?'selected="selected"':'')?>>repeat</option>
						<option value="no-repeat" <?php echo (isset($categories['background_repeat']) && $categories['background_repeat'] == 'no-repeat'?'selected="selected"':'')?>>no-repeat</option>
						<option value="repeat-x" <?php echo (isset($categories['background_repeat']) && $categories['background_repeat'] == 'repeat-x'?'selected="selected"':'')?>>repeat-x</option>
						<option value="repeat-y" <?php echo (isset($categories['background_repeat']) && $categories['background_repeat'] == 'repeat-y'?'selected="selected"':'')?>>repeat-y</option>
					</select>
				</div>
			</div>
			<div class="clear"></div>
		</td>
	</tr>
	
	<tr class="form-field">
		<th scope="row" valign="top"><label for="background_fixed">Background fixed</label></th>
		<td>
			<div class="rwmb-input">
				<div class="styled-select">
					<select class="rwmb-select" name="categories[background_fixed]" id="background_fixed" size="0">
						<option value="fixed" <?php echo (isset($categories['background_fixed']) && $categories['background_fixed'] == 'fixed'?'selected="selected"':'')?>>fixed</option>
						<option value="scroll" <?php echo (isset($categories['background_fixed']) && $categories['background_fixed'] == 'scroll'?'selected="selected"':'')?>>scroll</option>
					</select>
				</div>
			</div>
			<div class="clear"></div>
		</td>
	</tr>
	
	<tr class="form-field">
		<th scope="row" valign="top"><label for="background_position_x">Background position x</label></th>
		<td>
			<div class="rwmb-input">
				<div class="styled-select">
					<select class="rwmb-select" name="categories[background_position_x]" id="background_position_x" size="0">
						<option value="left" <?php echo (isset($categories['background_position_x']) && $categories['background_position_x'] == 'left'?'selected="selected"':'')?>>left</option>
						<option value="center" <?php echo (isset($categories['background_position_x']) && $categories['background_position_x'] == 'center'?'selected="selected"':'')?>>center</option>
						<option value="right" <?php echo (isset($categories['background_position_x']) && $categories['background_position_x'] == 'right'?'selected="selected"':'')?>>right</option>
					</select>
				</div>
			</div>
			<div class="clear"></div>
		</td>
	</tr>
	
	<tr class="form-field">
		<th scope="row" valign="top"><label for="background_position_y">Background position y</label></th>
		<td>
			<div class="rwmb-input">
				<div class="styled-select">
					<select class="rwmb-select" name="categories[background_position_y]" id="background_position_y" size="0">
						<option value="top" <?php echo (isset($categories['background_position_y']) && $categories['background_position_y'] == 'top'?'selected="selected"':'')?>>top</option>
						<option value="center" <?php echo (isset($categories['background_position_y']) && $categories['background_position_y'] == 'center'?'selected="selected"':'')?>>center</option>
						<option value="bottom" <?php echo (isset($categories['background_position_y']) && $categories['background_position_y'] == 'bottom'?'selected="selected"':'')?>>bottom</option>
					</select>
				</div>
			</div>
			<div class="clear"></div>
		</td>
	</tr>
	
	<tr class="form-field">
		<th scope="row" valign="top"><label for="">Full Screen Background</label></th>
		<td>
			<input id="background_full" class="checkbox of-input vpanel_checkbox" type="checkbox" name="categories[background_full]" <?php echo isset($categories['background_full']) && $categories['background_full'] == "on"?'checked="checked"':'';?>>
			<div class="clear"></div>
		</td>
	</tr>
<?php
}
function extra_category_fields_style ($tag) {?>
	<div class="form-field">
		<label>Post style</label>
		<div class="rwmb-input vpanel-radio-input">
			<input class="of-input of-radio" type="radio" name="categories[post_style]" id="categories-post_style-default" value="default" checked="checked">
			<label class="radio_no_margin" for="categories-post_style-default">Default</label>
			
			<input class="of-input of-radio" type="radio" name="categories[post_style]" id="categories-post_style-style_1" value="style_1">
			<label class="radio_no_margin" for="categories-post_style-style_1">1 column</label>
			
			<input class="of-input of-radio" type="radio" name="categories[post_style]" id="categories-post_style-style_2" value="style_2">
			<label class="radio_no_margin" for="categories-post_style-style_2">2 columns</label>
			
			<input class="of-input of-radio" type="radio" name="categories[post_style]" id="categories-post_style-style_3" value="style_3">
			<label class="radio_no_margin" for="categories-post_style-style_3">3 columns ( work in full with only )</label>
			
			<input class="of-input of-radio" type="radio" name="categories[post_style]" id="categories-post_style-style_4" value="style_4">
			<label class="radio_no_margin" for="categories-post_style-style_4">1 columns small image</label>
			
			<input class="of-input of-radio" type="radio" name="categories[post_style]" id="categories-post_style-style_5" value="style_5">
			<label class="radio_no_margin" for="categories-post_style-style_5">1 columns large image</label>
			
			<input class="of-input of-radio" type="radio" name="categories[post_style]" id="categories-post_style-style_6" value="style_6">
			<label class="radio_no_margin" for="categories-post_style-style_6">Style 6</label>
			
			<input class="of-input of-radio" type="radio" name="categories[post_style]" id="categories-post_style-style_7" value="style_7">
			<label class="radio_no_margin" for="categories-post_style-style_7">Style 7</label>
		</div>
	</div>
	
	<div class="form-field">
		<label>Page layout</label>
		<div class="rwmb-input">
			<label class="radio_no_margin"><input type="radio" class="rwmb-radio" name="categories[cat_layout]" value="default" checked="checked"></label>
			<label class="radio_no_margin"><input type="radio" class="rwmb-radio" name="categories[cat_layout]" value="full"></label>
			<label class="radio_no_margin"><input type="radio" class="rwmb-radio" name="categories[cat_layout]" value="fixed"></label>
			<label class="radio_no_margin"><input type="radio" class="rwmb-radio" name="categories[cat_layout]" value="fixed_2"></label>
		</div>
	</div>
	
	<div class="form-field">
		<label>Choose template</label>
		<div class="rwmb-input">
			<label class="radio_no_margin"><input type="radio" class="rwmb-radio" name="categories[cat_template]" value="default" checked="checked"></label>
			<label class="radio_no_margin"><input type="radio" class="rwmb-radio" name="categories[cat_template]" value="grid_1200"></label>
			<label class="radio_no_margin"><input type="radio" class="rwmb-radio" name="categories[cat_template]" value="grid_970"></label>
		</div>
	</div>
	
	<div class="form-field">
		<label>Sidebar layout</label>
		<div class="rwmb-input">
			<label class="radio_no_margin"><input type="radio" class="rwmb-radio" name="categories[cat_sidebar_layout]" value="default" checked="checked"></label>
			<label class="radio_no_margin"><input type="radio" class="rwmb-radio" name="categories[cat_sidebar_layout]" value="right"></label>
			<label class="radio_no_margin"><input type="radio" class="rwmb-radio" name="categories[cat_sidebar_layout]" value="full"></label>
			<label class="radio_no_margin"><input type="radio" class="rwmb-radio" name="categories[cat_sidebar_layout]" value="left"></label>
			<label class="radio_no_margin"><input type="radio" class="rwmb-radio" name="categories[cat_sidebar_layout]" value="centered"></label>
		</div>
	</div>
	
	<div class="form-field">
		<label for="cat_sidebar">Sidebar</label>
		<div class="styled-select">
			<select name="categories[cat_sidebar]" id="cat_sidebar">
				<?php $sidebars = get_option('sidebars');
				echo "<option value='default'>Default</option>";
				foreach ($GLOBALS['wp_registered_sidebars'] as $sidebar) {
					echo "<option value='".$sidebar['id']."'>".$sidebar['name']."</option>";
				}?>
			</select>
		</div>
	</div>
	
	<div class="form-field">
		<label>Site skin</label>
		<div class="rwmb-input">
			<label class="radio_no_margin"><input type="radio" class="rwmb-radio" name="categories[cat_skin_l]" value="default" checked="checked"></label>
			<label class="radio_no_margin"><input type="radio" class="rwmb-radio" name="categories[cat_skin_l]" value="site_light"></label>
			<label class="radio_no_margin"><input type="radio" class="rwmb-radio" name="categories[cat_skin_l]" value="site_dark"></label>
		</div>
	</div>
	
	<div class="form-field">
		<label>Choose Your Skin</label>
		<div class="rwmb-input">
			<label class="radio_no_margin"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="default" checked="checked"></label>
			<label class="radio_no_margin skin"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="skin"></label>
			<label class="radio_no_margin bright_cyan"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="bright_cyan"></label>
			<label class="radio_no_margin bright_pink"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="bright_pink"></label>
			<label class="radio_no_margin dark_grayish_blue"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="dark_grayish_blue"></label>
			<label class="radio_no_margin dark_grayish_cyan"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="dark_grayish_cyan"></label>
			<label class="radio_no_margin dark_grayish_cyan_2"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="dark_grayish_cyan_2"></label>
			<label class="radio_no_margin dark_green"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="dark_green"></label>
			<label class="radio_no_margin dark_moderate_violet"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="dark_moderate_violet"></label>
			<label class="radio_no_margin dark_pink"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="dark_pink"></label>
			<label class="radio_no_margin light_orange"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="light_orange"></label>
			<label class="radio_no_margin lime_green"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="lime_green"></label>
			<label class="radio_no_margin moderate_blue"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="moderate_blue"></label>
			<label class="radio_no_margin moderate_blue_2"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="moderate_blue_2"></label>
			<label class="radio_no_margin moderate_cyan"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="moderate_cyan"></label>
			<label class="radio_no_margin moderate_violet"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="moderate_violet"></label>
			<label class="radio_no_margin slightly_desaturated_blue"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="slightly_desaturated_blue"></label>
			<label class="radio_no_margin soft_blue"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="soft_blue"></label>
			<label class="radio_no_margin soft_cyan"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="soft_cyan"></label>
			<label class="radio_no_margin soft_red"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="soft_red"></label>
			<label class="radio_no_margin soft_yellow"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="soft_yellow"></label>
			<label class="radio_no_margin strong_cyan"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="strong_cyan"></label>
			<label class="radio_no_margin strong_orange"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="strong_orange"></label>
			<label class="radio_no_margin strong_red"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="strong_red"></label>
			<label class="radio_no_margin very_light_pink"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="very_light_pink"></label>
			<label class="radio_no_margin vivid_cyan"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="vivid_cyan"></label>
			<label class="radio_no_margin vivid_orange"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="vivid_orange"></label>
			<label class="radio_no_margin vivid_orange_2"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="vivid_orange_2"></label>
			<label class="radio_no_margin vivid_orange_3"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="vivid_orange_3"></label>
			<label class="radio_no_margin vivid_yellow"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="vivid_yellow"></label>
			<label class="radio_no_margin vivid_yellow_2"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="vivid_yellow_2"></label>
			<label class="radio_no_margin yellow"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="yellow"></label>
			<label class="radio_no_margin red"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="red"></label>
			<label class="radio_no_margin purple"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="purple"></label>
			<label class="radio_no_margin orange"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="orange"></label>
			<label class="radio_no_margin light_red"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="light_red"></label>
			<label class="radio_no_margin green"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="green"></label>
			<label class="radio_no_margin gray"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="gray"></label>
			<label class="radio_no_margin blue"><input type="radio" class="rwmb-radio" name="categories[cat_skin]" value="blue"></label>
		</div>
	</div>
	
	<div class="form-field">
		<label for="primary_color">Primary color</label>
		<input id="primary_color" class="wp-color-picker" type="text" name="categories[primary_color]">
	</div>
	
	<div class="form-field">
		<label for="secondary_color">Secondary Color ( it's darkness more than primary color )</label>
		<input id="secondary_color" class="wp-color-picker" type="text" name="categories[secondary_color]">
	</div>
	
	<div class="form-field form-field-images">
		<label for="small_image">Background image</label>
		<input type="text" size="36" class="upload upload_meta regular-text" id="small_image" name="categories[background_img]">
		<input id="small_image_button" class="upload_image_button button upload-button-2" type="button" value="Upload Image">
	</div>
	
	<div class="form-field">
		<label for="background_color">Background color</label>
		<input id="background_color" class="wp-color-picker" type="text" name="categories[background_color]">
	</div>
	
	<div class="form-field">
		<label for="background_repeat">Background repeat</label>
		<div class="rwmb-input">
			<div class="styled-select">
				<select class="rwmb-select" name="categories[background_repeat]" id="background_repeat" size="0">
					<option value="repeat" selected="selected">repeat</option>
					<option value="no-repeat">no-repeat</option>
					<option value="repeat-x">repeat-x</option>
					<option value="repeat-y">repeat-y</option>
				</select>
			</div>
		</div>
	</div>
	
	<div class="form-field">
		<label for="background_fixed">Background fixed</label>
		<div class="rwmb-input">
			<div class="styled-select">
				<select class="rwmb-select" name="categories[background_fixed]" id="background_fixed" size="0">
					<option value="fixed" selected="selected">fixed</option>
					<option value="scroll">scroll</option>
				</select>
			</div>
		</div>
	</div>
	
	<div class="form-field">
		<label for="background_position_x">Background position x</label>
		<div class="rwmb-input">
			<div class="styled-select">
				<select class="rwmb-select" name="categories[background_position_x]" id="background_position_x" size="0">
					<option value="left" selected="selected">left</option>
					<option value="center">center</option>
					<option value="right">right</option>
				</select>
			</div>
		</div>
	</div>
	
	<div class="form-field">
		<label for="background_position_y">Background position y</label>
		<div class="rwmb-input">
			<div class="styled-select">
				<select class="rwmb-select" name="categories[background_position_y]" id="background_position_y" size="0">
					<option value="top" selected="selected">top</option>
					<option value="center">center</option>
					<option value="bottom">bottom</option>
				</select>
			</div>
		</div>
	</div>
	
	<div class="form-field">
		<label for="background_full">Full Screen Background</label>
		<input id="background_full" class="checkbox of-input vpanel_checkbox" type="checkbox" name="categories[background_full]">
	</div>
<?php
}
add_action('category_edit_form_fields','extra_category_fields_edit_style',10,2);
add_action ('category_add_form_fields','extra_category_fields_style',10,2);

add_action('product_cat_edit_form_fields','extra_category_fields_edit_style',10,2);
add_action ('product_cat_add_form_fields','extra_category_fields_style',10,2);
/* save_extra_category_fileds */
add_action('edited_category','save_extra_category_fileds_style',10,2);
add_action('create_category','save_extra_category_fileds_style',10,2);

add_action('edited_product_cat','save_extra_category_fileds_style',10,2);
add_action('create_product_cat','save_extra_category_fileds_style',10,2);
function save_extra_category_fileds_style ($term_id) {
	if (isset($_POST['categories'])) {
		$t_id = $term_id;
		$categories = get_option("categories_$t_id");
		$categories = array_keys($_POST['categories']);
		foreach ($categories as $key){
			if (isset($_POST['categories'][$key])){
				$categories[$key] = $_POST['categories'][$key];
			}
		}
		update_option("categories_$t_id",$categories);
	}
}
?>