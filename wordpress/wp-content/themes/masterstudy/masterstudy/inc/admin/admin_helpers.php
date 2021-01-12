<?php
function add_theme_caps()
{
	$admin_users = $instructors = [];
	$admin_users[] = get_role('administrator');
	$instructors[] = get_role('stm_lms_instructor');

	if (!empty($admin_users)) {
		foreach ($admin_users as $user) {
			if (empty($user)) {
				continue;
			}
			foreach (
				[
					'publish', 'delete', 'delete_others', 'delete_private', 'delete_published',
					'edit', 'edit_others', 'edit_private', 'edit_published', 'read_private',
				] as $cap
			) {
				$user->add_cap("{$cap}_stm_lms_posts");
			}
		}
	}

	if (!empty($instructors)) {
		foreach ($instructors as $user) {
			if (empty($user)) {
				continue;
			}
			$user->add_cap("edit_posts");
			foreach (['publish', 'delete', 'edit'] as $cap) {
				$user->add_cap("{$cap}_stm_lms_posts");
			}
		}
	}
}

add_action('init', 'add_theme_caps');

add_action('init', 'masterstudy_remove_woo_redirect', 10);

function masterstudy_remove_woo_redirect()
{
	delete_transient('_wc_activation_redirect');
}

remove_action('bp_admin_init', 'bp_do_activation_redirect', 1);
remove_action('admin_init', 'pmpro_admin_init_redirect_to_dashboard', 1);

add_action('admin_init', function () {
	if (defined('PMPRO_VERSION')) {
		$pmpro_dashboard_version = get_option('pmpro_dashboard_version', 0);
		if (version_compare($pmpro_dashboard_version, PMPRO_VERSION) < 0) {
			update_option('pmpro_dashboard_version', PMPRO_VERSION);
		}
	}
});