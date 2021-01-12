<?php

// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}
$demos = array(
    'classic_lms' => array(
        'label' => esc_html__('Classic LMS', 'masterstudy'),
    ),
    'online-light' => array(
        'label' => esc_html__('LMS Light', 'masterstudy'),
    ),
    'udemy' => array(
        'label' => esc_html__('Udemy Affiliate', 'masterstudy'),
    ),
    'academy' => array(
        'label' => esc_html__('Academy', 'masterstudy'),
    ),
    'online-dark' => array(
        'label' => esc_html__('LMS Dark', 'masterstudy'),
    ),
    'default' => array(
        'label' => esc_html__('Offline Courses', 'masterstudy'),
    ),
    'course_hub' => array(
        'label' => esc_html__('Course Hub', 'masterstudy'),
    ),
    'single_instructor' => array(
        'label' => esc_html__('Private Instructor', 'masterstudy'),
    ),
    'language_center' => array(
        'label' => esc_html__('Language Center', 'masterstudy'),
    ),
    'rtl-demo' => array(
        'label' => esc_html__('RTL Demo', 'masterstudy'),
    ),
    'buddypress-demo' => array(
        'label' => esc_html__('BuddyPress Demo', 'masterstudy'),
    ),
    'classic-lms-2' => array(
        'label' => esc_html__('Classic LMS 2', 'masterstudy'),
    ),
    'distance-learning' => array(
        'label' => esc_html__('Distance Learning', 'masterstudy'),
    ),
);

$auth_code = stm_check_auth();
$plugins = stm_require_plugins(true);
$current_demo = get_option('stm_lms_layout', '');

?>
<div class="wrap about-wrap stm-admin-wrap  stm-admin-demos-screen">

    <?php stm_get_admin_tabs('demos'); ?>

    <?php if (!empty($auth_code)):
        ?>
        <div class="stm_demo_import_choices">
            <script>
                var stm_layouts = {};
            </script>
            <?php foreach ($demos as $demo_key => $demo_value): ?>
                <script>
                    stm_layouts['<?php echo esc_attr($demo_key); ?>'] = <?php echo json_encode(stm_layout_plugins($demo_key)); ?>;
                </script>
                <label class="<?php if ($demo_key == $current_demo) echo esc_attr('active'); ?>">
                    <div class="inner">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/inc/admin/product_registration/assets/img/layouts/' . $demo_key . '.jpg'); ?>"/>
                        <?php if ($demo_key == $current_demo): ?>
                            <div class="installed"><?php esc_html_e('Installed', 'masterstudy'); ?></div>
                        <?php else: ?>
                            <div class="install"
                                 data-name="<?php echo esc_attr($demo_value['label']); ?>"
                                 data-layout="<?php echo esc_attr($demo_key); ?>"><?php esc_html_e('Import', 'masterstudy'); ?></div>
                        <?php endif; ?>
                        <span class="stm_layout__label"><?php echo esc_attr($demo_value['label']); ?></span>
                    </div>
                </label>
            <?php endforeach; ?>
        </div>


        <div class="stm_install__demo_popup">
            <div class="stm_install__demo_popup_close"></div>

            <div class="inner">

                <?php if (!empty($current_demo) and $demos[$current_demo]):

                    $demo = $demos[$current_demo]['label'];

                    $wp_reset = "<a href='https://wordpress.org/plugins/wp-reset/'>" . esc_html__('WP Reset', 'masterstudy') . "</a>";
                    ?>

                    <div class="stm_install__demo_popup__alert">

                        <div>
                            <?php printf(esc_html__("The %s layout is already installed on the website.
                            Please reset your WordPress via the %s plugin to install another layout.
                            Please note, the resetting process removes all your current settings and data!", 'masterstudy'), $demo, $wp_reset); ?>
                        </div>

                        <span class="btn btn-default"
                           onclick="jQuery('.stm_install__demo_popup__alert').slideUp();"><?php esc_html_e('I understand', 'masterstudy'); ?></span>

                    </div>

                <?php endif; ?>

                <div class="choose_builder" style="display: none;">
                    <h4><?php esc_html_e('Choose Builder', 'masterstudy'); ?></h4>
                    <div class="stm_install__demo_popup_close"></div>
                    <div class="stm_plugins_status">
                        <?php require_once 'choose_plugin.php'; ?>
                    </div>
                </div>

                <div class="demo_install" style="display: none;">
                    <h4><?php esc_html_e('Demo Installation', 'masterstudy'); ?></h4>
                    <div class="stm_install__demo_popup_close"></div>
                    <div class="stm_plugins_status">
                        <?php foreach ($plugins as $plugin):
                            $active = (stm_check_plugin_active($plugin['slug'])) ? 'installed' : 'not-installed';
                            $active_text = ($active == 'installed') ? esc_html__('Installed & Activated', 'masterstudy') : esc_html__('Not installed', 'masterstudy');
                            ?>
                            <div id="<?php echo sanitize_text_field('stm_' . $plugin['slug']); ?>"
                                 class="stm_single_plugin_info <?php echo esc_attr($active); ?>"
                                 data-active="<?php echo esc_attr($active); ?>"
                                 data-slug="<?php echo sanitize_text_field($plugin['slug']); ?>">
                                <div class="image">
                                    <img
                                            src="<?php echo esc_url(get_template_directory_uri() . '/inc/admin/product_registration/assets/img/plugins/' . $plugin['slug'] . '.png'); ?>"/>
                                </div>
                                <div class="title"><?php echo sanitize_text_field($plugin['name']); ?></div>
                                <div class="status">
                                    <span><?php echo sanitize_text_field($active_text); ?></span>
                                    <div class="loading-dots"></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="stm_content_status">
                            <div class="image">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/inc/admin/product_registration/assets/img/plugins/demo.png'); ?>"/>
                            </div>
                            <div class="title"><?php esc_html_e('Demo content', 'masterstudy'); ?></div>
                            <div class="status"><span></span>
                                <div class="loading-dots"></div>
                            </div>
                        </div>
                    </div>
                    <div class="stm_install__demo_start"><?php esc_html_e('Setup Layout', 'masterstudy'); ?></div>
                </div>

            </div>
        </div>
    <?php else: ?>
        <div class="stm-admin-message">
            <?php printf(wp_kses_post(__('Please enter your Activation Token before running the MasterStudy.', 'masterstudy'))); ?>
        </div>
    <?php endif; ?>

</div>

<style type="text/css">
    .stm_install__demo_popup .inner {
        max-width: 720px;
        height: auto;
        max-height: 85vh;
        padding: 5px;
        width: auto;
        overflow-x: hidden;
    }
    .stm_install__demo_popup .inner .stm_content_status,
    .stm_install__demo_popup .inner .stm_plugins_status {
        display: flex;
        flex-wrap: wrap;
        flex-direction: row;
    }
    .choose_builder .choose_plugin__choices {
        display: flex!important;
        justify-content: center;
        width: 100%!important;
        padding: 30px 40px;
        border: 0;
        text-align: center;
    }
    .choose_builder .choose_plugin__choices .choose_plugin__choice {
        width: 40%!important;
        padding: 15px 30px 0;
        cursor: pointer;
        border-radius: 5px;
        transition: .3s ease;
    }
    .choose_builder .choose_plugin__choices .choose_plugin__choice img {
        width: 120px;
        margin: 0;
        height: auto;
        vertical-align: middle;
        border: 0;
    }
</style>

<script>
    (function ($) {
        var builder = 'js_composer';
        var plugins = <?php echo html_entity_decode(json_encode(wp_list_pluck($plugins, 'slug'))); ?>;
        var layout = 'default';
        var plugin = false;
        var layout_plugins = [];
        var installation = false;

        <?php if(!empty($_GET['layout_importing'])): ?>
        layout = '<?php echo esc_js($_GET['layout_importing']); ?>';
        <?php endif; ?>

        <?php if(!empty($_GET['builder'])): ?>
        builder = '<?php echo esc_js(sanitize_text_field($_GET['builder'])) ?>';
        if(builder === 'elementor') {
            layout_plugins.push('masterstudt-elementor-widgets');
        }
        <?php endif; ?>

        $(document).ready(function () {
            next_installable();
            show_popup();

            <?php if(!empty($_GET['layout_importing'])): ?>
            layout = '<?php echo esc_js($_GET['layout_importing']); ?>';
            $('.stm_demo_import_choices .install').click();
            setTimeout(function () {
                $('.stm_install__demo_popup .inner .stm_install__demo_start').click();
            }, 1000);

            <?php if(!empty($_GET['builder'])): ?>
            builder = '<?php echo esc_js(sanitize_text_field($_GET['builder'])) ?>';
            if (builder === 'elementor') {
                layout_plugins.push('masterstudt-elementor-widgets');
            }
            <?php endif; ?>

            window.history.pushState('', '', '<?php echo esc_url(remove_query_arg(array('layout_importing', 'builder'))) ?>');
            <?php endif; ?>

            $('.stm_install__demo_popup .inner .stm_install__demo_start').on('click', function (e) {
                e.preventDefault();

                if ($(this).attr('target') === '_blank') {
                    var win = window.open($(this).attr('href'), '_blank');
                    win.focus();

                    return;
                }

                if (!$(this).hasClass('installing')) {
                    next_installable();

                    if (!plugin) {
                        /*Plugins installed, Install demo*/
                        performAjax('import_demo');
                    } else {
                        /*Install plugin*/
                        performAjax(plugins[plugin]);
                    }

                    $('.stm_install__demo_popup .choose_builder').hide();
                    $('.stm_install__demo_popup .demo_install').show();
                }
            })

        });

        function performAjax(plugin_slug) {
            installation = true;
            var installing = "<?php esc_html_e('Installing', 'masterstudy'); ?>";
            var installed = "<?php esc_html_e('Installed & Activated', 'masterstudy'); ?>";
            var $current_plugin = $('#stm_' + plugin_slug);

            <?php if(!empty($_GET['layout_importing'])): ?>
            layout = '<?php echo esc_js($_GET['layout_importing']); ?>';
            <?php endif; ?>

            <?php if(!empty($_GET['builder'])): ?>
            builder = '<?php echo esc_js($_GET['builder']); ?>';
            if (builder === 'elementor') {
                layout_plugins.push('masterstudt-elementor-widgets');
            }
            <?php endif; ?>

            $.ajax({
                url: ajaxurl,
                dataType: 'json',
                context: this,
                data: {
                    'layout': layout,
                    'plugin': plugin_slug,
                    'action': 'masterstudy_install_plugin',
                    'security': stm_install_plugin,
                    'builder': builder
                },
                beforeSend: function () {
                    $current_plugin
                        .addClass('installing')
                        .find('.status > span').text(installing);
                    $('.stm_install__demo_popup .inner .stm_install__demo_start').addClass('installing');
                },
                complete: function (data) {
                    $current_plugin
                        .removeClass('installing')
                        .find('.status > span').html(installed).text();

                    var dt = data.responseJSON;
                    if (typeof dt.next !== 'undefined') {
                        plugin = dt.plugin_slug;
                        performAjax(dt.next);
                    }

                    if (typeof dt.activated !== 'undefined' && dt.activated) {
                        plugin = dt.plugin_slug;
                        $current_plugin.removeClass('.not-installed').addClass('installed').attr('data-active', 'installed');
                    }

                    if (typeof dt.import_demo !== 'undefined' && dt.import_demo) {
                        install_demo()
                    }
                },
                error: function () {
                    var new_params = '&layout_importing=' + layout + '&builder=' + builder;
                    window.location.href += new_params;
                }

            });
        }

        function install_demo() {
            installation = true;
            var importing_demo_text = "<?php esc_html_e('Importing Demo', 'masterstudy'); ?>";
            var imported_demo_text = "<?php esc_html_e('Imported', 'masterstudy'); ?>";

            <?php if(!empty($_GET['layout_importing'])): ?>
            layout = '<?php echo esc_js($_GET['layout_importing']); ?>';
            <?php endif; ?>

            <?php if(!empty($_GET['builder'])): ?>
            builder = '<?php echo esc_js($_GET['builder']); ?>';
            if (builder === 'elementor') {
                layout_plugins.push('masterstudt-elementor-widgets');
            }
            <?php endif; ?>

            $.ajax({
                url: ajaxurl,
                dataType: 'json',
                context: this,
                data: {
                    'demo_template': layout,
                    'builder': builder,
                    'action': 'stm_demo_import_content'
                },
                beforeSend: function () {
                    $('.stm_content_status').addClass('installing');
                    $('.stm_content_status .status > span').text(importing_demo_text);
                },
                complete: function (data) {
                    installation = false;
                    $('.stm_install__demo_popup .inner .stm_install__demo_start').removeClass('installing');
                    $('.stm_content_status').removeClass('installing').addClass('installed');
                    $('.stm_content_status .status > span').text(imported_demo_text);

                    var dt = data.responseJSON;
                    if (typeof dt.title !== 'undefined' && typeof dt.url !== 'undefined') {
                        var demo_start = '.stm_install__demo_popup .inner .stm_install__demo_start';
                        $(demo_start).text(dt.title);
                        $(demo_start).attr('href', dt.url);
                        $(demo_start).attr('target', '_blank');
                        $('<a class="stm_install_demo_to" href="' + dt.theme_options + '">' + dt.theme_options_title + '</a>').insertBefore(demo_start);
                    }

                }
            });
        }

        function show_popup() {
            $('.stm_demo_import_choices .install').on('click', function (e) {
                e.preventDefault();
                layout = $(this).attr('data-layout');

                <?php if(!empty($_GET['layout_importing'])): ?>
                layout = '<?php echo esc_js($_GET['layout_importing']); ?>';
                <?php endif; ?>

                hide_plugins(layout);
                $('.stm_install__demo_popup').addClass('active');
                $('.stm_install__demo_popup .demo_install').hide();
                $('.stm_install__demo_popup .choose_builder').show();
            });

            $('.stm_install__demo_popup_close').on('click', function (e) {
                e.preventDefault();
                if (!installation) {
                    $('.stm_install__demo_popup').removeClass('active');
                }
            });
        }

        $('.choose_plugin__choice').on('click', function (e) {
            e.preventDefault();

            $('.stm_install__demo_popup .choose_builder').hide();
            $('.stm_install__demo_popup .demo_install').show();

            builder = $(this).attr('data-builder');

            layout_plugins.push(builder);
            if (builder === 'elementor') {
                layout_plugins.push('masterstudt-elementor-widgets');

                var index_1 = layout_plugins.indexOf('js_composer');
                if(index_1 != -1) {
                    layout_plugins.splice(index_1, 1);
                }

            } else {
                var index_1 = layout_plugins.indexOf('elementor');
                var index_2 = layout_plugins.indexOf('masterstudt-elementor-widgets');
                if(index_1 != -1) {
                    layout_plugins.splice(index_1, 1);
                }
                if(index_2 != -1) {
                    layout_plugins.splice(index_2, 1);
                }
            }

            next_installable();
            hide_plugins(layout);

        });

        function next_installable() {
            $('.stm_single_plugin_info').each(function () {
                var active = $(this).attr('data-active');
                var currentPlugin = $(this).attr('data-slug');
                if (active == 'not-installed' && !plugin && layout_plugins.indexOf(currentPlugin) !== -1) plugin = currentPlugin;
            });
        }

        function hide_plugins(layout) {
            layout_plugins = stm_layouts[layout];

            $('.stm_single_plugin_info').each(function () {
                var plugin_slug = $(this).attr('data-slug');
                if(plugin_slug !== builder) {
                    if (layout_plugins.indexOf(plugin_slug) === -1) {
                        $(this).hide();
                    } else {
                        $(this).show();
                    }
                } else {
                    $(this).show();
                }

                if(builder == 'elementor' && plugin_slug == 'masterstudy-elementor-widgets') {
                    $(this).show();
                }
            });
        }

    })(jQuery);
</script>
