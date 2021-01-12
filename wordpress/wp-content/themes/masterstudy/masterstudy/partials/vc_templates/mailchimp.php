<?php
/**
 * @var $title
 * @var $title_color
 * @var $button_color
 * @var $css_class
 * @var $uniq_class
 */

$css_class .= ' ' . $uniq_class;

$inline_styles = '';

if(!empty($button_color)) {
	$inline_styles = '.stm_subscribe.' . $uniq_class . ' .widget_mailchimp .button {
	    background-color: ' . $button_color . '!important
	}';
}

stm_module_styles('mailchimp', 'style_1', array(), $inline_styles);


// Mailchimp widget settings
$widget = 'Stm_Mailchimp_Widget';
$instance = array(
	'title' => $title,
);

$args = array();
if(!empty($title_color)) $args['title_color'] = $title_color;
?>

	<div class="stm_subscribe <?php echo esc_attr($css_class); ?>">
		<?php the_widget( $widget, $instance, $args ); ?>
	</div> <!-- stm_subscribe -->
