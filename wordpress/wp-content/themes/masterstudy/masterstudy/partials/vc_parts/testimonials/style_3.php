<?php
$testimonials = new WP_Query(array('post_type' => 'testimonial', 'posts_per_page' => $testimonials_max_num));

$slide_col = 12 / $testimonials_slides_per_row;

wp_enqueue_script('owl.carousel');
wp_enqueue_style('owl.carousel');
stm_module_scripts('testimonials', $style);
stm_module_styles('testimonials', $style);

?>

<?php if ($testimonials->have_posts()):
	$testimonials_data = array();
	while ($testimonials->have_posts()): $testimonials->the_post();
		$testimonials_data[] = array(
			'title'   => get_the_title(),
			'excerpt' => get_the_excerpt(),
			'image'   => stm_get_VC_attachment_img_safe(get_post_thumbnail_id(), '100x100', 'thumbnail', true),
		);
	endwhile; ?>

    <div class="testimonials_main_wrapper simple_carousel_wrapper">

        <div class="navs">
            <div class="testimonials_navigation">
                <div class="simple_carousel_prev"><i class="lnr lnr-arrow-left"></i></div>
                <div class="simple_carousel_next"><i class="lnr lnr-arrow-right"></i></div>
            </div>

            <ul id="carousel-custom-dots">
				<?php foreach ($testimonials_data as $testimonial): ?>
                    <li class="testinomials_dots_image">
                        <img src="<?php echo esc_url($testimonial['image']) ?>"/>
                    </li>
				<?php endforeach; ?>
            </ul>
        </div>

        <div class="stm_testimonials_wrapper_style_3">
			<?php foreach ($testimonials_data as $testimonial): ?>
                <div class="stm_testimonials_single">
                    <div class="testimonials_title h3">
						<?php echo sanitize_text_field($testimonial['title']); ?>
                    </div>
                    <div class="stars">
                        <i class="fa fa-star"></i>
                    </div>
                    <div class="testimonials_excerpt">
						<?php echo wp_kses_post($testimonial['excerpt']); ?>
                    </div>
                </div>
			<?php endforeach; ?>
        </div>

    </div>

	<?php wp_reset_postdata(); ?>

<?php endif; ?>
