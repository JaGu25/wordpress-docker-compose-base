<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 * @var $height
 * @var $el_class
 * @var $el_id
 * @var $uniq
 * @var $css
 */


if($laptop_height !== ''): ?>
    <style type="text/css">
        @media (max-width: 1440px) {
            .<?php echo esc_attr($uniq) ?> {
                height : <?php echo esc_attr($laptop_height); ?>px !important;
            }
        }
    </style>
<?php endif;

if($tablet_height !== ''): ?>
    <style type="text/css">
        @media (max-width: 1024px) {
            .<?php echo esc_attr($uniq) ?> {
                height : <?php echo esc_attr($tablet_height); ?>px !important;
            }
        }
    </style>
<?php endif;

if($mobile_height !== ''): ?>
    <style type="text/css">
        @media (max-width: 768px) {
            .<?php echo esc_attr($uniq) ?> {
                height : <?php echo esc_attr($mobile_height); ?>px !important;
            }
        }
    </style>
<?php endif; ?>

<div class="<?php echo esc_attr( trim( $css_class ) ); ?>"
    <?php echo implode( ' ', $wrapper_attributes ); ?>
    <?php echo stm_echo_safe_output($inline_css); ?> >
    <span class="vc_empty_space_inner"></span>
</div>
