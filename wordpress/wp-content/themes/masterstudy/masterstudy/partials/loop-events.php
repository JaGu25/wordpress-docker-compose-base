<?php $event_start = get_post_meta(get_the_id(), 'event_start', true); ?>
<?php $event_location = get_post_meta(get_the_id(), 'event_location', true); ?>

<?php 
// Check if has sidebar, if true, enable other column grid
$blog_sidebar_position = stm_option( 'events_sidebar_position', 'none');
if( !empty( $_GET['sidebar_position'] ) and $_GET['sidebar_position'] == 'right'  ){
	$blog_sidebar_position = 'right';
} 
elseif( !empty( $_GET['sidebar_position'] ) and $_GET['sidebar_position'] == 'left'  ){
	$blog_sidebar_position = 'left';
} 
elseif( !empty( $_GET['sidebar_position'] ) and $_GET['sidebar_position'] == 'none'  ){
	$blog_sidebar_position = 'none';
} 

$cols_layout = 'col-md-3 col-sm-4 col-xs-6 teacher-col event-col';

if($blog_sidebar_position != 'none') {
	$cols_layout = 'col-md-4 col-sm-4 col-xs-6 teacher-col event-col event-col-small';
}

?>

<div class="<?php echo esc_attr($cols_layout); ?>">
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