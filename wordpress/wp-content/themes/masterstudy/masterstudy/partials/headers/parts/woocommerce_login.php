<?php if(defined('STM_LMS_URL')): ?>
    <div class="pull-right">
        <div class="header_login_url">
			<?php if (is_user_logged_in()):
				$current_user = STM_LMS_User::get_current_user();
			    ?>

                <a href="<?php echo esc_url(STM_LMS_User::user_page_url($current_user['id'])) ?>">
                    <i class="fa fa-user"></i><?php echo esc_attr($current_user['login']); ?>
                </a>
                <span class="vertical_divider"></span>

                <a class="logout-link" href="<?php echo wp_logout_url('/'); ?>"
                   title="<?php esc_attr_e('Log out', 'masterstudy'); ?>">
					<?php _e('Log out', 'masterstudy'); ?>
                </a>
			<?php else: ?>
                <a href="<?php echo esc_url(STM_LMS_User::login_page_url()); ?>">
                    <i class="fa fa-user"></i><?php _e('Login', 'masterstudy'); ?>
                </a>
                <span class="vertical_divider"></span>
                <a href="<?php echo esc_url(STM_LMS_User::login_page_url()); ?>"><?php _e('Register', 'masterstudy'); ?></a>
			<?php endif; ?>
        </div>
    </div>
<?php elseif (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))) || (function_exists('is_plugin_active_for_network') && is_plugin_active_for_network('woocommerce/woocommerce.php'))): ?>
	<div class="pull-right">
		<div class="header_login_url">
			<?php if (is_user_logged_in()):
				$current_user = wp_get_current_user();
				if (!empty($current_user->user_login)):
					?>
					<a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>">
						<i class="fa fa-user"></i><?php echo esc_attr($current_user->user_login); ?>
					</a>
					<span class="vertical_divider"></span>
				<?php endif; ?>
				<a class="logout-link" href="<?php echo wp_logout_url('/'); ?>"
				   title="<?php esc_attr_e('Log out', 'masterstudy'); ?>">
					<?php _e('Log out', 'masterstudy'); ?>
				</a>
			<?php else: ?>
				<a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>">
					<i class="fa fa-user"></i><?php _e('Login', 'masterstudy'); ?>
				</a>
				<span class="vertical_divider"></span>
				<a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>"><?php _e('Register', 'masterstudy'); ?></a>
			<?php endif; ?>
		</div>
	</div>
<?php endif; ?>