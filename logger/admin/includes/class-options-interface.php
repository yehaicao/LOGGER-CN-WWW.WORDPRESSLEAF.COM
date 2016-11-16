<?php
/**
 * @package   Options_Framework
 * @author    Devin Price <devin@wptheming.com>
 * @license   GPL-2.0+
 * @link      http://wptheming.com
 * @copyright 2013 WP Theming
 */

class Options_Framework_Interface {

	/**
	 * Generates the tabs that are used in the options menu
	 */
	static function optionsframework_tabs() {
		$counter = 0;
		$options = & Options_Framework::_optionsframework_options();
		$menu = '';

		foreach ( $options as $value ) {
			// Heading for Navigation
			if ( $value['type'] == "heading" ) {
				$counter++;
				$class = '';
				$class = ! empty( $value['id'] ) ? $value['id'] : $value['name'];
				$class = preg_replace( '/[^a-zA-Z0-9._\-]/', '', strtolower($class) ) . '-tab';
				$menu .= '<a id="options-group-'.  $counter . '-tab" class="nav-tab ' . $class .'" title="' . esc_attr( $value['name'] ) . '" href="' . esc_attr( '#options-group-'.  $counter ) . '">' . esc_html( $value['name'] ) . '</a>';
			}
		}

		return $menu;
	}

	/**
	 * Generates the options fields that are used in the form.
	 */
	static function optionsframework_fields() {

		global $allowedtags,$themename;
		$optionsframework_settings = get_option(vpanel_options);
		// Gets the unique option id
		if ( isset( $optionsframework_settings['id'] ) ) {
			$option_name = $optionsframework_settings['id'];
		}else {
			$option_name = vpanel_options;
		};

		$settings = get_option($option_name);
		$options = & Options_Framework::_optionsframework_options();

		$counter = 0;
		$menu = '';

		foreach ( $options as $value ) {

			$val = '';
			$select_value = '';
			$output = '';

			// Wrap all options
			if ( ( $value['type'] != "heading" ) && ( $value['type'] != "info" ) && ( $value['type'] != "content" ) ) {

				// Keep all ids lowercase with no spaces
				$value['id'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower($value['id']) );

				$id = 'section-' . $value['id'];

				$class = 'section';
				if ( isset( $value['type'] ) ) {
					$class .= ' section-' . $value['type'];
				}
				if ( isset( $value['class'] ) ) {
					$class .= ' ' . $value['class'];
				}

				$output .= '<div id="' . esc_attr( $id ) .'" class="' . esc_attr( $class ) . '">'."\n";
				if ( isset( $value['name'] ) ) {
					$output .= '<h4 class="heading">' . esc_html( $value['name'] ) . '</h4>' . "\n";
				}
				if ( $value['type'] != 'editor' && $value['type'] != 'upload' && $value['type'] != 'background' && $value['type'] != 'sidebar' ) {
					$output .= '<div class="option">' . "\n" . '<div class="controls">' . "\n";
				}else if ( $value['type'] == 'upload' || $value['type'] == 'background' ) {
					$output .= '<div class="option">' . "\n" . '<div class="controls controls-upload">' . "\n";
				}else if ( $value['type'] == 'sidebar' ) {
					$output .= '<div class="option">' . "\n" . '<div class="controls controls-sidebar">' . "\n";
				}else {
					$output .= '<div class="option">' . "\n" . '<div>' . "\n";
				}
			}

			// Set default value to $val
			if ( isset( $value['std'] ) ) {
				$val = $value['std'];
			}

			// If the option is already saved, override $val
			if ( ( $value['type'] != 'heading' ) && ( $value['type'] != 'info') && ( $value['type'] != 'content') ) {
				if ( isset( $settings[($value['id'])]) ) {
					$val = $settings[($value['id'])];
					// Striping slashes of non-array options
					if ( !is_array($val) ) {
						$val = stripslashes( $val );
					}
				}
			}

			// If there is a description save it for labels
			$explain_value = '';
			if ( isset( $value['desc'] ) ) {
				$explain_value = $value['desc'];
			}

			if ( has_filter( 'vpanel_' . $value['type'] ) ) {
				$output .= apply_filters( 'vpanel_' . $value['type'], $option_name, $value, $val );
			}


			switch ( $value['type'] ) {

			// Basic text input
			case 'text':
				$output .= '<input id="' . esc_attr( $value['id'] ) . '" class="of-input" name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" type="text" value="' . esc_attr( $val ) . '">';
				break;

			// Password input
			case 'password':
				$output .= '<input id="' . esc_attr( $value['id'] ) . '" class="of-input" name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" type="password" value="' . esc_attr( $val ) . '">';
				break;

			// Textarea
			case 'textarea':
				$rows = '8';

				if ( isset( $value['settings']['rows'] ) ) {
					$custom_rows = $value['settings']['rows'];
					if ( is_numeric( $custom_rows ) ) {
						$rows = $custom_rows;
					}
				}

				$val = stripslashes( $val );
				$output .= '<textarea id="' . esc_attr( $value['id'] ) . '" class="of-input" name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" rows="' . $rows . '">' . esc_textarea( $val ) . '</textarea>';
				break;
			
			// Sections
			case 'sections':
				$output .= '<ul id="sort-sections">';
					$order_sections_li = $val;
					if (empty($order_sections_li)) {
						$order_sections_li = array(1 => "next_previous",2 => "advertising",3 => "author",4 => "related",5 => "comments");
					}
					$order_sections = $order_sections_li;
					$i = 0;
					foreach ($order_sections as $key_r => $value_r) {
						$i++;
						if ($value_r == "") {
							unset($order_sections[$key_r]);
						}else {
							$output .= '<li id="'.esc_attr($value_r).'" class="ui-state-default">
								<div class="widget-head"><span>';
								if ($value_r == "next_previous") {
									$output .= esc_attr("Next and Previous articles");
								}else if ($value_r == "advertising") {
									$output .= esc_attr("Advertising");
								}else if ($value_r == "author") {
									$output .= esc_attr("About the author");
								}else if ($value_r == "related") {
									$output .= esc_attr("Related articles");
								}else if ($value_r == "comments") {
									$output .= esc_attr("Comments");
								}
								$output .= '</span></div>
								<input name="'.esc_attr( $option_name . '[' . $value['id'] . ']['.esc_attr($i).']' ).'" value="';if ($value_r == "next_previous") {$output .= esc_attr("next_previous");}else if ($value_r == "advertising") {$output .= esc_attr("advertising");}else if ($value_r == "author") {$output .= esc_attr("author");}else if ($value_r == "related") {$output .= esc_attr("related");}else if ($value_r == "comments") {$output .= esc_attr("comments");}$output .= '" type="hidden">
							</li>';
						}
					}
				$output .= '</ul>';
				break;
			
			// Sidebar
			case 'sidebar':
				$output .= '
				<input id="sidebar_name" type="text" name="sidebar_name" value="">
				<input id="sidebar_add" type="button" value="+ Add new sidebar">
				<div class="clear"></div>
				<ul id="sidebars_list">';
					$sidebars = get_option(esc_attr( $value['id'] ));
					if($sidebars) {
						foreach ($sidebars as $sidebar) {
							$output .= '<li><div class="widget-head">'.esc_html($sidebar).'<input id="sidebars" name="sidebars[]" type="hidden" value="'.esc_html($sidebar).'"><a class="del-builder-item del-sidebar-item">x</a></div></li>';
						}
					}
				$output .= '</ul>';
				break;
			
			// Select Box
			case 'select':
				$output .= '<select class="of-input" '.(isset($value['multiple']) && $value['multiple'] != ""?"multiple":"").' name="' . esc_attr( $option_name . '[' . $value['id'] . ']'.(isset($value['multiple']) && $value['multiple'] != ""?"[]":"") ) . '" id="' . esc_attr( $value['id'] ) . '">';
				foreach ($value['options'] as $key => $option ) {
					$output .= '<option'. (isset($value['multiple']) && $value['multiple'] != ""?(isset($val) && is_array($val) && in_array($key,$val)?' selected="selected"':""):selected( $val, $key, false )) .' value="' . esc_attr( $key ) . '">' . esc_html( $option ) . '</option>';
				}
				$output .= '</select>';
				break;

			// Select advanced
			case 'select_advanced':
				$output .= '<select class="of-input" '.(isset($value['multiple']) && $value['multiple'] != ""?"multiple":"").' name="' . esc_attr( $option_name . '[' . $value['id'] . '][]' ) . '" id="' . esc_attr( $value['id'] ) . '">';
				foreach ($value['options'] as $key => $option ) {
					$output .= '<option'. selected( $val, $key, false ) .' value="' . esc_attr( $key ) . '">' . esc_html( $option ) . '</option>';
				}
				$output .= '</select>';
				break;
			
			// Radio Box
			case "radio":
				$name = $option_name .'['. $value['id'] .']';
				foreach ($value['options'] as $key => $option) {
					$id = $option_name . '-' . $value['id'] .'-'. $key;
					$output .= '<input class="of-input of-radio '.(isset($value['class'])?esc_attr($value['class']):'').'" type="radio" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '" value="'. esc_attr( $key ) . '" '. checked( $val, $key, false) .'><label for="' . esc_attr( $id ) . '">' . esc_html( $option ) . '</label>';
				}
				break;

			// Image Selectors
			case "images":
				$name = $option_name .'['. $value['id'] .']';
				foreach ( $value['options'] as $key => $option ) {
					$selected = '';
					if ( $val != '' && ($val == $key) ) {
						$selected = ' of-radio-img-selected';
					}
					$output .= '<input type="radio" id="' . esc_attr( $value['id'] .'_'. $key) . '" class="of-radio-img-radio" value="' . esc_attr( $key ) . '" name="' . esc_attr( $name ) . '" '. checked( $val, $key, false ) .'>';
					$output .= '<div class="of-radio-img-label">' . esc_html( $key ) . '</div>';
					$output .= '<img src="' . esc_url( $option ) . '" alt="' . $option .'" class="of-radio-img-img '.(isset($value['class'])?esc_attr($value['class']):'').'' . $selected .'" onclick="document.getElementById(\''. esc_attr($value['id'] .'_'. $key) .'\').checked=true;">';
				}
				break;

			// Checkbox
			case "checkbox":
				$output .= '<input id="' . esc_attr( $value['id'] ) . '" class="checkbox of-input vpanel_checkbox" type="checkbox" name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" '. checked( $val, "on", false) .'>';
				$output .= '<label class="explain explain-checkbox" for="' . esc_attr( $value['id'] ) . '">' . wp_kses( $explain_value, $allowedtags) . '</label>';
				break;

			// Multicheck
			case "multicheck":
				foreach ($value['options'] as $key => $option) {
					$checked = '';
					$label = $option;
					$option = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower($key));

					$id = $option_name . '-' . $value['id'] . '-'. $option;
					$name = $option_name . '[' . $value['id'] . '][' . $option .']';

					if ( isset($val[$option]) ) {
						$checked = checked($val[$option], 1, false);
					}

					$output .= '<input id="' . esc_attr( $id ) . '" class="checkbox of-input vpanel_multicheck" type="checkbox" name="' . esc_attr( $name ) . '" ' . $checked . '><label for="' . esc_attr( $id ) . '">' . esc_html( $label ) . '</label>';
				}
				break;

			// Color picker
			case "color":
				$default_color = '';
				if ( isset($value['std']) ) {
					if ( $val !=  $value['std'] )
						$default_color = ' data-default-color="' .$value['std'] . '" ';
				}
				$output .= '<input name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" id="' . esc_attr( $value['id'] ) . '" class="of-color '.(isset($value['class'])?esc_attr($value['class']):'').'"  type="text" value="' . esc_attr( $val ) . '"' . $default_color .'>';

				break;

			// Uploader
			case "upload":
				$output .= Options_Framework_Media_Uploader::optionsframework_uploader( $value['id'], $val, null );

				break;

			// Slider
			case 'sliderui':
				$min = $max = $step = $edit = '';
				
				if(!isset($value['min'])){ $min  = '0'; }else{ $min = $value['min']; }
				if(!isset($value['max'])){ $max  = $min + 1; }else{ $max = $value['max']; }
				if(!isset($value['step'])){ $step  = '1'; }else{ $step = $value['step']; }
				
				if (!isset($value['edit'])) { 
					$edit  = ' readonly="readonly"'; 
				}else {
					$edit  = '';
				}
				
				if ($val == '') $val = $min;
				
				//values
				$data = 'data-id="'.$value['id'].'" data-val="'.$val.'" data-min="'.$min.'" data-max="'.$max.'" data-step="'.$step.'"';
				
				//html output
				$output .= '<input type="text" name="'.esc_attr( $option_name . '[' . $value['id'] . ']' ).'" id="'.esc_attr( $value['id'] ).'" value="'. $val .'" class="mini" '. $edit .' />';
				$output .= '<div id="'.$value['id'].'-slider" class="v_sliderui" '. $data .'></div>';
				break;
			
			// Typography
			case 'typography':

				unset( $font_size, $font_style, $font_face, $font_color );

				$typography_defaults = array(
					'size' => '',
					'face' => '',
					'style' => '',
					'color' => ''
				);

				$typography_stored = wp_parse_args( $val, $typography_defaults );

				$typography_options = array(
					'sizes' => of_recognized_font_sizes(),
					'faces' => of_recognized_font_faces(),
					'styles' => of_recognized_font_styles(),
					'color' => true
				);

				if ( isset( $value['options'] ) ) {
					$typography_options = wp_parse_args( $value['options'], $typography_options );
				}

				// Font Size
				if ( $typography_options['sizes'] ) {
					$font_size = '<select class="of-typography of-typography-size" name="' . esc_attr( $option_name . '[' . $value['id'] . '][size]' ) . '" id="' . esc_attr( $value['id'] . '_size' ) . '">';
					$sizes = $typography_options['sizes'];
					$font_size .= '<option value="" ' . selected( "default", "default", false ) . '>'.__("Size","vbegy").'</option>';
					foreach ( $sizes as $i ) {
						$size = $i . 'px';
						$font_size .= '<option value="' . esc_attr( $size ) . '" ' . (isset($typography_stored['size']) && is_string($typography_stored['size'])?selected( $typography_stored['size'], $size, false ):"") . '>' . esc_html( $size ) . '</option>';
					}
					$font_size .= '</select>';
				}

				// Font Face
				if ( $typography_options['faces'] ) {
					$font_face = '<select class="of-typography of-typography-face" name="' . esc_attr( $option_name . '[' . $value['id'] . '][face]' ) . '" id="' . esc_attr( $value['id'] . '_face' ) . '">';
					$faces = $typography_options['faces'];
					foreach ( $faces as $key => $face ) {
						$font_face .= '<option value="' . esc_attr( $key ) . '" ' . selected( $typography_stored['face'], $key, false ) . '>' . esc_html( $face ) . '</option>';
					}
					$font_face .= '</select>';
				}

				// Font Styles
				if ( $typography_options['styles'] ) {
					$font_style = '<select class="of-typography of-typography-style" name="'.$option_name.'['.$value['id'].'][style]" id="'. $value['id'].'_style">';
					$styles = $typography_options['styles'];
					foreach ( $styles as $key => $style ) {
						$font_style .= '<option value="' . esc_attr( $key ) . '" ' . selected( $typography_stored['style'], $key, false ) . '>'. $style .'</option>';
					}
					$font_style .= '</select>';
				}

				// Font Color
				if ( $typography_options['color'] ) {
					$default_color = '';
					if ( isset($value['std']['color']) ) {
						if ( $val !=  $value['std']['color'] )
							$default_color = ' data-default-color="' .$value['std']['color'] . '" ';
					}
					$font_color = '<input name="' . esc_attr( $option_name . '[' . $value['id'] . '][color]' ) . '" id="' . esc_attr( $value['id'] . '_color' ) . '" class="of-color of-typography-color"  type="text" value="' . esc_attr( $typography_stored['color'] ) . '"' . $default_color .'>';
				}

				// Allow modification/injection of typography fields
				$typography_fields = compact( 'font_size', 'font_face', 'font_style', 'font_color' );
				$typography_fields = apply_filters( 'of_typography_fields', $typography_fields, $typography_stored, $option_name, $value );
				$output .= implode( '', $typography_fields );

				break;

			// Background
			case 'background':

				$background = $val;

				// Background Color
				$default_color = '';
				if ( isset( $value['std']['color'] ) ) {
					if ( $val !=  $value['std']['color'] )
						$default_color = ' data-default-color="' .$value['std']['color'] . '" ';
				}
				$output .= '<input name="' . esc_attr( $option_name . '[' . $value['id'] . '][color]' ) . '" id="' . esc_attr( $value['id'] . '_color' ) . '" class="of-color of-background-color"  type="text" value="' . esc_attr( $background['color'] ) . '"' . $default_color .'>';

				// Background Image
				if ( !isset($background['image']) ) {
					$background['image'] = '';
				}

				$output .= Options_Framework_Media_Uploader::optionsframework_uploader( $value['id'], $background['image'], null, esc_attr( $option_name . '[' . $value['id'] . '][image]' ) );

				$class = 'of-background-properties '.(isset($value['class'])?esc_attr($value['class']):'').'';
				if ( '' == $background['image'] ) {
					$class .= ' hide';
				}
				$output .= '<div class="' . esc_attr( $class ) . '">';

				// Background Repeat
				$output .= '<select class="of-background of-background-repeat" name="' . esc_attr( $option_name . '[' . $value['id'] . '][repeat]'  ) . '" id="' . esc_attr( $value['id'] . '_repeat' ) . '">';
				$repeats = of_recognized_background_repeat();

				foreach ($repeats as $key => $repeat) {
					$output .= '<option value="' . esc_attr( $key ) . '" ' . selected( $background['repeat'], $key, false ) . '>'. esc_html( $repeat ) . '</option>';
				}
				$output .= '</select>';

				// Background Position
				$output .= '<select class="of-background of-background-position" name="' . esc_attr( $option_name . '[' . $value['id'] . '][position]' ) . '" id="' . esc_attr( $value['id'] . '_position' ) . '">';
				$positions = of_recognized_background_position();

				foreach ($positions as $key=>$position) {
					$output .= '<option value="' . esc_attr( $key ) . '" ' . selected( $background['position'], $key, false ) . '>'. esc_html( $position ) . '</option>';
				}
				$output .= '</select>';

				// Background Attachment
				$output .= '<select class="of-background of-background-attachment" name="' . esc_attr( $option_name . '[' . $value['id'] . '][attachment]' ) . '" id="' . esc_attr( $value['id'] . '_attachment' ) . '">';
				$attachments = of_recognized_background_attachment();

				foreach ($attachments as $key => $attachment) {
					$output .= '<option value="' . esc_attr( $key ) . '" ' . selected( $background['attachment'], $key, false ) . '>' . esc_html( $attachment ) . '</option>';
				}
				$output .= '</select>';
				$output .= '</div>';

				break;

			// export
			case 'export':
				$rows = '8';
				if ( isset( $value['settings']['rows'] ) ) {
					$custom_rows = $value['settings']['rows'];
					if ( is_numeric( $custom_rows ) ) {
						$rows = $custom_rows;
					}
				}
				$output .= '<textarea id="' . esc_attr( $value['id'] ) . '" class="of-input builder_select" name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" rows="' . $rows . '">' . esc_textarea($value['export']) . '</textarea>';
				break;
			
			// import
			case 'import':
				$rows = '8';
	
				$output .= '<textarea id="' . esc_attr( $value['id'] ) . '" class="of-input" name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" rows="' . $rows . '"></textarea>';
				break;
				
			// Editor
			case 'editor':
				//$output .= '<div class="explain">' . wp_kses( $explain_value, $allowedtags ) . '</div>'."\n";
				$output .= '<div class="vpanel_editor"></div>';
				echo $output;
				$textarea_name = esc_attr( $option_name . '[' . $value['id'] . ']' );
				$default_editor_settings = array(
					'textarea_name' => $textarea_name,
					'media_buttons' => "vpanel_editor",
					'tinymce' => array( 'plugins' => 'wordpress' )
				);
				$editor_settings = array();
				if ( isset( $value['settings'] ) ) {
					$editor_settings = $value['settings'];
				}
				$editor_settings = array_merge( $default_editor_settings, $editor_settings );
				wp_editor( $val, $value['id'], $editor_settings );
				$output = '';
				break;

			// Content
			case "content":
				if ( isset( $value['content'] ) ) {
					$output .= $value['content'] . "\n";
				}
				break;
			
			// Info
			case "info":
				$id = '';
				$class = 'section';
				if ( isset( $value['id'] ) ) {
					$id = 'id="' . esc_attr( $value['id'] ) . '" ';
				}
				if ( isset( $value['type'] ) ) {
					$class .= ' section-' . $value['type'];
				}
				if ( isset( $value['class'] ) ) {
					$class .= ' ' . $value['class'];
				}

				$output .= '<div ' . $id . 'class="' . esc_attr( $class ) . '">' . "\n";
				if ( isset($value['name']) ) {
					$output .= '<h4 class="heading">' . $value['name'] . '</h4>' . "\n";
				}
				if ( isset( $value['desc'] ) ) {
					$output .= apply_filters('of_sanitize_info', $value['desc'] ) . "\n";
				}
				$output .= '</div>' . "\n";
				break;

			// Heading for Navigation
			case "heading":
				$counter++;
				if ( $counter >= 2 ) {
					$output .= '</div>'."\n";
				}
				$class = '';
				$class = ! empty( $value['id'] ) ? $value['id'] : $value['name'];
				$class = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower($class) );
				$output .= '<div id="options-group-' . $counter . '" class="group ' . $class . '">';
				$output .= '<h3>' . esc_html( $value['name'] ) . '</h3>' . "\n";
				break;
			}

			if ( ( $value['type'] != "heading" ) && ( $value['type'] != "info" ) && ( $value['type'] != "content" ) ) {
				$output .= '</div>';
				if ( ( $value['type'] != "checkbox" ) && ( $value['type'] != "editor" ) ) {
					$output .= '<div class="explain vpanel_help"><div class="tooltip_s" original-title="' . wp_kses( $explain_value, $allowedtags) . '"><i class="dashicons dashicons-info"></i></div></div>'."\n";
				}
				$output .= '</div></div>'."\n";
			}

			echo $output;
		}

		// Outputs closing div if there tabs
		if ( Options_Framework_Interface::optionsframework_tabs() != '' ) {
			echo '</div>';
		}
	}

}