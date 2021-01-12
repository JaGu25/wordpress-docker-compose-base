<?php
if (!defined('ABSPATH')) {
    die('-1');
}

extract(shortcode_atts(array(), $atts));

/**
 * Shortcode attributes
 * @var $atts
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Cta
 */

$atts = vc_map_get_attributes($this->getShortcode(), $atts);
$this->buildTemplate($atts, $content);

$containerClass = trim('vc_cta3-container ' . esc_attr(implode(' ', $this->getTemplateVariable('container-class'))));
$cssClass = trim('vc_general ' . esc_attr(implode(' ', $this->getTemplateVariable('css-class'))));
$wrapper_attributes = array();
if (!empty($atts['el_id'])) {
    $wrapper_attributes[] = 'id="' . esc_attr($atts['el_id']) . '"';
}

$inline_css = ($this->getTemplateVariable('inline-css')) ? esc_attr(implode(' ', $this->getTemplateVariable('inline-css'))) : '';

$icons_top = $this->getTemplateVariable('icons-top');
$icons_left = $this->getTemplateVariable('icons-left');
$actions_top = $this->getTemplateVariable('actions-top');
$actions_left = $this->getTemplateVariable('actions-left');
$heading1 = $this->getTemplateVariable('heading1');
$heading2 = $this->getTemplateVariable('heading2');
$content = $this->getTemplateVariable('content');
$actions_bottom = $this->getTemplateVariable('actions-bottom');
$actions_right = $this->getTemplateVariable('actions-right');
$icons_bottom = $this->getTemplateVariable('icons-bottom');
$icons_right = $this->getTemplateVariable('icons-right');

?>

<section class="<?php echo esc_attr( $containerClass ); ?>" <?php echo implode( ' ', $wrapper_attributes ); ?>>
    <div class="<?php echo esc_attr( $cssClass ); echo ' style="' . masterstudy_filtered_output($inline_css) . '"'; ?>">
        <?php echo masterstudy_filtered_output($icons_top); ?>
        <?php echo masterstudy_filtered_output($icons_left); ?>
        <div class="vc_cta3_content-container">
            <?php echo masterstudy_filtered_output($actions_top); ?>
            <?php echo masterstudy_filtered_output($actions_left); ?>
            <div class="vc_cta3-content">
                <header class="vc_cta3-content-header">
                    <?php echo masterstudy_filtered_output($heading1); ?>
                    <?php echo masterstudy_filtered_output($heading2); ?>
                </header>
                <?php echo masterstudy_filtered_output($content); ?>
            </div>
            <?php echo masterstudy_filtered_output($actions_bottom); ?>
            <?php echo masterstudy_filtered_output($actions_right); ?>
        </div>
        <?php echo masterstudy_filtered_output($icons_bottom); ?>
        <?php echo masterstudy_filtered_output($icons_right); ?>
    </div>
</section>
