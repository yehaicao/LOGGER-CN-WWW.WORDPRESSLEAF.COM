<?php /* Template Name: Portfolio */
get_header();
	$vbegy_portfolio_columns = rwmb_meta("vbegy_portfolio_columns","select",$post->ID);
	$vbegy_portfolio_type = rwmb_meta("vbegy_portfolio_type","select",$post->ID);
	$vbegy_portfolio_margin = rwmb_meta("vbegy_portfolio_margin","select",$post->ID);
	$vbegy_portfolio_display = rwmb_meta("vbegy_portfolio_display","select",$post->ID);
	$vbegy_portfolio_options = rwmb_meta("vbegy_portfolio_options","select",$post->ID);
	$vbegy_items_per_page = rwmb_meta("vbegy_items_per_page","text",$post->ID);
	$vbegy_sidebar = rwmb_meta('vbegy_sidebar','select',$post->ID);
	$vbegy_single_category = rwmb_meta('vbegy_single_category','select',$post->ID);
	$vbegy_multiple_categories = get_post_meta($post->ID,'vbegy_multiple_categories');
	
	if ($vbegy_sidebar == "full") {
		if (isset($vbegy_portfolio_columns) && $vbegy_portfolio_columns == "2_columns") {
			$portfolio_columns = "col-md-6";
			if (isset($vbegy_portfolio_margin) && $vbegy_portfolio_margin == "yes") {
				$portfolio_width = 555;
				$portfolio_height = 370;
			}else {
				$portfolio_width = 570;
				$portfolio_height = 380;
			}
		}else if (isset($vbegy_portfolio_columns) && $vbegy_portfolio_columns == "4_columns") {
			$portfolio_columns = "col-md-3";
			if (isset($vbegy_portfolio_margin) && $vbegy_portfolio_margin == "yes") {
				$portfolio_width = 265;
				$portfolio_height = 175;
			}else {
				$portfolio_width = 285;
				$portfolio_height = 189;
			}
		}else {
			$portfolio_columns = "col-md-4";
			if (isset($vbegy_portfolio_margin) && $vbegy_portfolio_margin == "yes") {
				$portfolio_width = 360;
				$portfolio_height = 275;
			}else {
				$portfolio_width = 380;
				$portfolio_height = 255;
			}
		}
	}else {
		if (isset($vbegy_portfolio_columns) && $vbegy_portfolio_columns == "2_columns") {
			$portfolio_columns = "col-md-6";
			if (isset($vbegy_portfolio_margin) && $vbegy_portfolio_margin == "yes") {
				$portfolio_width = 360;
				$portfolio_height = 201;
			}else {
				$portfolio_width = 371;
				$portfolio_height = 206;
			}
		}else if (isset($vbegy_portfolio_columns) && $vbegy_portfolio_columns == "4_columns") {
			$portfolio_columns = "col-md-3";
			if (isset($vbegy_portfolio_margin) && $vbegy_portfolio_margin == "yes") {
				$portfolio_width = 165;
				$portfolio_height = 144;
			}else {
				$portfolio_width = 184;
				$portfolio_height = 121;
			}
		}else {
			$portfolio_columns = "col-md-4";
			if (isset($vbegy_portfolio_margin) && $vbegy_portfolio_margin == "yes") {
				$portfolio_width = 230;
				$portfolio_height = 176;
			}else {
				$portfolio_width = 246;
				$portfolio_height = 166;
			}
		}
	}
	$taxonomy = 'portfolio-category';
	if (isset($vbegy_portfolio_options) && ($vbegy_portfolio_options == "filter" || $vbegy_portfolio_options == "filter_pagination") && ($vbegy_portfolio_display == "lasts" || $vbegy_portfolio_display == "multiple_categories")) {?>
		<div class="row">
			<div class="col-md-12 portfolio-filter">
				<ul>
					<li class="current"><a href="#" data-filter="*"><?php _e('All', 'vbegy'); ?></a></li>
					<?php
					$args = array();
					if (isset($vbegy_portfolio_display) && $vbegy_portfolio_display == "multiple_categories") {
						$args = array("include" => $vbegy_multiple_categories);
					}
					$portfolio_filter = get_terms($taxonomy,$args);
					$count = count($portfolio_filter);
					if ($count > 0) {
						foreach ($portfolio_filter as $portfolio_filter_item) {
							echo '<li><a href="#" data-filter=".term-'.$portfolio_filter_item->term_id.'">'.$portfolio_filter_item->name.'</a></li>';
						}
					}
					?>
				</ul>
			</div>
		</div><!-- End row -->
	<?php }
	$post_excerpt = 10;
	$post_excerpt = (isset($post_excerpt) && $post_excerpt != "" && (int)$post_excerpt?$post_excerpt:10);
	
	$paged = (get_query_var("paged") != ""?(int)get_query_var("paged"):(get_query_var("page") != ""?(int)get_query_var("page"):1));
	if ($vbegy_portfolio_display == "single_category") {
		$args = array("post_type" => "portfolio","paged" => $paged,"posts_per_page" => (isset($vbegy_items_per_page) && $vbegy_items_per_page != ""?$vbegy_items_per_page:8),'tax_query' => array(array('taxonomy' => $taxonomy,'field' => 'id','terms' => $vbegy_single_category)));
	}else if ($vbegy_portfolio_display == "multiple_categories") {
		$args = array("post_type" => "portfolio","paged" => $paged,"posts_per_page" => (isset($vbegy_items_per_page) && $vbegy_items_per_page != ""?$vbegy_items_per_page:8),'tax_query' => array(array('taxonomy' => $taxonomy,'field' => 'id','terms' => $vbegy_multiple_categories)));
	}else {
		$args = array("post_type" => "portfolio","paged" => $paged,"posts_per_page" => (isset($vbegy_items_per_page) && $vbegy_items_per_page != ""?$vbegy_items_per_page:8));
	}
	query_posts($args);
	if (have_posts()) :?>
		<div class="row portfolio-all <?php echo (isset($vbegy_portfolio_margin) && $vbegy_portfolio_margin == "yes"?"":"portfolio-no-margin")?> portfolio-0">
			<ul>
				<?php while ( have_posts() ) : the_post();
					$terms = get_the_terms( $post->ID, $taxonomy);
					$portfolio_category = wp_get_post_terms($post->ID,$taxonomy,array("fields" => "all"));
					$vbegy_what_post = rwmb_meta('vbegy_what_post','select',$post->ID);?>
					<li class="<?php echo esc_attr($portfolio_columns)?> col-sm-6 <?php if (isset($terms) && is_array($terms)) {foreach ($terms as $term ) {echo 'term-'.$term->term_id.' ';}}?> portfolio-item <?php echo (isset($vbegy_portfolio_type) && $vbegy_portfolio_type == "style_2"?"portfolio-item-2":"")?> isotope-portfolio-item">
						<div class="portfolio-one">
							<div class="portfolio-head">
								<div class="portfolio-img">
									<?php if (has_post_thumbnail()) {
										echo get_aq_resize_img('full',$portfolio_width,$portfolio_height,$img_lightbox = "lightbox");
									}?>
								</div>
								<?php if (isset($vbegy_portfolio_type) && $vbegy_portfolio_type == "style_2") {?>
									<div class="portfolio-hover">
										<div class="portfolio-meta">
											<div class="portfolio-name"><h6><a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title()?></a></h6></div>
											<div class="portfolio-desc"><p><?php excerpt($post_excerpt)?></p></div>
										</div><!-- End portfolio-meta -->
									</div>
								<?php }?>
							</div><!-- End portfolio-head -->
							<?php if (isset($vbegy_portfolio_type) && $vbegy_portfolio_type == "style_1") {?>
								<div class="portfolio-content">
									<div class="portfolio-meta">
										<div class="portfolio-name"><h6><a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title()?></a></h6></div>
										<?php if (isset($portfolio_category[0])) {?>
											<div class="portfolio-cat"><?php echo get_the_term_list( $post->ID, $taxonomy, '', ', ', '' )?></div>
										<?php }?>
									</div><!-- End portfolio-meta -->
								</div><!-- End portfolio-content -->
							<?php }?>
						</div><!-- End portfolio-item -->
					</li>
				<?php endwhile;?>
			</ul>
		</div><!-- End portfolio-0 -->
	<?php else:
		
	endif;
	
	if (isset($vbegy_portfolio_options) && ($vbegy_portfolio_options == "pagination" || $vbegy_portfolio_options == "filter_pagination")) {
		vpanel_pagination();
	}
	wp_reset_postdata();
get_footer();?>