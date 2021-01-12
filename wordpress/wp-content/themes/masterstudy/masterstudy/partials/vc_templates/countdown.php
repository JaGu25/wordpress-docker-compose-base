<?php
/**
 * @var $datepicker
 * @var $label_color
 * @var $css
 * @var $css_class
 */

$countdown = rand(0, 999999);

wp_enqueue_script('jquery.countdown');
stm_module_styles('countdown');
?>
    <div class="text-center <?php echo esc_attr($css_class); ?>">
        <div class="stm_countdown" id="countdown_<?php echo esc_attr($countdown); ?>"></div>
    </div>

<?php if (!empty($datepicker)): ?>
    <script>
        jQuery(function ($) {
            var flash = false;
            var ts = <?php echo strtotime($datepicker) * 1000; ?>;
            var timeUp = '<?php echo __('Time is up, sorry!', 'masterstudy'); ?>';
            if ((new Date()) < ts) {
                $('#countdown_<?php echo esc_attr($countdown); ?>').countdown({
                    timestamp: ts,
                    callback: function (days, hours, minutes, seconds) {
                        var summaryTime = days + hours + minutes + seconds;
                        if (summaryTime == 0) {
                            $('#countdown_<?php echo esc_attr($countdown); ?>').html('<div class="countdown_ended h2">' + timeUp + '</div>');
                        }
                    }
                });
            } else {
                $('#countdown_<?php echo esc_attr($countdown); ?>').html('<div class="countdown_ended h2">' + timeUp + '</div>');
            }
        });
    </script>
<?php endif; ?>

<?php if (!empty($label_color)): ?>
    <style>
        .stm_countdown .countdown_label {
            color: <?php echo esc_attr($label_color); ?> !important;
        }
    </style>
<?php endif; ?>
