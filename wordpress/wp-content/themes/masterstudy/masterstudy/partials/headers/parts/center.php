<?php if (stm_option('online_show_search', true)): ?>
    <div class="stm_courses_search">
		<?php get_template_part('partials/headers/parts/categories'); ?>
		<?php get_template_part('partials/headers/parts/courses-search'); ?>
    </div>
<?php endif; ?>

<?php if (stm_option('online_show_links', true)): ?>
    <div class="stm_header_links">
        <?php get_template_part('partials/headers/parts/links'); ?>
    </div>
<?php endif; ?>