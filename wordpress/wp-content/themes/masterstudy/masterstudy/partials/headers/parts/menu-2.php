<div class="header_main_menu_wrapper clearfix">

    <ul class="header-menu clearfix">
		<?php wp_nav_menu(array(
				'theme_location' => 'primary',
				'depth'          => 3,
				'container'      => false,
				'menu_class'     => 'header-menu clearfix',
				'items_wrap'     => '%3$s',
				'fallback_cb'    => false
			)
		); ?>
    </ul>

	<?php get_template_part('partials/headers/parts/wpml_flags'); ?>

</div>