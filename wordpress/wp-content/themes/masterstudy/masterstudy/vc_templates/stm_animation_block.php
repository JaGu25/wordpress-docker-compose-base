<?php $atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);
wp_enqueue_style('aos.css');
stm_module_scripts('aos', 'style_1', array('aos.js', 'jquery'));

$duration = (!empty(intval($duration))) ? $duration : 300;
$delay = (!empty(intval($delay))) ? $delay : 0;

// masterstudy_show_template('stm_animation_block', $atts);
?>

<div data-aos="<?php echo esc_attr($type); ?>"
     data-aos-once="true"
     data-aos-duration="<?php echo intval($duration); ?>"
     data-aos-delay="<?php echo intval($delay); ?>">
    <?php echo wpb_js_remove_wpautop($content); ?>
</div>
