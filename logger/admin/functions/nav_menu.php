<?php register_nav_menus( array(
	'header_menu' => 'Header menu',
));
function vpanel_nav_fallback(){
	echo '<div class="menu-alert">'.__('You can use WP menu builder to build menus','vbegy').'</div>';
}