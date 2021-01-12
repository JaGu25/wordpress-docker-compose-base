<?php
/**
 * @var $css_class
 */
?>

<div class="stm_post_unit stm_post_unit_vc<?php echo esc_attr($css_class); ?>">
    <div class="stm_post_info">
		<h1 class="h2 post_title"><?php the_title(); ?></h1>
		<div class="stm_post_details clearfix">
			<ul class="clearfix post_meta">
				<li class="post_date h6"><i class="far fa-clock"></i><span><?php echo get_the_date(); ?></span></li>
				<li class="post_by h6"><i class="fa fa-user"></i><?php _e( 'Posted by:', 'masterstudy' ); ?> <span><?php the_author(); ?></span></li>
				<?php $cats = get_the_category( get_the_id() ); ?>
				<?php if(!empty($cats)): ?>
					<li class="post_cat h6"><i class="fa fa-flag"></i>
						<?php _e( 'Category:', 'masterstudy' ); ?>
						<?php foreach($cats as $cat): ?>
							<a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>">
                                <span><?php echo sanitize_text_field($cat->name); ?></span>
                            </a><span class="divider">,</span>
						<?php endforeach; ?>
					</li>
				<?php endif; ?>
			</ul>
			<div class="comments_num">
				<a href="<?php comments_link(); ?>" class="post_comments h6"><i class="fa fa-comments-o"></i> <?php comments_number(); ?> </a>
			</div>
		</div>
		<?php if( has_post_thumbnail() ){ ?>
			<div class="post_thumbnail">
				<?php the_post_thumbnail('img-1170-500', array('class'=>'img-responsive')); ?>
			</div>
		<?php } ?>
	</div>
</div> <!-- stm_post_unit -->
