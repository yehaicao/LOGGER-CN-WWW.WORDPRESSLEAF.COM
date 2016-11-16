<?php global $page_tamplate,$post_pagination;
if ($page_tamplate != true) {
	$post_pagination = vpanel_options("post_pagination");
}
if ($post_pagination != "none") {
	if ($post_pagination == "pagination") {
		vpanel_pagination();
	}else {?>
		<div class="page-navigation page-navigation-before clearfix row">
			<div class="col-md-6 col-sm-6">
				<div class="nav-next"><?php next_posts_link('<i class="fa fa-angle-double-left"></i><span>'.__('Old Entries','vbegy').'</span>')?></div>
			</div>
			<div class="col-md-6 col-sm-6">
				<div class="nav-previous"><?php previous_posts_link('<span>'.__('New Entries','vbegy').'</span><i class="fa fa-angle-double-right"></i>')?></div>
			</div>
		</div>
	<?php }
}