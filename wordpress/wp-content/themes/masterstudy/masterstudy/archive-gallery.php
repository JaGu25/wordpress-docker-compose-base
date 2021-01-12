<?php get_header();?>

	
	<?php
	
	// Sidebar Gallery
	$blog_sidebar_id = stm_option( 'gallery_sidebar' );
	$blog_sidebar_position = stm_option( 'gallery_sidebar_position', 'none');
	$content_before = $content_after =  $sidebar_before = $sidebar_after = '';

	
	if( !empty( $_GET['sidebar_position'] ) and $_GET['sidebar_position'] == 'right'  ){
		$blog_sidebar_position = 'right';
	} 
	elseif( !empty( $_GET['sidebar_position'] ) and $_GET['sidebar_position'] == 'left'  ){
		$blog_sidebar_position = 'left';
	} 
	elseif( !empty( $_GET['sidebar_position'] ) and $_GET['sidebar_position'] == 'none'  ){
		$blog_sidebar_position = 'none';
	}
	
	if( $blog_sidebar_id ) {
		$blog_sidebar = get_post( $blog_sidebar_id );
	}
	

	if( $blog_sidebar_position == 'right' && isset( $blog_sidebar ) ) {
		$content_before .= '<div class="row">';
		$content_before .= '<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">';

		$content_after .= '</div>'; // col
		$sidebar_before .= '<div class="col-lg-3 col-md-3 hidden-sm hidden-xs">';
		// .sidebar-area
		$sidebar_after .= '</div>'; // col
		$sidebar_after .= '</div>'; // row
	}

	if( $blog_sidebar_position == 'left' && isset( $blog_sidebar ) ) {
		$content_before .= '<div class="row">';
		$content_before .= '<div class="col-lg-9 col-lg-push-3 col-md-9 col-md-push-3 col-sm-12 col-xs-12">';

		$content_after .= '</div>'; // col
		$sidebar_before .= '<div class="col-lg-3 col-lg-pull-9 col-md-3 col-md-pull-9 hidden-sm hidden-xs">';
		// .sidebar-area
		$sidebar_after .= '</div>'; // col
		$sidebar_after .= '</div>'; // row
	}
	
	?>
	<!-- Title -->
	<?php get_template_part( 'partials/title_box' ); ?>
	<div class="container">
	    <?php if ( have_posts() ): ?>
	    	<?php echo wp_kses_post($content_before); ?>
			    <div class="<?php echo esc_attr('sidebar_position_'.$blog_sidebar_position); ?>">
				    
				    <div class="row gallery_entry_unit">
						<div class="col-md-4 col-sm-3"><h2 class="archive_title_gallery"><?php esc_html_e('Gallery', 'masterstudy'); ?></h2></div>
						<?php $category_name = 'gallery_category'; ?>
						<?php $args = array( 
							'order' => 'ASC'
						); ?>	
						<?php $terms = get_terms($category_name , $args); ?>
						<?php if(!empty($terms)): ?>
							<div class="col-md-8 col-sm-9">
								<ul class="gallery_terms_list heading_font xs-text-left">
									<li class="active all">
										<a href="#" data-filter=".all"><?php esc_html_e('All images', 'masterstudy'); ?></a>
									</li>
									<?php foreach ($terms as $term): ?>
										<li>
											<a href="#" data-filter=".<?php echo esc_attr($term->slug); ?>">
                                                <?php echo sanitize_text_field($term->name); ?>
                                            </a>
										</li>
									<?php endforeach; ?>
								</ul>
							</div>
						<?php endif; ?>
					</div>
					
					<div class="wait-for-images">
						<div id="stm_isotope" class="row">
					        <?php while ( have_posts() ): the_post();
								get_template_part('partials/loop','gallery');
					        endwhile; ?>
						</div>
					</div>
					
					<div class="multiseparator gallery_sep"></div>
					<?php
						echo paginate_links( array(
							'type'      => 'list',
							'prev_text' => '<i class="fa fa-chevron-left"></i><span class="pagi_label">'.__('Previous', 'masterstudy').'</span>',
							'next_text' => '<span class="pagi_label">'.__('Next', 'masterstudy').'</span><i class="fa fa-chevron-right"></i>',
						) );
					?>
			        
			    </div> <!-- blog_layout -->
			<?php echo wp_kses_post($content_after); ?>
			<?php echo wp_kses_post($sidebar_before); ?>
				<div class="sidebar-area sidebar-area-<?php echo esc_attr($blog_sidebar_position); ?>">
					<?php
						if( isset( $blog_sidebar ) && $blog_sidebar_position != 'none' ) {
							echo apply_filters( 'the_content' , $blog_sidebar->post_content);
						}
					?>
				</div>
			<?php echo wp_kses_post($sidebar_after); ?>
		        
	    <?php endif; ?>
	</div>

<?php get_footer();?>