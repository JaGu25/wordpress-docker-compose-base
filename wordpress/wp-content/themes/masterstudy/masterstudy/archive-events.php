<?php get_header();?>

	
	<?php
	
	// Sidebar Gallery
	$blog_sidebar_id = stm_option( 'events_sidebar' );
	$blog_sidebar_position = stm_option( 'events_sidebar_position', 'none');
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
					
					<div class="row">
				        <?php while ( have_posts() ): the_post();
							get_template_part('partials/loop','events');
				        endwhile; ?>
					</div>
					
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