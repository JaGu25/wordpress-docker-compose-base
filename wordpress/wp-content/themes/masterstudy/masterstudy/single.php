<?php get_header(); ?>
    <div class="stm_single_post">
		<?php if (have_posts()) :
			while (have_posts()) : the_post();
				get_template_part('partials/content');
			endwhile;
		endif; ?>
    </div>
<?php get_footer(); ?>