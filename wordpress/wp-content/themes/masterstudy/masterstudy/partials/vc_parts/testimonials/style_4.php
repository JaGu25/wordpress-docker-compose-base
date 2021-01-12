<?php
$testimonials = new WP_Query(array('post_type' => 'testimonial', 'posts_per_page' => $testimonials_max_num));

$slide_col = $testimonials_slides_per_row;

wp_enqueue_script('owl.carousel');
wp_enqueue_style('owl.carousel');
stm_module_scripts('testimonials', $style);
stm_module_styles('testimonials', $style);

?>

<?php if ($testimonials->have_posts()):
    $testimonials_data = array();
    while ($testimonials->have_posts()): $testimonials->the_post();
        $testimonials_data[] = array(
            'title' => get_the_title(),
            'excerpt' => get_the_excerpt(),
            'user' => get_post_meta(get_the_ID(), 'testimonial_user', true),
            'image' => stm_get_VC_attachment_img_safe(get_post_thumbnail_id(), '100x100', 'thumbnail', true),
        );
    endwhile; ?>

    <div class="testimonials_main_wrapper simple_carousel_wrapper">

        <h2 class="testimonials_main_title text-center"><?php echo esc_attr($testimonials_title); ?></h2>

        <div class="stm_testimonials_wrapper_style_4" data-slides="<?php echo intval($slide_col); ?>">
            <?php foreach ($testimonials_data as $testimonial): ?>
                <div class="stm_testimonials_single">

                    <div class="testimonials_image">
                        <img src="<?php echo wp_kses_post($testimonial['image']); ?>"
                             title="<?php echo sanitize_text_field($testimonial['title']); ?>"/>
                    </div>

                    <div class="testimonials_excerpt">
                        <?php echo wp_kses_post($testimonial['excerpt']); ?>
                    </div>

                    <div class="testimonials-bottom">

                        <div class="stars">
                            <i class="fa fa-star"></i>
                        </div>

                        <div class="testimonials_title h3">
                            <?php echo sanitize_text_field($testimonial['user']); ?>
                        </div>

                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php wp_reset_postdata(); ?>

<?php endif; ?>
