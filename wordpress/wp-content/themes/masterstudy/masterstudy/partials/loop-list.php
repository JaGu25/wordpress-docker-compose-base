<?php $blog_sidebar_pos = stm_option('blog_sidebar_position'); ?>
<div class="col-md-12">
    <div class="post_list_content_unit">
        <h2 class="post_list_item_title"><a href="<?php the_permalink() ?>"
                                            title="<?php esc_attr_e('View full', 'masterstudy') ?>"><?php esc_attr(the_title()); ?></a>
        </h2>
        <div class="post_list_meta_unit">
            <div class="date-d"><?php echo get_the_date('d'); ?></div>
            <div class="date-m"><?php echo get_the_date('M'); ?></div>
			<?php $comments_num = get_comments_number(get_the_id()); ?>
			<?php if ($comments_num): ?>
                <div class="post_list_comment_num">
                    <span><?php echo esc_attr($comments_num); ?></span><i class="fa-icon-stm_icon_comment_o"></i>
                </div>
			<?php endif; ?>
			<?php if (is_sticky(get_the_id())): ?>
                <div class="sticky_post heading_font"><?php _e('Sticky Post', 'masterstudy'); ?></div>
			<?php endif; ?>
        </div>
        <div class="post_list_inner_content_unit post_list_inner_content_unit_left">
			<?php if (has_post_thumbnail()): ?>
                <a href="<?php the_permalink() ?>" title="<?php esc_attr_e('Read more', 'masterstudy'); ?>">
                    <div class="post_list_featured_image">
						<?php if ($blog_sidebar_pos == 'none') {
							the_post_thumbnail('img-1100-450', array('class' => 'img-responsive'));
						} else {
							the_post_thumbnail('img-770-300', array('class' => 'img-responsive'));
						}
						?>
                    </div>
                </a>
			<?php endif; ?>

			<?php if (has_excerpt(get_the_id())): ?>
                <div class="post_list_item_excerpt"><?php echo get_the_excerpt(); ?></div>
			<?php endif; ?>

            <!-- Post cats -->
			<?php $post_list_item_categories = wp_get_post_categories(get_the_id());
			if (!empty($post_list_item_categories)): ?>
                <div class="post_list_cats">
                    <span class="post_list_cats_label"><?php _e('Posted in:', 'masterstudy'); ?></span>
					<?php foreach ($post_list_item_categories as $post_list_single_cat): ?>
						<?php $post_list_cat = get_category($post_list_single_cat); ?>
                        <a href="<?php echo esc_url(get_term_link($post_list_cat)); ?>">
							<?php echo sanitize_text_field($post_list_cat->name); ?>
                        </a><span class="post_list_divider">,</span>
					<?php endforeach; ?>
                </div>
			<?php endif; ?>

            <!-- Post tags -->
			<?php $posttags = get_the_tags();
			if ($posttags): ?>
                <div class="post_list_item_tags">
                    <span class="post_list_tags_label"><?php esc_html_e('Tags:', 'masterstudy'); ?></span>
					<?php foreach ($posttags as $tag): ?>
                        <a href="<?php echo get_tag_link($tag->term_id); ?>"><?php echo esc_attr($tag->name); ?></a><span
                                class="post_list_divider">,</span>
					<?php endforeach; ?>
                </div>
			<?php endif; ?>

            <div class="post_list_btn_more" <?php if (!has_excerpt()){ ?>style="margin-top:0;" <?php } ?>>
                <a href="<?php the_permalink() ?>" class="btn btn-default"
                   title="<?php _e('Read more', 'masterstudy'); ?>"><?php esc_attr_e('Read more', 'masterstudy'); ?></a>
            </div>
        </div>
    </div>
</div> <!-- col -->