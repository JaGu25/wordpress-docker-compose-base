<?php
/**
 * @var $h2
 * @var $h2_font_container
 * @var $h2_font_container_tag
 * @var $h2_link
 * @var $h2_el_id
 * @var $h2_el_class
 * @var $title_font
 * @var $h4_font_container_tag
 * @var $h4_link
 * @var $h4_el_id
 * @var $h4_el_class
 * @var $subtitle_font
 * @var $txt_align
 * @var $custom_text
 * @var $el_id
 * @var $el_class
 *
 * Button
 *
 * @var $add_button
 * @var $btn_title
 * @var $btn_link
 * @var $btn_align
 * @var $btn_button_block
 * @var $btn_i_icon
 * @var $btn_i_align
 * @var $btn_el_id
 * @var $btn_el_class
 */

$uniq_class = 'ce_cta_' . md5(json_encode(get_defined_vars()));

$style = '';

if (!empty($title_font)) $style .= ".{$uniq_class} .ce_cta__content__title, .{$uniq_class} .ce_cta__content__title a {" . implode('', $title_font) . "} ";
if (!empty($subtitle_font)) $style .= ".{$uniq_class} .ce_cta__content__subtitle, .{$uniq_class} .ce_cta__content__subtitle a {" . implode('', $subtitle_font) . "} ";

wp_enqueue_style('cew_cta', get_template_directory_uri() . '/assets/css/global_styles/el_tta.css', array(), time());
wp_add_inline_style('cew_cta', $style);

$subtitle_data = $title_data = '';
if (!empty($h2_el_id)) $title_data .= " id='{$h2_el_id}'";
if (!empty($h4_el_id)) $subtitle_data .= " id='{$h4_el_id}'";

if ($h2 && !empty($h2_link) && !empty($h2_link['url'])) {
    $target = (!empty($h2_link['is_external'])) ? '_blank' : '_self';
    $h2 = "<a href='{$h2_link['url']}' target='{$target}'>{$h2}</a>";
}

if (!empty($h4) && !empty($h4_link) && !empty($h4_link['url'])) {
    $target = (!empty($h4_link['is_external'])) ? '_blank' : '_self';
    $h4 = "<a href='{$h4_link['url']}' target='{$target}'>{$h4}</a>";
}


$uniq_class .= " ce_text_{$txt_align} {$el_class} add_button_{$add_button} btn_align_{$btn_align} btn_button_block_{$btn_button_block}";

if(!empty($btn_i_icon) && !empty($btn_i_icon['value'])) {
    $uniq_class .= " btn_has_icon btn_has_icon_on_the_{$btn_i_align}";
}

if(!empty($particles) and $particles === 'yes') $uniq_class .= ' has-particles';

?>

<div class="ce_cta <?php echo esc_attr($uniq_class); ?>" id="<?php echo esc_attr($el_id); ?>">

    <div class="ce_cta__content">
        <div class="ce_cta__content__header">
            <?php if (!empty($h2)):
                echo masterstudy_filtered_output("<h2 {$title_data} class='ce_cta__content__title {$h2_el_class}'>{$h2}</h2>");
            endif; ?>
            <?php if (!empty($h4)):
                echo masterstudy_filtered_output("<h4 {$subtitle_data} class='ce_cta__content__subtitle {$h4_el_class}'>{$h4}</h4>");
            endif; ?>
        </div>

        <?php if (!empty($content)): ?>
            <div class="ce_cta__content__text">
                <?php echo masterstudy_filtered_output(wpautop($content)); ?>
            </div>
        <?php endif; ?>

    </div>

    <?php if ($add_button && $btn_title): ?>

        <div class="ce_cta__action">
            <a href="<?php echo (!empty($btn_link['url'])) ? $btn_link['url'] : '#' ?>"
               <?php if(!empty($btn_el_id)): ?> id="<?php echo esc_attr($btn_el_id); ?>" <?php endif; ?>
               target="<?php echo (!empty($btn_link['is_external'])) ? '_blank' : '_self'; ?>"
               class="button <?php if(!empty($btn_el_class)) echo esc_attr($btn_el_class); ?>">
                <span><?php echo masterstudy_filtered_output($btn_title); ?></span>
                <?php if (!empty($btn_i_icon) && !empty($btn_i_icon['value'])): ?>
                    <i class="<?php echo esc_attr($btn_i_icon['value']); ?>"></i>
                <?php endif; ?>
            </a>
        </div>

    <?php endif; ?>

</div>
