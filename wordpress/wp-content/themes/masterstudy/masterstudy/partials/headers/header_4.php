<?php stm_module_scripts('header_js', 'header_2'); ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="header_top">

                <div class="header_top_socials">
					<?php if (stm_option('header_4_show_socials') and stm_option('top_bar_social')): ?>
						<?php get_template_part('partials/headers/parts/socials'); ?>
					<?php endif; ?>
                </div>

                <div class="logo-unit">
					<?php get_template_part('partials/headers/parts/logo'); ?>
                    <div class="stm_menu_toggler" data-text="<?php esc_html_e('Menu', 'masterstudy'); ?>"></div>
                </div>

                <div class="header_top_phone">
					<?php get_template_part('partials/headers/parts/phone'); ?>
                </div>

            </div>

            <div class="header_bottom stm_lms_menu_popup">
				<?php get_template_part('partials/headers/parts/menu-2'); ?>
            </div>

        </div>
    </div>
</div>