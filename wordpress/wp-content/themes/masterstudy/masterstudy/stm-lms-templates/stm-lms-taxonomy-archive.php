<?php get_header(); ?>

<?php $courses_page = STM_LMS_Options::courses_page();
if (empty($courses_page) or !is_page($courses_page)): ?>
	<?php get_template_part('partials/title_box'); ?>
<?php endif; ?>

    <div class="stm-lms-wrapper">
        <div class="container">
			<?php STM_LMS_Templates::show_lms_template('courses_taxonomy/archive'); ?>
        </div>
    </div>

<?php get_footer(); ?>