<?php $terms = (get_the_terms(get_the_ID(), 'gallery_category')); ?>
<div class="col-md-3 col-sm-4 col-xs-6 stm-isotope-item teacher-col gallery-col all <?php if (!empty($terms)): foreach ($terms as $term): echo esc_attr($term->slug) . ' '; endforeach; endif; ?>">

	<?php if (has_post_thumbnail()): ?>
        <div class="gallery_single_view">
            <div class="gallery_img">
				<?php $url_big = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'full'); ?>
                <a class="stm_fancybox"
                   href="<?php echo esc_url($url_big[0]); ?>"
                   title="<?php _e('Watch full image', 'masterstudy'); ?>"
                   data-caption="<?php the_title(); ?>"
                   rel="gallery_rel">
					<?php the_post_thumbnail('img-270-180', array('class' => 'img-responsive')); ?>
                </a>
            </div>
        </div>
	<?php endif; ?>

</div>