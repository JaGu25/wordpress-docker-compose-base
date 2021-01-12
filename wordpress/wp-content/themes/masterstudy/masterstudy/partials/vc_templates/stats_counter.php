<?php
/**
 * @var $title
 * @var $counter_value
 * @var $duration
 * @var $icon
 * @var $icon_size
 * @var $icon_height
 * @var $icon_text_alignment
 * @var $icon_text_color
 * @var $counter_text_color
 * @var $text_font_size
 * @var $counter_text_font_size
 * @var $border
 * @var $css
 * @var $css_class
 */

stm_module_styles('stats_counter');

if( ! wp_is_mobile() ){
	wp_enqueue_script( 'countUp.min.js' );
	stm_module_scripts('stats_counter');
}

$icon = (isset($icon) && !empty(trim($icon))) ? $icon : '';
$styles = array("color:" . esc_attr($counter_text_color));
if(!empty($text_font_size)) $styles[] = "font-size: {$text_font_size}px; line-height: {$text_font_size}px; margin-bottom: 20px;";
$style = "style='" . implode(';', $styles) . "'";

$counter_styles = array("color:" . esc_attr($icon_text_color));
if(!empty($counter_text_font_size)) $counter_styles[] = "font-size: {$counter_text_font_size}px; line-height: {$counter_text_font_size}px";
$counter_style = "style='" . implode(';', $counter_styles) . "'";

if(!empty($border)) $css_class .= ' with_border_' . $border;
?>

<div class="stats_counter<?php echo esc_attr( $css_class ); ?> text-<?php echo esc_attr($icon_text_alignment); ?>"
     style="color:<?php echo esc_attr($icon_text_color); ?>"
     data-id="<?php echo esc_attr($id); ?>"
     data-value="<?php echo esc_attr($counter_value); ?>"
     data-duration="<?php echo esc_attr($duration); ?>">
	<?php if( $icon ){ ?>
		<div class="icon" style="height: <?php echo esc_attr( $icon_height ); ?>px;"><i style="font-size: <?php echo esc_attr( $icon_size ); ?>px;" class="fa <?php echo esc_attr( $icon ); ?>"></i></div>
	<?php } ?>
	<?php if( wp_is_mobile() ){ ?>
		<div class="h1" id="<?php echo esc_attr( $id ); ?>" <?php echo sanitize_text_field($style); ?>>
            <?php echo esc_attr( $counter_value ); ?>
        </div>
	<?php }else{ ?>
		<div class="h1" id="<?php echo esc_attr( $id ); ?>" <?php echo sanitize_text_field($style); ?>></div>
	<?php } ?>
	<?php if ( $title ) { ?>
		<div class="stats_counter_title h5" <?php echo sanitize_text_field($counter_style); ?>>
            <?php echo sanitize_text_field( $title ); ?>
        </div>
	<?php } ?>
</div>
