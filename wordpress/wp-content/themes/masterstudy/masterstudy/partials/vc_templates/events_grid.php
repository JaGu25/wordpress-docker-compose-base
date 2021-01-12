<?php
/**
 * @var $per_page
 * @var $css
 * @var $css_class
 */


$paged = get_query_var( 'paged', 1 );

$events = new WP_Query( array( 'post_type' => 'events', 'posts_per_page' => $per_page ,'paged' => $paged ) );

stm_module_styles('event_grid');

?>

<?php if($events->have_posts()): ?>
	<div class="row">
		<?php while($events->have_posts()): $events->the_post(); ?>
			<div class="col-md-3 col-sm-4 col-xs-6 teacher-col event-col">
				<?php $event_start = get_post_meta(get_the_id(), 'event_start', true); ?>
				<?php $event_location = get_post_meta(get_the_id(), 'event_location', true); ?>
				<div class="event_archive_item">
					<a href="<?php the_permalink() ?>" title="<?php esc_attr_e('View full', 'masterstudy'); ?>">
						<?php if(has_post_thumbnail()): ?>
							<div class="event_img">
								<?php the_post_thumbnail('img-270-153'); ?>
							</div>
						<?php endif; ?>
						<div class="h4 title"><?php the_title(); ?></div>
					</a>
					<?php if(!empty($event_start)): ?>
						<div class="event_start">
							<i class="far fa-clock"></i>
							<?php echo date_i18n( get_option( 'date_format' ), strtotime( $event_start ) ); ?>
						</div>
					<?php endif; ?>
					<?php if(!empty($event_location)): ?>
						<div class="event_location">
							<i class="fa fa-map-marker"></i>
							<?php echo esc_attr($event_location); ?>
						</div>
					<?php endif; ?>

					<div class="multiseparator"></div>
				</div>
			</div>
		<?php endwhile; ?>
	</div>

	<?php
		echo paginate_links( array(
			'type'      => 'list',
			'total' => $events->max_num_pages,
			'prev_text' => '<i class="fa fa-chevron-left"></i><span class="pagi_label">'.__('Previous', 'masterstudy').'</span>',
			'next_text' => '<span class="pagi_label">'.__('Next', 'masterstudy').'</span><i class="fa fa-chevron-right"></i>',
		) );
	?>

<?php endif; ?>
<?php wp_reset_postdata(); ?>
