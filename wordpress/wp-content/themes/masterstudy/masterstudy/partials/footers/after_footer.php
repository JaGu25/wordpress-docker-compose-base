<?php if (is_singular('events')): ?>
    <?php get_template_part('partials/event', 'form'); ?>
<?php endif; ?>

    <!-- Searchform -->
<?php get_template_part('partials/searchform'); ?>

    <script>
        var cf7_custom_image = '<?php echo esc_url(get_stylesheet_directory_uri())  ?>/assets/img/';
        var daysStr = '<?php esc_html_e('Days', 'masterstudy'); ?>';
        var hoursStr = '<?php esc_html_e('Hours', 'masterstudy'); ?>';
        var minutesStr = '<?php esc_html_e('Minutes', 'masterstudy'); ?>';
        var secondsStr = '<?php esc_html_e('Seconds', 'masterstudy'); ?>';
    </script>

<?php
global $wp_customize;
if (is_stm() && !$wp_customize) {
    get_template_part('partials/frontend_customizer');
}
?>