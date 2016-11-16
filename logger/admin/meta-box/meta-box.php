<?php
/*
Plugin Name: Meta Box
Plugin URI: http://www.deluxeblogtips.com/meta-box
Description: Create meta box for editing pages in WordPress. Compatible with custom post types since WP 3.0
Version: 4.3.8
Author: Rilwis
Author URI: http://www.deluxeblogtips.com
License: GPL2+
*/

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

// Script version, used to add version for scripts and styles
define( 'RWMB_VER', '4.3.8' );

// Define plugin URLs, for fast enqueuing scripts and styles
if ( ! defined( 'RWMB_URL' ) )
	define( 'RWMB_URL', get_template_directory_uri( __FILE__ ) );
define( 'RWMB_JS_URL', trailingslashit( RWMB_URL . '/admin/meta-box/js' ) );
define( 'RWMB_CSS_URL', trailingslashit( RWMB_URL . '/admin/meta-box/css' ) );

// Plugin paths, for including files
if ( ! defined( 'RWMB_DIR' ) )
	define( 'RWMB_DIR', get_template_directory( __FILE__ ) );
define( 'RWMB_INC_DIR', trailingslashit( RWMB_DIR . '/admin/meta-box/inc' ) );
define( 'RWMB_FIELDS_DIR', trailingslashit( RWMB_INC_DIR . 'fields' ) );

// Optimize code for loading plugin files ONLY on admin side
// @see http://www.deluxeblogtips.com/?p=345

// Helper function to retrieve meta value
require_once RWMB_INC_DIR . 'helpers.php';

if ( is_admin() )
{
	require_once RWMB_INC_DIR . 'common.php';
	require_once RWMB_INC_DIR . 'field.php';

	// Field classes
	foreach ( glob( RWMB_FIELDS_DIR . '*.php' ) as $file )
	{
		require_once $file;
	}

	// Main file
	require_once RWMB_INC_DIR . 'meta-box.php';
	require_once RWMB_INC_DIR . 'init.php';
}
