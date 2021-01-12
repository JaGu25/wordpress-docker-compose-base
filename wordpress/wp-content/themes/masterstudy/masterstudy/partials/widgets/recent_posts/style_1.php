<a href="<?php the_permalink() ?>">
	<?php if(has_post_thumbnail()): ?>
		<?php the_post_thumbnail('img-63-50', array('class'=>'img-responsive')); ?>
	<?php endif; ?>
	<span class="h6"><?php the_title(); ?></span>
</a>
<?php $cats = get_the_category( get_the_id() ); ?>
<?php if(!empty($cats)): ?>
	<div class="cats_w">
		<?php foreach($cats as $cat): ?>
			<a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>">
                <?php echo sanitize_text_field($cat->name); ?>
            </a><span class="comma">,</span>
		<?php endforeach; ?>
	</div>
<?php endif; ?>