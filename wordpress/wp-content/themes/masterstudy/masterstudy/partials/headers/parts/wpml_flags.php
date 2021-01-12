<?php
if (function_exists('icl_get_languages')):
	$langs = icl_get_languages('orderby=id&order=asc');
else :
	$langs = array();
endif;

$langs = apply_filters('stm_lms_wpml_switcher', $langs);

?>

<?php if (!empty($langs)): ?>
    <div class="language-switcher-unit">

		<?php foreach ($langs as $lang): ?>

            <div class="stm_lang">
                <a href="<?php echo esc_url($lang['url']) ?>">
                    <img src="<?php echo esc_url($lang['country_flag_url']) ?>"/>
                </a>
            </div>

		<?php endforeach; ?>

    </div>
<?php endif;