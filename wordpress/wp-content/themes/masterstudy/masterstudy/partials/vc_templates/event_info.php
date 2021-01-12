<?php
/**
 * @var $css_class
 */

stm_module_styles('event_info');
?>

<div class="stm_event_unit_vc<?php echo esc_attr($css_class); ?>">
    <div class="stm_post_info">
		<h1 class="h2 event_title"><?php the_title(); ?></h1>
		<?php if( has_post_thumbnail() ){ ?>
			<?php $image_size = 'img-1170-500'; ?>
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

							<?php if(!empty($event_start)): ?>
								<div class="event_date_info_unit event_start">
									<div class="event_labels heading_font"><i class="far fa-clock"></i><?php _e('Start:', 'masterstudy') ?></div>
									<?php echo date_i18n( get_option( 'date_format' ), strtotime( $event_start ) );?>
								</div>
							<?php endif; ?>

							<?php if(!empty($event_end)): ?>
								<div class="event_date_info_unit event_end">
									<div class="event_labels heading_font"><?php _e('End:', 'masterstudy') ?></div>
									<?php echo date_i18n( get_option( 'date_format' ), strtotime( $event_end ) );?>
								</div>
							<?php endif; ?>

							<?php if(!empty($event_location)): ?>
								<div class="event_date_info_unit event_location">
									<div class="event_labels heading_font"><i class="fa fa-map-marker"></i><?php _e('Location:', 'masterstudy') ?></div>
									<?php echo esc_attr($event_location); ?>
								</div>
							<?php endif; ?>

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
</div> <!-- stm_post_unit -->
