<?php stm_module_scripts('header_js', 'header_2'); ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="header_top">

                <div class="logo-unit">
                    <?php get_template_part('partials/headers/parts/logo'); ?>
                </div>

                <div class="stm_lms_categories-courses__toggler mbc">
                    <i class="lnr lnr-magnifier"></i>
                </div>

                <div class="categories-courses">
					<?php get_template_part('partials/headers/parts/courses_categories_with_search'); ?>
                </div>

                <div class="stm_header_top_toggler mbc">
                    <i class="lnr lnr-user"></i>
                </div>

            </div>

        </div>
    </div>
</div>

<?php get_template_part('partials/headers/mobile/account'); ?>