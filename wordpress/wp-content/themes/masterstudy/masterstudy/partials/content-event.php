<?php $vc_status = get_post_meta( get_the_ID() , '_wpb_vc_js_status', true); ?>
<?php $elementor_data = get_post_meta(get_the_ID(), '_elementor_data', true); ?>
<?php $elementor_status = (get_post_type() == 'events') ? true : false; ?>

<?php if (($vc_status != 'false' && $vc_status == true) || !empty($elementor_data) || $elementor_status){ ?>
	<?php get_template_part( 'partials/title_box' ); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	    <div class="container">
	        <?php the_content(); ?>
	        <?php
	        wp_link_pages( array(
	            'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'masterstudy' ) . '</span>',
	            'after'       => '</div>',
	            'link_before' => '<span>',
	            'link_after'  => '</span>',
	            'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'masterstudy' ) . ' </span>%',
	            'separator'   => '<span class="screen-reader-text">, </span>',
	        ) );
	        ?>
	    </div>

	</article>
<?php }else{ ?>
	<?php
	// Blog setup
	$blog_layout = stm_option('events_layout');

	// Sidebar
	$blog_sidebar_id = stm_option( 'events_sidebar' );
	$blog_sidebar_position = stm_option( 'events_sidebar_position', 'none');
	$content_before = $content_after =  $sidebar_before = $sidebar_after = '';

	if( !empty( $_GET['sidebar_id'] ) ){
		$blog_sidebar_id = intval( $_GET['sidebar_id'] );
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
	<div class="container blog_main_layout_<?php echo esc_attr($blog_layout); ?>">

    	<?php echo wp_kses_post($content_before); ?>
    		<div class="blog_layout_list sidebar_position_<?php echo esc_attr($blog_sidebar_position); ?>">
	    		<div class="stm_post_unit">
				    <div class="stm_post_info">
						<h1 class="h2 event_title"><?php the_title(); ?></h1>
						<?php if( has_post_thumbnail() ){ ?>
							<?php if( !isset( $blog_sidebar ) && $blog_sidebar_position == 'none' ) {
								$image_size = 'img-1170-500';
							} else {
								$image_size = 'img-840-430';
							}; ?>
							<div class="event_thumbnail">
								<?php the_post_thumbnail($image_size, array('class'=>'img-responsive')); ?>
							</div>
						<?php } ?>
						<?php
							$event_start = get_post_meta(get_the_id(), 'event_start', true);
							$event_end = get_post_meta(get_the_id(), 'event_end', true);
							$event_location = get_post_meta(get_the_id(), 'event_location', true);
						?>
						<?php if(!empty($event_start) or !empty($event_end) or !empty($event_location)): ?>
							<table class="event_date_info_table">
								<tr>
									<td class="event_info">
										<div class="event_date_info">
											<div class="event_date_info_unit event_start">
												<div class="event_labels heading_font"><i class="far fa-clock"></i><?php _e('Start:', 'masterstudy') ?></div>
												<?php echo date_i18n( get_option( 'date_format' ), strtotime( $event_start ) );?>
											<div class="event_date_info_unit event_end">
												<div class="event_labels heading_font"><?php _e('End:', 'masterstudy') ?></div>
												<?php echo date_i18n( get_option( 'date_format' ), strtotime( $event_end ) );?>
											</div>
											<div class="event_date_info_unit event_location">
												<div class="event_labels heading_font"><i class="fa fa-map-marker"></i><?php _e('Location:', 'masterstudy') ?></div>
												<?php echo esc_attr($event_location); ?>
											</div>
										</div>
									</td>
									<td class="event_btn">
										<div class="event_action_button">
											<a href="#event_form" data-toggle="modal" class="btn btn-default"><?php _e('Join!', 'masterstudy'); ?></a>
										</div>
									</td>
								</tr>
							</table>
						<?php endif; ?>
					</div>
					<?php if( get_the_content() ){ ?>
						<div class="text_block clearfix">
							<?php the_content(); ?>
						</div>
					<?php } ?>
	    		</div> <!-- stm_post_unit -->

				<?php
			        wp_link_pages( array(
			            'before'      => '<div class="page-links"><label>' . __( 'Pages:', 'masterstudy' ) . '</label>',
			            'after'       => '</div>',
			            'link_before' => '<span>',
			            'link_after'  => '</span>',
			            'pagelink'    => '%',
			            'separator'   => '',
			        ) );
		        ?>

		        <div class="row mg-bt-10">
			        <div class="col-md-8 col-sm-8 col-xs-12">
				        <div class="stm_post_tags widget_tag_cloud">
							<?php if( $tags = wp_get_post_tags( get_the_ID() ) ){ ?>
								<div class="tagcloud">
									<?php foreach( $tags as $tag ){ ?>
										<a href="<?php echo get_tag_link( $tag ); ?>"><?php echo sanitize_text_field( $tag->name ); ?></a>
									<?php } ?>
								</div>
							<?php } ?>
						</div>
			        </div>
			        <div class="col-md-4 col-sm-4 col-xs-12">
						<div class="pull-right xs-pull-left">
							<?php if(function_exists('stm_configurations_share')) stm_configurations_share(); ?>
						</div>
			        </div>
		        </div> <!-- row -->

		        <?php if ( comments_open() || get_comments_number() ) { ?>
    		        <div class="multiseparator"></div>
					<div class="stm_post_comments">
						<?php comments_template(); ?>
					</div>
				<?php } ?>
	    	</div>
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

	</div>
<?php } ?>
