<?php

$styles = '';
if (!empty($icon_bg)) {
    $styles = ".{$main_class} .stm_image_box__icon {
        background-color: {$icon_bg};
    }";
}
stm_module_styles('image_box', $style, array(), $styles);


$atts['image_size'] = (!empty($image_size)) ? $image_size : '290x250';

$style = $atts['style'] = (empty($style)) ? 'style_1' : $style;

?>

<div class="<?php echo esc_attr($align); ?>">
    <?php stm_load_vc_element('image_box', $atts, $style); ?>
</div>
