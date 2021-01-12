<?php global $stm_option;
$header_top_bar_color = stm_option('top_bar_color');
$socials = $stm_option['top_bar_use_social'];
if (empty($header_top_bar_color)) {
	$header_top_bar_color = '#333';
};

?>
<div class="header_top_bar" style="background-color:<?php echo sanitize_text_field($header_top_bar_color); ?>">
    <div class="container">
        <div class="clearfix">
			<?php if (stm_option('top_bar_wpml')): ?>
                <?php get_template_part('partials/headers/parts/wpml_switcher'); ?>
			<?php endif; ?>

            <!-- Header Top bar Login -->

			<?php if (stm_option('top_bar_login')): ?>
				<?php get_template_part('partials/headers/parts/woocommerce_login'); ?>
			<?php endif; ?>
            <!-- Header top bar Socials -->
			<?php if (!empty($socials) and stm_option('top_bar_social')): ?>
				<?php get_template_part('partials/headers/parts/socials'); ?>
			<?php endif; ?>

			<?php get_template_part('partials/headers/parts/data_info'); ?>


        </div>
    </div>
</div>