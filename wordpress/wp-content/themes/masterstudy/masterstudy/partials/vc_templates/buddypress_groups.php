<?php
/**
 * @var $css
 * @var $title
 */

if (function_exists('BuddyPress') and bp_is_active('groups')):
    stm_module_styles('buddypress_groups');
    stm_module_scripts('buddypress_groups');
    ?>

    <div class="stm_buddypress_groups">

        <div class="stm_buddypress_groups__heading">
            <?php if (!empty($title)): ?>
                <h2 class="stm_buddypress_groups__title"><?php echo sanitize_text_field($title); ?></h2>
            <?php endif; ?>
            <div class="stm_buddypress_groups__sort">
                <span class="stm_buddypress_groups__sort_label"><?php esc_html_e('Sort by: ', 'masterstudy'); ?></span>
                <select name="sort_by">
                    <option value="popular" selected><?php esc_html_e('Popular', 'masterstudy'); ?></option>
                    <option value="active"><?php esc_html_e('Active', 'masterstudy'); ?></option>
                    <option value="newest"><?php esc_html_e('Newest', 'masterstudy'); ?></option>
                    <option value="random"><?php esc_html_e('Random', 'masterstudy'); ?></option>
                </select>
            </div>
        </div>

        <div class="stm_buddypress_groups__list">
            <?php stm_get_buddypress_groups(); ?>
        </div>

    </div>

<?php endif;
