<?php

$langs = apply_filters('wpml_active_languages', NULL, 'skip_missing=0&orderby=id&order=asc');

if (empty($langs)) $langs = array();

?>

<?php if (!empty($langs)):

    if (count($langs) > 1) {
        $langs_exist = 'dropdown_toggle';
    } else {
        $langs_exist = 'no_other_langs';
    }

    ?>
    <div class="pull-left language-switcher-unit">
        <div class="stm_current_language <?php echo esc_attr($langs_exist); ?>" <?php if ($langs_exist == 'dropdown_toggle') { ?> id="lang_dropdown" data-toggle="dropdown" <?php } ?>>
            <?php echo esc_attr(ICL_LANGUAGE_NAME); ?>
            <?php if ($langs_exist == 'dropdown_toggle') { ?><i class="fa fa-chevron-down"></i><?php } ?>
        </div>
        <?php if ($langs_exist == 'dropdown_toggle'): ?>
            <ul class="dropdown-menu lang_dropdown_menu" role="menu" aria-labelledby="lang_dropdown">
                <?php foreach ($langs as $lang): ?>
                    <?php if (!$lang['active']): ?>
                        <li role="presentation">
                            <a role="menuitem" tabindex="-1"
                               href="<?php echo esc_attr($lang['url']); ?>"><?php echo esc_attr($lang['native_name']); ?></a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
<?php else: ?>
    <div class="pull-left">
        <ul class="top_bar_info clearfix">
            <li class="hidden-info"><?php esc_html_e('English', 'masterstudy'); ?></li>
        </ul>
    </div>
<?php endif; ?>
