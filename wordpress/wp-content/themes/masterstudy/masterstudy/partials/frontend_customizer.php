<div id="frontend_customizer" class="hidden-xs" style="left: -276px;">
    <div class="customizer_wrapper">

        <h3><?php _e('Header type', 'masterstudy'); ?></h3>
        <div class="customizer_element">
            <div class="stm_switcher" id="navigation_type">
                <div class="switcher_label disable"><?php _e('Static', 'masterstudy'); ?></div>
                <div class="switcher_nav"></div>
                <div class="switcher_label enable"><?php _e('Sticky', 'masterstudy'); ?></div>
            </div>
        </div>
        
        <?php if(is_front_page()): ?>
	        <h3><?php _e('Header transparency', 'masterstudy'); ?></h3>
	        <div class="customizer_element">
	            <div class="stm_switcher" id="navigation_transparency">
	                <div class="switcher_label switcher_label_on disable"><?php _e('On', 'masterstudy'); ?></div>
	                <div class="switcher_nav"></div>
	                <div class="switcher_label switcher_label_off enable"><?php _e('Off', 'masterstudy'); ?></div>
	            </div>
	        </div>
        <?php endif; ?>

        <h3><?php _e('Color Scheme', 'masterstudy'); ?></h3>
        <div class="customizer_element">
            <div class="customizer_colors" id="skin_color">
                <span id="skin_default" class="active" data-secondary="default"><img src="<?php echo esc_url( get_stylesheet_directory_uri() )  ?>/assets/img/tmp/yellow-blue.png" alt="<?php esc_attr_e('Default skin', 'masterstudy'); ?>"/></span>
                <span id="skin_red_green" data-secondary="green"><img src="<?php echo esc_url( get_stylesheet_directory_uri() )  ?>/assets/img/tmp/red-green.png" alt="<?php esc_attr_e('Red skin', 'masterstudy'); ?>"/></span>
                <span id="skin_blue_green" data-secondary="blue"><img src="<?php echo esc_url( get_stylesheet_directory_uri() )  ?>/assets/img/tmp/blue-green.png" alt="<?php esc_attr_e('Blue skin', 'masterstudy'); ?>"/></span>
                <span id="skin_red_brown" data-secondary="red"></span>
            </div>
        </div>
    </div>
    <div id="frontend_customizer_button"><i class="fa fa-cog"></i></div>
</div>

<script>
	var logos_url = '<?php echo esc_url( get_stylesheet_directory_uri() )  ?>/assets/img/tmp';
</script>