<?php stm_module_styles('recent_posts_widget', 'style_2'); ?>

<a href="<?php the_permalink() ?>">
	<?php if(has_post_thumbnail()): ?>
		<?php the_post_thumbnail('img-75-75', array('class'=>'img-responsive')); ?>
	<?php endif; ?>
	<span class="h6"><?php the_title(); ?></span>
</a>

<div class="cats_w">
    <?php echo wp_kses_post(get_the_date(get_option('date_format'), get_the_ID())); ?>
</div>
