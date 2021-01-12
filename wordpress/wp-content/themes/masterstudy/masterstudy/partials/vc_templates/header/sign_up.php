<?php
/**
 * @var $css_class
 * @var $title
 */

stm_module_styles('headers', 'header_2');

$logged_in = is_user_logged_in();

if(!empty($_GET['action']) && $_GET['action'] === 'elementor') $logged_in = false;

if (!$logged_in) : ?>

    <div class="header_2">

        <div class="header_top">

            <div class="<?php echo esc_attr($css_class); ?>">

                <?php get_template_part('partials/headers/parts/sign-up', null, compact('title')); ?>

            </div>

        </div>

    </div>

<?php endif;