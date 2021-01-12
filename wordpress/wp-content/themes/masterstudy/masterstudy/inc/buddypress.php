<?php

function stm_get_buddypress_groups($args = array())
{
    $default_args = array(
        'per_page' => 6,
        'type' => 'popular',
    );

    $args = wp_parse_args($args, $default_args);

    if (bp_has_groups($args)) {
        get_template_part('partials/buddypress/groups');
    }

}

add_action('wp_ajax_stm_load_buddypress_groups', 'stm_load_buddypress_groups');
add_action('wp_ajax_nopriv_stm_load_buddypress_groups', 'stm_load_buddypress_groups');

function stm_load_buddypress_groups()
{
    check_ajax_referer('stm_buddypress_groups', 'nonce');

    $sort = (!empty($_GET['sort'])) ? sanitize_text_field($_GET['sort']) : 'popular';

    ob_start();

    stm_get_buddypress_groups(array('type' => $sort));

    $content = ob_get_clean();

    wp_send_json(
        array(
            'html' => $content
        )
    );

}

function stm_get_buddypress_active_instructors($limit)
{

    global $wpdb;

    $prefix = $wpdb->prefix;
    $capabilities = "{$prefix}capabilities";

    $bp = buddypress();
    $table = $bp->activity->table_name;


    $request = "SELECT {$table}.user_id,
    COUNT({$table}.user_id) AS `value_occurrence` 
    FROM {$table}
    INNER JOIN wp_usermeta
    ON {$table}.user_id = wp_usermeta.user_id
    WHERE wp_usermeta.meta_key = '{$capabilities}' 
    AND wp_usermeta.meta_value LIKE '%stm_lms_instructor%'
    GROUP BY {$table}.user_id
    ORDER BY `value_occurrence` DESC
    LIMIT {$limit}";

    return $wpdb->get_results($request);

}

function stm_get_buddypress_instructors_list($limit = 10)
{

    $tpl_path = 'partials/buddypress/instructors-carousel/';

    $instructors = apply_filters('stm_get_buddypress_active_instructors', stm_get_buddypress_active_instructors($limit));

    if (!empty($instructors)) {
        get_template_part("{$tpl_path}instructors-start");

        if (apply_filters('stm_lms_show_defaults_instructors', true)) {
            foreach ($instructors as $instructor) {
                $instructor_id = $instructor->user_id;
                $activity_number = $instructor->value_occurrence;

                require get_template_directory() . "/{$tpl_path}instructor-single.php";
            }
        }

        do_action('masterstudy_instructors_before_end');

        get_template_part("{$tpl_path}instructors-end");
    }
}