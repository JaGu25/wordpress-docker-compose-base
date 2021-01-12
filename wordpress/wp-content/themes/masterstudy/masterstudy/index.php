<?php get_header(); ?>
<?php
// Blog setup
$blog_layout = stm_option('blog_layout');
// Sidebar Blog
$blog_sidebar_id = stm_option('blog_sidebar');
$blog_sidebar_position = stm_option('blog_sidebar_position', 'none');
$content_before = $content_after = $sidebar_before = $sidebar_after = '';
// Teacher Sidebar
if (get_post_type() == 'teachers') {
	$blog_sidebar_id = stm_option('teachers_sidebar');
	$blog_sidebar_position = stm_option('teachers_sidebar_position', 'none');
}

if (!empty($_GET['sidebar_id'])) {
	$blog_sidebar_id = intval($_GET['sidebar_id']);
}

if (!empty($_GET['sidebar_position']) and $_GET['sidebar_position'] == 'right') {
	$blog_sidebar_position = 'right';
} elseif (!empty($_GET['sidebar_position']) and $_GET['sidebar_position'] == 'left') {
	$blog_sidebar_position = 'left';
} elseif (!empty($_GET['sidebar_position']) and $_GET['sidebar_position'] == 'none') {
	$blog_sidebar_position = 'none';
}

if (!empty($_GET['layout']) and $_GET['layout'] == 'grid') {
	$blog_layout = 'grid';
}

if ($blog_sidebar_id) {
	$blog_sidebar = get_post($blog_sidebar_id);
} else {
    if ($blog_sidebar_position !== 'none' and is_active_sidebar('default') and get_post_type() == 'post' or is_search()) {
        $blog_sidebar = 'widget_area';
        //$blog_sidebar_position = 'right';
    }
}
if (empty($blog_sidebar)) {
    $blog_sidebar_position = 'none';
}


if ($blog_sidebar_position == 'right' && !empty($blog_sidebar)) {
	$content_before .= '<div class="row">';
	$content_before .= '<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">';

	$content_after .= '</div>'; // col
	$sidebar_before .= '<div class="col-lg-3 col-md-3 hidden-sm hidden-xs">';
	// .sidebar-area
	$sidebar_after .= '</div>'; // col
	$sidebar_after .= '</div>'; // row
}

if ($blog_sidebar_position == 'left' && !empty($blog_sidebar)) {
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
<?php get_template_part('partials/title_box'); ?>
    <div class="container blog_main_layout_<?php echo esc_attr($blog_layout); ?>">
		<?php if (have_posts()): ?>
			<?php echo wp_kses_post($content_before); ?>
            <div class="blog_layout_<?php echo esc_attr($blog_layout . ' sidebar_position_' . $blog_sidebar_position); ?>">

                <div class="row">
					<?php while (have_posts()): the_post(); ?>
						<?php if (get_post_type() == 'teachers') {
							get_template_part('partials/loop', 'teacher');
						} else {
							if ($blog_layout == 'grid') {
								get_template_part('partials/loop', 'grid');
							} else {
								get_template_part('partials/loop', 'list');
							}
						} ?>
					<?php endwhile; ?>
                </div>

				<?php
				echo paginate_links(array(
					'type'      => 'list',
					'prev_text' => '<i class="fa fa-chevron-left"></i><span class="pagi_label">' . __('Previous', 'masterstudy') . '</span>',
					'next_text' => '<span class="pagi_label">' . __('Next', 'masterstudy') . '</span><i class="fa fa-chevron-right"></i>',
				));
				?>

            </div> <!-- blog_layout -->
			<?php echo wp_kses_post($content_after); ?>
			<?php echo wp_kses_post($sidebar_before); ?>
            <div class="sidebar-area sidebar-area-<?php echo esc_attr($blog_sidebar_position); ?>">
				<?php
				if (isset($blog_sidebar) && $blog_sidebar_position != 'none') {
					if ($blog_sidebar == 'widget_area') {
						dynamic_sidebar('default');
					} else {
						echo apply_filters('the_content', $blog_sidebar->post_content);
					}
				}
				?>
            </div>
			<?php echo wp_kses_post($sidebar_after); ?>
		<?php else: ?>
            <div class="no-results">
                <h3><?php esc_html_e('No result has been found. Please check for correctness.', 'masterstudy'); ?></h3>
                <div class="widget_search">
					<?php echo get_search_form(); ?>
                </div>
            </div>
		<?php endif; ?>
    </div>

<?php get_footer(); ?>